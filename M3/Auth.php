<?php
include("./db.php");
session_start();

$sql = 'SELECT Hash, Nummer FROM Benutzer B
WHERE B.Nutzername = \''.$_POST['benutzer'].'\'';
$result = mysqli_query($connection, $sql);

if ($result) $row = mysqli_fetch_assoc($result);

if (password_verify($_POST['password'], $row['Hash'])) {
    $sql = 'CALL UserRole('.$row['Nummer'].', @role);';
    $result = mysqli_query($connection, $sql);
    $sql = 'SELECT @role;';
    $result = mysqli_query($connection, $sql);
    if ($result) {
        $row2 = mysqli_fetch_assoc($result);
    }
    $_SESSION['user'] = $_POST['benutzer'];
    $_SESSION['role'] = $row2["@role"];
    $sql = 'UPDATE Benutzer B SET B.`LetzterLogin` = NOW() WHERE B.Nummer = '.$row['Nummer'];
    $result = mysqli_query($connection, $sql);
} else if ($_POST['action'] == 'Abmelden') {
    unset($_SESSION['user']);
    unset($_SESSION['role']);
} else {
    $_SESSION['error'] = true;
}
if(!isset($_SESSION['angemeldet'])) {
    $_SESSION['angemeldet'] = 0;
}
mysqli_free_result($result);
header("Location: Detail.php?id=" . $_POST["id"]);
