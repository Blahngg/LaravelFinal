<?php

namespace App\Livewire\Music;

use App\Models\Music;
use App\Models\Rating;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class MusicData extends Component
{
    use WithPagination;
    public $music;
    public $search = '';
    public $filter;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    public function mount(Music $music){
        $this->music = $music;
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

    public function delete($id){
        DB::beginTransaction();
        try{
            $rating = Rating::findOrFail($id);
            $rating->delete();
            DB::commit();
            $this->dispatch('music-deleted');
        }catch(Exception $e){
            DB::rollBack();
        }
    }

    public function render()
    {
        $music = $this->music;

        $ratingsQuery = $this->music->ratings();

        if($this->filter){
            $ratingsQuery->where('rating', $this->filter);
        }

        $ratingsQuery->where('user_id', 'like', '%'. $this->search.'%')
            ->orderBy($this->sortField, $this->sortDirection);

        $ratings = $ratingsQuery->paginate(10);
        

        return view('livewire.pages.music.music-data')
            ->with(compact('music', 'ratings'));
    }
}
