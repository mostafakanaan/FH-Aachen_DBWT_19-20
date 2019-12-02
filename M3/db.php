<?php
//Connectiion string..
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::create(__DIR__,'.env');
$dotenv->load();
$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS','DB_PORT']);
$connection = mysqli_connect(
getenv('DB_HOST'),
getenv('DB_USER'),
getenv('DB_PASS'),
getenv('DB_NAME'),
(int) getenv('DB_PORT')
);
//Erros abfangen...
if(mysqli_connect_errno()){
printf("Verbindung zur Datenbank konnte nicht hergestellt werden: %s\n", mysqli_connect_error());
}
