<?php

namespace App\Livewire\User;

use App\Models\Music;
use App\Models\Playlist;
use App\Models\Rating;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.user')]
class MusicData extends Component
{
    use WithPagination;
    public $music;
    public $filter;
    public $showRatingModal = false;
    public $showPlaylistModal = false;
    public $rating;
    public $review;
    public $liked = false;

    public function mount(Music $music){
        $this->music = $music;
        $this->liked = Auth::user()
            ? Auth::user()->likes->contains($music->id)
            : false;
    }

    public function toggleLike()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $user->likes()->toggle($this->music->id);

        // Refresh liked status
        $this->liked = $user->likes->contains($this->music->id);
    }

    public function openRatingModal()
    {
        $this->showRatingModal = true;
    }

    public function closeRatingModal()
    {
        $this->showRatingModal = false;
    }
    public function openPlaylistModal()
    {
        $this->showPlaylistModal = true;
    }

    public function closePlaylistModal()
    {
        $this->showPlaylistModal = false;
    }

    public function saveRating()
    {

        if(!Auth::check())
        {
            return to_route('login');
        }

        $hasReview = $this->music->ratings()
            ->where('user_id', Auth::id())
            ->exists();

        if(!$hasReview)
        {
            $validated = $this->validate([
                'rating' => 'between:1,5|integer',
                'review' => 'nullable'
            ]);

            DB::beginTransaction();
            try{
                $validated['music_id'] = $this->music->id;
                $validated['user_id'] = Auth::id();
                Rating::create($validated);
                DB::commit();
                $this->reset(['rating', 'review']);
                $this->showRatingModal = false;
                $this->dispatch('rating-created');
            }catch(Exception $e){
                DB::rollBack();
            }
        } 
        else
        {
            $this->dispatch('rating-failed');
        }
    }

    public function newPlaylist()
    {
        if(!Auth::check())
        {
            return to_route('login');
        }

        DB::beginTransaction();
        try{
            $data = [
                'user_id' => Auth::id(),
                'title' => $this->music->title
            ];

            $image = 'playlist_images/' . basename($this->music->image);
            Storage::disk('public')
                ->copy($this->music->image, $image);
            $data['image'] = $image;
            $playlist = Playlist::create($data);
            $playlist->musics()->attach($this->music->id);
            DB::commit();
            $this->showPlaylistModal = false;
            $this->dispatch('playlist-created');
        }catch(Exception $e){
            dd($e);
            $this->dispatch('playlist-failed');
        }
    }
    

    public function addToPlaylist($id)
    {
        if(!Auth::check())
        {
            return to_route('login');
        }

        Db::beginTransaction();
        try{
            $playlist = Playlist::findOrFail($id);
            $playlist->musics()->attach($this->music->id);
            DB::commit();
            $this->dispatch('added-to-playlist');
        }catch(Exception $e){
            Db::rollBack();
            $this->dispatch('error-adding-to-playlist');
        }
    }


    public function render()
    {
        $music = $this->music;

        $ratingsQuery = $this->music->ratings();

        $playlists = User::findOrFail(Auth::id())->playlists;

        $averageRating = $music->ratings()->avg('rating');

        if($this->filter){
            $ratingsQuery->where('rating', $this->filter);
        }

        $ratings = $ratingsQuery->paginate(10);
        

        return view('livewire.pages.user.music-data')
            ->with(compact('music', 'ratings', 'playlists', 'averageRating'));
    }
}
