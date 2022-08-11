<?php
$host = "35.213.130.168";
$user_name = "ugqqutcy6t3iz";
$password="WelCome./@1";
$DB_name="dbxugi5p1g2jud";
$port="3306";

$connection= mysqli_connect($host,$user_name,$password,$DB_name,$port);

if($connection->connect_error)
{
	echo"error";
	die();
}