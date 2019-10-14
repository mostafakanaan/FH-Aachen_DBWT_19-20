<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
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

<!-- TODO: Trennstrich unter nav, nav auslagern, -->

<body>
    <div class="container">
<!--Header bzw Nav include -->
<?php
include 'inc/navbar.html'
?>

        <!-- content area -->
        <main><div class="row">
        <div class="col splash">
            <img src="img/banner.jpg" id="banner" alt="eMensa Banner - Quelle: https://unsplash.com/photos/CgVqj1l-u44 "/>
        </div>
    </div>
    <div class="row">
        <div class="col-4">   <!--Side Text  -->
            <p>Der Dienst <b>e-Mensa</b> ist noch beta. Sie können bereits
                <a class="underline" href="Produkte.php">Mahlzeiten</a> durchstöbern, aber noch nicht bestellen.
            </p>
        </div>
        <div class="col-8">
            <div class="row">
                <div class="col-8"><h2>Leckere Gerichte vorbestellen</h2>
                    <p id="legga">... und gemeinsam mit Kommilitonen und Freunden essen</p></div>
                <div class="col-4" id="buttons">
                    <div class="row">
                    <button type="button" class="btn btn-primary signinbtn"><i class="far fa-hand-point-right"></i> Registrieren</button>
                    </div>
                    <div class="row">
                    <button type="button" class="btn btn-primary signinbtn"><i class="fas fa-sign-in-alt"></i> Anmelden</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <p>Registrieren Sie sich <a class="underline" href="#">hier</a>, um über die Veröffentlichung
                des Dienstes per Mail informiert zu werden.
            </p>
        </div>
        <div class="col not-splash">
            <img src="img/food.jpg" id="food" alt="Food Quelle: https://www.freepik.com/premium-photo/hand-drawn-pieces-pizza-pizza-sharing-share-business-shareholders_2359324.htm"/>
        </div>
    </div>

        </main>
        




        <!-- Footer -->
<?php
include 'inc/footer.html'
?>

    </div>
<?php
include 'inc/js.html' 
?>
</body>
</html>