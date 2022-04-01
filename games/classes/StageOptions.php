<?php
/**
 * Created by PhpStorm.
 * Game: ultimate-pc
 * Date: 2022/03/19
 * Time: 09:11 م
 */


include(__DIR__ . '/../../db_connect.php');


class StageOptions
{

    static function create($stage_id , $option){

        global $con;

        $statement = $con->prepare("
                    INSERT INTO stage_options (stage_id , option)  
                                       VALUES (:stage_id , :option)");
        $result = $statement->execute(
            array(
                ':stage_id'    => $stage_id,
                ':option'      => $option
            )
        );

        return $con->lastInsertId();
    }


    static function listOptions($stage_id){
        global $con;
        $query = "SELECT *  
                  FROM stage_options 
                  WHERE stage_id = ?"; // db query
        $statement = $con->prepare($query);  // prepare query
        $statement->execute([$stage_id]);
        $options = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $options;
    }



}