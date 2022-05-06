<?php
if(!isset($_SESSION)) session_start();

include './../../games/classes/Game.php';
include '../../include/lang/lang_controller.php';
$logoPath = "../../include/upload/logo.jpg";

$game = Game::get($_GET['game_id']);

//var_dump($_SESSION);die;
?>
    <html>
    <head>
        <title>Games</title>
        <meta charset="utf-8"/>
        <?php
            include "../../include/game_header.php";
            include "../../include/game_navbar.php";
        ?>
        <link rel="stylesheet" href="pick_image_game.css">
    </head>
    <body class="<?=isset($_SESSION['lang'])  && $_SESSION['lang'] == 'ar'? 'rtl' :''?>">
    <div class="container-fluid pt-5">

        <input type="hidden" id="game_id" value="<?=$_GET['game_id']?>">

        <audio  preload='auto' id="correctAudio">
            <source src="correct_answer.mp3" type="audio/mpeg" >
        </audio>

        <audio  preload='auto' id="wrongAudio">
            <source src="wrong_answer.mp3" type="audio/mpeg" >
        </audio>


        <div class="text-center">
            <button class="btn btn-success start-game p-5 mt-5 font-weight-bolder"><?=$lang['start']?>
                <i class="fas fa-play"></i>
            </button>
        </div>


        <h2 class="text-primary text-center mt-3 " id="progress"></h2>

        <div class="container stage-container">
            <audio  preload='auto' id="voiceContent">
                <source id="voiceContentSource"  src="" type="audio/mpeg" >
            </audio>
            <h5 id="content" class="m-2 d-none"></h5>
            <div id="options" class="row mt-2 p-3">
            </div>


        </div>
    </div>
    <script src="pick_image_game.js"> </script>

    </body>
    </html>
