<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\YouTubeService;


class YoutubeController extends Controller
{
    protected $youtubeService;

    public function __construct(YouTubeService $youtubeService)
    {
        $this->youtubeService = $youtubeService;
    }

    public function searchVideos(Request $request)
    {
        $query = $request->input('query');
        $results = [];
    
        if (!empty($query)) {
            $results = $this->youtubeService->searchVideos($query);
        }
    
        return view('youtube', ['results' => $results]);
    }

}
