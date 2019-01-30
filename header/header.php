<nav class="navbar navbar-dark navbar-expand-md sticky-top bg-dark p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0"
    href="./">Website Logo</a>
    <div class="w-100 order-1 order-md-0">
        <ul class="navbar-nav px-3">
        </ul>
    </div>
    <div class="order-2 order-md-1">
        <ul class="navbar-nav px-3">
            <?php if(isset($_SESSION["user"]) && $_SESSION["user"] !== "") {?>
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