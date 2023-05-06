@extends('layouts.songsGrid')

    @section('header')
        <img src="{{ $playlist->picture_big }}" alt="Foto de la playlist">
        <div class="playlist-info">
          <h2>{{ $playlist->title }}</h2>
          <p><strong>Creador: </strong>{{ $playlist->creator->name }}</p>
          <p><strong>Servicio: </strong>Deezer</p>
          <p><strong>Tipo: </strong>{{ $playlist->public ? 'Public' : 'Private' }}</p>
          <p><strong>Número de canciones: </strong>{{ $playlist->nb_tracks }} </p>
          {{-- <p><strong>Seguidores:</strong> {{ $playlist['followers']['total'] }} </p> --}}
        </div>
    @endsection

    @section('data')
        @foreach ($tracks as $track)
            <tr>
                <td><a href="https://www.deezer.com/track/{{ $track->id }}" target="_blank">{{ $track->title }}</a></td>
                <td>{{ $track->artist->name }}</td>
                <td>{{ $track->album->title }}</td>
                <td>
                    {{
                        sprintf('%02d:%02d',
                            ($track->duration) / 60,
                            ($track->duration) % 60
                        )
                    }}
                </td>
                <td><i class="fas fa-play"></i></td>
            </tr>
        @endforeach
    @endsection
