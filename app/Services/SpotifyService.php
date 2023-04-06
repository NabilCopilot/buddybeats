<?php

namespace App\Services;

use GuzzleHttp\Client;

class SpotifyService
{

    protected $client;

    public function __construct($accessToken = null)
    {
        if ($accessToken) {
            $this->client = new Client([
                'base_uri' => 'https://api.spotify.com/v1/',
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
            ]);
        }
    }

    public function getUserPlaylists()
    {
        $response = $this->client->get('me/playlists');
        $data = json_decode((string)$response->getBody(), true);

        return $data['items'];
    }

    public function getPlaylistTracks($playlistId)
    {
        $response = $this->client->get("playlists/{$playlistId}/tracks");
        $data = json_decode((string)$response->getBody(), true);

        return $data['items'];
    }

}
