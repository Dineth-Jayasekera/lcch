<?php

include '../../DB/DB.php';

global $connection;

$province_id = $_POST['province_id'];

$district_id = $_POST['district_id'];

if (isset($_POST['province_id'])) {
    $sql = "SELECT * FROM districts WHERE province_id = '$province_id'";
    $result = mysqli_query($connection, $sql);
    $districts = array();

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            $districts[] = array(
                "id" => $row['id'],
                "name" => $row['name_en']
            );
        }
    }

    echo json_encode($districts);
}

if (isset($_POST['district_id'])) {
    $sql = "SELECT * FROM cities WHERE district_id = '$district_id'";
    $result = mysqli_query($connection, $sql);
    $cities = array();

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            $cities[] = array(
                "id" => $row['id'],
                "name" => $row['name_en']
            );
        }
    }

    echo json_encode($cities);
}
