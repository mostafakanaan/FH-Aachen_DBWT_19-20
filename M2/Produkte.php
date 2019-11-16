<?php require __DIR__ . '/vendor/autoload.php';
//Connectiion string..
$query = 'SELECT Mahlzeiten.id, Mahlzeiten.Name,Mahlzeiten.Beschreibung,Mahlzeiten.Vorrat,Mahlzeiten.Verfuegbar, P.`Alt-Text`,P.Titel,P.Binaerdaten
FROM Mahlzeiten INNER JOIN Mahlzeit_hat_Bild B on Mahlzeiten.ID = B.Mahlzeiten_ID INNER JOIN Bilder P on P.ID = B.Bild_ID;'; //Query um an die Zutaten zu kommen
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
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>eMensa - Produkte</title>
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
include 'inc/navbar.php'
?>

<main>
    <div class="row">
        <div class="col-3">
            <div class="card background" id="bigcard">
                <div class="card-body">
                    <h5 class="card-title">Speisenliste filtern</h5>
                    <div class="form-group">
                        <select class="form-contro align-items-center" id="kategorien">

                            <option disabled selected class="align-text-center">Kategorien :</option>
                            <option>Asiatisch</option>
                            <option>Burger</option>
                            <option>Deutsche Gerichte</option>
                            <option>Döner</option>
                            <option>Hähnchen</option>
                            <option>Kuchen</option>
                            <option>Pizza</option>
                            <option>Rindfleisch</option>
                            <option>Salate</option>
                            <option>Schnitzel</option>
                            <option>Wok</option>
                        </select>
                    </div>

                    <div class="form-check">
                        <ul style="list-style: none">
                            <li><input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">nur verfügbare</label></li>
                            <li><input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                                <label class="form-check-label" for="defaultCheck2">nur vegetarische</label></li>
                            <li><input class="form-check-input" type="checkbox" value="" id="defaultCheck3">
                                <label class="form-check-label" for="defaultCheck3">nur vegane</label></li>
                        </ul>
                    </div>
                    <a href="#" class="btn btn-dark" id="filter">Speisen filtern</a>
                </div>
            </div>
        </div>

<div class="col-9">
            <div class="row background" id="titel">
                <h2>Verfügbare Speisen (Bestseller)</h2>
            </div>

            <div class="row">
                <?php
                if ($result) {// Query ausführen..
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'] -1; //ID richtig setzen.. -> bessere lösung: alles in ein Array wie bei Detail.php
                        if($row['Verfuegbar']) {// Wenn Produkt verfügbar ist..
                         echo '<div class="col-3 cols"><img src="data:image/gif;base64,'.base64_encode($row["Binaerdaten"]).'" alt="'. $row['Alt-Text']. '" class="smallimg">
                        <p class="produkt">' . $row['Name'] . '</p>
                        <a href="Detail.php?id=' . $id . '" class="underline">Details</a>
                        </div>';
                        }else {//Wenn Produkt vergriffen ist...
                        echo '<div class="col-3 cols"><img src="data:image/gif;base64,'.base64_encode($row['Binaerdaten']).'" alt="'.$row['Alt-Text'].'" class="smallimg">
                        <p class="grauerText produkt">' . $row['Name'] . '</p>
                        <a  class="grauerText">vergriffen</a>
                        </div>';

                        }
                    }
                }
                mysqli_close($connection);
                ?>
            </div>
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