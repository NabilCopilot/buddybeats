@extends('layouts.template')
@section('content')
<div class="dash-content">
    <h3>Videos populares de música</h3>
    <ul>
        @foreach ($videos as $video)
            <li>Video: {{ $video['title'] }}, Visitas: {{ $video['views'] }}</li>
        @endforeach
    </ul>
</div>
@endsection
