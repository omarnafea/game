<?php
include "../classes/Stage.php";
Stage::updateCorrectAnswer($_POST['stage_id'] , $_POST['option_id']);
die(json_encode(['success'=>true , 'message'=>'Option saved  successfully']));
