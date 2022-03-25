<?php

session_start();

include "../users/classes/User.php";

$username=$_POST['username'];
$password=sha1($_POST['password']);//encrypt password using sha1
$response = [
    "success"=>true
];

    $user = User::getByUserNameAndPassword($username , $password);

    if($user){
        $_SESSION['username']=$username;      // Register Session Name
        $_SESSION['user_id']=$user['id'];  // Register Session ID
    }
    else{
        $response['success'] = false;
        $response['message'] = "Username or password not correct";
    }
    die(json_encode($response));
?>