@extends('layouts.template')
@section('content')
<div class="dash-content">
    <h1>Resultados de búsqueda de YouTube</h1>

    <form action="{{ route('search') }}" method="get">
        <label for="query">Buscar videos:</label>
        <input type="text" name="query" id="query" value="{{ request('query') }}">
        <button type="submit">Buscar</button>
    </form>

    @if(isset($results) && !empty($results->items))
        <ul>
            @foreach($results->items as $video)
                <li>
                    <h2>{{ $video->snippet->title }}</h2>
                    <a href="https://www.youtube.com/watch?v={{ $video->id->videoId }}" target="_blank">
                        <img src="{{ $video->snippet->thumbnails->medium->url }}" alt="{{ $video->snippet->title }}">
                    </a>
                    <p>{{ $video->snippet->description }}</p>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
