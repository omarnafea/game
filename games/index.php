<?php
include './classes/Game.php';

if(!isset($_SESSION)){
    session_start();
}


$games = Game::listGames($_SESSION['user_id']);

//echo "<pre>";
//print_r($games);
//echo "</pre>";
//die;


?>
<html>
<head>
    <title>Games</title>
    <meta charset="utf-8"/>
    <?php include "../include/header.php";?>
    <link rel="stylesheet" href="games.css">
</head>
<body>
<?php include "../include/navbar.php"?>
<div class="container-fluid pt-5">

    <?php
    include "../include/dashboard.php";
    ?>

    <h2 class="text-primary text-center mt-3">Games</h2>
    <a href="add_game.php" class="btn btn-primary mb-2">Add New game</a>
    <table id="categories_table" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th scope="col">Category</th>
            <th scope="col">Type</th>
            <th scope="col">Name EN</th>
            <th scope="col">Name AR</th>
            <th scope="col">Edit</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
          <?php
          foreach($games as $game)
          { ?>
               <tr>
               <td><?=$game['category_en']?></td>
               <td><?=$game['type']?></td>
               <td><?=$game['name_en']?></td>
               <td><?=$game['name_ar']?></td>
               <td>
                   <a href="add_game.php?game_id=<?=$game['id']?>" class="btn btn-primary">Edit</a>
               </td>
               <td>
                   <a href="add_game.php?category_id=<?=$game['id']?>" class="btn btn-primary">Action</a>
               </td>
              </tr>
          <?php }?>
        </tbody>
    </table>
</div>
<script src="games.js"> </script>
</body>
</html>