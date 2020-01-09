<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailsController extends Controller
{
    public function index($id)
    {
      $mahlzeiten =  DB::table('Mahlzeiten')
            ->join('Mahlzeit_hat_Bild','Mahlzeiten.ID','=','Mahlzeit_hat_Bild.Mahlzeiten_ID')
            ->join('Bilder','Bilder.ID','=','Mahlzeit_hat_Bild.Bild_ID')
            ->join('Preise','Mahlzeiten.ID','=','Preise.Mahlzeiten_ID')
            ->where('Mahlzeit_hat_Bild.Mahlzeiten_ID','=',$id)
//          ->select(Mahlz)
          ->first();

      $zutaten = DB::table('Mahl_enthaelt_zutat')->join('Zutaten','Mahl_enthaelt_zutat.Zutat_ID'
          ,'=','Zutaten.ID')->where('Mahlzeit_ID','=',$id)->get();


        return view('detail',['mahlzeiten' => $mahlzeiten, 'zutaten'=> $zutaten]);
    }
}
