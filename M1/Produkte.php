<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>eMensa - Produkte</title>
    <meta name="description" content="Startseite der eMensa">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"
    integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz"
    crossorigin="anonymous">
</head>

    <body>
        <div class="container">
    <!--Header bzw Nav include -->
<?php
include 'inc/navbar.html'
?>

<main>

    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Speisenliste filtern</h5>
                    <div class="form-group">
                        <select class="form-contro align-items-center" id="kategorien">

                            <option disabled selected class="align-text-center">Kategorien :</option>
                            <option>Asiatisch</option>
                            <option>Burger</option>
                            <option>Deutsche Gerichte</option>
                            <option>Döner</option>
                            <option>Hähnchen</option>
                            <option>Kuchen</option>
                            <option>Pizza</option>
                            <option>Rindfleisch</option>
                            <option>Salate</option>
                            <option>Schnitzel</option>
                            <option>Wok</option>
                        </select>
                    </div>

                    <div class="form-check">
                        <ul style="list-style: none">
                            <li><input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                <label class="form-check-label" for="defaultCheck1">nur verfügbare</label></li>
                            <li><input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                                <label class="form-check-label" for="defaultCheck2">nur vegetarische</label></li>
                            <li><input class="form-check-input" type="checkbox" value="" id="defaultCheck3">
                                <label class="form-check-label" for="defaultCheck3">nur vegane</label></li>
                        </ul>
                    </div>
                    <a href="#" class="btn btn-primary" id="filter">Speisen filtern</a>
                </div>
            </div>
        </div>

<div class="col-9">
            <div class="row" id="titel">
                <h2>Verfügbare Speisen (Bestseller)</h2>
            </div>

            <div class="row">
                <div class="col-3 cols"><img src="img/CWok.jpg" alt="Curry Wok" class="smallimg">
                    <p class="produkt">Curry Wok</p>
                    <a href="Detail.php" class="underline">Details</a>
                </div>
                <div class="col-3 cols"><img src="img/Schnitzel.jpg" alt="Schnitzel" class="smallimg">
                    <p class="produkt">Schnitzel</p>
                    <a href="Detail.php" class="underline">Details</a>
                </div>
                <div class="col-3 cols"><img src="img/Bratrolle.jpg" alt="Bratrolle" class="smallimg">
                    <p class="grauerText produkt">Bratrolle</p>
                    <p class="grauerText">vergriffen</p>
                </div>
                <div class="col-3 cols"><img src="img/Krautsalat.jpg" alt="Krautsalat" class="smallimg">
                    <p class="produkt">Krautsalat</p>
                    <a href="Detail.php" class="underline">Details</a>
                </div>
            </div>
            <div class="row"><br></div>
            <div class="row">
                <div class="col-3 cols productcol"><img src="img/falafel.jpg" alt="Falafel" class="smallimg">
                    <p class="produkt">Falafel</p>
                    <a href="Detail.php" class="underline">Details</a>
                </div>
                <div class="col-3 cols productcol"><img src="img/Currywurst.png" alt="Currywurst" class="smallimg">
                    <p class="produkt">Currywurst</p>
                    <a href="Detail.php" class="underline">Details</a>
                </div>
                <div class="col-3 cols productcol"><img src="img/Kaesestulle.jpg" alt="Kaesestulle" class="smallimg">
                    <p class="produkt">Käsestulle</p>
                    <a href="Detail.php" class="underline">Details</a>
                </div>
                <div class="col-3 cols productcol"><img src="img/spiegelei.jpg" alt="Spiegelei" class="smallimg">
                    <p class="produkt">Spiegelei</p>
                    <a href="Detail.php" class="underline">Details</a>
                </div>
            </div>
        </div>
    </div>

</main>
        <!-- Footer -->
        <?php
include 'inc/footer.php'
?>
</div>
    <?php
include 'inc/js.html' 
?>
</body>
</html>