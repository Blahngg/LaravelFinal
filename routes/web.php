<?php

use App\Http\Controllers\MusicController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\Socialite\ProviderCallbackController;
use App\Http\Controllers\Socialite\ProviderRedirectController;
use App\Http\Middleware\AdminMiddleware;
use App\Livewire\Music\MusicCreate;
use App\Livewire\Music\MusicData;
use App\Livewire\Music\MusicList;
use App\Livewire\Music\MusicUpdate;
use App\Livewire\User\Likes;
use App\Livewire\User\MusicData as UserMusicData;
use App\Livewire\User\Playlist;
use App\Livewire\User\PlaylistView;
use App\Livewire\User\Ratings;
use App\Livewire\User\Search;
use App\Livewire\User\SimilarMusic;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/auth/{provider}/redirect', ProviderRedirectController::class)->name('auth.redirect');
Route::get('/auth/{provider}/callback', ProviderCallbackController::class)->name('auth.callback');

Route::get('/', [MusicController::class, 'index'])
    ->name('index');
    
Route::get('/music/{music}', UserMusicData::class)
    ->name('music.view');

Route::get('search', Search::class)
    ->name('search');

Route::get('similar/{music}', SimilarMusic::class)
    ->name('similar');

Route::middleware('auth')->group(function(){

    Route::view('profile', 'profile')
        ->name('profile');

    Route::get('/likes', Likes::class)
        ->name('likes');

    Route::get('/ratings', Ratings::class)
        ->name('ratings');

    Route::get('/playlist', Playlist::class)
        ->name('playlist');

    Route::get('/playlist/{playlist}', PlaylistView::class)
        ->name('playlist.view');
});

Route::prefix('admin')
    ->middleware(['auth', 'verified', AdminMiddleware::class])
    ->group(function (){

        Route::view('dashboard', 'dashboard')
            ->name('dashboard');

        Route::get('music', MusicList::class)
            ->name('music.index');

        Route::get('music/create', MusicCreate::class)
            ->name('music.create');

        Route::get('music/{music}/edit', MusicUpdate::class)
            ->name('music.edit');

        Route::get('music/{music}', MusicData::class)
            ->name('music.show');

        Route::resource('rating', RatingController::class);
});


require __DIR__.'/auth.php';
