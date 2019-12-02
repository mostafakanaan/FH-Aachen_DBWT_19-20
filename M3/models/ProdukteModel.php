<?php
namespace Emensa\Model {
    include('./db.php');
//*************
//GET Parameter
//**********
    $limit = @$_GET['limit'] ?: '8';
//Limit GET Parameter, wenn kein Limit angegeben ist der Default wert 8
    $available = @$_GET['avail'] ?: 'false';
    $kat = @$_GET['kat'] ?: 0;
    $vegetarisch = @$_GET['vegetarisch'] ?: 'false';
    $vegan = @$_GET['vegan'] ?: 'false';
//*************
//QUERYS
//**********
    $query = 'SELECT Mahlzeiten.id, Mahlzeiten.Name,Mahlzeiten.Beschreibung,Mahlzeiten.Vorrat,Mahlzeiten.Verfuegbar, P.`Alt-Text`,P.Titel,P.Binaerdaten
FROM Mahlzeiten INNER JOIN Mahlzeit_hat_Bild B on Mahlzeiten.ID = B.Mahlzeiten_ID INNER JOIN Bilder P on P.ID = B.Bild_ID'; //Query um an die Zutaten zu kommen

    if ($kat > 0) {//für alle Anzeigen...
        $query .= ' WHERE Kategorie_ID = ' . $kat . ';';
    }
    $katequery = 'SELECT * FROM `Kategorien;';


    $result = mysqli_query($connection, $query);
    $kateresult = mysqli_query($connection, $katequery);
}
?>