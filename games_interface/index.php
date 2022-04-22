<?php
include './../games/classes/Game.php';
include './../include/lang/lang_controller.php';
$logoPath = "../include/upload/logo.jpg";
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
<body class="<?=isset($_SESSION['lang'])  && $_SESSION['lang'] == 'ar'? 'rtl' :''?>">

<?php
include "../include/game_navbar.php";

$isArabic = $_SESSION['lang'] == 'ar';

?>
<div class="container-fluid pt-5">
    <h2 class="text-primary text-center mt-3"><?=$lang['games']?></h2>

    <div class="games-container">

        <div class="row">
            <?php
            foreach($games as $game)
            { ?>

                <div class="game-cart col-md-4 mt-2 ">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="<?=$game['image']?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"> <?=$isArabic ? $game['name_ar']: $game['name_en']?></h5>
                            <p class="card-text">   <?=$isArabic ? $game['category_ar']: $game['category_en']?></p>
                        </div>
                        <div class="card-body my-0">
                            <a href="<?=getGameLink($game)?>" class="btn btn-success"><?=$lang['start']?>
                                <i class="fas fa-play"></i></a>
                        </div>
                    </div>
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
         }else {
             return "start_game/pick_image_game.php?game_id={$game['id']}";

         }
     }
 }

?>