@extends('layouts.songsGrid')
@section('data')
    @foreach ($tracks as $track)
        <tr>
            <td>{{ $track['track']['name'] }}</td>
            <td>{{ $track['track']['artists'][0]['name'] }}</td>
            <td>{{ $track['track']['album']['name'] }}</td>
            <td>{{ $track['track']['duration_ms'] }}</td>
            <td><i class="fas fa-play"></i></td>
        </tr>
    @endforeach       
@endsection
