<?php
/**
 * Created by PhpStorm.
 * Category: ultimate-pc
 * Date: 2022/03/19
 * Time: 09:11 م
 */


include(__DIR__ . '/../../db_connect.php');


class User
{

    static function getByUserNameAndPassword($username , $password){
        global $con;
        $query = "SELECT *  FROM users where user_name = ? AND password = ?"; // db query
        $statement = $con->prepare($query);  // prepare query
        $statement->execute([$username , $password]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        return $user;
    }



    static function create($name , $email , $username , $password){

        global $con;

        $statement = $con->prepare("
   INSERT INTO users (name, email,user_name,password) 
   VALUES (:name, :email, :user_name,:password )");
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
        return $result;
    }


    static function get($id){
        global $con;
        $query = "SELECT *  FROM users where id = ?"; // db query
        $statement = $con->prepare($query);  // prepare query
        $statement->execute([$id]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        return $user;
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