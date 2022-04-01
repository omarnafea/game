<?php
include './../games/classes/Game.php';

if(!isset($_SESSION)){
    session_start();
}

$games = Game::listGames();

?>
<html>
<head>
    <title>Games</title>
    <meta charset="utf-8"/>
    <?php include "../include/header.php";?>
    <link rel="stylesheet" href="games.css">
</head>
<body>
<?php include "../include/navbar.php"?>
<div class="container-fluid pt-5">

    <?php
//    include "../include/dashboard.php";
    ?>

    <h2 class="text-primary text-center mt-3">Games</h2>

    <div class="games-container">

        <div class="row">
            <?php
            foreach($games as $game)
            { ?>


                <div class="game-cart col-md-4">

                    <h4> <?=$game['name_en']?></h4>
                    <p> <?=$game['name_ar']?></p>
                    <p> <?=$game['category_en']?></p>

                    <a href="<?=getGameLink($game)?>" class="btn btn-primary">Start</a>
                </div>
            <?php }?>

        </div>

    </div>
</div>
<script src="games.js"> </script>
</body>
</html>

<?php
 function getGameLink($game){
     $gameTypes = Game::getGamesTypes();
     foreach ($gameTypes as $type => $name){
         if($gameTypes[$game['type']] == "QUESTIONS"){
             return "start_game/questions_game.php?game_id={$game['id']}";
         }
     }
 }

?>