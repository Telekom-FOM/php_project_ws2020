<?php
//classes required for unserialization
include("php_include/classes.php");
session_start();
$user = unserialize($_SESSION['user']);
print_r($user);
echo $user->email;