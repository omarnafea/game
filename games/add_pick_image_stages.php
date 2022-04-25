<?php

if(!isset($_SESSION))
    session_start();

if(!isset($_SESSION['user_id'])){
    header("location:../login");
}

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

        <?php
        printStages($stages);
        ?>


        <div id="stages">

        </div>

        <button class="btn btn-primary mt-2" id="add_stage"> Add Stage</button>

        <div class="text-center mb-3">
            <button class="btn btn-success w-50" id="save_stages">save</button>
        </div>

    </div>
<script src="pick_image_stages.js"> </script>
</body>
</html>


<?php
function printStages ($stages){
    foreach ($stages as $stage){?>
<div class="row mb-5">
    <div class="col-md-12">
        <div class="form-group">

            <div class="row">

                <label class="m-2">content</label>

                <?php
                if ($stage['content_type'] === "STRING"){?>
                    <input type="text" class="form-control content" value="<?=$stage['content']?>">
                    <button class="btn btn-primary mt-2" onclick="EditTextContent(<?=$stage['id']?>)"> Edit</button>
                <?php }elseif ($stage['content_type'] === "IMAGE"){?>
                    <img src="<?=$stage['content']?>" class="img-fluid" width="200" height="200">
                    <button class="btn btn-primary mt-2" onclick="EditImageContent(<?=$stage['id']?>)"> Edit</button>
                <?php }elseif ($stage['content_type'] === "VOICE"){?>
                    <audio  preload='auto' id="voiceContent" controls>
                        <source id="voiceContentSource"  src="<?=$stage['content']?>" type="audio/mpeg" >
                    </audio>

                    <button class="btn btn-primary ml-2" onclick="EditVoiceContent(<?=$stage['id']?>)"> Edit</button>
                <?php }?>
            </div>

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
                        <input type="checkbox"
                            <?php if($stage['correct_answer_id'] == $option['id']) echo 'checked'?>
                               class="col-2 form-control correct-option" value="option_<?=$i?>"
                               data-stage_id="<?=$stage['id']?>" data-option_id="<?=$option['id']?>">
                       <div>
                           <img src="<?=$option['option']?>" class="img-fluid" width="200" height="200">
                       </div>
                        <button class="btn btn-primary" onclick="editOption(<?=$option['id']?>)"> Edit</button>
                    </div>

                </div>
            </div>

       <?php
        $i++;
        }
    ?>


    <div class="col-md-5">
        <button class="btn btn-danger delete-btn" data-id ="<?=$stage['id']?>" onclick="deleteRow(this)"><i class="fa fa-times-circle"></i></button>
    </div>

    <hr class="text-success">
</div>

   <?php
    }
}


?>


<div id="edit_option_modal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="edit_option_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title blue font-weight-bold">Edit Option</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="blue">Option</label>
                        <input type="file" class="form-control" name="option_image" accept=".jpg , .png , .jpeg" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Save" />
                    <input type="hidden" name="option_id" id="option_id" value="" />
                    <button type="button" class="btn btn-default close_btn" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="edit_content_text_modal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="edit_content_text_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title blue font-weight-bold">Edit Content</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="blue">content</label>
                        <input type="text" class="form-control" name="option_image"  required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Save" />
                    <input type="hidden" name="stage_id" class="stage-id" value="" />
                    <button type="button" class="btn btn-default close_btn" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="edit_content_voice_modal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="edit_content_voice_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title blue font-weight-bold">Edit Content</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="blue">content</label>
                        <input type="text" class="form-control" name="option_image"  required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Save" />
                    <input type="hidden" name="stage_id" class="stage-id" value="" />
                    <button type="button" class="btn btn-default close_btn" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="edit_content_image_modal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="edit_content_image_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title blue font-weight-bold">Edit Content</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="blue">content</label>
                        <input type="file" class="form-control" name="option_image" accept=".jpg , .png , .jpeg" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Save" />
                    <input type="hidden" name="stage_id" class="stage-id" value="" />
                    <button type="button" class="btn btn-default close_btn" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
