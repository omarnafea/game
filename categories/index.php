<?php

if(!isset($_SESSION))
    session_start();

if(!isset($_SESSION['user_id'])){
    header("location:../login");
}

include './classes/Category.php';
$categories = Category::listCategories();
//
//echo "<pre>";
//print_r($categories);
//echo "</pre>";
//die;
?>
<html>
<head>
    <title>categories</title>
    <meta charset="utf-8"/>
    <?php include "../include/header.php";?>
    <link rel="stylesheet" href="categories.css">
</head>
<body>
<?php include "../include/navbar.php"?>
<div class="container-fluid pt-5">

    <?php
    include "../include/dashboard.php";
    ?>

    <h2 class="text-primary text-center mt-3">categories</h2>
    <a href="add_category.php" class="btn btn-primary mb-2">Add New category</a>
    <table id="categories_table" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Name EN</th>
            <th>Name AR</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
          <?php
          foreach($categories as $category)
          { ?>
               <tr>
               <td><?=$category['name_en']?></td>
               <td><?=$category['name_ar']?></td>
               <td>
                   <a href="add_category.php?category_id=<?= $category['category_id']?>"  class="btn btn-primary">Edit</a>
               </td>
              </tr>
          <?php }?>
        </tbody>
    </table>
</div>
<script src="categories.js"> </script>
</body>
</html>