
<?php
include "../db_connect.php";

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


</div>
</body>
</html>

