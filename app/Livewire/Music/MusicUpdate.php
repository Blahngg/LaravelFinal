<?php

namespace App\Livewire\Music;

use App\Models\Genre;
use App\Models\Music;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]
class MusicUpdate extends Component
{
    use WithFileUploads;

    public $music;
    public $title;
    public $artist;
    public $image;
    public $musicImage;
    public $audio;
    public $selectedGenres = [];

    public function mount(Music $music){
        $this->music = $music;
        $this->title = $music->title;
        $this->artist = $music->artist;
        $this->musicImage = $music->image;
        $this->selectedGenres = $music->genres()->pluck('genres.id')->toArray();
    }

    public function update(){
        $validated = $this->validate([
            'title' => 'required',
            'artist' => 'required',
            'image' => 'nullable|image',
            'audio' => 'nullable|mimes:wav,mpeg',
            'selectedGenres' => 'exists:genres,id'
        ]);

        DB::beginTransaction();
        try{

            if ($this->image) {
                if($this->music->image && Storage::disk("public")->exists($this->music->image)){
                    Storage::disk("public")->delete($this->music->image);
                }
                $validated["image"] = $this->image->store("music_images","public");
            }
            else{
                unset($validated['image']);
            }

            if ($this->audio) {
                if($this->music->audio && Storage::disk("public")->exists($this->music->audio)){
                    Storage::disk("public")->delete($this->music->audio);
                }
                $validated['audio'] = $this->audio->store('music_audios', 'public');
            }
            else{
                unset($validated['audio']);
            }

            $this->music->update($validated);
            $this->music->genres()->sync($validated['selectedGenres']);
            DB::commit();
            $this->dispatch('music-updated');
        }catch(Exception $e){
            DB::rollBack();
            dd($e);
        }
    }
    public function render()
    {
        $genres = Genre::all();

        return view('livewire.pages.music.music-update')
            ->with(compact('genres'));
    }
}
