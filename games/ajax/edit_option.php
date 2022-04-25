<?php

include "../classes/StageOptions.php";
include "../../upload/classes/Upload.php";

$newImage = [
    'name' => $_FILES['option_image']['name'],
    'type' => $_FILES['option_image']['type'],
    'tmp_name' => $_FILES['option_image']['tmp_name'],
    'error' => $_FILES['option_image']['error'],
    'size' => $_FILES['option_image']['size']
];

$optionImage = Upload::uploadImage($newImage)['image'];

StageOptions::update($_POST['option_id'] ,$optionImage );

die(json_encode(['success'=>true , 'message'=>'Option saved  successfully']));
