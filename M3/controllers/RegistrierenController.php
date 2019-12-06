<?php

namespace Emensa\Controller {
    include('/../models/UserModel.php');
    include('/../models/FachbereichModel.php');
    $view['nickname'] = $_POST['nickname'];
    $view['gast'] = $_POST['gast'];
    $view['fh'] = $_POST['fh'];
    $view['studi'] = $_POST['studi'];
    $view['fb'] = (new \Emensa\Model\Fachbereich)->return_all();

    if ($_POST['password'] != $_POST['passwordwd']) {
        $view['error'][] = 'Die Passwörter stimmen nicht überein';
    } else {
        $view['password'] = $_POST['password'];
    }
    if ((isset($_POST['gast']) && (isset($_POST['fh']) || isset($_POST['studi'])))) {
        $view['error'][] = 'Sie können kein Gast sein und zu gleich FH Angehöriger';
    }
    if (isset($_POST['nickname']) && !isset($_POST['gast']) && !isset($_POST['fh']) && !isset($_POST['studi'])) {
        $view['error'][] = 'Keine Rolle angegeben';
    }
    if (isset($_POST['nickname']) && \emensa\Model\User::username_does_exist($_POST['nickname'])) {
        $view['error'][] = 'Der Benutzername existiert bereits';
    }
}