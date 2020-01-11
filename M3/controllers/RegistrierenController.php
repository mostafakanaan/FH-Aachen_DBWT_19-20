<?php

namespace Emensa\Controller {

    require_once('./db.php');
    include(__DIR__ . '/../models/UserModel.php');
    include(__DIR__ . '/../models/FachbereichModel.php');
    $view['fbs'] = \Emensa\Model\Fachbereich::return_all();

    if (isset($_POST['first'])) {
        if (\Emensa\Model\User::username_does_exist($_POST['nickname'])) {
            $view['error'][] = 'Der Benutzername existiert bereits';
        } else {
            $view['nickname'] = $_POST['nickname'];
        }
        if ($_POST['password'] != $_POST['passwordwd']) {
            $view['error'][] = 'Die Passwörter stimmen nicht überein';
        } else {
            $view['password'] = $_POST['password'];
        }
        if ((isset($_POST['gast']) && (isset($_POST['fh']) || isset($_POST['studi'])))) {
            $view['error'][] = 'Sie können kein Gast sein und zu gleich FH Angehöriger';
        } else {
            $view['gast'] = $_POST['gast'];
            $view['fh'] = $_POST['fh'];
            $view['studi'] = $_POST['studi'];
        }
        if (isset($_POST['nickname']) && !isset($_POST['gast']) && !isset($_POST['fh']) && !isset($_POST['studi'])) {
            $view['error'][] = 'Keine Rolle angegeben';
        } else {
            $view['gast'] = $_POST['gast'];
            $view['fh'] = $_POST['fh'];
            $view['studi'] = $_POST['studi'];
        }

        if (!isset($view['error'])) {
            $view['firstsuccess'] = 'on';
        }
    } else if (isset($_POST['second'])) {
        $view['firstsuccess'] = 'on';
        if (isset($_POST['mnummer']) && !($_POST['mnummer'] > 9999999 && $_POST['mnummer'] < 1000000000)) {
            $view['error'][] = 'Die Martrikelnummer muss 8- oder 9-stellig sein';
        } else {
            $view['mnummer'] = $_POST['mnummer'];
        }
        if (\Emensa\Model\User::mnummer_does_exist($_POST['mnummer'])) {
            $view['error'][] = 'Die Martrikelnummer existiert bereits';
        } else {
            $view['mnummer'] = $_POST['mnummer'];
        }
        if (\emensa\Model\User::email_does_exist($_POST['email'])) {
            $view['error'][] = 'Die Email existiert bereits';
        } else {
            $view['email'] = $_POST['email'];
        }


        $view['password'] = $_POST['password'];
        $view['nickname'] = $_POST['nickname'];
        $view['gast'] = $_POST['gast'];
        $view['fh'] = $_POST['fh'];
        $view['studi'] = $_POST['studi'];
        $view['vorname'] = $_POST['vorname'];
        $view['nachname'] = $_POST['nachname'];
        $view['fb'] = $_POST['fb'];
        $view['studiengang'] = $_POST['studiengang'];
        $view['telefon'] = $_POST['telefon'];
        $view['buero'] = $_POST['buero'];


        if (!isset($view['error'])) {
            $error = false;
            mysqli_begin_transaction($connection);
            mysqli_query($connection, 'INSERT INTO
            Benutzer (`E-Mail`, Nutzername, Anlegedatum, Aktiv, Vorname, Nachname, Hash)
                VALUES (\''.$_POST['email'].'\',\''.$_POST['nickname'].'\',NOW(),1,\''.$_POST['vorname'].'\',\''.$_POST['nachname'].'\',\''.password_hash($_POST['password'], PASSWORD_BCRYPT).'\');');
            if (mysqli_error($connection)) {
                mysqli_rollback($connection);
                $error = true;
            }
            if (isset($_POST['fh'])||isset($_POST['studi'])) {
                mysqli_query($connection, 'INSERT INTO
                `FH_Angehoerige` (Nummer)
                    VALUES (LAST_INSERT_ID());');
                mysqli_query($connection, 'INSERT INTO FHAng_gehoertzu_Fachbereich (Benutzer_ID, Fachbereiche_ID) 
                    VALUES (LAST_INSERT_ID(),'.$_POST['fb'].');');
                if (mysqli_error($connection)) {
                    mysqli_rollback($connection);
                    $error = true;
                }
            }
            if (isset($_POST['studi'])) {
                mysqli_query($connection, 'INSERT INTO
                Studenten (Nummer, Studiengang, Matrikelnummer)
                    VALUES (LAST_INSERT_ID(), \''.$_POST['studiengang'].'\', '.$_POST['mnummer'].');');
                if (mysqli_error($connection)) {
                    mysqli_rollback($connection);
                    $error = true;
                }
            }
            if (isset($_POST['fh'])) {
                mysqli_query($connection, 'INSERT INTO
                Mitarbeiter (Nummer, Buero, Telefon)
                    VALUES (LAST_INSERT_ID(), \''.$_POST['buero'].'\', \''.$_POST['telefon'].'\');');
                if (mysqli_error($connection)) {
                    mysqli_rollback($connection);
                    $error = true;
                }
            }
            if (isset($_POST['gast'])) {
                mysqli_query($connection, 'INSERT INTO
                `Gaeste` (Nummer,Grund)
                    VALUES (LAST_INSERT_ID(),\'Emensa\');');
                if (mysqli_error($connection)) {
                    mysqli_rollback($connection);
                    $error = true;
                }
            }
            $result = mysqli_query($connection, 'SELECT LAST_INSERT_ID();');
            $view['id'] = mysqli_fetch_assoc($result)['LAST_INSERT_ID()'];
            if (mysqli_error($connection)) {
                mysqli_rollback($connection);
                $error = true;
            }
            if(!$error) {
                mysqli_commit($connection);
                $view['secondsuccess'] = 'on';
            } else {
                $view['error'][] = "Einfügen fehlgeschlagen";
            }
        }
    }
    mysqli_close($connection);
}
