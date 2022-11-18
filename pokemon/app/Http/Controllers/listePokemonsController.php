<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class listePokemonsController extends Controller
{
    /**
     * @param  string  $id
     * @return \Illuminate\View\View
     */

    public function show($nom){
        return view('listePokemons', ['nom' => $nom]);
    }
}
