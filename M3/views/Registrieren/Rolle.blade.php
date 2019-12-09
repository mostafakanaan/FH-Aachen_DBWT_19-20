@extends('app')
@section('pageTitle','Registrierung')
@section('content')

    <form action="Registrierung.php" method="post">
        <div class="col-12 justify-content-center">
            <div class="row justify-content-center">
                <div class="col-5 justify-content-center">
                    @if (isset($error))
                        <fieldset class="alert alert-danger">
                            <legend>Es gab Fehler beim Bearbeiten Ihrer Anfrage:</legend>
                            <ul>
                                @foreach ($error as $item)
                                    <li>{{$item}}</li>
                                @endforeach
                            </ul>
                        </fieldset>
                    @endif

                    <div class="card background registration">
                        <div class="card-body align-text-center">
                            <h3 class="card-title align-text-center">Benutzerdaten: </h3>
                            {{--      Name und email abfragen..      --}}
                            <label for="benutzer_vorname">Vorname</label>
                            <input class="form-control registerbox" type="text" name="vorname" id="benutzer_vorname"
                                   required
                                   placeholder="zB: marcel.." onfocus="this.placeholder = ''"
                                   onblur="this.placeholder = 'zB: marcel..'"
                                   autocomplete="off">
                            <label for="benutzer_nachname">Nachname</label>
                            <input class="form-control registerbox" type="text" name="nachname" id="benutzer_nachname"
                                   required
                                   placeholder="zB: remmy" onfocus="this.placeholder = ''"
                                   onblur="this.placeholder = 'zB: remmy'"
                                   autocomplete="off">
                            <label for="em">E-Mail</label>
                            <input class="form-control registerbox" type="email" name="email" id="em" required
                                   placeholder="zB: remmy@fh-aachen.de" onfocus="this.placeholder = ''"
                                   onblur="this.placeholder = 'zB: remmy@fh-aachen.de'"
                                   autocomplete="off"><br>
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" name="nickname" value="{{$nickname}}">
            <input type="hidden" name="password" value="{{$password}}">
            <input type="hidden" name="second">

            @if (isset($fh))
                <div class="row justify-content-center">
                    <div class="col-5 justify-content-center">
                        <div class="card background registration">
                            <div class="card-body align-text-center">
                                <h4>Ihre Daten als Mitarbeiter:</h4>
                                <label for="fb">In welchem FB arbeiten Sie?</label><br>
                                <select name="fb" id="fb" size="5" required>
                                    <?php
                                    foreach ($fbs as $item) {
                                        echo "<option value='" . $item['ID'] . "'";
                                        if ($fb == $item['ID']) echo " selected";
                                        echo "\>" . $item['Name'] . "</option>";
                                    }
                                    ?>
                                </select><br>
                                <label for="buero">Büro</label>
                                <input class="form-control registerboxsmall" type="text" name="buero" id="buero" required
                                       value="{{$buero or ''}}"> <br>
                                <label for="telefon">Telefonnummer</label>
                                <input class="form-control registerboxsmall" type="tel" name="telefon" id="telefon" required
                                value="{{$telefon or ''}}"> <br> <br>
                                <input type="hidden" name="fh" value="on">
                                <input type="submit" class="btn btn-dark align-text-center" value="Senden">
                            </div>
                        </div>
                    </div>
                </div>
            @elseif (isset($studi))
                <div class="row justify-content-center">
                    <div class="col-5 justify-content-center">
                        <div class="card background registration">
                            <div class="card-body align-text-center">
                                <h4>Ihre Daten als Student:</h4>
                                <label for="fb">In welchem FB studieren Sie?</label><br>
                                <select name="fb" id="fb" size="5" required>
                                    <?php
                                    foreach ($fbs as $item) {
                                        echo "<option value='" . $item['ID'] . "'";
                                        if ($fb == $item['ID']) echo " selected";
                                        echo ">" . $item['Name'] . "</option>";
                                    }
                                    ?>
                                </select><br>
                                <label for="mnummer">Matrikelnummer</label>
                                <input class="form-control registerbox" type="text" name="mnummer" id="mnummer"
                                       required
                                       placeholder="... 8 bis 9 stellig!" onfocus="this.placeholder = ''"
                                       onblur="this.placeholder = '8 bis 9 stellig!'"
                                       autocomplete="off">
                                <label for="studiengang">Studiengang</label>
                                <select name="studiengang" id="studiengang" required>
                                    <option value="ET" @if ($studiengang == 'ET') selected @endif>ET</option>
                                    <option value="INF" @if ($studiengang == 'INF') selected @endif>INF</option>
                                    <option value="ISE" @if ($studiengang == 'ISE') selected @endif>ISE</option>
                                    <option value="MCD" @if ($studiengang == 'MCD') selected @endif>MCD</option>
                                    <option value="WI" @if ($studiengang == 'WI') selected @endif>WI</option>
                                </select> <br>
                                <input type="submit" class="btn btn-dark align-text-center" value="Senden">
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="studi" value="on">
            @else
                <input type="hidden" name="gast" value="on">
                <input type="submit" class="btn btn-dark align-text-center" value="Senden">
            @endif

        </div>
    </form>

@endsection