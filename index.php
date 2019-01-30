<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Webtest Login">
        <title>Webtest Home</title>

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
                    <?php if(isset($_SESSION["user"])) {?>
                        <li class="nav-item text-nowrap">
                            <a class="nav-link"
                                href="#"><?php echo $_SESSION["user"]; ?></a>
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
                <h1>Home Page</h1>
                <br />
                <form action="./search.php" method="post">
                    <div>
                        <div class="form-group">
                            <label class="form-control-label required" for="search">Search</label>
                            <input type="text" id="search" name="search" required="required" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" id="search" name="search" class="btn-secondary btn">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </main> 
    </body>
</html>
