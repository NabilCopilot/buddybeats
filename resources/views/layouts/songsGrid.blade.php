@extends('layouts.template')
@section('content')
    <h1>Playlist Details</h1>
    <div class="playlist-header">
        <img src="{{ $playlist['images'][0]['url'] }}" alt="Foto de la playlist">
        <div class="playlist-info">
          <h2>{{ $playlist['name'] }}</h2>
          <p><strong>Creador:</strong>{{ $playlist['owner']['display_name'] }}</p>
          <p><strong>Servicio:</strong> Spotify</p>
          <p><strong>Tipo:</strong> {{ $playlist['type'] }}</p>
          <p><strong>Número de canciones:</strong> {{ $playlist['tracks']['total'] }} </p>
          {{-- <p><strong>Seguidores:</strong> {{ $playlist['followers']['total'] }} </p> --}}
        </div>
    </div>
    <table class="playlist-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Artist</th>
                <th>Album</th>
                <th>Duration</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @yield('data')
        </tbody>
    </table>
@endsection
            