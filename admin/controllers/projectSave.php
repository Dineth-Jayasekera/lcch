<?php

include '../../DB/DB.php';

global $connection;

$title = $_POST['title'];
$description= str_replace("'","`",$_POST['description']);
$fb = $_POST['fb'];

$photograph_name = $_FILES['photograph']['name'];
$photograph_tmp = $_FILES['photograph']['tmp_name'];

$imageName =  time() . ".jpg";

$sql_addProject = "INSERT INTO `projects`
            (`title`,
            `description`,
            `image`,
            `fb`)
        VALUES
            ('$title',
            '$description',
            '$imageName',
            '$fb');
";

if (mysqli_query($connection, $sql_addProject)) {
    move_uploaded_file($photograph_tmp, "../../assets/img/projects/" . $imageName);
    echo "Successfully Saved";
} else {
    echo "Failed on saving ";
}
