<?php

include '../../DB/DB.php';
require_once './helpers/sendMail.php';

global $connection;

$for = $_POST['for'];

$member_id = $_POST['member'];
$user_role = $_POST['user_role'];

$status = $_POST['status'];
$id = $_POST['id'];

$sql_checkMember = "SELECT * FROM members WHERE id = '$member_id';";
$result_checkMember = mysqli_query($connection, $sql_checkMember);

date_default_timezone_set("Asia/Colombo");
$date = date("Y-m-d h:i:s");

//Create Account 
if ($for == "CreateAccount") {

    if (mysqli_num_rows($result_checkMember) > 0) {
        $row_checkMember = mysqli_fetch_assoc($result_checkMember);

        $name = $row_checkMember['first_name'] . ' ' . $row_checkMember['last_name'];
        $username = $row_checkMember['email'];
        $password = bin2hex(openssl_random_pseudo_bytes(4));

        $sql_checkUser = "SELECT * FROM users WHERE member_id = '$member_id';";
        $result_checkUser = mysqli_query($connection, $sql_checkUser);

        if (mysqli_num_rows($result_checkUser) > 0) {
            echo 'This User Account Already Exist';
            exit;
        }

        $sql_createUser = "INSERT INTO `users`
                    (`member_id`,
                    `username`,
                    `password`,
                    `is_active`,
                    `role`,
                    `created_at`)
                VALUES
                    ('$member_id',
                     '$username',
                     '" . md5($password) . "',
                     '1',
                     '$user_role',
                    '$date');";
        if (mysqli_query($connection, $sql_createUser)) {

            $sql_updateMember = "UPDATE members SET 
                                    having_account = '1' 
                                 WHERE 
                                    id = '$member_id';";

            if (mysqli_query($connection, $sql_updateMember)) {

                $mail = new sendMail();
                $message = '<div style="padding:10px; border: 2px solid blue; border-radius: 10px;">
                    <h2>Hi ' . $name . ',</h2>
<center><h1 >Please use this details to login</h1></center>
<ul>
	<li><b>Username :</b> ' . $username . '</li>
    <li><b>Password :</b> ' . $password . '</li>
</ul>
</div>';
                $mail->send($username, "Account Details", $message);
            }
        } else {
            echo "User Creation Failed";
        }
    } else {
        echo 'This Member Not Exist';
        exit;
    }
} elseif ($for == "AccountStatusChange") {
    $sql_updateUser = "UPDATE users SET 
                                    is_active = '$status' 
                                 WHERE 
                                    id = '$id';";

    if (mysqli_query($connection, $sql_updateUser)) {
        echo 'Successfully Updated';
    }
}
