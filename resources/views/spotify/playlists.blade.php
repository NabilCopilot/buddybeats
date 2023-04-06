@extends('layouts.template')
@section('content')
    <div class="dash-content">
        <h1>User Playlists</h1>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Number of Tracks</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($playlists as $playlist)
                    <tr>
                        <td>
                            <a href="/spotify/playlists/{{ $playlist['id'] }}">{{ $playlist['name'] }}</a>
                        </td>
                        <td>{{ $playlist['description'] }}</td>
                        <td>{{ $playlist['tracks']['total'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
