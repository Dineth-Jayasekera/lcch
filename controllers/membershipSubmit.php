<?php

include '../DB/DB.php';

global $connection;

date_default_timezone_set("Asia/Colombo");
$date = date("Y-m-d");

$firstName = $_POST['firstName'];
$middleName = $_POST['middleName'];
$lastName = $_POST['lastName'];
$mostUsedName = $_POST['mostUsedName'];
$email = $_POST['email'];
$dob = $_POST['dob'];
$address_line1 = $_POST['address_line1'];
$address_line2 = $_POST['address_line2'];
$address_line3 = $_POST['address_line3'];
$province = $_POST['province'];
$district = $_POST['district'];
$city = $_POST['city'];
$postal_code = $_POST['postal_code'];
$gender = $_POST['gender'];
$preferred_language = $_POST['preferred_language'];
$working_place = $_POST['working_place'];
$designation = $_POST['designation'];
$telephone_residence = $_POST['telephone_residence'];
$mobile = $_POST['mobile'];
$secondary_mobile = $_POST['secondary_mobile'];
$nic = $_POST['nic'];
$school = $_POST['school'];
$referral = $_POST['referral'];

$photograph_name = $_FILES['photograph']['name'];
$photograph_tmp = $_FILES['photograph']['tmp_name'];

$imageName = $firstName . time() . ".jpg";

$query = "INSERT INTO `members`
    
        (`first_name`,
        `middle_name`,
        `last_name`,
        `email`,
        `most_used_name`,
        `address_line1`,
        `address_line2`,
        `address_line3`,
        `province_id`,
        `district_id`,
        `city_id`,
        `postal_code`,
        `dob`,
        `gender`,
        `preferred_language`,
        `nic`,
        `telephone`,
        `mobile`,
        `secondary_mobile`,
        `working_place`,
        `designation`,
        `school_university`,
        `referral`,
        `image`,
        `registered_date`)

VALUES ('$firstName',
        '$middleName',
        '$lastName',
        '$email',
        '$mostUsedName',
        '$address_line1',
        '$address_line2',
        '$address_line3',
        '$province',
        '$district',
        '$city',
        '$postal_code',
        '$dob',
        '$gender',
        '$preferred_language',
        '$nic',
        '$telephone_residence',
        '$mobile',
        '$secondary_mobile',
        '$working_place',
        '$designation',
        '$school',
        '$referral',
        '$imageName',
        '$date');
";

if (mysqli_query($connection, $query)) {
    move_uploaded_file($photograph_tmp, "../admin/assets/img/profile_imgs/" . $imageName);
    echo "Registration Completed";
} else {
    echo "Registration Failed";
}
?>