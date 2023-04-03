<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\SyncController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\YouTubeController;

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

//debo decidir que hacer con transferir, sincronizar y compartir
//el problema de q lo coge como una variable de la url, cambiar el orden
Route::get('transfer', TransferController::class)->name('transfer');
Route::get('sync', SyncController::class)->name('sync');
//Playlist Route Groups
Route::controller(PlaylistController::class)->group(function () {
    Route::get('playlists', 'index')->name('playlists.index');
    Route::get('playlists/{service}', 'showPlaylists')->name('playlists.service');
    Route::get('playlists/{service}/{id}', 'showPlaylist')->name('playlists.songs');
});

Route::get('/search', [YouTubeController::class, 'searchVideos'])->name('search');




/* Route::get('playlists/{service?}/{id?}', function ($service=null, $id=null) {
    if($service && $id ){
        //muestra una playlist de un servicio
        return "Welcome to your $id playlist in $service";
    }elseif($service){
        //muestra todas las playlists de todos los servicios
        return "Welcome to your playlists in $service ";
    }else{
        //muesta todas las playlists de todos los servicios
        return "Welcome to all your playlists in all your linked services";
    }
}); */

