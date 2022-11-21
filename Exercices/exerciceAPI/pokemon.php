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
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css" />
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script src="http://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready( function () {
                $('#bestiaire').DataTable();
            } );
        </script>
    </head>
    <body>
        <h1>TABLEAU DES POKEMON</h1>
        <table id="bestiaire" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                        $pokemons = new pokemonApi($urlPokemons);
                        $pokemons->render();
                    ?>
            </tbody>
        </table>
    </body>
</html>