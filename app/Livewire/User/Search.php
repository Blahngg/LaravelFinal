<?php

namespace App\Livewire\User;

use App\Models\Music;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.user')]
class Search extends Component
{
    use WithPagination;
    public $music;
    public $similarMusic;
    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $searchFilter = 'title';
    public $searchFilterName = 'Title';
    public $showSearchFilter = false;
    public $showSearchResults = false;

    public function toggleSearchFilter(){
        if($this->showSearchFilter){
            $this->showSearchFilter = false;
        }
        else{
            $this->showSearchFilter = true;
        }
    }
    public function focus()
    {
        $this->showSearchResults = true;
    }

    public function blur()
    {
        // small delay to allow clicks on results before hiding
        usleep(100000); // 200ms
        $this->showSearchResults = false;
    }

    public function changeSearchFilter($filter, $filterName){
        $this->searchFilter = $filter;
        $this->searchFilterName = $filterName;
    }

    public function findSimilarSong(Music $music){

        // Get the genre IDs of that song
        $genreIds = $music->genres->pluck('id');

        $this->music = $music;

        $this->similarMusic = Music::whereHas('genres', function ($query) use ($genreIds) {
            $query->whereIn('genres.id', $genreIds);
        })
        ->where('id', '!=', $music->id)
        ->inRandomOrder()
        ->take(5)
        ->get();

        dd($this->similarMusic);
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
        $musics = collect();
        $results = collect();
        $musicData = $this->music ?? collect();

        if($this->searchFilter === 'title' && strlen($this->search) > 0){
            $musics = Music::
                where('title', 'like', '%'.$this->search.'%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10);
        }
        elseif($this->searchFilter === 'artist' && strlen($this->search) > 0){
            $musics = Music::
                where('artist', 'like', '%'.$this->search.'%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10);
        }
        elseif($this->searchFilter === 'similar' && strlen($this->search) > 0){
            $results = Music::
                where('title', 'like', '%'.$this->search.'%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10);
        }

        if($this->similarMusic){
            $musics = $this->similarMusic;
        }

        return view('livewire.pages.user.search')
            ->with(compact('musics', 'results', 'musicData'));
    }
}
