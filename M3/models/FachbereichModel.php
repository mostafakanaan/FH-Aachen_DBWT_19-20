<?php
namespace Emensa\Model {
    require_once('./db.php');
    class Fachbereich {
        public function return_all()
        {
            global $link;
            $sql = 'SELECT F.ID, F.Name FROM Fachbereiche F';
            $result = mysqli_query($link, $sql);
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
    }
}