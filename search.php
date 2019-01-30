<?php
session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once("database/MasterDBProvider.php");
    $masterDatabaseProvider = MasterDBProvider::getDBProvider();

    $searchQuery = $_POST['search-query'];
    $searchResults = $masterDatabaseProvider->findUsers($searchQuery);
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Webtest Search">
        <title>Webtest Search</title>

        <link rel="stylesheet" type="text/css" href="assets/css/webtest.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body class="bg-light">
        <?php require_once("header/header.php"); ?>
        <main role="main" class="container">
            <div class="my-3 p-3 bg-white rounded box-shadow">
                <h1>Search Page</h1>
                <br />
                <?php 
                    if (isset($_SESSION["user"]) && $_SESSION["user"] !== "") {
                        require_once("form/search-form.php");
                        if (isset($searchQuery) && $searchQuery !== "") {
                            echo '<div>Results for <strong>' . $searchQuery . '</strong> search query:</div>';
                            foreach ($searchResults as $user) {
                                echo '<div class="media text-muted pt-3">';
                                    echo '<p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">';
                                        echo '<span class="d-block">';
                                                echo '<strong class="text-gray-dark">' . $user . '</strong>';
                                        echo '</span>';
                                    echo '</p>';
                                echo '</div>';
                            }
                        }
                    } else {
                        echo '<h3>Please login.</h3>';
                        require_once("form/login-form.php");
                    } 
                ?>
            </div>
        </main> 
    </body>
</html>
