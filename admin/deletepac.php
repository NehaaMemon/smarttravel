<?php
include 'header.php';





$id=$_GET['id'];
$q1="DELETE FROM `upcome` WHERE `id` = '$id'";

mysqli_query($con,$q1);


echo "<script>window.open('allpackages.php','_self')</script>";





?>
