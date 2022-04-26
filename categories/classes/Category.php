<?php
/**
 * Created by PhpStorm.
 * Game: ultimate-pc
 * Date: 2022/03/19
 * Time: 09:11 م
 */


include(__DIR__ . '/../../db_connect.php');

class Category
{

    static function create($name_en , $name_ar ){
        global $con;

        $statement = $con->prepare("
                    INSERT INTO categories (name_en , name_ar)  VALUES (:name_en , :name_ar )");
        $result = $statement->execute(
            array(
                ':name_en'            => $name_en,
                ':name_ar'            => $name_ar
            )
        );
    }

    static function update( $id ,$name_en , $name_ar){

        global $con;
        $params =  [
            ':name_en'              => $name_en,
            ':name_ar'             => $name_ar,
            ':category_id'           => $id,
        ];

        $statement = $con->prepare(
            "UPDATE categories 
                      SET name_en = :name_en,name_ar = :name_ar 
                       WHERE category_id = :category_id");

        $result = $statement->execute($params);
        return $result;
    }


    static function get($id){
        global $con;
        $query = "SELECT *  FROM categories where category_id = ?"; // db query
        $statement = $con->prepare($query);  // prepare query
        $statement->execute([$id]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    static function listCategories(){

        global $con;
        $query = "SELECT *  FROM categories "; // db query
        $statement = $con->prepare($query);  // prepare query
        $statement->execute();
        $categories = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $categories;
    }

    static function getCount(){
        global $con;
        $query = "SELECT COUNT(*) as count  FROM categories "; // db query
        $statement = $con->prepare($query);  // prepare query
        $statement->execute();
        $count = $statement->fetch(PDO::FETCH_ASSOC);
        return $count['count'];
    }


}