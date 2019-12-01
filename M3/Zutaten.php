<?php
require "vendor/autoload.php";
require __DIR__ . '/vendor/autoload.php';

Use eftec\bladeone\BladeOne;

$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';
$blade = new BladeOne($views,$cache,BladeOne::MODE_AUTO);

$query = 'SELECT ID,Name,Vegan,Vegetarisch,Glutenfrei,Bio FROM Zutaten ORDER BY Bio DESC,Name;'; //Query um an die Zutaten zu kommen
//Connectiion string..
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
$result = mysqli_query($connection, $query);
$count = mysqli_num_rows($result);

mysqli_close($connection);

echo $blade->run("Zutaten",array("result"=>$result, "count"=>$count));