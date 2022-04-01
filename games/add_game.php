<?php
$game_id = -1;
$category_id = -1;
$name_en = "";
$name_ar = "";
include "./classes/Game.php";
include "./classes/Stage.php";
include "./classes/StageOptions.php";
include "../categories/classes/Category.php";
$update_mode = false; //add category (not Update)

$stages = [];
$categories = Category::listCategories();
$types = Game::getGamesTypes();

if(isset($_GET['game_id'])){
$update_mode = true;
$game_id = $_GET['game_id'];

$game= Game::get($game_id);
$stages = Stage::listStages($game_id);

$name_en = $game["name_en"];
$name_ar = $game["name_ar"];

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
    <link rel="stylesheet" href="games.css">
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
                    echo '<h2 class="text-primary text-center mt-3">Add New game</h2>';
                 }else{
                    echo '<h2 class="text-primary text-center mt-3">Update game</h2>';
                 }
         ?>
       

        <form id="add_game_form">
             
        <div class="form-group">
            <label>Name EN</label>
            <input  type="text" value="<?=$name_en?>" class="form-control" name="name_en" id="name_en" placeholder="Enter game name in english" required >
        </div>

        <div class="form-group">
            <label>Name AR</label>
            <input  type="text" value="<?=$name_ar?>" class="form-control" name="name_ar" id="name_ar" placeholder="Enter game name in arabic" required >
        </div>

            <div class="form-group">
                <label>Category</label>

                <select id="category_id" name="category_id" class="form-control">
                    <option value="-1">Select Category</option>
                    <?php
                    foreach($categories as $category){
                        $selected = "";

                        if($category['category_id'] == $category_id)
                            $selected = 'selected';
                        ?>
                        <option value="<?=$category['category_id']?>" <?=$selected?>><?=$category['name_en']?></option>

                    <?php }?>
                </select>
            </div>

            <div class="form-group">
                <label>Type</label>

                <select id="type" name="type" class="form-control">
                    <option value="-1">Select Type</option>
                    <?php
                    foreach($types as $type_key => $type_name){
                        $selected = "";

                        ?>
                        <option value="<?=$type_key?>" <?=$selected?>><?=$type_name?></option>

                    <?php }?>
                </select>
            </div>

        
        <div class="text-center">
            <input type="submit" class="btn btn-primary submit-btn" value="Save">
        </div>

        <input type="hidden"  id="game_id" name="game_id" value="<?=$game_id?>">

        </form>





</div>


    <div class="stages-container">
        <h2>Stages</h2>


        <div id="stages">

            <?php
              printStages($stages);
            ?>
        </div>

        <button class="btn btn-primary mt-2" id="add_stage"> Add Stage</button>

        <div class="text-center">

            <button class="btn btn-success w-50" id="save_stages">save</button>

        </div>


    </div>
<script src="games.js"> </script>
</body>
</html>


<?php

function printStages ($stages){

    foreach ($stages as $stage){?>

<div class="row  stages-row">
    <div class="col-md-12">
        <div class="form-group">
            <label>content</label>
            <input type="text" class="form-control content" value="<?=$stage['content']?>">
        </div>
    </div>

    <?php
        $options = StageOptions::listOptions($stage['id']);

        $i = 1;

        foreach ($options as $option){?>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Option <?=$i?></label>
                    <div class="row">
                        <input type="checkbox" <?php if($stage['correct_answer_id'] == $option['id']) echo 'checked'?> class="col-2 form-control correct-option" value="option_<?=$i?>">
                        <input type="text" data-name="option_<?=$i?>" class="col-10 form-control option option-<?=$i?>" value="<?=$option['option']?>">
                    </div>

                </div>
            </div>

       <?php
        $i++;
        }
    ?>


    <div class="col-md-3">
        <button class="btn btn-danger delete-btn" onclick="deleteRow(this)"><i class="fa fa-times-circle"></i></button>
    </div>

</div>

   <?php


    }


}


?>