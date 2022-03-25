<?php
$category_id = -1;
$name_en = "";
$name_ar = "";
include "./classes/Category.php";
$update_mode = false; //add category (not Update)

include '../db_connect.php';
if(isset($_GET['category_id'])){
$update_mode = true;
$category_id = $_GET['category_id'];

$category = Category::get($category_id);

$name_en = $category["name_en"];
$name_ar = $category["name_ar"];

/*
echo '<pre>';
print_r($category);
echo '</pre>';die;
*/


}

?>
<html>
<head>
    <title>Add category</title>
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


    <div class="main-form">


         <?php 
                 if($update_mode == false){
                    echo '<h2 class="text-primary text-center mt-3">Add New category</h2>';
                 }else{
                    echo '<h2 class="text-primary text-center mt-3">Update category</h2>';
                 }
         ?>
       

        <form id="add_category_form">
             
        <div class="form-group">
            <label>Name EN</label>
            <input  type="text" value="<?=$name_en?>" class="form-control" name="name_en" id="name_en" placeholder="Enter category name in english" required >
        </div>

        <div class="form-group">
            <label>Name AR</label>
            <input  type="text" value="<?=$name_ar?>" class="form-control" name="name_ar" id="name_ar" placeholder="Enter category name in arabic" required >
        </div>

        
        <div class="text-center">
            <input type="submit" class="btn btn-primary submit-btn" value="Save">
        </div>

        <input type="hidden"  id="category_id" name="category_id" value="<?=$category_id?>">

        </form>


</div>
<script src="categories.js"> </script>
</body>
</html>
