<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\SpotifyAuthControllerNEW;

class TransferControllerNEW extends Controller
{

    public function store(Request $request)
    {
        $sourceData = [];
        $sourceData['playlist_id'] = $request->playlist;
        $sourceData['source_songs'] = null;
        $sourceData['source_songs_in_array'] = null;

        $sourceSelect = $request->source;
        switch ($sourceSelect) {
            case "spotify":
                $sourceController = new SpotifyAuthControllerNEW();
                break;
            case "deezer":
                $sourceController = new DeezerController();
                $sourceData['source_songs'] = $sourceController->sourceSongsForTansferForm($request, $sourceData['playlist_id']);
                $sourceData['source_songs_in_array'] = $this->converDeezertSongsToArray($sourceData['source_songs']);
                break;
            case "youtube":
                echo 'source youtube no implementado';
                break;
            default:
                echo 'source no valido';
                break;
        }

        dd($sourceData['source_songs_in_array']);

        $destinationData = [];
        $destinationData['name'] = $request->name;
        $destinationData['description'] = $request->description;
        $destinationData['public'] = $request->public;

        $destinationSelect = $request->destination;

        switch ($destinationSelect) {
            case "spotify":
                $destinationController = new SpotifyAuthControllerNEW();
                $destinationController->createPlaylist($request, $sourceData);
                break;
            case "deezer":
                $destinationController = new DeezerController();
                break;
            case "youtube":
                echo 'destination youtube no implementado';
                break;
            default:
                echo 'source no valido';
                break;
        }
    }

    public function converDeezertSongsToArray($songs)
    {
        $songsArray = [];
        foreach ($songs['tracks'] as $song) {
            $songArray = [];
            $songArray['title'] = $song->title;
            $songArray['artist'] = $song->artist->name;
            array_push($songsArray, $songArray);
        }

        return $songsArray;
    }
}