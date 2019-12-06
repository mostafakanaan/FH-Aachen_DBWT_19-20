<?php

namespace Emensa\Model {
    require_once('./db.php');

    class User
    {
        public function email_does_exist()
        {

        }

        public function username_does_exist($username)
        {
            global $link;
            $sql = 'SELECT * FROM Benutzer WHERE Nutzername = "' . $username . '"';
            $result = mysqli_query($link, $sql);
            if (0 < mysqli_num_rows($result)) {
                return true;
            } else {
                return false;
            }
        }

        public function matriklenumber_does_exist()
        {

        }
    }
}
