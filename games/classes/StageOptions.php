<?php

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

    static function update($id , $option){

        global $con;
        $statement = $con->prepare(" UPDATE stage_options SET option = :option WHERE id = :id");
        $result = $statement->execute(
            array(
                ':id'    => $id,
                ':option'      => $option
            )
        );
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