<?php

if(!isset($_SESSION))
    session_start();


if(!isset($_SESSION['user_id']))
    header("location:../login");


include "../games/classes/Game.php";
include "../categories/classes/Category.php";
include "../users/classes/User.php";

?>
<html>
<head>
    <title>Dashboard</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="dashboard.css">
    <?php include "../include/header.php";?>
</head>

<body>

<?php include "../include/navbar.php"?>
<div class="container-fluid mt-5 pt-5">
    <?php
    include "../include/dashboard.php";
    ?>



    <div class="row mt-3">
        <div class="col-md-4 mt-lg-3 mt-sm-2 mb-2">
            <div class="row  bg-blue rounded">
                <div class="col-4  p-2  border-right border-white">
                    <div class="text-center pt-2">
                        <a href="../users" class="text-white stretched-link">
                            <i class="fas fa-users fa-3x"></i>
                        </a>
                    </div>
                </div>
                <div class="col-8  p-2 bg-purple">
                    <a href="../users" class="text-white stretched-link"></a>
                    <h4 class="text-center text-white ">Total Users</h4>
                    <p class="text-center text-white font-weight-bold"><?=User::getCount()?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mt-lg-3 mt-sm-2 mb-2 mx-1">
            <div class="row  bg-blue rounded">
                <div class="col-4  p-2  border-right border-white">
                    <div class="text-center pt-2">
                        <a href="../categories" class="text-white stretched-link">
                            <i class="fas fa-sitemap fa-3x"></i>
                        </a>
                    </div>
                </div>
                <div class="col-8  p-2 bg-yellow">
                    <a href="../categories" class="text-white stretched-link"></a>
                    <h4 class="text-center text-white ">Total Categories</h4>
                    <p class="text-center text-white font-weight-bold"><?=Category::getCount()?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mt-lg-3 mt-sm-2 mb-2">
            <div class="row  bg-blue rounded">
                <div class="col-4  p-2  border-right border-white">
                    <div class="text-center pt-2">
                        <a href="../games" class="text-white stretched-link">
                            <i class="fas fa-play fa-3x"></i>
                        </a>
                    </div>
                </div>
                <div class="col-8  p-2 bg-red">
                    <a href="../games" class="text-white stretched-link"></a>
                    <h4 class="text-center text-white ">Total Games</h4>
                    <p class="text-center text-white font-weight-bold"><?=Game::getCount()?></p>
                </div>
            </div>
        </div>

    </div>

    </div>
</body>
</html>

