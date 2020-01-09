<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'eMensa') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.4.1.slim.min.js') }}" defer></script>
    <script src="{{ asset('js/popper.min.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
{{--    own css--}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
{{--    Fontawesome--}}
    <link rel="dns-prefetch" href="//use.fontawesome.com">
    <link href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" rel="stylesheet">

</head>
<body>
<div class="container">
    {{--    Navbar...--}}
    <header class="row">
        <div class="col-3">
            <h1>e-Mensa</h1>
        </div>
        <nav class="col-6">
            <ul class="nav">
                <li class="nav-item"><a class="nav-link" href="Start.php">Start</a></li>
                <li class="nav-item"><a class="nav-link" href="Produkte.php">Mahlzeiten</a></li>
                <li class="nav-item"><a class="nav-link active" href="#">Bestellung</a></li>
                <li class="nav-item"><a class="nav-link active" target="_blank" href="https://www.fh-aachen.de/">FH-Aachen</a>
                </li>
            </ul>
        </nav>
        <div class="col-3">
            <form action="http://www.google.de/search" class="row" method="get" target="_blank" id="search"
                  title="Suche in fh-aachen.de">
                <input id="suchbegriff" type="text" name="q" class="form-control" placeholder="Suchen.."
                       onfocus="this.placeholder = ''" onblur="this.placeholder = 'Suchen..'" autocomplete="off"/>
                <input type="hidden" name="as_sitesearch" value="https://www.fh-aachen.de/"/>
                <button class="searchbutton" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    {{--    Footer--}}
    <footer class="row">
        <div class="col-3 copyright">
            <i class="far fa-copyright"></i>
            DBWT
            <?php echo date("d.m.Y", time()) ?>
        </div>
        <nav class="col-6">
            <ul class="nav" id="bottom_nav">
                <!-- die Deko-Striche evtl schöner -->
                <li class="nav-item"><a class="nav-link" href="#">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="Registrierung.php">Registrieren</a></li>
                <li class="nav-item"><a class="nav-link active" href="Zutaten.php">Zutatenliste</a></li>
                <li class="nav-item"><a class="nav-link active" href="Impressum.php">Impressum</a></li>
            </ul>
        </nav>
    </footer>


</div>
</body>
</html>
