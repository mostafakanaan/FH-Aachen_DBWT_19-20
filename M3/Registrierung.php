<?php

require "vendor/autoload.php";

use eftec\bladeone\BladeOne;

$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';
$blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);

require_once(__DIR__ .'/controllers/RegistrierenController.php');

if (!$view['error'] && $view['nickname'] && $view['password']) {
    echo $blade->run("Registrieren.Rolle", $view);
} else {
    echo $blade->run("Registrieren.Benutzer", $view);
}