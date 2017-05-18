<?php ob_start();

//save the post info to variables
$email = $_POST['email'];
$password = $_POST['password'];

//connect to the db
require_once('db.php');

//create the sql to verify if the user is correct
$sql = "SELECT userId, password, initials, admin FROM skiUsers WHERE email = :email";

//bind the commands
$cmd = $conn->prepare($sql);
$cmd->bindParam(':email', $email, PDO::PARAM_STR, 50);

//execute the commands
$cmd->execute();
$user = $cmd->fetch();

if (password_verify($password, $user['password'])){
    session_start();
    $_SESSION['userId'] = $user['userId'];
    $_SESSION['email'] = $email;
    $_SESSION['initials'] = $user['initials'];
    $_SESSION['admin'] = $user['admin'];

    header('location:800mResults.php');
}
else
{
    header('location:login.php?invalid=true');
    exit();
}

$conn = null;

ob_flush();

?>

