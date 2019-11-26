<?php require __DIR__ . '/vendor/autoload.php';
//Connection string..

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
//*************
//GET Parameter
//**********
$limit = @$_GET['limit'] ?: '8';//Limit GET Parameter, wenn kein Limit angegeben ist der Default wert 8
$available = @$_GET['avail'] ?: 'false';
$kat = @$_GET['kat'] ?: 0;
$vegetarisch = @$_GET['vegetarisch'] ?: 'false';
$vegan = @$_GET['vegan'] ?: 'false';


//*************
//QUERYS
//**********

$query = 'SELECT Mahlzeiten.id, Mahlzeiten.Name,Mahlzeiten.Beschreibung,Mahlzeiten.Vorrat,Mahlzeiten.Verfuegbar, P.`Alt-Text`,P.Titel,P.Binaerdaten
FROM Mahlzeiten INNER JOIN Mahlzeit_hat_Bild B on Mahlzeiten.ID = B.Mahlzeiten_ID INNER JOIN Bilder P on P.ID = B.Bild_ID'; //Query um an die Zutaten zu kommen

if($kat > 0 ){//für alle Anzeigen...
    $query .= ' WHERE Kategorie_ID = '. $kat .';';
}

$katequery = 'SELECT * FROM `Kategorien;';
//Erros abfangen...
if(mysqli_connect_errno()){
    printf("Verbindung zur Datenbank konnte nicht hergestellt werden: %s\n", mysqli_connect_error());
}
$result = mysqli_query($connection, $query);
$kateresult = mysqli_query($connection, $katequery);


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
                    <!--                            Form für Filter...-->
                    <form action="Produkte.php" method="get">

                        <h5 class="card-title">Speisenliste filtern</h5>
                        <div class="form-group">
                            <select class="form-contro align-items-center" id="kategorien">
                                <?php
                              if ($kateresult) {// Query ausführen..
                                  $optgrouprow = mysqli_fetch_all($kateresult); //$optgroup index 0 -> ID 1-> Kategorie_ID 2 -> BILD ID 3 -> Bezeichnung
                                                                                //same for $option
                                  foreach($optgrouprow as $optgroup) {
                                      if($optgroup[1] == NULL )//Ab in ein OPTGroup
                                          echo '<optgroup label="'. $optgroup[3] .'">';
                                          foreach($optgrouprow as $option) {//Suche alle die zu der OPTGroup gehören...
                                                  if($optgroup[0] == $option[1]){//$optgroup -> Obergruppe $option -> Subgruppen
                                                      echo '<option value="'. $option[3] .'">'. $option[3] .'</option>';
                                                  }
                                              }
                                      echo '</optgroup>';//Wenn alle unterkategorien gefunden wurden..
                                  }
                              }
                              ?>
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
                    </form>
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
                    while ($row = mysqli_fetch_assoc($result) and $limit > 0) {
                        $id = $row['id']; //ID richtig setzen.. -> bessere lösung: alles in ein Array wie bei Detail.php
                        if($row['Verfuegbar']) {// Wenn Produkt verfügbar ist..
                         echo '<div class="col-3 cols"><img src="data:image/gif;base64,'.base64_encode($row["Binaerdaten"]).'" alt="'. $row['Alt-Text']. '" class="smallimg">
                        <p class="produkt">' . $row['Name'] . '</p>
                        <a href="Detail.php?id=' . $id . '" class="underline">Details</a>
                        </div>';
                        }else if(!($row['Verfuegbar']) ){//Wenn Produkt vergriffen ist...
                            if($available == "false"){
                        echo '<div class="col-3 cols"><img src="data:image/gif;base64,'.base64_encode($row['Binaerdaten']).'" alt="'.$row['Alt-Text'].'" class="smallimg">
                        <p class="grauerText produkt">' . $row['Name'] . '</p>
                        <a  class="grauerText">vergriffen</a>
                        </div>';
                        }
                    }
                        $limit--;
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