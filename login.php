<?php ob_start(); ?>

<?php
$pageTitle = 'Login';
require_once('header.php'); ?>
    </head>


    <main  class = "container">
        <h1>Log In</h1>

        <?php
        if ($_GET['invalid'] == true) {
            echo '<div class="alert alert-danger" id="message">Invalid Login</div>';
        }
        else
        {
            echo '<div class="alert alert-info" id="message">Please log into your account</div>';
        }
        ?>

        <form method="post" action="validate.php">
            <fieldset class="form-group">
                <label for="email" class="col-sm-1">Email:</label>
                <input name="email" id="email" required type="email" placeholder="email@email.com"/>
            </fieldset>
            <fieldset class="form-group">
                <label for="password" class="col-sm-1">Password:</label>
                <input type="password" name="password" id="password" required />
            </fieldset>
            <button class="btn btn-success col-sm-offset-1">Login</button>
        </form>
        <br /><a href="reset-password.php">Reset password</a>
    </main>

<?php
// you can get an error if you use require instead of include
require_once('footer.php');
ob_flush();
?>