<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/pokemon', function () {
    return "Hello World !";
});

Route::get('/{nom}-{prenom}', function($nom, $prenom){
    echo $nom . $prenom;
});


Route::get('/listePokemon', function(){
    return view('listePokemons');
});
Route::get('/listePokemon/{nom}', 'App\Http\controllers\listePokemonsController@show');

Route::get('/htmlCode', function(){
    ?>
    <!doctype html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Mauvaise façon</title>
    </head>
    <body>
        <p>Le fichier risque d'être longggggg</p>
    </body>
    </html>
    <?php
});
