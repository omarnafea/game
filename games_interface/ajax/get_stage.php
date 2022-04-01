<?php

include "../../games/classes/Stage.php";
include "../../games/classes/StageOptions.php";

$stages = Stage::listStages($_POST['game_id']);

die(json_encode(['success'=>true , 'data' => $stages]));
