<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <title>BuddyBeats</title>
    
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <script src="https://kit.fontawesome.com/b58bf2b7cf.js" crossorigin="anonymous"></script>

    @vite([
        'resources/css/crud.css',
        'resources/js/crud.js',
        'resources/css/playlistTable.css',
        'resources/css/app.css',
        'resources/js/app.js',
    ])
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <!--<img src="images/logo.png" alt="">-->
            </div>

            <h1 class="logo_name">BuddyBeats</h1>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li>
                    <a href="{{route('home')}}">
                        <span class="link-name">Home</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('spotify.auth') }}">
                        <img class="icon" src="{{ asset('assets/images/spotify_logo.png') }}">
                        <span class="link-name">Spotify</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('youtube.auth')}}">
                        <img class="icon" src="{{ asset('assets/images/youtube_logo.png') }}">
                        <span class="link-name">YouTube</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('playlists.service', ['service' => 'applemusic']) }}">
                        <img class="icon" src="{{ asset('assets/images/apple_music_logo.png') }}">
                        <span class="link-name">Apple Music</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('playlists.service', ['service' => 'tidal']) }}">
                        <img class="icon" src="{{ asset('assets/images/tidal_logo.png') }}">
                        <span class="link-name">TIDAL</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('deezer.playlists')}}">
                        <img class="icon" src="{{ asset('assets/images/deezer_logo.png') }}">
                        <span class="link-name">Deezer</span>
                    </a>
                </li>
            </ul>

            <ul class="logout-mode">

                <x-logout>
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </x-logout>

                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                    <span class="link-name">Dark Mode</span>
                </a>

                <div class="mode-toggle">
                  <span class="switch"></span>
                </div>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div>
            
            <!--<img src="images/profile.jpg" alt="">-->
        </div>
        
        {{-- <div class="text">Dashboard Sidebar</div> --}}
        <div class="dash-content">
            <div class="container mx-auto py-8">
                <div x-data="{ showDiv: false, currentScreen: 1 }">
                    <!-- Botón para mostrar/ocultar el div -->
                    <button @click="showDiv = !showDiv" class="px-4 py-2 bg-blue-600 text-white rounded">Transfer</button>
        
                    <!-- Div para mostrar/ocultar -->
                    <div x-show="showDiv" class="mt-4 p-6 bg-white rounded shadow-lg" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                        @include('forms.transfer')
                    </div>
                </div>
            </div>
        
            @yield('content')
        </div>
        
        
    </section>
</body>
</html>