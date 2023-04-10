@extends('layouts.template')
@section('content')
    <h1>Playlist Details</h1>
    <div class="playlist-header">
        @yield('header')
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