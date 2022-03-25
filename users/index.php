<?php


include('./classes/User.php');

$users = Category::listUsers();
?>
<html>
<head>
    <title>Login</title>
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
    <h2 class="text-primary text-center mt-3">Users</h2>
    <a href="add_user.php" class="btn btn-primary mb-2">Add New User</a>
    <table id="users_table" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">User Name</th>
            <th scope="col">Email</th>
            <th scope="col">Edit</th>
        </tr>
        </thead>
        <tbody>
          <?php
          foreach($users as $user)
          { ?>
               <tr>

               <td><?=$user['name']?></td>
               <td><?=$user['user_name']?></td>
               <td><?=$user['email']?></td>
               <td>
                   <a href="add_user.php?user_id=<?=$user['id']?>"  class="btn btn-primary">Edit</a>
               </td>
              </tr>
          <?php }?>
        </tbody>
    </table>
</div>
<script src="users.js"> </script>
</body>
</html>
