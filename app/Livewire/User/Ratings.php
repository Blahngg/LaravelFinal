<?php

namespace App\Livewire\User;

use App\Models\Music;
use App\Models\Rating;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.user')]
class Ratings extends Component
{
    use WithPagination;
    public $music;
    public $filter;
    public $showReviewModal = false;
    public $showEditModal = false;
    public $ratingModel;
    public $rating;
    public $review;
    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    public function updatingFilter()
    {
        $this->resetPage(); // reset pagination when filter changes
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openReviewModal($id)
    {
        $rating = Rating::findOrFail($id);

        $this->rating = $rating->rating;
        $this->review = $rating->review;

        $this->showReviewModal = true;
    }

    public function closeReviewModal()
    {
        $this->reset(['rating', 'review']);

        $this->showReviewModal = false;
    }
    public function openEditModal($id)
    {
        $rating = Rating::findOrFail($id);

        $this->music = Music::findOrFail($rating->music_id);
        $this->ratingModel = $rating;
        $this->rating = $rating->rating;
        $this->review = $rating->review;

        $this->showEditModal = true;
    }

    public function closeEditModal()
    {
        $this->reset(['music', 'ratingModel', 'rating', 'review']);

        $this->showEditModal = false;
    }
    public function updateRating()
    {

        if(!Auth::check())
        {
            return to_route('login');
        }

        $hasReview = $this->music->ratings()
            ->where('user_id', Auth::id())
            ->exists();

        if($hasReview)
        {
            $validated = $this->validate([
                'rating' => 'between:1,5|integer',
                'review' => 'nullable'
            ]);

            DB::beginTransaction();
            try{
                $this->ratingModel->update($validated);
                DB::commit();
                $this->reset(['rating', 'review']);
                $this->showEditModal = false;
                $this->dispatch('rating-updated');
            }catch(Exception $e){
                DB::rollBack();
                dd($e);
            }
        } 
        else
        {
            $this->dispatch('rating-update-failed');
        }
    }

    public function deleteRating($id){
        DB::beginTransaction();
        try{
            $rating = Rating::findOrFail($id);
            $rating->delete();
            DB::commit();
            $this->dispatch('rating-deleted');
        }catch(Exception $e){
            DB::rollBack();
            $this->dispatch('rating-delete-failed');
        }
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            // Toggle direction if sorting the same column
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            // Sort by a new column
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        $ratingsQuery = User::findOrFail(Auth::id())->ratings()
            ->join('music', 'ratings.music_id', '=', 'music.id')
            ->select('ratings.*')
            ->with('music');

        if($this->filter){
            $ratingsQuery->where('rating', $this->filter);
        }

        $ratings = $ratingsQuery
            ->where(function ($query) {
                $query->where('music.title', 'like', '%' . $this->search . '%')
                    ->orWhere('music.artist', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.pages.user.ratings')
            ->with(compact('ratings'));
    }
}
