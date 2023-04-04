@extends('layouts.template')
@section('content')
    <div class="dash-content">
        <h1>Playlist Videos</h1>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Thumbnail</th>
                    <th>Video ID</th>
                </tr>
            </thead>
            <tbody>
                @foreach($playlistItems->getItems() as $item)
                    <tr>
                        <td>{{ $item->getSnippet()->getTitle() }}</td>
                        <td>
                            <img src="{{ $item->getSnippet()->getThumbnails()->getMedium()->getUrl() }}" alt="{{ $item->getSnippet()->getTitle() }} thumbnail">
                        </td>
                        <td>{{ $item->getContentDetails()->getVideoId() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection