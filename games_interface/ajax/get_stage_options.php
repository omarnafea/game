<?php

include "../../games/classes/Stage.php";
include "../../games/classes/StageOptions.php";

$options = StageOptions::listOptions($_POST['stage_id']);

die(json_encode(['success'=>true , 'data' => $options]));
