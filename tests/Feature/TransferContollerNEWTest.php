<?php

namespace Tests\Feature;

use App\Http\Controllers\DeezerController;
use App\Http\Controllers\SpotifyAuthControllerNEW;
use App\Http\Controllers\TransferControllerNEW;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransferControllerNEWTest extends TestCase
{
    use WithFaker;

    public function testConvertSpotifySongsToArray()
    {
        $transferController = new TransferControllerNEW();
        $songs = [
            [
                'track' => [
                    'name' => 'Song Title',
                    'artists' => [
                        ['name' => 'Artist Name']
                    ]
                ]
            ]
        ];

        $expectedResult = [
            [
                'title' => 'Song Title',
                'artist' => 'Artist Name'
            ]
        ];

        $result = $transferController->convertSpotifySongsToArray($songs);
        $this->assertEquals($expectedResult, $result);
    }

    public function testConverDeezertSongsToArray()
    {
        $transferController = new TransferControllerNEW();
        $songs = [
            'tracks' => [
                (object)[
                    'title' => 'Song Title',
                    'artist' => (object)['name' => 'Artist Name']
                ]
            ]
        ];

        $expectedResult = [
            [
                'title' => 'Song Title',
                'artist' => 'Artist Name'
            ]
        ];

        $result = $transferController->converDeezertSongsToArray($songs);
        $this->assertEquals($expectedResult, $result);
    }

    public function testStore()
    {
        // SpotifyAuthControllerNEW and DeezerController should be mocked
        $spotifyAuthControllerMock = $this->getMockBuilder(SpotifyAuthControllerNEW::class)
            ->disableOriginalConstructor()
            ->getMock();

        $deezerControllerMock = $this->getMockBuilder(DeezerController::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Configure mocked methods as needed
        // $spotifyAuthControllerMock->method('getPlaylistTracks')->willReturn(...);
        // $deezerControllerMock->method('sourceSongsForTansferForm')->willReturn(...);

        $this->app->instance(SpotifyAuthControllerNEW::class, $spotifyAuthControllerMock);
        $this->app->instance(DeezerController::class, $deezerControllerMock);

        $request = [
            'playlist' => 'some_playlist_id',
            'source' => 'spotify',
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'public' => true,
            'destination' => 'deezer',
        ];

        $response = $this->post('/transfer', $request);
        // Check response status or other assertions
        // $response->assertStatus(200);
    }
}
