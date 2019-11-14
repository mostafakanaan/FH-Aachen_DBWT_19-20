<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>eMensa - Startseite</title>
    <meta name="description" content="Startseite der eMensa">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"
          integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz"
          crossorigin="anonymous">
</head>

<?php
$query = 'SELECT ID,Name,Beschreibung,Verfuegbar,Gastpreis FROM Mahlzeiten INNER JOIN Preise P on Mahlzeiten.ID = P.Mahlzeiten_ID ;'; //Query um an die Zutaten zu kommen
//Connectiion string..
$connection = mysqli_connect('149.201.88.110','s_mk6651s',',SDS@A8.AC', 'db3166667','3306');

//Erros abfangen...
if(mysqli_connect_errno()){
    printf("Verbindung zur Datenbank konnte nicht hergestellt werden: %s\n", mysqli_connect_error());
}
$result = mysqli_query($connection, $query);
$mahlid = $_GET['id']; // Setze get Paramter für den Dynamischen aufruf..

if ($result) { // Query ausführen..
    $arrayofrows = mysqli_fetch_all($result); //Speichere alle Daten in einem Array..
    echo "<pre>";
    print_r($arrayofrows[$mahlid - 1]); // -1 damit die übergabe parameter mit der ID in der Datenbank übereinstimmen
    echo "</pre>";

    echo "<pre>";
    print_r($_GET['id']);
    echo "</pre>";


}
mysqli_close($connection);

?>
