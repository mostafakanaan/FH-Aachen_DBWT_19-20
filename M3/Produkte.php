<?php
require "vendor/autoload.php";
require __DIR__ . '/vendor/autoload.php';

Use eftec\bladeone\BladeOne;

$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';
$blade = new BladeOne($views,$cache,BladeOne::MODE_AUTO);

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

mysqli_close($connection);

echo $blade->run("Produkte",array("result"=>$result, "kateresult"=>$kateresult, "limit"=>$limit, "available"=>$available, "kat"=>$kat, "vegetarisch"=>$vegetarisch, "vegan"=>$vegan));
?>