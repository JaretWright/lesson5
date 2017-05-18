<?php ob_start();

//access the current session in order to delete it
session_start();

//terminate the user session
session_destroy();

//redirect to the login page
header('location:default.php');
ob_flush();

?>