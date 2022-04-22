
<?php
if(!isset($_SESSION)) session_start();

?>
<link rel="stylesheet" href="../../assets/css/bootstrap.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"/>

<link rel="stylesheet" href="../../assets/fonts/css/all.css" />
<link rel="stylesheet" href="../../assets/css/main.css"/>

<?php if($_SESSION['lang'] == 'ar'){?>

    <link rel="stylesheet" href="../assets/bootstrap-v4-rtl-master/dist/css/bootstrap-rtl.min.css" media="screen">
    <link rel="stylesheet" href="ui_manager/asset/css/custom-rtl.css">
<?php }?>

<script src="../../assets/js/jquery-3.4.1.min.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
<script src="../../assets/js/boot.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>




