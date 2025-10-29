<?php

namespace App\Livewire\Music;

use App\Models\Music;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class MusicList extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    public function updatingFilter()
    {
        $this->resetPage(); // reset pagination when filter changes
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
            $music = Music::findOrFail($id);
            Storage::disk("public")->delete($music->image);
            Storage::disk("public")->delete($music->audio);
            $music->delete();
            DB::commit();
            $this->dispatch('music-deleted');
        }catch(Exception $e){
            DB::rollBack();
        }
    }
    public function render()
    {

        $musics = Music::query()
            ->where('title', 'like', '%'. $this->search.'%')
            ->orWhere('artist', 'like', '%'. $this->search.'%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.pages.music.music-list')
            ->with(compact('musics'));
    }
}
