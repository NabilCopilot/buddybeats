@extends('layouts.songsGrid')

    @section('header')
        <img src="{{ $playlist['images'][0]['url'] }}" alt="Foto de la playlist">
        <div class="playlist-info">
          <h2>{{ $playlist['name'] }}</h2>
          <p><strong>Creador:</strong>{{ $playlist['owner']['display_name'] }}</p>
          <p><strong>Servicio:</strong> Spotify</p>
          <p><strong>Tipo:</strong> {{ $playlist['type'] }}</p>
          <p><strong>Número de canciones:</strong> {{ $playlist['tracks']['total'] }} </p>
          {{-- <p><strong>Seguidores:</strong> {{ $playlist['followers']['total'] }} </p> --}}
        </div>
    @endsection

    @section('data')
        @foreach ($tracks as $track)
            <tr>
                <td><a href="https://open.spotify.com/track/{{ $track['track']['id'] }}" target="_blank">{{ $track['track']['name'] }}</a></td>
                <td>{{ $track['track']['artists'][0]['name'] }}</td>
                <td>{{ $track['track']['album']['name'] }}</td>
                <td>
                    {{sprintf('%02d:%02d:%02d',
                      ($track['track']['duration_ms'] / 1000) / 3600,
                      (($track['track']['duration_ms'] / 1000) / 60) % 60,
                      ($track['track']['duration_ms'] / 1000) % 60
                    )}}
                </td>
                <td><i class="fas fa-play"></i></td>
            </tr>
        @endforeach
    @endsection
