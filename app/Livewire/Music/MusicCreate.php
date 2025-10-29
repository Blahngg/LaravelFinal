<?php

namespace App\Livewire\Music;

use App\Models\Genre;
use App\Models\Music;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Features\SupportFileUploads\WithFileUploads;

#[Layout('layouts.app')]
class MusicCreate extends Component
{
    use WithFileUploads;

    public $title;
    public $artist;
    public $image;
    public $audio;
    public $selectedGenres = [];

    public function save(){
        $validated = $this->validate([
            'title' => 'required',
            'artist' => 'required',
            'image' => 'required|image',
            'audio' => 'required|mimes:wav,mpeg',
            'selectedGenres' => 'exists:genres,id'
        ]);

        DB::beginTransaction();
        try{
            $validated['image'] = $this->image->store('music_images', 'public');
            $validated['audio'] = $this->audio->store('music_audios', 'public');
            $music = Music::create($validated);
            $music->genres()->attach($validated['selectedGenres']);
            DB::commit();
            $this->reset(['title', 'artist', 'image', 'audio', 'selectedGenres']);
            $this->dispatch('music-created');
        }catch(Exception $e){
            DB::rollBack();
            dd($e);
        }
    }

    public function clearFields(){
        $this->reset(['title', 'artist', 'image', 'audio']);
    }

    public function render()
    {
        $genres = Genre::all();

        return view('livewire.pages.music.music-create')
            ->with(compact('genres'));
    }
}
