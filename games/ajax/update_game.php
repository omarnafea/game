<?php

include "../classes/Game.php";
include "../../upload/classes/Upload.php";


$image = null;
if(!empty( $_FILES['image']['name'])){
    $image = Upload::uploadImage($_FILES['image'])['image'];
}

Game::update($_POST['game_id'] , $_POST['name_en'] , $_POST['name_ar'] , $_POST['type'] , $_POST['category_id'] , $image);

die(json_encode(['success'=>true , 'message'=>'Game data updated successfully' , "game_id" => $_POST['game_id']]));