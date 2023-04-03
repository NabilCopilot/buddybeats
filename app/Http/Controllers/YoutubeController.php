<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Youtube;
use Google_Service_YouTube_Playlist;
use Google_Service_YouTube_PlaylistSnippet;
use Google_Service_YouTube_PlaylistStatus;
//en vez de usar el namespace puedo cargar directamente el vendor/autoload 
//para cargar todas las clases automaticamente
require_once __DIR__ . '/vendor/autoload.php';

class YoutubeController extends Controller{
    public function obtenerVideos()
    {
        $client = new Google_Client();
        $client->setApplicationName('Mi aplicación de YouTube');
        $client->setDeveloperKey('AIzaSyDBkhNp_r28ActFjOk0BAQoryw-tKTFA6s');

        $service = new Google_Service_YouTube($client);
        //si detecta el objeto

        $searchResponse = $service->videos->listVideos('snippet,statistics', array(
            'chart' => 'mostPopular',
            'maxResults' => 10,
            'videoCategoryId' => '10' // Categoría de música
        ));

        $videos = array();

        foreach ($searchResponse['items'] as $searchResult) {
            $title = $searchResult['snippet']['title'];
            $views = $searchResult['statistics']['viewCount'];
            $videos[] = array('title' => $title, 'views' => $views);
        }

        return view('youtube', compact('videos'));
    }
    //crear playlist
    public function crearPlaylist()
    {
        $client = new Google_Client();
        $client->setApplicationName('API code samples');
        $client->setDeveloperKey('AIzaSyDBkhNp_r28ActFjOk0BAQoryw-tKTFA6s');

        // Define service object for making API requests.
        $service = new Google_Service_YouTube($client);

        // Define the $playlist object, which will be uploaded as the request body.
        $playlist = new Google_Service_YouTube_Playlist();

        // Add 'snippet' object to the $playlist object.
        $playlistSnippet = new Google_Service_YouTube_PlaylistSnippet();
        $playlistSnippet->setDefaultLanguage('en');
        $playlistSnippet->setDescription('This is a sample playlist description.');
        $playlistSnippet->setTags(['sample playlist', 'API call']);
        $playlistSnippet->setTitle('Sample playlist created via API');
        $playlist->setSnippet($playlistSnippet);

        // Add 'status' object to the $playlist object.
        $playlistStatus = new Google_Service_YouTube_PlaylistStatus();
        $playlistStatus->setPrivacyStatus('private');
        $playlist->setStatus($playlistStatus);

        $response = $service->playlists->insert('snippet,status', $playlist);
        print_r($response);   
    }
        

}

