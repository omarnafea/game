<?php
/**
 * Created by PhpStorm.
 * User: ultimate-pc
 * Date: 2022/03/19
 * Time: 09:11 م
 */
include('../db_connect.php');

class User
{


    static function getByUserNameAndPassword($username , $password){

    }



    static function create($name , $email , $username , $password){

        global $con;

        $statement = $con->prepare("
   INSERT INTO users (name, email,user_name,password,privilege_id) 
   VALUES (:name, :email, :user_name,:password,:privilege_id )");
        $result = $statement->execute(
            array(
                ':name'            => $name,
                ':email'           => $email,
                ':user_name'       => $username,
                ':password'        => $password
            )
        );
    }

    static function update( $id ,$name , $email , $username , $password = ""){

        global $con;

        $pass = "";

        $params =    array(
            ':name'              => $name,
            ':email'             => $email,
            ':user_name'         => $username,
            ':user_id'           => $id,
        );

        if(trim($_POST['password'])  !== ""){

            $pass=',password = :password';
            $params[':password'] = sha1($_POST["password"]);
        }

        $statement = $con->prepare(
            "UPDATE users 
                      SET name = :name,email = :email ,user_name = :user_name {$pass}
                       WHERE id = :user_id");

        $result = $statement->execute($params);


    }


    static function get($id){

    }

    static function listUsers(){

        global $con;
        $query = "SELECT *  FROM users "; // db query
        $statement = $con->prepare($query);  // prepare query
        $statement->execute();
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

}