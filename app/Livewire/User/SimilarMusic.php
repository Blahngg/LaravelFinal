<?php

namespace App\Livewire\User;

use App\Models\Music;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.user')]
class SimilarMusic extends Component
{
    use WithPagination;
    public $music;
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
    public function render()
    {
        $genreIds = $this->music->genres->pluck('id');
        $music = $this->music;

        $musics = $this->music->whereHas('genres', function ($query) use ($genreIds) {
            $query->whereIn('genres.id', $genreIds);
        })
        ->where('id', '!=', $this->music->id)
        ->inRandomOrder()
        ->take(5)
        ->get();

        return view('livewire.pages.user.similar-music')
            ->with(compact('musics', 'music'));
    }
}
