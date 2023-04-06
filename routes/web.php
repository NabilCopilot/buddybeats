<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\SyncController;

use App\Http\Controllers\TransferController;
use App\Http\Controllers\YouTubeController;
use App\Http\Controllers\SpotifyController;
use App\Http\Controllers\SpotifyAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomeController::class)->name('home');

Route::get('transfer', TransferController::class)->name('transfer');
Route::get('sync', SyncController::class)->name('sync');

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
