<?php
ob_start();

// ensure the user has been verified
session_start();

if (empty($_SESSION['userId'])){
    header('location:login.php');
    exit();
}

$pageTitle = '800m Times';
require_once('header.php')
?>


</head>

<body>
<main class="container">
    <h1>Results</h1>

    <?php
    //query the database to get the existing records returned
    include_once('db.php');
    $sql_skierID = "SELECT userId FROM skiUsers";
    $cmd = $conn->prepare($sql_skierID);
    $cmd->execute();
    $listOfSkierIDs = $cmd->fetchAll();

    foreach ($listOfSkierIDs as $skier)
    {
        $sql = "SELECT userId, email, initials, recordDate, lap1, lap2, addTime(lap1, lap2) AS totalTime 
                FROM skiUsers LEFT JOIN skierTimes ON skiUsers.userId = skierTimes.skierID
                WHERE userID = :skierID";

        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':skierID', $skier['userId'], PDO::PARAM_INT);
        $cmd->execute();
        $allTimes = $cmd->fetchAll();

        if (!empty($allTimes))
        {
            echo '<table class="table table-bordered table-striped table-hover"><tr><th>Date</th><th>Lap 1</th><th>Lap 2</th><th>Total Time</th>';
            echo '    <caption class="" id="message">800m times for '.$allTimes[0]['initials'].'</caption>';
            foreach ($allTimes as $runTime)
            {
                echo '<tr>
                    <td>'.$runTime['recordDate'].'</td>
                    <td>'.$runTime['lap1'].'</td>
                    <td>'.$runTime['lap2'].'</td>
                    <td>'.$runTime['totalTime'].'</td>
                  </tr>';
            }
            echo '</table>';
        }

    }
    ?>

</main>
</body>


<?php
// you can get an error if you use require instead of include
require_once('footer.php');
?>
<?php ob_flush()?>
