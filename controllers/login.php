<?php

include '../DB/DB.php';

global $connection;

date_default_timezone_set("Asia/Colombo");
$date = date("Y-m-d h:i:s");

$username = $_POST['username'];
$password = $_POST['password'];

$sql_checkMember = "SELECT m.first_name, m.last_name, u.password, u.role, m.image, m.id as member_id, u.id as user_id FROM users u INNER JOIN members m ON u.member_id = m.id WHERE u.username = '$username' AND u.is_active = '1';";
$result_checkMember = mysqli_query($connection, $sql_checkMember);

if (mysqli_num_rows($result_checkMember) == 0) {
    echo 'Failed';
} else {
    $row_checkMember = mysqli_fetch_assoc($result_checkMember);
    if ($row_checkMember['password'] == md5($password)) {

        setcookie("displayName", $row_checkMember['first_name'], time() + (86400 * 30), "/");
        setcookie("role", $row_checkMember['role'], time() + (86400 * 30), "/");
        setcookie("image", $row_checkMember['image'], time() + (86400 * 30), "/");
        setcookie("member_id", $row_checkMember['member_id'], time() + (86400 * 30), "/");
        setcookie("fullName", $row_checkMember['first_name'] . ' ' . $row_checkMember['last_name'], time() + (86400 * 30), "/");

        $user_id = $row_checkMember['user_id'];

        $sql_loginHistory = "INSERT INTO `login_history`
                                (`user_id`,
                                `date_time`,
                                `action`)
                            VALUES
                                '$user_id',
                                '$date',
                                'Login');
                            ";

        if(mysqli_query($connection, $sql_loginHistory)){}else{
            die(mysqli_error($connection));
        }

        echo 'success';
        exit;
    } else {
        echo 'Failed';
    }
}
