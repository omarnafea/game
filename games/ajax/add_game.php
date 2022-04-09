<?php


if(!isset($_SESSION)) session_start();


include "../classes/Game.php";
include "../../upload/classes/Upload.php";



$image = Upload::uploadImage($_FILES['image'])['image'];


$game_id = Game::create($_SESSION['user_id'] , $_POST['type'], $_POST['name_en'] , $_POST['name_ar'] , $_POST['category_id'] , $image);
die(json_encode(['success'=>true , 'message'=>'game added successfully' , "game_id"=>$game_id] ));

