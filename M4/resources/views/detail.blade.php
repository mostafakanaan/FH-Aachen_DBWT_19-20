@extends('layouts.app')
@section('content')
    <div class="row background" id="detailsTitel">
        <h2 class="align-text-center" id="details">Details für {{$mahlzeiten->Name}}</h2>
        <!--                Mahlid = id in der url als Getparamter in [4] ist der name der Mahlzeit gespeichert...-->
    </div>
    <div class="row">
        <div class="col-2" id="logincol">
            <div class="card background" id="login">
                {{dd(session()->all())}}
                <div class="card-body align-text-center">
                    <h5 class="card-title align-text-center"><i class="fas fa-sign-in-alt"></i> Login</h5>
                    <form action="{{ route('login', [$id])}}" method="POST">
                        @csrf
                        <div class="form-group">
                            @if($errors->any())
                                @php $_SESSION['error'] = false @endphp
                                <p class="alert alert-danger">Das hat nicht geklappt! Bitte versuchen sie es
                                    erneut..</p>
                                <input type="text" class="form-control alert alert-danger" id="email" name="benutzer"
                                       placeholder="Benutzer">
                                <br>
                                <input type="password" class="form-control alert alert-danger" id="password"
                                       name="password"
                                       placeholder="*******">
                                <br>
                                <input type="submit" name="action" class="btn btn-primary button" value="Anmelden">
                            @elseif (\Illuminate\Support\Facades\Session::get('user') == null)
                                <label for="email">Benutzer</label>
                                <input type="text" name="benutzer" class="form-control" id="email"
                                       placeholder="Benutzer-ID.."
                                       onfocus="this.placeholder = ''" onblur="this.placeholder = 'Benutzer-ID..'"
                                       autocomplete="off">
                                <label for="password">Passwort</label>
                                <input type="password" name="password" class="form-control" id="password"
                                       placeholder="Aktuelles Passwort.."
                                       onfocus="this.placeholder = ''"
                                       onblur="this.placeholder = 'Aktuelles Passwort..'"
                                       autocomplete="off">

                                <input type="submit" name="action" class="btn btn-dark align-text-center"
                                       value="Anmelden">

                            @else
                                <div class="row">

                                </div>
                                <br>
                                <div class="row justify-content-center">
                                    <input type="submit" class="btn btn-primary button" name="action" value="Abmelden">
                                </div>
                            @endif
                            <input type="hidden" name="id" value="">
                        </div>
                    </form>
                </div>
            </div>

            <p id="register">Melden Sie sich jetzt an, um die wirklich viel günstigeren Preise für Mitarbeiter oder
                Studenten zu sehen.
            </p>

        </div>
        <div class="col-6" id="produktcol">
            <img src="data:image/gif;base64, {{base64_encode($mahlzeiten->Binaerdaten)}}" id="produktimg"
                 alt=""/>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#beschreibung" role="tab"
                       aria-controls="beschreibung" aria-selected="true">Beschreibung</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="zutaten-tab" data-toggle="tab" href="#zutaten" role="tab"
                       aria-controls="zutaten" aria-selected="false">Zutaten</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="bewertungen-tab" data-toggle="tab" href="#bewertungen" role="tab"
                       aria-controls="bewertungen" aria-selected="false">Bewertungen</a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="beschreibung" role="tabpanel">
                    {{$mahlzeiten->Beschreibung}}

                </div>
                <div class="tab-pane" id="zutaten" role="tabpanel" aria-labelledby="zutaten-tab">
                    <!--                            Zutaten ausgabe..-->
                    @foreach($zutaten as $key => $zutat)
                        {{$zutat->Name}}
                    @endforeach

                </div>
                <div class="tab-pane" id="bewertungen" role="tabpanel">
                    <form action="http://bc5.m2c-lab.fh-aachen.de/form.php" method="post" id="bewertungsform">
                        <input type="hidden" name="matrikel" value="3167397"/>
                        <input type="hidden" name="kontrolle" value="KAN"/>
                        <div class="row background">

                            @if($average!=0)
                                <h5 id="old-ratings"> Die letzten fünf Bewertungen für {{$mahlzeiten->Name}}:</h5>
                                <small> Ø Durchschnitt= {{number_format((float)$average, 2, '.', '')}} </small>
                            @else
                                <h5 id="old-ratings"> Keine Bewertungen für {{$mahlzeiten->Name}}.</h5>
                            @endif
                        </div>
                        @foreach($kommentare as $kommentar)
                            <div class="row">
                                <div class="col-8">
                                    <h5>{{$kommentar->Vorname . ' ' . $kommentar->Nachname}}</h5>
                                </div>
                                <div class="col-4">
                                    @for($x=0; $x<$kommentar->Bewertung; $x++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    {{ $kommentar->Zeitpunkt }}
                                </div>
                                <div class="col-4">
                                    {{ $kommentar->Bemerkung }}
                                </div>
                            </div>
                            <hr>
                        @endforeach
                        @if(Session::get('role') == 'Student')
                            <div class="row">
                                <h4 id="mz-bewerten">Mahlzeit bewerten:</h4>
                                {{--                                <label for="name"><b>Benutzername:</b></label>--}}
                                <input id="name" type="hidden" class="form-control" name="benutzer"
                                       placeholder="zB: remmy.."
                                       onfocus="this.placeholder = ''" onblur="this.placeholder = 'zB: remmy..'"
                                       autocomplete="off">
                                <input name="{{Session::get('user')}}" value="{{$mahlzeiten->Name}}" type="hidden">
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <select class="form-control bewertung" name="bewertung">
                                            <option disabled selected class="align-text-center">Bewertung</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <label for="bemerkung" class="visuallyhidden"></label>
                                    <textarea class="form-control" id="bemerkung" name="bemerkung"
                                              placeholder="Wie hat's Ihnen geschmeckt?"></textarea>
                                </div>
                                <div class="col-3">
                                    <button type="submit" id="sendbtn" class="btn btn-primary"><i
                                                class="far fa-check-circle"></i> Senden
                                    </button>
                                </div>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        <div class="col-2 align-text-center" id="preiscol">
            <p id="spreis">
                <b>
                    @if(Session::get('role') == 'Student')
                        Studenten
                    @elseif(Session::get('role') == 'Mitarbeiter')
                        MA
                    @else
                        Gast
                    @endif

                </b>
                -Preis :
                <b>
                    @if(Session::get('role') == 'Student')
                        {{$mahlzeiten->Studentpreis}}
                    @elseif(Session::get('role') == 'Mitarbeiter')
                        {{$mahlzeiten->MA-Preis}}
                    @else
                        {{$mahlzeiten->Gastpreis}}
                    @endif
                </b>€</p>
            <p id="preis">

            </p>
            <button type="button" class="btn btn-primary btn-lg"><i class="fas fa-utensils"></i> Vorbestellen
            </button>
        </div>
    </div>
@endsection
