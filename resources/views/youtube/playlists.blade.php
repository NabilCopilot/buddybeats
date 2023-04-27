@extends('layouts.playlistsGrid')
@section('data')
    @foreach($playlists->getItems() as $playlist)
        <tr>
            <td>
                <a href="/youtube/playlist/{{ $playlist->getId() }}">{{ $playlist->getSnippet()->getTitle() }}</a>
            </td>
            <td>Youtube</td>
            <td>{{ $playlist->getContentDetails()->getItemCount() }}</td>
            <td>
                @if($playlist->getSnippet()->getChannelTitle())
                    {{ $playlist->getSnippet()->getChannelTitle() }}
                @else
                    YouTube
                @endif
            </td>
            {{-- <td>
                {{ ucfirst($playlist->status->privacyStatus) }}
            </td> --}}
            <td><i class="fas fa-play"></i></td>
        </tr>
    @endforeach
@endsection
