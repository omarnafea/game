<?php
/**
 * Created by PhpStorm.
 * Game: ultimate-pc
 * Date: 2022/03/19
 * Time: 09:11 م
 */


include(__DIR__ . '/../../db_connect.php');


class Game
{

    static function create($user_id , $type , $name_en , $name_ar , $category_id ){


        global $con;

        $statement = $con->prepare("
                    INSERT INTO games (user_id , type , name_en , name_ar , category_id)  
                                       VALUES (:user_id , :type , :name_en , :name_ar , :category_id )");
        $result = $statement->execute(
            array(
                ':user_id'         => $user_id,
                ':type'            => $type,
                ':name_en'         => $name_en,
                ':name_ar'         => $name_ar,
                ':category_id'     => $category_id
            )
        );
    }

    static function update( $id ,$name_en , $name_ar ,$type  , $category_id){

        global $con;
        $params =    array(
            ':id'                    => $id,
            ':name_en'               => $name_en,
            ':name_ar'               => $name_ar,
            ':category_id'           => $category_id,
            ':type'                  => $type
        );

        $statement = $con->prepare(
            "UPDATE games 
                      SET name_en = :name_en,name_ar = :name_ar ,type = :type , category_id = :category_id");
        $result = $statement->execute($params);
        return $result;
    }


    static function get($id){
        global $con;
        $query = "SELECT *  FROM games where id = ?"; // db query
        $statement = $con->prepare($query);  // prepare query
        $statement->execute([$id]);
        $game = $statement->fetch(PDO::FETCH_ASSOC);
        return $game;
    }

    static function listGames($user_id = null){
        global $con;

        $where = '';
        $params = [];

        if(isset($user_id)){
            $params = [$user_id];
            $where = " WHERE user_id = ?";
        }

        $query = "SELECT * , categories.name_en as category_en , categories.name_ar as categories_ar  

                  FROM games 
                  JOIN categories on categories.category_id = games.category_id
                  $where"; // db query
        $statement = $con->prepare($query);  // prepare query
        $statement->execute($params);
        $game = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $game;
    }

    static function getGamesTypes(){

       return [

           'TEXT_QUESTIONS' => 'QUESTIONS',
           'PICK_IMAGE' => 'PICK IMAGE',
           'DRAG_ELEMENT' => 'DRAG ELEMENT'
       ];
    }

}