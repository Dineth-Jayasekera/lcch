<?php

include '../../DB/DB.php';

global $connection;

$id = $_POST['id'];

$sql_deleteProject = "UPDATE projects
SET
status = 0
WHERE id = '$id';
";

if (mysqli_query($connection, $sql_deleteProject)) {
    echo "Successfully Saved";
} else {
    echo "Failed on saving";
}
