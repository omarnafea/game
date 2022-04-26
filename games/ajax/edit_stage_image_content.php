<?php

include "../classes/Stage.php";
include "../../upload/classes/Upload.php";

$image = Upload::uploadImage($_FILES['content'])['image'];

Stage::updateContent($_POST['stage_id'] , $image);
die(json_encode(['success'=>true , 'message'=>'Stage saved  successfully']));
