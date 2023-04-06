@extends('layouts.template')
@section('content')
    <h1>Playlists</h1>
    <table class="playlist-table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Service</th>
                <th>Number of Tracks</th>
                <th>Creator</th>
                <th>Types</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @yield('data')
        </tbody>
    </table>
@endsection