<?php

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
            $pokemon = new Pokemon($pokeLink["url"]);
            echo '<td>' . $pokemon->id . '</td>';
            echo '<td>' . $pokemon->name . '</td>';
            echo '<td><img src=' . $pokemon->img . '></img></td></tr>';
        }
    }

    $listPokemon = file_get_contents('http://pokeapi.co/api/v2/pokemon');
    $tabPokemon = json_decode($listPokemon, TRUE);
    $tabPokemon = $tabPokemon['results'];

    
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
                    foreach($tabPokemon as $pokemon){
                        $show = new showPokemon;
                        $show->render($pokemon);
                    }
                ?>
        </table>
    </body>
</html>