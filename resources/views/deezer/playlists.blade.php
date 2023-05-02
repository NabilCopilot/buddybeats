@extends('layouts.playlistsGrid')
@section('data')    
    @foreach ($playlists as $playlist)
        <tr>
            <td>
                <a href="/deezer/playlists/{{ $playlist->id }}"> {{ $playlist->title }} </a>
            </td>
            <td>Deezer</td>
            <td>{{ $playlist->nb_tracks }}</td>
            <td>{{  $playlist->creator->name }}</td>
            <td>{{ $playlist->public ? 'Public' : 'Private' }}</td>
            <td><i class="fas fa-play"></i></td>
        </tr>
    @endforeach
@endsection