<?php ob_start();

$pageTitle = 'Account Settings';

// check if the user has a valid account
session_start();

if (empty($_SESSION['userId']))
{
    header('location:login.php');
    exit();
}

require_once('header.php'); ?>
</head>

<body>
<main class="container">
    <h1>Account Settings</h1>
    <div class="alert alert-info" id="message">Update your account</div>

    <form method="post" action="update-registration.php">
        <fieldset class="form-group">
            <label for="email" class="col-sm-2">Email:</label>
            <input name="email" id="email" required type="email" placeholder="email@email.com">
        </fieldset>
        <fieldset class="form-group">
            <label for="initials" class="col-sm-2">Initials:</label>
            <input name="initials" id="initials" placeholder="JW">
        </fieldset>
        <fieldset class="form-group">
            <label for="password" class="col-sm-2">Password:</label>
            <input type="password" name="password" id="password" required pattern="(?=.*\d)(?=.*[A-Z].{8,}"/>
            <span id="result"></span>
        </fieldset>
        <fieldset class="form-group">
            <label for="confirm" class="col-sm-2">Confirm Password:</label>
            <input type="password" name="confirm" id="confirm" required pattern="(?=.*\d)(?=.*[A-Z].{8,}"/>
        </fieldset>
        <div class="col-sm-offset-2">
            <button class="btn btn-success btnRegister">Register</button>
        </div>
    </form>
</main>
</body>

<?php

require_once('anchored-footer.php');
ob_flush();
?>