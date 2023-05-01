<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\SpotifyAuthControllerNEW;

class TransferControllerNEW extends Controller
// TODO: aqui me llegan los datos del form, tengo q llamar al controlador destino y el controlador origen. Y pasarle sus respectivos datos a cada uno
// origen-> id de playlist para obtener las canciones
// destino-> nombre, descripcion y publico de la playlist para crearla
// como paso las canciones de origen a destino?
//llamo desde aqui el enpoint q me devuelva un array con las canciones artista y canciones
//luego llamo al controlador destino y le paso el array
{

    public function store(Request $request)
    // TODO: segun el valor del select origen y select destino, instancio el controlador correspondiente
    {
        dd($request->all());

        $sourceSelect = $request->source;
        $destinationSelect = $request->destination;

        $sourceController = new SpotifyAuthControllerNEW();
        $destinationController = new SpotifyAuthControllerNEW();

        $sourceData = [];
        $sourceData['id'] = $request->id;

        $destinationData = [];
        $destinationData['name'] = $request->name;
        $destinationData['description'] = $request->description;
        $destinationData['public'] = $request->public;

        //para q funcione añade debes d tener el token de acceso en la sesion
        $sourceController->createPlaylist($request, $sourceData);
    }

}