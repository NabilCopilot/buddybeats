<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaylistController;

use App\Http\Controllers\YouTubeController;
use App\Http\Controllers\SpotifyController;
use App\Http\Controllers\SpotifyAuthController;
use App\Http\Controllers\SpotifyAuthControllerNEW;
use App\Http\Controllers\TransferControllerNEW;
use App\Http\Controllers\DeezerAuthController;
use App\Http\Controllers\DeezerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('layouts.template');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::post('transfer', [TransferControllerNEW::class, 'store'])->name('transfer');

Route::controller(PlaylistController::class)->group(function () {
    Route::get('playlists', 'index')->name('playlists.index');
    Route::get('playlists/{service}', 'showPlaylists')->name('playlists.service');
    Route::get('playlists/{service}/{id}', 'showPlaylist')->name('playlists.songs');
});

Route::get('/youtube/auth', [YouTubeController::class, 'auth'])->name('youtube.auth');
Route::get('/youtube/callback', [YouTubeController::class, 'callback'])->name('youtube.callback');
Route::get('/youtube/playlists', [YouTubeController::class, 'getPlaylists'])->name('youtube.playlists');
Route::get('/youtube/playlist/{id}', [YouTubeController::class, 'getPlaylistVideos']);

Route::get('/spotify/auth', [SpotifyAuthController::class, 'redirectToProvider'])->name('spotify.auth');
Route::get('/spotify/callback', [SpotifyAuthController::class, 'handleProviderCallback'])->name('spotify.callback');
Route::get('/spotify/playlists', [SpotifyController::class, 'showPlaylists'])->name('spotify.playlists');
Route::get('/spotify/playlists/{id}', [SpotifyController::class, 'showPlaylistTracks'])->name('spotify.tracks');

// implementacion de la nueva autenticacion, flujo de codigo
Route::get('/spotify_authorize', [SpotifyAuthControllerNEW::class, 'redirectToSpotify']);
Route::get('/spotify_callback', [SpotifyAuthControllerNEW::class, 'handleCallback']);

//SPOTIFY
Route::get('/create_playlist', [SpotifyAuthControllerNEW::class, 'createPlaylist']);
Route::get('/add_to_playlist/{playlistId}/{artistName}/{trackName}', [SpotifyAuthControllerNEW::class, 'addToPlaylist']);
Route::post('/get_my_playlists', [SpotifyAuthControllerNEW::class, 'getMyPlaylists'])->name('spotify.myplaylists');

//DEEZER
Route::get('/deezer_redirect', [DeezerAuthController::class, 'redirectToDeezer']);
Route::get('/deezer_callback', [DeezerAuthController::class, 'handleDeezerCallback']);
Route::get('/deezer_info', [DeezerAuthController::class, 'getUserInfo']);
Route::get('/deezer', [DeezerController::class, 'getUserInfo']);
Route::get('/create_deezer_playlist', [DeezerController::class, 'createPlaylist'])->name('create-playlist');
Route::get('/add_track_to_playlist', [DeezerController::class, 'addTrackToPlaylist'])->name('add-track-to-playlist');
Route::get('/deezer/playlists', [DeezerController::class, 'getUserPlaylists'])->name('deezer.playlists');
Route::post('/deezer/source_playlists', [DeezerController::class, 'sourcePlaylists']);
Route::get('/deezer/playlists/{id}', [DeezerController::class, 'getPlaylistTracks'])->name('deezer.tracks');




