@extends('layouts.playlistsGrid')
@section('data')    
    @foreach ($playlists as $playlist)
        <tr>
            <td>
                <a href="/spotify/playlists/{{ $playlist['id'] }}"> {{ $playlist['name'] }} </a>
            </td>
            <td>Spotify</td>
            <td>{{ $playlist['tracks']['total'] }}</td>
            <td>{{ $playlist['owner']['display_name'] }}</td>
            <td>{{ $playlist['type'] }}</td>
            <td><i class="fas fa-play"></i></td>
        </tr>
    @endforeach
@endsection
