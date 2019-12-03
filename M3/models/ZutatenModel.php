<?php
namespace Emensa\Model {
    include('./db.php');

        $sql = 'SELECT ID,Name,Vegan,Vegetarisch,Glutenfrei,Bio FROM Zutaten ORDER BY Bio DESC,Name;';
        $result = mysqli_query($connection, $sql);
        $count = mysqli_num_rows($result);
}