<?php

namespace App\Livewire\User;

use App\Models\Playlist;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('layouts.user')]
class PlaylistView extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $playlist;
    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $showEditModal = false;
    public $image;
    public $playlistImage;
    public $title;
    public $description;

    public function mount(Playlist $playlist)
    {
        $this->playlist = $playlist;
        $this->playlistImage = $playlist->image;
        $this->title = $playlist->title;
        $this->description = $playlist->description;
    }

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

    public function openEditModal(){
        $this->showEditModal = true;
    }

    public function closeEditModal(){
        $this->showEditModal = false;
    }

    public function updatePlaylist(){
        if(!Auth::check())
        {
            return to_route('login');
        }

        DB::beginTransaction();
        try{
            $validated = $this->validate([
                'title' => 'required',
                'description' => 'nullable',
                'image' => 'nullable|image',
            ]);

            if ($this->image) {
                if($this->playlist->image && Storage::disk("public")->exists($this->playlist->image)){
                    Storage::disk("public")->delete($this->playlist->image);
                }
                $validated["image"] = $this->image->store("playlist_images","public");
            }
            else{
                unset($validated['image']);
            }

            $this->playlist->update($validated);
            DB::commit();
            $this->showEditModal = false;
            $this->dispatch('playlist-updated');
        }catch(Exception $e){
            dd($e);
            $this->dispatch('playlist-update-failed');
        }
    }

    public function deletePlaylist(){
        if(Auth::check()){
            DB::beginTransaction();
            try{
                $this->playlist->delete();
                DB::commit();
                return to_route('playlist');
            }catch(Exception $e){
                $this->dispatch('playlist-delete-failed');
            }
        }
        
    }
    
    public function render()
    {
        $musics = $this->playlist
            ->musics()
            ->where(function (Builder $query) {
                return $query->where('title', 'like', '%'.$this->search.'%')
                    ->orWhere('artist', 'like', '%'.$this->search.'%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);
;

        return view('livewire.pages.user.playlist-view')
            ->with(compact('musics'));
    }
}
