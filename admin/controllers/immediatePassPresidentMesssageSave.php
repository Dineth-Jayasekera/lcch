<?php

include '../../DB/DB.php';

global $connection;

$year_id = $_POST['year'];
$member_id = $_POST['member'];
$president_message = str_replace("'","`",$_POST['president_message']);

$photograph_name = $_FILES['photograph']['name'];
$photograph_tmp = $_FILES['photograph']['tmp_name'];

$imageName = $designation_order . time() . ".jpg";


$sql_addExco = "INSERT INTO `immediate_pass_president_message`
            (`member_id`,
            `image`,
            `year_id`,
            `message`)
        VALUES
            ('$member_id',
            '$imageName',
            '$year_id',
            '$president_message');
";

if (mysqli_query($connection, $sql_addExco)) {
    move_uploaded_file($photograph_tmp, "../../assets/img/Immediate_Pass_president_messages/" . $imageName);
    echo "Successfully Updated";
} else {
    echo "Error On Saving";
}
