<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function MongoDB\BSON\toJSON;

class DetailsController extends Controller
{
    public function index($id)
    {
        session_start();
        $_SESSION['error'] = false;
        $_SESSION['angemeldet'] = 0;
        $_SESSION['role'] = '';

      $mahlzeiten =  DB::table('Mahlzeiten')
            ->join('Mahlzeit_hat_Bild','Mahlzeiten.ID','=','Mahlzeit_hat_Bild.Mahlzeiten_ID')
            ->join('Bilder','Bilder.ID','=','Mahlzeit_hat_Bild.Bild_ID')
            ->join('Preise','Mahlzeiten.ID','=','Preise.Mahlzeiten_ID')
            ->where('Mahlzeit_hat_Bild.Mahlzeiten_ID','=',$id)
//          ->select(Mahlz)
          ->first();

      $zutaten = DB::table('Mahl_enthaelt_zutat')->join('Zutaten','Mahl_enthaelt_zutat.Zutat_ID'
          ,'=','Zutaten.ID')->where('Mahlzeit_ID','=',$id)->get();

        return view('detail',['mahlzeiten' => $mahlzeiten, 'zutaten'=> $zutaten, 'id' => $id]);
    }

    public function auth($id)
    {
//        "_token" => "Vokg1mPthkO7zgx5jOOpgO7wrJWWTcdbP1gDNXb9"
//      "benutzer" => "dsad"
//      "password" => "ada"
//      "action" => "Anmelden"
//      "id" => null

        // \request()->benutzer
        // \request()->password
        session_start();
        $benutzer = DB::table('Benutzer')->where('Benutzer.Nutzername', '=',\request()->benutzer)
            ->select('Hash', 'Nummer')->first();
        if ( \request()->action == 'Anmelden' AND  $benutzer != null AND password_verify(\request()->password, $benutzer->Hash)){
            $nummer = (int)\request()->Nummer;
            $sql = DB::select('CALL UserRole('.$nummer.',@role)');
            $sql = DB::select('SELECT @role');
//            $sql = DB::select('SELECT @role');
            //Fehlt ..
//            $sql = DB::select('UPDATE Benutzer B SET B.`LetzterLogin` = NOW() WHERE B.Nummer =');
            DB::table('Benutzer')->where('Benutzer.Nummer', '=',\request()->nummer);
            $_SESSION['user'] = $_POST['benutzer'];
            $_SESSION['role'] = $sql;//FIXME: kann nicht auf $sql->@role zugreifen wegen @ Symbol...

        }else if(\request()->action == 'Abmelden'){
            unset($_SESSION['user']);
            unset($_SESSION['role']);
        } else {
            return redirect()->back()->withErrors(['msg', 'The M']);
        }
        if(!isset($_SESSION['angemeldet'])) {
            $_SESSION['angemeldet'] = 0;
        }

        return redirect()->back();
    }

}
