<?php

include '../../DB/DB.php';

global $connection;

$year_id = $_POST['year'];
$member_id = $_POST['member'];
$designation_order = $_POST['designation_order'];
$designation = $_POST['designation'];
$facebook = $_POST['facebook'] ?? '#';
$twitter = $_POST['twitter'] ?? '#';
$instergram = $_POST['instergram'] ?? '#';
$linkedIn = $_POST['linkedIn'] ?? '#';

$photograph_name = $_FILES['photograph']['name'];
$photograph_tmp = $_FILES['photograph']['tmp_name'];

$imageName = $designation_order . time() . ".jpg";

$sql_checkExco = "SELECT * FROM exco WHERE member_id = '$member_id' AND year_id = '$year_id' AND designation_order = '$designation_order';";
$result_checkExco = mysqli_query($connection, $sql_checkExco);

if (mysqli_num_rows($result_checkExco) > 0) {
    echo 'This Position Already Exist, Please Remove Before Adding.';
    exit;
}

$sql_addExco = "INSERT INTO `exco`
            (`member_id`,
            `designation`,
            `photograph`,
            `year_id`,
            `designation_order`,
            `ig`,
            `fb`,
            `twitter`,
            `linkedin`)
        VALUES
            ('$member_id',
            '$designation',
            '$imageName',
            '$year_id',
            '$designation_order',
            '$instergram',
            '$facebook',
            '$twitter',
            '$linkedIn');
";

if (mysqli_query($connection, $sql_addExco)) {
    move_uploaded_file($photograph_tmp, "../../assets/img/team/" . $imageName);
    echo "Registration Completed";
} else {
    echo "Registration Failed";
}
