<?php

namespace Tests\Feature;

use App\Http\Controllers\DeezerController;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class DeezerControllerTest extends TestCase
{
    use WithFaker;

    public function testSearchTrack()
    {
        $mockResponse = new Response(200, [], json_encode([
            'data' => [
                [
                    'id' => 12345
                ]
            ]
        ]));

        $mockHandler = new MockHandler([$mockResponse]);
        $handlerStack = HandlerStack::create($mockHandler);
        $httpClient = new Client(['handler' => $handlerStack]);

        $deezerController = new DeezerController();
        $deezerController->client = $httpClient;

        $songs = [
            [
                'title' => 'Test Song',
                'artist' => 'Test Artist'
            ]
        ];

        $result = $deezerController->searchTrack(new Request(), $songs);

        $this->assertEquals([12345], $result);
    }

    public function testCreatePlaylist()
    {
        $playlistTitle = 'Test Playlist';
        $playlistDescription = 'Test Description';

        $mockResponse = new Response(200, [], json_encode([
            'id' => 12345,
            'title' => $playlistTitle,
            'description' => $playlistDescription
        ]));

        $mockHandler = new MockHandler([$mockResponse]);
        $handlerStack = HandlerStack::create($mockHandler);
        $httpClient = new Client(['handler' => $handlerStack]);

        $deezerController = new DeezerController();
        $deezerController->client = $httpClient;

        $request = new Request();
        $request->session()->put('deezer_access_token', 'test_token');

        $result = $deezerController->createPlaylist($request, $playlistTitle, $playlistDescription);

        $this->assertEquals(12345, $result->id);
        $this->assertEquals($playlistTitle, $result->title);
        $this->assertEquals($playlistDescription, $result->description);
    }

    // Add more tests for other methods as needed
}
