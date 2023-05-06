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
                $sourceData['source_songs'] = $sourceController->getPlaylistTracks($request, $sourceData['playlist_id']);
                $sourceData['source_songs_in_array'] = $this->convertSpotifySongsToArray($sourceData['source_songs']);
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

        $destinationData = [];
        $destinationData['name'] = $request->name;
        $destinationData['description'] = $request->description;
        $destinationData['public'] = $request->public;
        $destinationData['id_playlist'] = null;
        $destinationData['id_tracks'] = null;

        $destinationSelect = $request->destination;
        switch ($destinationSelect) {
            case "spotify":
                $destinationController = new SpotifyAuthControllerNEW();
                $destinationData['id_tracks'] = $destinationController->getSpotifyTracksId($request, $sourceData['source_songs_in_array']);
                // dd($destinationData['id_tracks']); -> FUNCIONA
                // $destinationController->createPlaylist($request, $destinationData['name'], $destinationData['description'], $destinationData['public']);
                break;
            case "deezer":
                $destinationController = new DeezerController();
                $destinationData['id_tracks'] = $destinationController->searchTrack($request, $sourceData['source_songs_in_array']);
                $destinationData['id_playlist'] = $destinationController->createPlaylist($request, $destinationData['name'], $destinationData['description']);
                $destinationController->addTrackToPlaylist($request, $destinationData['id_playlist']->id, $destinationData['id_tracks']);
                break;
            case "youtube":
                echo 'destination youtube no implementado';
                break;
            default:
                echo 'source no valido';
                break;
        }
    }

    // FORMATO CANCIONES ORIGEN: ARRAY NUMERICO CON CLAVES 'title' y 'artist'
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

    public function convertSpotifySongsToArray($songs)
    {
        $songsArray = [];
        foreach ($songs as $song) {
            $songArray = [];
            $songArray['title'] = $song['track']['name'];
            $songArray['artist'] = $song['track']['artists'][0]['name'];
            array_push($songsArray, $songArray);
        }

        return $songsArray;
    }

}