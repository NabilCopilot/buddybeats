<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\SpotifyAuthControllerNEW;

class TransferControllerNEW extends Controller
{

    public function store(Request $request)
    {
        $spotify = new SpotifyAuthControllerNEW();

        $data = [];
        $data['name'] = $request->name;
        $data['description'] = $request->description;
        $data['public'] = $request->public;

        //para q funcione añade debes d tener el token de acceso en la sesion
        $spotify->createPlaylist($request, $data);
    }

}