<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class energyAPI{
    public function __construct($url){
        $this->listEnergy = file_get_contents($url);
        $this->tabEnergy = json_decode($this->listEnergy, TRUE);
        $this->tabEnergy = $this->tabEnergy['results'];
    
        foreach($this->tabEnergy as $energy){
            if(substr($energy['url'], -3, 1) == '/'){
                $idEnergy = substr($energy['url'], -2, 1);
            }else if(substr($energy['url'], -3, 1) == '0'){
                $idEnergy = substr($energy['url'], -6, 5);
            }else{
                $idEnergy = substr($energy['url'], -3, 2);
            }
    

            DB::table('energy')->insert([
                'id' => $idEnergy,
                'name' => $energy['name'],
            ]);
        }
    }
}

class EnergySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $urlEnergy = 'http://pokeapi.co/api/v2/type';
        $API = new energyAPI($urlEnergy);
    }
}