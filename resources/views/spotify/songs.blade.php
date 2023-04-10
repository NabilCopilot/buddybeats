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
                <td>{{ $track['track']['name'] }}</td>
                <td>{{ $track['track']['artists'][0]['name'] }}</td>
                <td>{{ $track['track']['album']['name'] }}</td>
                <td>{{ $track['track']['duration_ms'] }}</td>
                <td><i class="fas fa-play"></i></td>
            </tr>
        @endforeach
    @endsection
