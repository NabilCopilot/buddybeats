@extends('layouts.songsGrid')

    @section('header')
        <img src="" alt="Foto de la playlist">
        <div class="playlist-info">
          <h2></h2>
          <p><strong>Creador:</strong> </p>
          <p><strong>Servicio:</strong> Yotube</p>
          <p><strong>Tipo:</strong> </p>
          <p><strong>Número de canciones:</strong>  </p>
          {{-- <p><strong>Seguidores:</strong> </p> --}}
        </div>
    @endsection

    @section('data')
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
                <td>artista</td>
                <td>album</td>
                <td>{{ $duration }}</td>
            </tr>
        @endforeach
    @endsection