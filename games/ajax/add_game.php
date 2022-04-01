<?php


if(!isset($_SESSION)) session_start();


include "../classes/Game.php";
Game::create($_SESSION['user_id'] , $_POST['type'], $_POST['name_en'] , $_POST['name_ar'] , $_POST['category_id']);
die(json_encode(['success'=>true , 'message'=>'game added successfully']));

