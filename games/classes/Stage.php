<?php
/**
 * Created by PhpStorm.
 * Game: ultimate-pc
 * Date: 2022/03/19
 * Time: 09:11 م
 */


include(__DIR__ . '/../../db_connect.php');


class Stage
{

    static function create($game_id , $content , $content_type){


        global $con;

        $statement = $con->prepare("
                    INSERT INTO game_stages (game_id , content , content_type)  
                                       VALUES (:game_id , :content , :content_type)");
        $result = $statement->execute(
            array(
                ':game_id'       => $game_id,
                ':content'       => $content,
                ':content_type'  => $content_type
            )
        );

        return $con->lastInsertId();
    }


    static function updateCorrectAnswer( $id , $correctAnswerId){

        global $con;
        $params = array(
            ':id'                    => $id,
            ':correct_answer_id'     => $correctAnswerId
        );

        $statement = $con->prepare(
            "UPDATE game_stages 
                      SET correct_answer_id = :correct_answer_id  where id = :id");
        $result = $statement->execute($params);
        return $result;
    }

    static function update( $id ,$content , $correctAnswerId){

        global $con;
        $params = array(
            ':id'                    => $id,
            ':content'               => $content,
            ':correct_answer_id'     => $correctAnswerId
        );

        $statement = $con->prepare(
            "UPDATE game_stages 
                      SET content = :content,correct_answer_id = :correct_answer_id  where id = :id");
        $result = $statement->execute($params);
        return $result;
    }


    static function get($id){
        global $con;
        $query = "SELECT *  FROM game_stages where id = ?"; // db query
        $statement = $con->prepare($query);  // prepare query
        $statement->execute([$id]);
        $game = $statement->fetch(PDO::FETCH_ASSOC);
        return $game;
    }

    static function listStages($game_id){

        global $con;
        $query = "SELECT *  
                  FROM game_stages 
                  WHERE game_id = ?"; // db query
        $statement = $con->prepare($query);  // prepare query
        $statement->execute([$game_id]);
        $game = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $game;
    }



    static function deleteByGameId($game_id){

        global $con;
        $query = "delete  gs, so
                  FROM game_stages as gs
                  join stage_options as so on so.stage_id =  gs.id  
                  WHERE game_id = ?"; // db query
        $statement = $con->prepare($query);  // prepare query
        $statement->execute([$game_id]);
        $game = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $game;
    }

}