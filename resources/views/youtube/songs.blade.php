@extends('layouts.template')
@section('content')
    <div class="dash-content">
        <h1>Playlist Videos</h1>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Thumbnail</th>
                    <th>Duration</th>
                </tr>
            </thead>
            <tbody>
                @foreach($playlistItems->getItems() as $item)
                    @php
                        $videoId = $item->getContentDetails()->getVideoId();
                        $videoDetail = $videoDetails[$videoId] ?? null;
                        $duration = $videoDetail ? (new DateInterval($videoDetail->getContentDetails()->getDuration()))->format('%H:%I:%S') : '';
                    @endphp
                    <tr>
                        <td>
                            <a href="https://www.youtube.com/watch?v={{ $videoId }}" target="_blank">
                                {{ $item->getSnippet()->getTitle() }}
                            </a>
                        </td>
                        <td>
                            <img src="{{ $item->getSnippet()->getThumbnails()->getMedium()->getUrl() }}" alt="{{ $item->getSnippet()->getTitle() }} thumbnail">
                        </td>
                        <td>{{ $duration }}</td>
                    </tr>
                @endforeach
            </tbody>
            
        </table>
    </div>
@endsection