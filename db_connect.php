<?php



$dsn='mysql:host=localhost;dbname=game'; // the database connection string
$user='root';                            // the user name of the php myadmin
$pass='';                                // password of php myadmin
$option=array(
    PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8',
);
try{
    $con =new PDO($dsn,$user,$pass,$option); //PHP Database Object
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo'failed to connect'.$e->getMessage();
}
?>