<?php
namespace Emensa\Controller {
    require_once(__DIR__ . '/../vendor/autoload.php');

    Use eftec\bladeone\BladeOne;

    $views = __DIR__ . '/../views';
    $cache = __DIR__ . '/../cache';
    $blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);

    echo $blade->run("Start", array());



}