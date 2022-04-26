<?php

include "../classes/Category.php";

//print_r($_POST);die;

if(!isset($_POST['name_en'])){
    die(json_encode(['success'=>false , 'message'=>'Missed column en_name']));
}

Category::create($_POST['name_en'] , $_POST['name_ar']);

die(json_encode(['success'=>true , 'message'=>'category added successfully']));

