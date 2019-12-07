<?php
namespace Emensa\Controller {
    include(__DIR__ . '/../models/DetailModel.php');

    session_start();


    $view= [
        'arrayofrows'=>$arrayofrows,
        'arrayofrowszutat'=>$arrayofrowszutat
    ];


}