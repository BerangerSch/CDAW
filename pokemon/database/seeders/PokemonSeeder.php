<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Pokemon{
    public function __construct($url){
        $jsonPokemon = file_get_contents($url);
        $pokemon = json_decode($jsonPokemon, TRUE);

        // On récupère l'id de l'énergie du pokemon par l'url de l'énergie
        $urlEnergy = $pokemon['types'][0]['type']['url'];
        if(substr($urlEnergy, -3, 1) == '/'){
            $idEnergy = substr($urlEnergy, -2, 1);
        }else if(substr($urlEnergy, -3, 1) == '0'){
            $idEnergy = substr($urlEnergy, -6, 5);
        }else{
            $idEnergy = substr($urlEnergy, -3, 2);
        }

        DB::table('pokemon')->insert([
            'id' => $pokemon['id'],
            'id_energy' => $idEnergy,
            'name' => $pokemon['name'],
            'pv_max' => $pokemon['stats'][0]['base_stat'],
            'level' => $pokemon['base_experience'],
            'path' => $pokemon["sprites"]["front_default"]
        ]);
    }
}

class pokemonAPI{
    public function __construct($url){
        $this->listPokemon = file_get_contents($url);
        $this->tabPokemon = json_decode($this->listPokemon, TRUE);
        $this->tabPokemon = $this->tabPokemon['results'];
    
        foreach($this->tabPokemon as $pokemon){
            $pokemon = new Pokemon($pokemon['url']);
        }
    }
}

class PokemonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $urlPokemons = 'http://pokeapi.co/api/v2/pokemon';
        $API = new pokemonAPI($urlPokemons);
        
    }
}