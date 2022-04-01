
<html>
<head>
    <title>game</title>
    <meta charset="utf-8"/>
    <?php
    include "../include/header.php";
    ?>
    <link rel="stylesheet" href="game.css">

</head>

<body>
<?php include "../include/navbar.php"?>

<div class="container-fluid pt-5">

    <p>Drag the W3Schools image into the rectangle:</p>

    <audio autoplay preload='auto' id="myAudio">
        <source src="ok.mp3" type="audio/mpeg" >
    </audio>

    <div class="row">
        <div class="col-md-3 game-choice"></div>
        <div class="col-md-3 game-choice"></div>
        <div class="col-md-3 game-choice"></div>
        <div class="col-md-3 game-choice correct-choice"></div>
    </div>


    <img id="drag1" src="cat.jpg" draggable="true" ondragstart="drag(event)" width="200" height="200">


    <br>

</div>

<script src="game.js"> </script>
<script src="shake.js"></script>

</body>
</html>