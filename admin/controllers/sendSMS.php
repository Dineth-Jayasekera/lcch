<?php
require_once './helpers/sendSMS.php';

$numbers = $_POST['pnone_number'];
$message = $_POST['msg'];

$sendSMS = new sendSMS();

$response = $sendSMS->send($numbers, $message);
if( $response == "done"){
    echo 'Successfully Send';
}else{
    echo 'Successfully Send Failed '.$response;
}