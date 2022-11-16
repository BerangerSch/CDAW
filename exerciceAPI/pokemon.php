<?php

    $urlPokemons = 'http://pokeapi.co/api/v2/pokemon';

    class Pokemon{
        public function __construct($url){
            $jsonPokemon = file_get_contents($url);
            $pokemon = json_decode($jsonPokemon, TRUE);
            $this->id = $pokemon["id"];
            $this->name = $pokemon["name"];
            $this->img = $pokemon["sprites"]["front_default"];
        }
    }

    class showPokemon{
        public function render($pokeLink){
            $pokemon = new Pokemon($pokeLink);
            echo '<td>' . $pokemon->id . '</td>';
            echo '<td>' . $pokemon->name . '</td>';
            echo '<td><img src=' . $pokemon->img . '></img></td></tr>';
        }
    }

    class pokemonAPI{
        public function __construct($url){
            $this->listPokemon = file_get_contents($url);
            $this->tabPokemon = json_decode($this->listPokemon, TRUE);
            $this->tabPokemon = $this->tabPokemon['results'];
        }

        public function render(){
            $show = new showPokemon;
            foreach($this->tabPokemon as $pokemon){
                $show->render($pokemon["url"]);
            }
        }
    }
    
?>

<html>
    <head>TABLEAU DES POKEMON</head>
    <body>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
            </tr>
            <tr>
                <?php
                    $pokemons = new pokemonApi($urlPokemons);
                    $pokemons->render();
                ?>
        </table>
    </body>
</html>