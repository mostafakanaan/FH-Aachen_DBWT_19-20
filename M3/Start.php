<?php
require "vendor/autoload.php";
require __DIR__ . '/vendor/autoload.php';

Use eftec\bladeone\BladeOne;

$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';
$blade = new BladeOne($views,$cache,BladeOne::MODE_AUTO);


echo $blade->run("Start",array());
?>