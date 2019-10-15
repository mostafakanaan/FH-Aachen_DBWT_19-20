<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>eMensa - Detail</title>
    <meta name="description" content="Startseite der eMensa">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"
    integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz"
    crossorigin="anonymous">
</head>
    <body>
        <div class="container">
<!--Header bzw Nav include -->
<?php
include 'inc/navbar.html'
?>

<main>
<div class="row">
        <h2 class="align-text-center" id="details">Details für "Schnitzel"</h2>
    </div>

    <div class="row">
        <div class="col-2" id="logincol">
            <div class="card" id="login">
                <div class="card-body align-text-center">
                    <h6 class="card-title align-text-center"><i class="fas fa-sign-in-alt"></i> Login</h6>
                    <hr>
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" placeholder="Benutzer">
                        <input type="password" class="form-control" id="password" placeholder="Passwort">
                        <button type="button" class="btn btn-success" id="loginbutton">Anmelden</button>
                    </div>
                    
                </div>
            </div>
            <p style="width: 13rem; font-size: 14px;">Melden Sie sich jetzt an, um die wirklich viel günstigeren Preise
                für
                Mitarbeiter oder Studenten zu sehen.
            </p>
        </div>
        <div class="col-6" id="produktcol">
            <img src="img/Schnitzel.jpg" id="produktimg" alt="Falafel"/>
            <hr>
            <!-- Nav tabs -->
                




            <!-- <ul class="nav nav-tabs" id="myTab" role="tablist"> 
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#beschreibung" role="tab"
                       aria-controls="beschreibung" aria-selected="true">Beschreibung</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="zutaten-tab" data-toggle="tab" href="#zutaten" role="tab"
                       aria-controls="zutaten" aria-selected="false">Zutaten</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="bewertungen-tab" data-toggle="tab" href="#bewertungen" role="tab"
                       aria-controls="bewertungen" aria-selected="false">Bewertungen</a>
                </li>
            </ul>
            -->

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="beschreibung" role="tabpanel">Dünne panierte gebratene Scheibe Schweinefleisch mit
                    Beilage(Reis/Pommes).
                </div>
                <div class="tab-pane" id="zutaten" role="tabpanel" aria-labelledby="zutaten-tab">Schweinefleisch
                    (80%), Mehl (Weizen, Mais), Rapsöl, Palmfett, modifizierte Weizenstärke,
                    jodiertes Speisesalz, Kartoffelstärke, Stabilisator: Natriumcitrate; Glukosesirup, Gewürze,
                    Hefe, Aroma, Dextrose, Zitronensaftpulver.
                </div>
                <div class="tab-pane" id="bewertungen" role="tabpanel">
                    <form action="http://bc5.m2c-lab.fh-aachen.de/form.php" method="post">
                        <input type="hidden" name="matrikel" value="3167397"/>
                        <input type="hidden" name="kontrolle" value="KAN"/>
                        <div class="form-group">
                            <input id="name" class="form-control" name="benutzer" placeholder="Name">
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <select class="form-control" name="bewertung" id="bewertung">
                                        <option disabled selected class="align-text-center">Bewertung:</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col3">
                                <button type="submit" id="sendbtn" class="btn btn-primary"><i
                                        class="far fa-check-circle"></i> Senden
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="bemerkung"
                                      placeholder="Wie hat's Ihnen geschmeckt?"></textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-2 align-text-center" id="preiscol">
            <p id="spreis"><b>Gast-</b>Preis :</p>
            <p id="preis">5, 95€</p>
            <button type="button" class="btn btn-primary btn-lg"><i class="fas fa-utensils"></i> Vorbestellen
            </button>
        </div>
    </div>    

</main>


            <!-- Footer -->
<?php
include 'inc/footer.php'
?>
    </div>
<?php
include 'inc/js.html' 
?>
    </body>
</html>