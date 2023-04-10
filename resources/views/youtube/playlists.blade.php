@extends('layouts.playlistsGrid')
@section('data')
    @foreach($playlists->getItems() as $playlist)
        <tr>
            <td>
                <a href="/youtube/playlist/{{ $playlist->getId() }}">{{ $playlist->getSnippet()->getTitle() }}</a>
            </td>
            <td>Youtube</td>
            <td>{{ $playlist->getContentDetails()->getItemCount() }}</td>
        </tr>
    @endforeach
@endsection
