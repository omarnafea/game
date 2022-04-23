<?php
if(!isset($_SESSION)) session_start();

include './../../games/classes/Game.php';
include '../../include/lang/lang_controller.php';
$logoPath = "../../include/upload/logo.jpg";
$game = Game::get($_GET['game_id']);

?>
    <html>
    <head>
        <title>Games</title>
        <meta charset="utf-8"/>

        <?php
        include "../../include/game_header.php";
        include "../../include/game_navbar.php";
        ?>
        <link rel="stylesheet" href="questions_game.css">
    </head>
    <body class="<?=isset($_SESSION['lang'])  && $_SESSION['lang'] == 'ar'? 'rtl' :''?>">
    <div class="container-fluid pt-5">

        <audio  preload='auto' id="correctAudio">
            <source src="correct_answer.mp3" type="audio/mpeg" >
        </audio>

        <audio  preload='auto' id="wrongAudio">
            <source src="wrong_answer.mp3" type="audio/mpeg" >
        </audio>

        <?php
        //    include "../include/dashboard.php";
        ?>

        <h2 class="text-primary text-center mt-3 " id="progress"></h2>

        <div class="container stage-container">

            <div id="content" class="m-2"></div>
            <div id="options" class="row mt-2">

            </div>


        </div>
    </div>
    <script src="questions_game.js"> </script>

    <script>
        getFirstStage(<?=$game['id']?>)
    </script>
    </body>
    </html>
