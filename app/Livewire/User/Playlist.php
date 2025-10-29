<?php

namespace App\Livewire\User;

use App\Models\Playlist as ModelsPlaylist;
use App\Models\User;
use Illuminate\Foundation\Console\InteractsWithComposerPackages;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.user')]
class Playlist extends Component
{
    use WithPagination;

    public $toggleFilterDropdown = false;
    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $sortName = 'Recently Added';

    public function openFilterDropdown(){
        if($this->toggleFilterDropdown){
            $this->toggleFilterDropdown = false;
        }
        else{
            $this->toggleFilterDropdown = true;
        }
    }

    public function sortBy($field, $name)
    {
        if ($this->sortField === $field) {
            // Toggle direction if sorting the same column
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            // Sort by a new column
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $this->sortName = $name;
    }

    public function render()
    {
        $playlists = User::find(Auth::id())
            ->playlists()
            ->where('title', 'like', '%'. $this->search.'%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.pages.user.playlist')
            ->with(compact('playlists'));
    }
}
