<?php ob_start();

session_start();
//store the information from the post into local variables
$lap1minutes = $_POST['lap1Minutes'];
$lap1seconds = $_POST['lap1seconds'];
$lap2minutes = $_POST['lap2Minutes'];
$lap2seconds = $_POST['lap2seconds'];

$safeToSave = true;
$userId = $_SESSION['userId'];

//validate the inputs prior to saving - this is called server side validation
if (($lap1minutes < 0) && ($lap2minutes < 0)){
    echo 'Minutes must be greater than or equal to 0';
    $safeToSave=false;
}

if ($lap1minutes == "")
    $lap1minutes = 0;

if ($lap2minutes == "")
    $lap2minutes = 0;

if (($lap1seconds <= 0 || $lap1seconds >= 60) || ($lap1seconds <= 0 || $lap1seconds >= 60)){
    echo 'Seconds must be greater than 0 and less than 60';
    $safeToSave=false;
}

if ($safeToSave){
    include_once('db.php');        //connects to the database
    $timeForRun = '0:'.$minutes.':'.$seconds;

    $sql = "INSERT INTO skierTimes (skierID, eightHundredMeterTime) VALUES (:userId, :timeForRun)";

    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':userId', $userId, PDO::PARAM_INT);
    $cmd->bindParam(':timeForRun', $timeForRun, PDO::PARAM_STR);
    $cmd->execute();
   // header('location:800mResults.php');
}
ob_flush();




