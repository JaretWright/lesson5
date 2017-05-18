<?php ob_start();

$pageTitle = '800m Times';
require_once('header.php')
?>


</head>

<body>
<main class="container">
    <h1>Record Time</h1>
    <!-- <div class="alert alert-info" id="message">Enter your 800m time</div> -->

    <div id="stylized" class="myform">
        <form id="form" name="form" method="post" action="record-800m.php">
            <div class="form-group col-md-12">
                <label for="minutes" class="col-md-1">Lap 1</label>
                <div >
                    <label class="control-label col-md-1">Minutes:</label>
                    <input class="col-md-2" type="number" min="0" max="15" name="lap1Minutes" id="lap1Minutes"  placeholder="minutes"/>
                </div>
                <div>
                    <label class="control-label col-md-1">Seconds:</label>
                    <input class="col-md-2" type="number" min="0" max="59.99" step="0.01" name="lap1Seconds" id="lap1Seconds" placeholder="seconds"/>
                </div>
            </div>

            <div class="form-group col-md-12">
                <label for="minutes" class="col-md-1">Lap 2</label>
                <div >
                    <label class="control-label col-md-1">Minutes:</label>
                    <input class="col-md-2" type="number" min="0" max="15" name="lap2Minutes" id="lap2Minutes"  placeholder="minutes"/>
                </div>
                <div>
                    <label class="control-label col-md-1">Seconds:</label>
                    <input class="col-md-2" type="number" min="0" max="59.99" step="0.01" name="lap2Seconds" id="lap2Seconds" placeholder="seconds"/>
                </div>
            </div>
            <div class="col-sm-offset-2">
                <button class="btn btn-success btnRegister">Submit</button>
            </div>
        </form>
    </div>

    </form>
</main>
</body>

<body>
<main class="container">
    <h1>Results</h1>
    <?php
        include_once ("db.php");
        $sql = "SELECT userId, email, initials, recordDate, lap1, lap2, addTime(lap1, lap2) AS totalTime
                FROM skiUsers LEFT JOIN skierTimes ON skiUsers.userId = skierTimes.skierID
                WHERE userID = :skierID";

        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':skierID', $user, PDO::PARAM_INT);
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
    ?>
</main>

<?php
// you can get an error if you use require instead of include
$conn=null;
require_once('anchored-footer.php');
ob_flush()
?>
