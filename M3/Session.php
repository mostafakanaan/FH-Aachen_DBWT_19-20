<?php
if(!isset($_SESSION['angemeldet'])) {
    $_SESSION['angemeldet'] = 0;
}

if ($_SESSION['error'] == true) {
    $_SESSION['error'] = false;
    echo '<legend>Login</legend>
    <p class="error">Das hat nicht geklappt! Bitte versuchen sie es erneut.</p>
    <input type="text" class="error" id="user" name="benutzer" placeholder="Benutzer">
    <br>
    <input type="password" class="error" id="password" name="password" placeholder="*******">
    <br>
    <input type="submit" class="button" value="Anmelden">
    <input type="hidden" name="id" value="'.$_GET["rezept"].'">';
} else if (!isset($_SESSION['user'])) {
    echo '<legend>Login</legend>
    <input type="text" id="user" name="benutzer" placeholder="Benutzer">
    <br>
    <input type="password" id="password" name="password" placeholder="*******">
    <br>
    <input type="submit" class="button" value="Anmelden">
    <input type="hidden" name="id" value="'.$_GET["rezept"].'">';
} else {
    echo 'Hallo '.$_SESSION['user'].', Sie sind angemeldet als '.$_SESSION['role'].
        '<input type="submit" class="button" name="action" value="Abmelden">
    <input type="hidden" name="id" value="'.$_GET["rezept"].'">';
}