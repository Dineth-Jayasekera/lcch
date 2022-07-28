<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

unset($_COOKIE['displayName']);
setcookie('displayName', null, -1, '/');
setcookie('role', null, -1, '/');
setcookie('fullName', null, -1, '/');
setcookie('image', null, -1, '/');
setcookie('member_id', null, -1, '/');
echo '<script>window.location.replace("https://lcch.ictforlife.org");</script>';
exit;
