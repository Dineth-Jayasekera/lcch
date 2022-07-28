<?php

include '../../DB/DB.php';

global $connection;

$member_status = ($_POST['member_status'] == "on" ? "1" : "0");
$member_interview_status = $_POST['member_interview_status'] == "on" ? "1" : "0";
$member_id = $_POST['update_member_id'];
$mylci = $_POST['mylci'];
$mylci_register_date = $_POST['mylci_register_date'];

$sql = "UPDATE `members`
SET
    `is_active` = '$member_status',
    `is_interview_done` = '$member_interview_status',
    `mylci` = '$mylci',
    `mylci_register_date` = '$mylci_register_date'
WHERE `id` = '$member_id';
";

if (mysqli_query($connection, $sql)) {
    echo "Successfully Updated";
} else {
    echo "Error On Saving";
}