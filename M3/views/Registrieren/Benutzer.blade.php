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
            <form action="Registrierung.php" method="POST">
                <div class="card background" id="registration">
                    <div class="card-body align-text-center">
                        <h5 class="card-title align-text-center"><i class="fas fa-user-plus"></i> Registrieren</h5>
                        <div class="form-group">
                            <label for="nickname">Benutzername</label>
                            <input class="form-control registerbox" type="text" name="nickname" id="nickname" required
                                   value="{{$nickname or ''}}"
                                   placeholder="zB: remmydemmy.." onfocus="this.placeholder = ''"
                                   onblur="this.placeholder = 'zB: remmydemmy..'"
                                   autocomplete="off">
                            <label for="pass">Passwort</label>
                            <input class="form-control registerbox" type="password" name="password" id="pass" required
                                   value="{{$password or ''}}"
                                   placeholder="Neues Passwort.." onfocus="this.placeholder = ''"
                                   onblur="this.placeholder = 'Neues Passwort..'"
                                   autocomplete="off">
                            <label for="passwd">Passwort wiederholen</label>
                            <input class="form-control registerbox" type="password" name="passwordwd" id="passwd"
                                   required value="{{$password or ''}}"
                                   placeholder="Wiederholung.." onfocus="this.placeholder = ''"
                                   onblur="this.placeholder = 'Wiederholung..'"
                                   autocomplete="off">
                            <br> <input class="form-check-input" type="checkbox" name="studi" id="studi">
                            <label class="form-check-label" for="studi">Student</label>
                            <br> <input class="form-check-input" type="checkbox" name="fh" id="fh">
                            <label class="form-check-label" for="fh">Mitarbeiter</label>
                            <br><input class="form-check-input" type="checkbox" name="gast" id="gast">
                            <label class="form-check-label" for="gast">Gast</label>
                        </div>
                        <input type="hidden" name="first" value="on">
                        <input type="submit" class="btn btn-dark align-text-center" value="Fortsetzen">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection