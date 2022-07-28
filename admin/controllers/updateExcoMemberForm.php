<?php

include '../../DB/DB.php';

global $connection;

$twit = $_POST['twit'] ?? '#';
$fb = $_POST['fb'] ?? '#';
$ig = $_POST['ig'] ?? '#';
$linkedin = $_POST['linkedin'] ?? '#';
$update_member_id = $_POST['update_member_id'];

$sql = "UPDATE `exco`
SET
    `twitter` = '$twit',
    `linkedin` = '$linkedin',
    `ig` = '$ig',
    `fb` = '$fb'
WHERE `id` = '$update_member_id';
";

if (mysqli_query($connection, $sql)) {
    echo "Successfully Updated";
} else {
    echo "Error On Saving";
}