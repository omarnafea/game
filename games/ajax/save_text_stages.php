<?php


if(!isset($_SESSION)) session_start();


include "../classes/Stage.php";
include "../classes/StageOptions.php";


Stage::deleteByGameId($_POST['game_id']);
foreach ($_POST['stages'] as $stage){
   $stage_id =  Stage::create($_POST['game_id'] , $stage['content']);

   foreach ($stage['optionsContent'] as $key => $option){

       $option_id = StageOptions::create($stage_id , $option);

       if($key === $stage['correct_answer']){
           Stage::updateCorrectAnswer($stage_id , $option_id);
       }
   }

}


die(json_encode(['success'=>true , 'message'=>'Stages saved  successfully']));
