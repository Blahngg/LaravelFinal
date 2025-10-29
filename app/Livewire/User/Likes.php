<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.user')]
class Likes extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    public function updatingSearch()
    {
        $this->resetPage(); 
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
        $likes = User::findOrFail(Auth::id())
            ->likes()
            ->where(function ($query) {
                $query->where('title', 'like', '%'.$this->search.'%')
                    ->orWhere('artist', 'like', '%'.$this->search.'%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.pages.user.likes')
            ->with(compact('likes'));
    }
}
