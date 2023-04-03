<?php

namespace App\Services;

use Google_Client;
use Google_Service_YouTube;

class YouTubeService
{
    protected $client;

    public function __construct()
    {
        $client = new Google_Client();
        $client->setDeveloperKey(config('services.youtube.key'));
        $this->client = new Google_Service_YouTube($client);
    }

    public function searchVideos(string $query)
    {
        $params = [
            'q' => $query,
            'type' => 'video',
            'part' => 'id,snippet',
            'maxResults' => 10,
        ];

        return $this->client->search->listSearch('id,snippet', $params);
    }
}
