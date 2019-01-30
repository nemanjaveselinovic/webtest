<?php
session_start();
if(isset($_SESSION["user"])) {
    header('Location: ./');
    die();
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once("database/MasterDBProvider.php");
    $masterDatabaseProvider = MasterDBProvider::getDBProvider();

    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $email = $_POST['email'];
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

    elseif($password != $cpassword){
        $error = "Passwords doesn't match.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    }

    if ($error === "") {
        $user = $masterDatabaseProvider->getUserByEmail($email);
        if ($user !== "") {
            $error = "Email alreday exists.";
        } else {
            $masterDatabaseProvider->saveUser($username, $password, $email);
        }
    }  
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Webtest Register">
        <title>Webtest Register</title>

        <link rel="stylesheet" type="text/css" href="assets/css/webtest.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body class="bg-light">
    <?php require_once("header/header.php"); ?>
        <main role="main" class="container">
            <div class="my-3 p-3 bg-white rounded box-shadow">
                <h1>Register Page</h1>
                <br />
                <?php 
                    if(isset($error) && $error === "") {
                        echo '<div> Registration completed successfully</div>';
                    } else {
                        if(isset($error) && $error !== "") {
                            echo '<div class="alert alert-danger">' .  $error . '</div>';
                        }
                    require_once("form/register-form.php");
                    } 
                ?>
            </div>
        </main> 
    </body>
</html>
