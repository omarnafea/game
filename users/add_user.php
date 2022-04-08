<?php

$update_mode = false;

$name = "";
$user_name = "";
$email = "";
$prev_id = -1;
$user_id  = -1;
include './classes/User.php';


if(isset($_GET['user_id'])){

    $user_id  = $_GET['user_id'];

    $update_mode = true;

    $user = User::get($user_id);
/*
    echo '<pre>';
    print_r($user);
    echo '</pre>';
    die;

    */
    $name = $user['name'];
    $user_name = $user['user_name'];
    $email = $user['email'];
}

?>
<html>
<head>
    <title>Add user</title>
    <meta charset="utf-8"/>
    <?php include "../include/header.php";?>
    <link rel="stylesheet" href="users.css">
</head>

<body>
<?php include "../include/navbar.php"?>

<div class="container-fluid pt-5">
    <?php
    include "../include/dashboard.php";
    ?>
    <div class="main-form">
        <h2 class="text-primary text-center mt-3"><?=$update_mode ? "Update user" : "Add New User"?></h2>

        <form method="post" id="user_add_form" enctype="multipart/form-data">

            <div class="form-group">
                <label> Name</label>
                <input type="Text" value="<?=$name?>" class="form-control" id="name" name="name" placeholder="Enter name" required>
            </div>

            <div class="form-group">
                <label> Username</label>
                <input type="Text" value="<?=$user_name?>" class="form-control" id="user_name" name="user_name" placeholder="Enter user username" required>
            </div>

            <div class="form-group">
                <label> Email</label>
                <input type="email"   value="<?=$email?>" class="form-control" id="email" name="email" placeholder="Enter user email" required>
            </div>

            <div class="form-group">
                <label> Password</label>
                <input type="password" class="form-control" id="password"  autocomplete="new-password" name="password" placeholder="Enter user password" >
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password"  autocomplete="new-password" name="confirm_password" placeholder="Confirm password" >
            </div>

            <input type="hidden" name="user_id" value="<?=$user_id?>" id="user_id" />
            <div class="text-center">
                <input type="submit"  class="btn btn-success submit-btn"  value="Save" />
            </div>
        </form>

    </div>

</div>

<script src="users.js"> </script>

</body>
</html>