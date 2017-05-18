<?php ob_start();?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Save Registration</title>
    </head>
    <body>

    <?php
    //save the user inputs to variables
    $email = $_POST['email'];
    $initials = $_POST['initials'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $ok = true;

    if (empty($password)) {
        echo 'The system thinks it is empty';
    }
    else
        echo 'The system can see a value';

    echo '<br />The length of the string is: '.strlen($password);

    //validate the inputs
    if (empty($email)){
        echo 'Email is required<br />';
        $ok = false;
    }

    //validate the inputs
    if (empty($initials)){
        echo 'Initials are required<br />';
        $ok = false;
    }


    if (empty($password) || (strlen($password) < 8)){
        echo 'Password is invalid<br />';
        $ok = false;
    }
    else
    {
        echo 'password was ok';
    }

    if ($password != $confirm){
        echo 'Passwords do not match<br />';
        $ok = false;
    }

    if ($ok)
    {
        //connect
        require_once('db.php');

        //set up sql insert
        $sql = "INSERT INTO skiUsers (email, initials, password) VALUES (:email, :initials, :password)";

        //hash the password
        $password = password_hash($password, PASSWORD_DEFAULT);

        //execute the save
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':email', $email, PDO::PARAM_STR, 50);
        $cmd->bindParam(':initials', $initials, PDO::PARAM_STR, 3);
        $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);
        $cmd->execute();

        //disconnect
        $conn=null;

        header('location:login.php');
    }


    ?>

    </body>

    </html>
<?php ob_flush();?>