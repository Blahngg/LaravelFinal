<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $top = Music::orderBy('listens', 'asc')
            ->limit(4)
            ->get();
            
        
        $rated = Music::withAvg('ratings', 'rating')
                ->orderBy('ratings_avg_rating', 'asc')
                ->limit(4)
                ->get();

        return view('index')
            ->with(compact('top', 'rated'));
    }

    public function topSongs(){
        $musics = Music::orderBy('listens', 'asc')
            ->limit(10)
            ->get();

        $title = 'Popular Songs';

        return view('top-page')
            ->with(compact('musics', 'title'));
    }

    public function topRatedSongs(){
        $musics = Music::withAvg('ratings', 'rating')
            ->orderBy('ratings_avg_rating', 'asc')
            ->limit(10)
            ->get();

        $title = 'Top Rated Songs';

        return view('top-page')
            ->with(compact('musics', 'title'));
    }
}
