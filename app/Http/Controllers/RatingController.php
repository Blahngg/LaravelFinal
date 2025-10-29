<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('rating.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rating.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'music_id' => 'required|exists:music,id',
            'rating' => 'required|integer',
            'review' => 'nullable'
        ]);
        $validated['user_id'] = 1;

        DB::beginTransaction();
        try{
            Rating::create($validated);
            DB::commit();
            return to_route('music.show', $validated['music_id']);
        }catch(Exception $e){
            DB::rollBack();
            dd($e);
        } 
    }

    /**
     * Display the specified resource.
     */
    public function show(Rating $rating)
    {
        return view('rating.show')
            ->with(compact('rating'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rating $rating)
    {
        return view('rating.edit')
            ->with(compact('rating'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rating $rating)
    {
        $validated = $request->validate([
            'music_id' => 'required|exists:music,id',
            'rating' => 'required|integer',
            'review' => 'nullable'
        ]);

        DB::beginTransaction();
        try{
            $rating->update($validated);
            DB::commit();
            return to_route('music.show', $validated['music_id']);
        }catch(Exception $e){
            DB::rollBack();
            dd($e);
        } 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating)
    {
       DB::beginTransaction();
        try{
            $rating->delete();
            DB::commit();
            return to_route('music.show', $rating->music_id);
        }catch(Exception $e){
            DB::rollBack();
            dd($e);
        } 
    }
}
