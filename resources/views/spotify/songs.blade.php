@extends('layouts.template')
@section('content')
    <div class="dash-content">
        <h1>Playlist Tracks</h1>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Artist</th>
                    <th>Album</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tracks as $track)
                    <tr>
                        <td>{{ $track['track']['name'] }}</td>
                        <td>{{ $track['track']['artists'][0]['name'] }}</td>
                        <td>{{ $track['track']['album']['name'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection