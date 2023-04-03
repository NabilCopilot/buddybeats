<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    //3 rutas 3 metodos: un metodo por ruta

    //muestra todos los servcicios y sus playlists
    public function index(){
        return view('playlists.index');
    }
    //muestra todas las playlists de un servicio
    public function showPlaylists($service){
        
        return view('playlists.showPlaylists', compact('service'));
    }
    //muestra una playlist de un servicio
    public function showPlaylist($service, $id){
        return view('playlists.showPlaylist', compact('service', 'id'));
    }
}
