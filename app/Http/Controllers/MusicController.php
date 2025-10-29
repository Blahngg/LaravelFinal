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
        $musics = Music::limit(4)->get();

        return view('index')
            ->with(compact('musics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('music.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'artist' => 'required',
            'image' => 'required|image',
            'audio' => 'required|mimes:wav,mpeg'
        ]);

        DB::beginTransaction();
        try{
            $validated['image'] = $request->file('image')->store('music_images', 'public');
            $validated['audio'] = $request->file('audio')->store('music_audios', 'public');
            Music::create($validated);
            DB::commit();
            return to_route('music.index');
        }catch(Exception $e){
            DB::rollBack();
            dd($e);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Music $music)
    {
        $ratings = $music->ratings;

        return view('music.show')
            ->with(compact('music', 'ratings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Music $music)
    {
        return view('music.edit')
            ->with(compact('music'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Music $music)
    {
        $validated = $request->validate([
            'title' => 'required',
            'artist' => 'required',
            'image' => 'nullable|image',
            'audio' => 'nullable|mimes:wav,mpeg'
        ]);

        DB::beginTransaction();
        try{

            if ($request->hasFile("image")) {
                if($request->image && Storage::disk("public")->exists($music->image)){
                    Storage::disk("public")->delete($music->image);
                }
                $validated["image"] = $request->file("image")->store("music_images","public");
            }
            if ($request->hasFile("audio")) {
                if($request->audio && Storage::disk("public")->exists($music->audio)){
                    Storage::disk("public")->delete($music->audio);
                }
                $validated['audio'] = $request->file('audio')->store('music_audios', 'public');
            }

            $music->update($validated);
            DB::commit();
            return to_route('music.index');
        }catch(Exception $e){
            DB::rollBack();
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Music $music)
    {
        DB::beginTransaction();
        try{
            Storage::disk("public")->delete($music->image);
            Storage::disk("public")->delete($music->audio);
            $music->delete();
            DB::commit();
            return to_route('music.index');
        }catch(Exception $e){
            DB::rollBack();
            dd($e);
        }

    }
}
