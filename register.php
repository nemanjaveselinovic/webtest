<?php

require_once("database/MasterDBProvider.php");

$masterDatabaseProvider = MasterDBProvider::getDBProvider();

$username = "test233123";
$password = "test233312";
$rpassword = "test233312";
$email = "test2@fdsf3.com";

$error = "";

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Invalid password";
}

if (strlen($username) < 8) {
    $error = "Username must be at least 8 chars length.";
}

if (strlen($password) === 0) {
    $error = "Password cant be empty.";
}

elseif($password != $rpassword){
    $msg = "Passwords doesn't match.";
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Invalid email format.";
}

if ($error !== "") {
    echo $error;
    return;
}


$masterDatabaseProvider->saveUser($username, $password, $email);

