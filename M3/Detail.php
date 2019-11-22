<?php require __DIR__ . '/vendor/autoload.php'; ?>
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
<?php
$mahlid = $_GET['id'];// Setze get Paramter für den Dynamischen aufruf..

$query = 'SELECT Mahlzeiten.id, X.Gastpreis, Mahlzeiten.Name,Mahlzeiten.Beschreibung,Mahlzeiten.Vorrat,Mahlzeiten.Verfuegbar, P.`Alt-Text`,P.Titel,P.Binaerdaten
FROM Mahlzeiten INNER JOIN Mahlzeit_hat_Bild B on Mahlzeiten.ID = B.Mahlzeiten_ID INNER JOIN Bilder P on P.ID = B.Bild_ID
INNER JOIN Preise X ON Mahlzeiten.ID = X.Mahlzeiten_ID WHERE B.Mahlzeiten_ID ='. $mahlid . ';'; //Query um an die Zutaten zu kommen

$zutatquery = 'SELECT `Mahl_enthaelt_zutat`.`Mahlzeit_ID`, `Mahl_enthaelt_zutat`.`Zutat_ID`, Z.Name  FROM `Mahl_enthaelt_zutat` INNER JOIN Zutaten Z on `Mahl_enthaelt_zutat`.`Zutat_ID` = Z.ID WHERE Mahlzeit_ID ='. $mahlid . ';' ; //Query um an die Zutaten zu kommen
//Query um an alle Zutaten zu kommen mit INNER JOIN
//Connectiion string..
$dotenv = Dotenv\Dotenv::create(__DIR__,'.env');
$dotenv->load();
$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS','DB_PORT']);
$connection = mysqli_connect(
    getenv('DB_HOST'),
    getenv('DB_USER'),
    getenv('DB_PASS'),
    getenv('DB_NAME'),
    (int) getenv('DB_PORT')
);
//Erros abfangen...
if(mysqli_connect_errno()){
    printf("Verbindung zur Datenbank konnte nicht hergestellt werden: %s\n", mysqli_connect_error());
}
$result = mysqli_query($connection, $query);
$result2 = mysqli_query($connection, $zutatquery);

if ($result and $result2) { // Query ausführen..
    $arrayofrows = mysqli_fetch_all($result); //Speichere alle Daten in einem Array..
    $arrayofrowszutat = mysqli_fetch_all($result2);// Speichere alle daten in einem Array <- Zutaten..

}
mysqli_close($connection);
if(empty($arrayofrows)){//Prüfen ob die ID Valid ist
    header('refresh:3;URL=Produkte.php');//Wenn nicht leite zur Produkt.php um..
    exit;
}else{

}
?>
<body>
    <div class="container">
        <!--Header bzw Nav include -->
        <?php include 'inc/navbar.php' ?>

        <main>
            <div class="row background" id="detailsTitel">

                <h2 class="align-text-center" id="details">Details für <?php  echo '"'. $arrayofrows[0][2]. '"' ?></h2>
<!--                Mahlid = id in der url als Getparamter in [2] ist der name der Mahlzeit gespeichert...-->
            </div>

            <div class="row">
                <div class="col-2" id="logincol">
                    <div class="card background" id="login">
                        <div class="card-body align-text-center">
                            <h5 class="card-title align-text-center"><i class="fas fa-sign-in-alt"></i> Login</h5>
                            <div class="form-group">
                                <label for="email">Benutzer</label>
                                <input type="email" class="form-control" id="email" placeholder="Benutzer-ID.." onfocus="this.placeholder = ''" onblur="this.placeholder = 'Benutzer-ID..'" autocomplete="off">
                                <label for="password">Passwort</label>
                                <input type="password" class="form-control" id="password" placeholder="Aktuelle Passwort.." onfocus="this.placeholder = ''" onblur="this.placeholder = 'Aktuelle Passwort..'" autocomplete="off"> 
                            </div>
                            <a class="btn btn-dark align-text-center" href="#">Anmelden</a>
                        </div>
                    </div>
                    <p id="register">Melden Sie sich jetzt an, um die wirklich viel günstigeren Preise für Mitarbeiter oder Studenten zu sehen.
                    </p>
                </div>
                <div class="col-6" id="produktcol">

                    <img src="data:image/gif;base64,<?php echo base64_encode($arrayofrows[0][8]) ?>" id="produktimg" alt=" <?php  echo $arrayofrows[0][6] ?>"/>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist"> 
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
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="beschreibung" role="tabpanel"><?php echo $arrayofrows[0][3]?>
                        </div>
                        <div class="tab-pane" id="zutaten" role="tabpanel" aria-labelledby="zutaten-tab">
<!--                            Zutaten ausgabe..-->
                            <?php
                            foreach($arrayofrowszutat as $zutat){// Alle Zutaten im Array ausgeben...
                                if($zutat == end($arrayofrowszutat)){//Wenn das die letzte Zutat im Array ist...
                                    echo $zutat[2];

                                }else{//Wenns nicht die letzte ist...
                                    echo $zutat[2] . ', ';
                                }

                            }


                            ?>
                        </div>
                        <div class="tab-pane" id="bewertungen" role="tabpanel">
                            <form action="http://bc5.m2c-lab.fh-aachen.de/form.php" method="post" id="bewertungsform">
                                <input type="hidden" name="matrikel" value="3167397"/>
                                <input type="hidden" name="kontrolle" value="KAN"/>
                                <div class="form-group" id="benutzername">
                                    <div class="row">
                                    <label for="name"><b>Benutzername:</b></label>
                                    <input id="name" class="form-control" name="benutzer" placeholder="zB: remmy.." onfocus="this.placeholder = ''" onblur="this.placeholder = 'zB: remmy..'" autocomplete="off">
                                </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-4">
                                        <div class="form-group mahlzeiten">
                                            <select class="form-control mahlzeiten" name="mahlzeit">
                                                <option disabled selected class="align-text-center">Mahlzeit</option>
                                                <option>Curry Wok</option>
                                                <option>Schnitzel</option>
                                                <option>Bratrolle</option>
                                                <option>Krautsalat</option>
                                                <option>Falafel</option>
                                                <option>Currywurst</option>
                                                <option>Käsestulle</option>
                                                <option>Spiegelei</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <select class="form-control bewertung" name="bewertung">
                                                <option disabled selected class="align-text-center">Bewertung</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-5">
                                            <label for="bemerkung" class="visuallyhidden"></label>
                                            <textarea class="form-control" id="bemerkung" name="bemerkung"
                                            placeholder="Wie hat's Ihnen geschmeckt?"></textarea>
                                    </div>
                                    <div class="col-3">
                                        <button type="submit" id="sendbtn" class="btn btn-primary"><i class="far fa-check-circle"></i> Senden
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-2 align-text-center" id="preiscol">
                    <p id="spreis"><b>Gast-</b>Preis :</p>
                    <p id="preis"> <?php echo $arrayofrows[0][1]?> </p>
                    <button type="button" class="btn btn-primary btn-lg"><i class="fas fa-utensils"></i> Vorbestellen
                    </button>
                </div>
            </div>   
        </main>
        <!-- Footer -->
        <?php include 'inc/footer.php';include 'inc/js.html'?>
    </div>
</body>
</html>