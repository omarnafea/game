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

    static function create($user_id , $type , $name_en , $name_ar , $category_id  , $image ){


        global $con;

        $statement = $con->prepare("
                    INSERT INTO games (user_id , type , name_en , name_ar , category_id , image)  
                                       VALUES (:user_id , :type , :name_en , :name_ar , :category_id , :image)");
        $result = $statement->execute(
            array(
                ':user_id'         => $user_id,
                ':type'            => $type,
                ':name_en'         => $name_en,
                ':name_ar'         => $name_ar,
                ':category_id'     => $category_id,
                ':image'           => $image
            )
        );
        return $con->lastInsertId();
    }

    static function update( $id ,$name_en , $name_ar ,$type  , $category_id , $image  = null){

        global $con;
        $params =    array(
            ':id'                    => $id,
            ':name_en'               => $name_en,
            ':name_ar'               => $name_ar,
            ':category_id'           => $category_id,
            ':type'                  => $type
        );

        $updateImageSQL  ='';

        if(isset($image)){
            $updateImageSQL = " ,image = :image";
            $params[":image"] = $image;
        }

        $statement = $con->prepare(
            "UPDATE games 
                      SET name_en = :name_en,name_ar = :name_ar ,type = :type , category_id = :category_id {$updateImageSQL} 
                       WHERE id = :id");
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

        $query = "SELECT games.* , categories.name_en as category_en , categories.name_ar as category_ar  

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

    static function getCount(){
        global $con;
        $query = "SELECT COUNT(*) as count  FROM games "; // db query
        $statement = $con->prepare($query);  // prepare query
        $statement->execute();
        $game = $statement->fetch(PDO::FETCH_ASSOC);
        return $game['count'];
    }

}