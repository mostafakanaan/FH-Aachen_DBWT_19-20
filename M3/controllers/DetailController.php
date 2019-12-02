<?php

namespace Emensa\Controller {
    require_once(__DIR__ . '/../vendor/autoload.php');
    include(__DIR__ . '/../models/DetailModel.php');

    Use eftec\bladeone\BladeOne;


    $views = __DIR__ . '/../views';
    $cache = __DIR__ . '/../cache';
    $blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);

    mysqli_close($connection);

    echo $blade->run("Detail", array("arrayofrows" => $arrayofrows, "arrayofrowszutat" => $arrayofrowszutat));

}
?>