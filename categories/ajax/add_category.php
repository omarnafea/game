<?php


include "../classes/Category.php";
Game::create($_POST['name_en'] , $_POST['name_ar']);
die(json_encode(['success'=>true , 'message'=>'category added successfully']));

