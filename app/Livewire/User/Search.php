<?php

namespace App\Livewire\User;

use App\Models\Genre;
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
    public $selectedGenres = [];
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

    public function changeSearchFilter($filter, $filterName){
        $this->searchFilter = $filter;
        $this->searchFilterName = $filterName;
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
        $musics = Music::query();
        $results = collect();
        $musicData = $this->music ?? collect();
        $genres = Genre::all();

        if($this->searchFilter === 'title' && strlen($this->search) > 0){
            $musics->where('title', 'like', '%'.$this->search.'%');
        }
        elseif($this->searchFilter === 'artist' && strlen($this->search) > 0){
            $musics->where('artist', 'like', '%'.$this->search.'%');
        }

        if (!empty($this->selectedGenres)) {
            $musics->whereHas('genres', function ($query) {
                $query->whereIn('genres.id', $this->selectedGenres);
            });
        }

        $musics = $musics->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10);

        return view('livewire.pages.user.search')
            ->with(compact('musics', 'results', 'musicData', 'genres'));
    }
}
