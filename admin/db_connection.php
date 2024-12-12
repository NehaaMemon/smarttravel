<?php
$con = new mysqli("localhost","root","","travele");

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>
