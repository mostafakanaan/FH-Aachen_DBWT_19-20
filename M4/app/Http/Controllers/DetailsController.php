<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use function MongoDB\BSON\toJSON;

class DetailsController extends Controller
{
    public function index($id)
    {
        session_start();
        $_SESSION['error'] = false;
        $_SESSION['angemeldet'] = 0;
        $_SESSION['role'] = '';

        $mahlzeiten = DB::table('Mahlzeiten')
            ->join('Mahlzeit_hat_Bild', 'Mahlzeiten.ID', '=', 'Mahlzeit_hat_Bild.Mahlzeiten_ID')
            ->join('Bilder', 'Bilder.ID', '=', 'Mahlzeit_hat_Bild.Bild_ID')
            ->join('Preise', 'Mahlzeiten.ID', '=', 'Preise.Mahlzeiten_ID')
            ->where('Mahlzeit_hat_Bild.Mahlzeiten_ID', '=', $id)
//          ->select(Mahlz)
            ->first();

        $kommentare = DB::select('SELECT Vorname, Nachname, Bewertung, Bemerkung, Zeitpunkt FROM Kommentare
    JOIN Studenten on Studenten.Nummer=Studenten_ID
    JOIN Benutzer on Benutzer.Nummer=Studenten_ID
    WHERE Mahlzeiten_ID=' . $id .
            ' ORDER BY Zeitpunkt;');

        $zutaten = DB::table('Mahl_enthaelt_zutat')->join('Zutaten', 'Mahl_enthaelt_zutat.Zutat_ID'
            , '=', 'Zutaten.ID')->where('Mahlzeit_ID', '=', $id)->get();

        $sum = 0;
        $average = 0;

        if (!empty($kommentare)) {
            foreach ($kommentare as $kommentar) {
                $sum += $kommentar->Bewertung;
            }
            $average = $sum / count($kommentare);
        }

        return view('detail', ['mahlzeiten' => $mahlzeiten, 'zutaten' => $zutaten, 'id' => $id, 'kommentare' => $kommentare, 'average' => $average]);
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
        $benutzer = DB::table('Benutzer')->where('Benutzer.Nutzername', '=', \request()->benutzer)
            ->select('Hash', 'Nummer')->first();
        if (\request()->action == 'Anmelden' AND $benutzer != null AND password_verify(\request()->password, $benutzer->Hash)) {
            $nummer = (int)\request()->Nummer;
            DB::select('call UserRole(?,@role  )', [$benutzer->Nummer]);
            $role = DB::select(DB::raw('select @role as role'));

            $_SESSION['user'] = $_POST['benutzer'];
            session(['role' => $role[0]->role]);

        } else if (\request()->action == 'Abmelden') {
//            unset($_SESSION['user']);
//            unset($_SESSION['role']);
            Session::forget('user');
            Session::forget('role');
        } else {
            return redirect()->back()->withErrors(['msg', 'The M']);
        }
        if (!isset($_SESSION['angemeldet'])) {
            $_SESSION['angemeldet'] = 0;
        }

        return redirect()->back();
    }

}
