<?php

include "../classes/Stage.php";

Stage::updateContent($_POST['stage_id'] , $_POST['content']);
die(json_encode(['success'=>true , 'message'=>'Stage saved  successfully']));
