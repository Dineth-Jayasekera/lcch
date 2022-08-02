<?php
$host = "192.99.232.124";
$user_name = "colomboh_lcch";
$password="WelCome./@1";
$DB_name="colomboh_lcch";
$port="3306";

$connection= mysqli_connect($host,$user_name,$password,$DB_name,$port);

if($connection->connect_error)
{
	echo"error";
	die();
}