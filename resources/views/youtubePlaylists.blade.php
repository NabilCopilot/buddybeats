@extends('layouts.template')
@section('content')
    <div class="dash-content">
        <h1>Listas de reproducción de YouTube</h1>

        @if(isset($playlists))
            <ul>
                @foreach($playlists->items as $playlist)
                    <li>
                        <h2>{{ $playlist->snippet->title }}</h2>
                        <a href="https://www.youtube.com/playlist?list={{ $playlist->id }}" target="_blank">
                            <img src="{{ $playlist->snippet->thumbnails->medium->url }}" alt="{{ $playlist->snippet->title }}">
                        </a>
                        <p>{{ $playlist->snippet->description }}</p>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection