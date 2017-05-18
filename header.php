<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle; ?></title>

    <!-- Latest compiled and minified CSS http://getbootstrap.com/getting-started/-->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="app.css">

</head>
<body>


<nav class="navbar navbar-inverse ">
    <ul class="nav navbar-nav">
        <li><a href="default.php" class="navbar-brand">Fitness Tracker for Heights OCUP Team</a></li>

        <?php

        //start a session
        session_start();

        if (empty($_SESSION['userId']))
        {
            // this links should only show if the person is NOT logged in
            echo '<br />
                  <li><a href="register.php">Register</a></li>
                  <li><a href="login.php">Login</a></li>';
        } else {
            //this should only show if the person is logged in
            echo '<br />
                  <li><a href="account-settings.php">Account Settings</a></li>
                  <li><a href="800mResults.php">800m results</a></li>
                  <li><a href="logout.php">Logout</a></li>';
        }

        ?>
    </ul>

    <?php
    if (!empty($_SESSION['userId']))
        echo '<div class="navbar-text pull-right">'.'Logged in: '.$_SESSION['initials'].'</div>';
    ?>
</nav>