<?php
namespace Emensa\Model {
    include('./db.php');
    $mahlid = $_GET['id'];// Setze get Paramter für den Dynamischen aufruf..

    $query = 'SELECT Mahlzeiten.id, X.Gastpreis, Mahlzeiten.Name,Mahlzeiten.Beschreibung,Mahlzeiten.Vorrat,Mahlzeiten.Verfuegbar, P.`Alt-Text`,P.Titel,P.Binaerdaten
FROM Mahlzeiten INNER JOIN Mahlzeit_hat_Bild B on Mahlzeiten.ID = B.Mahlzeiten_ID INNER JOIN Bilder P on P.ID = B.Bild_ID
INNER JOIN Preise X ON Mahlzeiten.ID = X.Mahlzeiten_ID WHERE B.Mahlzeiten_ID ='. $mahlid . ';'; //Query um an die Zutaten zu kommen
    $zutatquery = 'SELECT `Mahl_enthaelt_zutat`.`Mahlzeit_ID`, `Mahl_enthaelt_zutat`.`Zutat_ID`, Z.Name  FROM `Mahl_enthaelt_zutat` INNER JOIN Zutaten Z on `Mahl_enthaelt_zutat`.`Zutat_ID` = Z.ID WHERE Mahlzeit_ID ='. $mahlid . ';' ; //Query um an die Zutaten zu kommen
//Query um an alle Zutaten zu kommen mit INNER JOIN

    $result = mysqli_query($connection, $query);
    $result2 = mysqli_query($connection, $zutatquery);
    if ($result and $result2) { // Query ausführen..
        $arrayofrows = mysqli_fetch_all($result); //Speichere alle Daten in einem Array..
        $arrayofrowszutat = mysqli_fetch_all($result2);// Speichere alle daten in einem Array <- Zutaten..
    }
    if(empty($arrayofrows)){//Prüfen ob die ID Valid ist
        header('refresh:3;URL=Produkte.php');//Wenn nicht leite zur Produkt.php um..
        exit;
    }else{
    }
}
?>