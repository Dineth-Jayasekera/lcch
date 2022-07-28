<?php
$host = "localhost";
$user_name = "urpvtyt7qkvtn";
$password="WelCome./@1";
$DB_name="dbuxzggl0okrl6";
$port="3306";

$connection= mysqli_connect($host,$user_name,$password,$DB_name,$port);

if($connection->connect_error)
{
	echo"error";
	die();
}