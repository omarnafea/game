<?php
session_start();
if(isset($_SESSION['user_id'])){
    header("location:dashboard");
}else{
    header("location:login");
}

