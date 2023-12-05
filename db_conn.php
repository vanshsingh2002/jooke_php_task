<?php

$sname= "localhost";
$unmae= "root";
$password = "";

$db_name = "php_task_intern";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}