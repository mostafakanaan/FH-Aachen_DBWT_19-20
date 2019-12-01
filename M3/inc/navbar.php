<!--$Page ist die Dateiendung in der URL z.b. Start.php-->
<?php $page = basename($_SERVER['PHP_SELF']); ?>
<header class="row">
    <div class="col-3">
        <h1>e-eeeMensa</h1>
    </div>
    <nav class="col-6">
        <ul class="nav">
            <li class="nav-item"><a class="nav-link <?php if ($page == 'Start.php')  echo " disabled" ?> " href="Start.php">Start</a></li>
            <li class="nav-item"><a class="nav-link <?php if ($page == 'Produkte.php')  echo " disabled" ?> " href="Produkte.php">Mahlzeiten</a></li>
            <li class="nav-item"><a class="nav-link active" href="#">Bestellung</a></li>
            <li class="nav-item"><a class="nav-link active" target="_blank" href="https://www.fh-aachen.de/">FH-Aachen</a></li>
        </ul>
    </nav>
    <div class="col-3">
        <form action="http://www.google.de/search" class="row" method="get" target="_blank" id="search" title="Suche in fh-aachen.de">
            <input id="suchbegriff" type="text" name="q" class="form-control" placeholder="Suchen.." onfocus="this.placeholder = ''" onblur="this.placeholder = 'Suchen..'" autocomplete="off"/>
            <input type="hidden" name="as_sitesearch" value="https://www.fh-aachen.de/"/>
            <button class="searchbutton" type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>
</header>