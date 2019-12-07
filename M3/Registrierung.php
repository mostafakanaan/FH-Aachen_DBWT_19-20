<?php
require "vendor/autoload.php";

use eftec\bladeone\BladeOne;

$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';
$blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);

include(__DIR__ . '/controllers/RegistrierenController.php');


//echo '<pre>';
//var_dump($view);
//echo '</pre>';

//foreach ($view['fbs'] as $item)
//    echo $item['ID'] . ' - ' . $item['Name'];


//foreach ($view['fbs'] as $item)
//    echo "<option value='";


if (isset($view['secondsuccess'])) {
    echo $blade->run("Registrieren.Done", $view);
} else if (isset($view['firstsuccess'])) {
    echo $blade->run("Registrieren.Rolle", $view);
} else {
    echo $blade->run("Registrieren.Benutzer", $view);
}
