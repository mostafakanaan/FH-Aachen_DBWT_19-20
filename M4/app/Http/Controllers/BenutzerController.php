<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BenutzerController extends Controller
{
    public function auth()
    {
//        "_token" => "Vokg1mPthkO7zgx5jOOpgO7wrJWWTcdbP1gDNXb9"
//      "benutzer" => "dsad"
//      "password" => "ada"
//      "action" => "Anmelden"
//      "id" => null

        // \request()->benutzer
        // \request()->password
    dd(\request());
        session_start();
        $benutzer = DB::table('Benutzer')->where('Benutzer.Nutzername', '=',\request()->benutzer)
            ->select('Hash', 'Nummer')->first();

        if (password_verify(\request()->password, $benutzer->Hash)){

//            $sql = DB::select('CALL UserRole(\request()->Nummer, @role');
//            $sql = DB::select('SELECT @role');
            //Fehlt ..
//            $sql = DB::select('UPDATE Benutzer B SET B.`LetzterLogin` = NOW() WHERE B.Nummer = {{/request->Nummer}}');
            $_SESSION['user'] = $_POST['benutzer'];
//            $_SESSION['role'] = $row2["@role"];
            dd($_POST);

        }else if($_POST['action'] == 'Abmelden'){
            unset($_SESSION['user']);
//            unset($_SESSION['role']);
        } else {
            $_SESSION['error'] = true;
        }
        if(!isset($_SESSION['angemeldet'])) {
            $_SESSION['angemeldet'] = 0;
        }

        return redirect()->action('DetailsController@index');
    }

}
