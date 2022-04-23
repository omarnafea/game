<?php

include "./classes/Game.php";
include "./classes/Stage.php";
include "./classes/StageOptions.php";
include "../categories/classes/Category.php";

$game_id = $_GET['game_id'];
$game= Game::get($game_id);
$stages = Stage::listStages($game_id);
$contentType = "STRING";

$hasStages = false;
if(count($stages) > 0){
    $contentType = $stages[0]['content_type'];
    $hasStages = true;
}
?>
<html>
<head>
    <title>Add Stages</title>
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

    <input type="hidden"  id="game_id" name="game_id" value="<?=$game_id?>">

    <div class="col-md-3 mt-5">
        <div class="form-group">
            <label>Content Type</label>
            <select class="form-control" id="content_type" <?=$hasStages ?'disabled'  : ''?>>
                <option value="STRING" <?=$contentType === 'STRING' ?  'selected': ''?>>Text</option>
                <option value="IMAGE" <?=$contentType === 'IMAGE' ?  'selected': ''?>>Image</option>
                <option value="VOICE"  <?=$contentType === 'VOICE' ?  'selected': ''?>>Voice</option>
            </select>
        </div>
    </div>



    <div class="stages-container">
        <h2 class="mt-3 text-center text-primary">Stages</h2>
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
<script src="pick_image_stages.js"> </script>
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