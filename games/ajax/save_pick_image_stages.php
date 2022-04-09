<?php


if(!isset($_SESSION)) session_start();


include "../classes/Stage.php";
include "../classes/StageOptions.php";
include "../../upload/classes/Upload.php";



$stagesCount = count($_FILES['file']['name']) / 4;

//var_dump($_POST);

$stage_index = 1;
$stages = [];
$currentFile_index = 0;

for($i = 0 ; $i <$stagesCount ; $i++){

    $stage = [];
    $stage['optionsContent'] = [];
    $stage['content'] = $_POST['stage' . $stage_index . 'content'];

    for($k =  $stage_index * 4 - 4; $k <= $stage_index * 4 - 1 ; $k++){

        var_dump($k);
        $new_image = [];
        $new_image['name']=$_FILES['file']['name'][$k];
        $new_image['type']=$_FILES['file']['type'][$k];
        $new_image['tmp_name']=$_FILES['file']['tmp_name'][$k];
        $new_image['error']=$_FILES['file']['error'][$k];
        $new_image['size']=$_FILES['file']['size'][$k];

        $file = Upload::uploadImage($new_image);
        $file_path = $file['image'];
//        var_dump($file);

        array_push($stage['optionsContent'] , $file_path);

    }

    array_push($stages, $stage);

    $stage_index ++;
}

//var_dump($stages);

Stage::deleteByGameId($_POST['game_id']);

$stageIndex = 1;
foreach ($stages as $stage){
   $stage_id =  Stage::create($_POST['game_id'] , $stage['content']);

   $optionIndex = 1;
   foreach ($stage['optionsContent'] as $key => $option){

       $option_id = StageOptions::create($stage_id , $option);
       $correctOptionIndex = $_POST['stage' . $stageIndex . 'correct'];

       if($optionIndex == $correctOptionIndex){
           Stage::updateCorrectAnswer($stage_id , $option_id);

       }

       $optionIndex++;
   }

    $stageIndex++;

}


die(json_encode(['success'=>true , 'message'=>'Stages saved  successfully']));
