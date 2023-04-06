<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BuddyBeats</title>
    <!--
    <link rel="stylesheet" href="/assets/css/demo.css">
    -->
    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    @vite([
        //'resources/css/aside_bar.css', 
        //'resources/js/aside_bar.js', 
        //'resources/css/nav_bar.css', 
        //'resources/js/nav_bar.js', 
        //'resources/css/app.css',
        //'resources/js/app.js',
        'resources/css/crud.css',
        'resources/js/crud.js',
    ])
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <!--<img src="images/logo.png" alt="">-->
            </div>

            <span class="logo_name">CodingLab</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li>
                    <a href="{{route('home')}}">
                        <span class="link-name">Home</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('transfer')}}">
                        <span class="link-name">Transfer</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('sync')}}">
                        <span class="link-name">Synchronize</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('playlists.index')}}">
                        <span class="link-name">Playlists</span>
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
                    <a href="{{ route('playlists.service', ['service' => 'deezer']) }}">
                        <img class="icon" src="{{ asset('assets/images/deezer_logo.png') }}">
                        <span class="link-name">Deezer</span>
                    </a>
                </li>
            </ul>
            
            <ul class="logout-mode">
                <li><a href="#">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>

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
        {{-- todo esto deberia cambiar segun la ruta --}}
            {{-- <div class="text">Dashboard Sidebar</div> --}}
        @yield('content')     <!--EL campo de la plantilla que rellenare desde la vista-->
    </section>
</body>
    <!--
    <script src="/assets/js/demo.js"></script>
    -->
</html>