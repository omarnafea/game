<?php

include "../classes/Stage.php";
include "../../upload/classes/Upload.php";

$voice = Upload::uploadVoice($_FILES['content'])['voice'];

Stage::updateContent($_POST['stage_id'] , $voice);
die(json_encode(['success'=>true , 'message'=>'Stage saved  successfully']));
