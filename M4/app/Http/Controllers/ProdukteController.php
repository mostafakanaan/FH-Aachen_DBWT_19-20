<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukteController extends Controller
{
    public function index($limit = 8, $avail = 0, $vegan = 0, $kat = 2, $vegetarisch = 0)
    {
//        dd($limit);
       $produkte = DB::table('Mahlzeiten')
           ->join('Mahlzeit_hat_Bild','Mahlzeiten.ID','=', 'Mahlzeit_hat_Bild.Mahlzeiten_ID')
//           ->join('Bilder','Bilder.ID','=', 'Mahlzeit_hat_Bild.Bild_ID')
           ->join('Mahl_enthaelt_zutat','Mahlzeiten.ID','=', 'Mahl_enthaelt_zutat.Mahlzeit_ID')
           ->join('Kategorien','Mahlzeiten.Kategorie_ID','=','Kategorien.ID')
           ->whereNotNull('Mahlzeiten.Name');

       if($avail != 0){
          $produkte->where('Verfuegbar','=','1');

       }
       if($vegan != 0){
            $produkte->join('Zutaten','Mahl_enthaelt_zutat.Zutat_ID','=','Zutaten.ID');
//                ->where('Mahlzeit_ID','=','.ID')

       }
//        if($vegetarisch != 0){
//             $produkte->where(DB::table('Mahl_enthaelt_zutat')
//                ->join('Zutaten','Mahl_enthaelt_zutat.Zutat_ID','=','Zutaten.ID')
//                ->where('Mahl_enthaelt_zutat.Mahlzeit_ID','=','Mahlzeiten.id')
//                ->select('vegetarisch'));
//        }
//        if($kat != 2){
//            $produkte->where('Kategorien.ID','=',$kat);
//        }
       $produkte =  $produkte->get();

       dd($produkte);

        return view('produkte');
    }
}
