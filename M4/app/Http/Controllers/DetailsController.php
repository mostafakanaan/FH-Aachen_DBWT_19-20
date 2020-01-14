<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use mysql_xdevapi\Table;
use function MongoDB\BSON\toJSON;

class DetailsController extends Controller
{
    public function index($id)
    {
        session_start();
        $_SESSION['error'] = false;
        $_SESSION['angemeldet'] = 0;
        $_SESSION['role'] = '';

        if (!session()->exists('user'))
            session(['user' => '']);

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
        session_start();
        $benutzer = DB::table('Benutzer')->where('Benutzer.Nutzername', '=', \request()->benutzer)
            ->select('Hash', 'Nummer')->first();
        if (\request()->action == 'Anmelden' AND $benutzer != null AND password_verify(\request()->password, $benutzer->Hash)) {
            $nummer = (int)\request()->Nummer;
            DB::select('call UserRole(?,@role  )', [$benutzer->Nummer]);
            $role = DB::select(DB::raw('select @role as role'));

            Session::forget('user');
            session(['user' => $_POST['benutzer']]);
            session(['role' => $role[0]->role]);
        } else if (\request()->action == 'Abmelden') {

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

    public function rate($id, $user)
    {
        $benutzernummer = DB::table('Benutzer')->where('Nutzername', '=', $user)->select('Nummer')
            ->first();

//        DB::table('Kommentare')
//            ->updateOrInsert(['Mahlzeiten_ID' => $id, 'Studenten_ID' => $benutzernummer->Nummer, 'Bemerkung' => \request()->bemerkung, 'Bewertung' => \request()->bewertung]);

        $bemerkung = '"'. \request()->bemerkung . '"';

        DB::statement('REPLACE INTO Kommentare (Mahlzeiten_ID, Studenten_ID, Bemerkung, Bewertung) VALUES (' .
            $id . ', ' .
            $benutzernummer->Nummer . ', ' .
            $bemerkung . ', ' .
            \request()->bewertung . ');'
        );

        return redirect()->back();
    }
}
