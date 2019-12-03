<?php
namespace Emensa\Controller {
    include(__DIR__ . '/../models/ProdukteModel.php');

    $view= [
        'result'=>$result,
        'kateresult'=>$kateresult,
        'limit'=> $limit,
        'available'=>$available,
        'kat'=>$kat,
        'vegetarisch'=>$vegetarisch,
        'vegan'=>$vegan
    ];

}
?>