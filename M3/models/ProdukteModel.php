<?php
namespace Emensa\Model {
    include('./db.php');
//*************
//GET Parameter
//**********
    $limit = @$_GET['limit'] ?: '8';
//Limit GET Parameter, wenn kein Limit angegeben ist der Default wert 8
    $available = @$_GET['avail'] ?: '0';
    $kat = @$_GET['kat'] ?: 0;
    $vegetarisch = @$_GET['vegetarisch'] ?: '0';
    $vegan = @$_GET['vegan'] ?: '0';
//*************
//QUERYS
//**********
    $query = 'SELECT Mahlzeiten.id, Mahlzeiten.Name,Mahlzeiten.Beschreibung,Mahlzeiten.Vorrat,Mahlzeiten.Verfuegbar, P.`Alt-Text`,P.Titel,P.Binaerdaten
    FROM Mahlzeiten INNER JOIN Mahlzeit_hat_Bild B on Mahlzeiten.ID = B.Mahlzeiten_ID INNER JOIN Bilder P on P.ID = B.Bild_ID
    INNER JOIN Mahl_enthaelt_zutat MEZ on Mahlzeiten.ID = MEZ.Mahlzeit_ID
    INNER JOIN Kategorien K on Mahlzeiten.Kategorie_ID = K.ID WHERE Mahlzeiten.Name IS NOT NULL '. ($available ? ' AND Mahlzeiten.Verfuegbar = 0 ' : '') . // Vefügbar abfrage
         ($vegan ? ' AND 0 = ALL (SELECT  Zutaten.Vegan FROM Zutaten Zutaten WHERE Zutaten.ID = MEZ.Zutat_ID)' : '') . //vegan abfrage
         ($vegetarisch ? ' AND 0 = ALL (SELECT  Zutaten.Vegan FROM Zutaten Zutaten WHERE Zutaten.ID = MEZ.Zutat_ID)' : '') . //Vegetarisch abfrage
         ($kat != 0 ? ' AND K.ID =' . $kat : '') .  ' GROUP BY Mahlzeiten.id' . ($limit != 0 ? ' LIMIT ' . $limit : ''); // Kategorie abfrage -> Group By um mehrfache Einträge zusammen zu fassen..
    $katequery = 'SELECT * FROM `Kategorien;'; // Um an alle Kategorien ran zu kommen...


    $result = mysqli_query($connection, $query);
    $kateresult = mysqli_query($connection, $katequery);
    mysqli_close($connection);
}
?>