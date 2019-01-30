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
    $error = "";

    $user = $masterDatabaseProvider->getUser($username, $password);
    if ($user === "") {
        $error = "Error logging you in.";
    } else {
        $_SESSION["user"] = $user;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Webtest Login">
        <title>Webtest Login</title>

        <link rel="stylesheet" type="text/css" href="assets/css/webtest.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body class="bg-light">
    <nav class="navbar navbar-dark navbar-expand-md sticky-top bg-dark p-0">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0"
            href="./">Website Logo</a>
            <div class="w-100 order-1 order-md-0">
                <ul class="navbar-nav px-3">
                </ul>
            </div>
            <div class="order-2 order-md-1">
                <ul class="navbar-nav px-3">
                    <?php if(isset($user) && $user !== "") {?>
                        <li class="nav-item text-nowrap">
                            <a class="nav-link"
                                href="#"><?php echo $user; ?></a>
                        </li>
                        <li class="nav-item text-nowrap">
                            <a class="nav-link"
                                href="./logout.php">Logout</a>
                        </li>
                    <?php } else {?>
                        <li class="nav-item text-nowrap">
                            <a class="nav-link"
                                href="./login.php">Log in</a>
                        </li>
                        <li class="nav-item text-nowrap">
                            <a class="nav-link"
                                href="./register.php">Register</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
        <main role="main" class="container">
            <div class="my-3 p-3 bg-white rounded box-shadow">
                <h1>Login Page</h1>
                <br />
                <?php if(isset($user) && $user !== "") {?>
                    <div> Welcome, <?php echo $user; ?>! </div>
                <?php } else {?>
                    <?php if(isset($error) && $error !== "") {?>
                        <div class="alert alert-danger"> <?php echo $error; ?></div>
                    <?php } ?>
                    <form action="./login.php" method="post">
                        <div>
                            <div class="form-group">
                                <label class="form-control-label required" for="username">Username</label>
                                <input type="text" id="username" name="username" required="required" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label required" for="password">Password</label>
                                <input type="password" id="password" name="password" required="required" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" id="login" name="login" class="btn-secondary btn">Login</button>
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </main> 
    </body>
</html>
