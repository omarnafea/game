<?php

include('../User.php');

if(trim($_POST['password'])  !== ""){

    if($_POST['password'] != $_POST['confirm_password']){
        die(json_encode(['success' => false , 'message'=>'Passwords not matches'] ));
    }
}

User::update($_POST["user_id"] , $_POST["name"], $_POST["email"] , $_POST["user_name"] , trim($_POST['password']));

die(json_encode(['success' => true , 'message'=>'User data updated successfully'] ));

?>