<?php

namespace Emensa\Model {
    class User
    {
        public function username_does_exist($username) {
            global $connection;
            $sql = 'SELECT * FROM Benutzer WHERE Nutzername = \''.$username.'\'';
            $result = mysqli_query($connection, $sql);
            if (0 < mysqli_num_rows($result)) {
                return true;
            } else {
                return false;
            }
        }

        public function mnummer_does_exist($mnummer) {
            global $connection;
            $sql = 'SELECT * FROM Studenten WHERE Matrikelnummer = \''.$mnummer.'';
            $result = mysqli_query($connection, $sql);
            if (0 < mysqli_num_rows($result)) {
                return true;
            } else {
                return false;
            }
        }

        public function email_does_exist($email) {
            global $connection;
            $sql = 'SELECT * FROM Benutzer WHERE `E-Mail` = \''.$email.'\'';
            $result = mysqli_query($connection, $sql);
            if (0 < mysqli_num_rows($result)) {
                return true;
            } else {
                return false;
            }
        }

        public function getID($benutzername) {
            global $connection;
            $sql = 'SELECT Nummer FROM Benutzer WHERE `Nutzername` = \''.$benutzername.'\'';
            $result = mysqli_query($connection, $sql);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
    }
}
