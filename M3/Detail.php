<?php
require "vendor/autoload.php";
require __DIR__ . '/vendor/autoload.php';

Use eftec\bladeone\BladeOne;

$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';
$blade = new BladeOne($views,$cache,BladeOne::MODE_AUTO);

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

echo $blade->run("Detail",array("arrayofrows" => $arrayofrows, "arrayofrowszutat" => $arrayofrowszutat));


?>