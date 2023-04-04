@extends('layouts.template')
@section('content')
    <div class="dash-content">
        <h1>YouTube Playlists</h1>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Thumbnail</th>
                    <th>Items</th>
                </tr>
            </thead>
            <tbody>
                @foreach($playlists->getItems() as $playlist)
                    <tr>
                        <td>
                            <a href="/youtube/playlist/{{ $playlist->getId() }}">{{ $playlist->getSnippet()->getTitle() }}</a>
                        </td>
                        <td>{{ $playlist->getSnippet()->getDescription() }}</td>
                        <td>
                            <img src="{{ $playlist->getSnippet()->getThumbnails()->getMedium()->getUrl() }}" alt="{{ $playlist->getSnippet()->getTitle() }} thumbnail">
                        </td>                        
                        <td>{{ $playlist->getContentDetails()->getItemCount() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
