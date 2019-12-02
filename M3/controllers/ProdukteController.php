<?php
namespace Emensa\Controller {
    require_once(__DIR__ . '/../vendor/autoload.php');
    include(__DIR__ . '/../models/ProdukteModel.php');


    Use eftec\bladeone\BladeOne;

    $views = __DIR__ . '/../views';
    $cache = __DIR__ . '/../cache';
    $blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);

    mysqli_close($connection);

    echo $blade->run("Produkte", array("result" => $result, "kateresult" => $kateresult, "limit" => $limit, "available" => $available, "kat" => $kat, "vegetarisch" => $vegetarisch, "vegan" => $vegan));
}
?>