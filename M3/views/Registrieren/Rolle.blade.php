@extends('app')
@section('pageTitle','Registrierung')
@section('content')

    <div class="row justify-content-center">
        <div class="col-5">
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
            <form action="Registrierung.php" method="post">
                <div class="card background" id="registration">
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

                        @if (isset($studi) || isset($fh))
                            <h5>Ihr Fachbereich</h5>
                            <label for="fb">In welchem FB @if(isset($studi))studieren @else arbeiten @endif
                                Sie?</label><br>
                            <select name="fb" id="fb" size="5" required>
                                @foreach ($fb as $item)
                                    <option value="{{$item['ID']}}">{{$item['Name']}}</option> {{--TODO--}}
                                @endforeach
                            </select>
                            <div>
                                @endif
                                @if (isset($studi))
                                    <h5>Ihre Daten als Student</h5>
                                    <label for="mnummer">Matrikelnummer</label>
                                    <input type="text" name="mnummer" id="mnummer" required><br>
                                    <label for="studiengang">Studiengang</label>
                                    <select name="studiengang" id="studiengang" required>
                                        <option value="ET">ET</option>
                                        <option value="INF">INF</option>
                                        <option value="ISE">ISE</option>
                                        <option value="MCD">MCD</option>
                                        <option value="WI">WI</option>
                                    </select>
                                @endif

                                <input type="hidden" name="nickname" value="{{$nickname}}">
                                <input type="hidden" name="password" value="{{$password}}">
                                <input type="hidden" name="second">
                                <input type="submit" class="btn btn-dark align-text-center" value="Senden">
                            </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection