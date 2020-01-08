@extends('layouts.app')

@section('content')
    <body>
    <div class="row">
        <div class="col splash">
            <img src="img/banner.jpg" id="banner"
                 alt="eMensa Banner - Quelle: https://unsplash.com/photos/CgVqj1l-u44 "/>
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
                        <form action="Registrierung.php">
                            <button type="submit" class="btn btn-primary signinbtn"><i
                                    class="far fa-hand-point-right"></i> Registrieren
                            </button>
                        </form>
                    </div>
                    <div class="row">
                        <form action="../Views/Detail.blade.php">
                            <button type="submit" class="btn btn-primary signinbtn"><i class="fas fa-sign-in-alt"></i>
                                Anmelden
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <p>Registrieren Sie sich <a class="underline" href="Registrierung.php">hier</a>, um über die
                Veröffentlichung
                des Dienstes per Mail informiert zu werden.
            </p>
        </div>
        <div class="col not-splash">
            <img src="img/food.jpg" id="food"
                 alt="Food Quelle: https://www.freepik.com/premium-photo/hand-drawn-pieces-pizza-pizza-sharing-share-business-shareholders_2359324.htm"/>
        </div>
    </div>
@endsection
