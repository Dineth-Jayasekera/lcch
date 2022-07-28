<?php

include '../../DB/DB.php';

global $connection;

$title = str_replace("'","`",$_POST['title']);
$slogan = str_replace("'","`",$_POST['slogan']);
$youtube = $_POST['youtube'];

$sql = "UPDATE `configurations`
SET
    `title` = '$title',
    `slogan` = '$slogan',
    `video_link` = '$youtube'
WHERE `id` = '1';
";

if (mysqli_query($connection, $sql)) {
    echo "Successfully Updated";
} else {
    echo "Error On Saving";
}