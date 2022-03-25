<?php

include('../classes/User.php');

if($_POST['password'] != $_POST['confirm_password']){
    die(json_encode(['success' => false , 'message'=>'Passwords not matches'] ));
}

Category::create($_POST["name"] , $_POST["email"] , $_POST["user_name"] , sha1($_POST["password"]));

die(json_encode(['success' => true , 'message'=>'Category added successfully'] ));