<?php
ob_start();  // This is output buffer start.  It depends on the servers INI file, but on many, you will receive an error that says
// Warning: session_start(): Cannot send session cache limiter - headers already sent (output started at /home/gcjwright/gcjwright.computerstudi.es/phpexperiment/lesson5/header.php:5) in /home/gcjwright/gcjwright.computerst
// This is because We are trying to pass in the $pageTitle information into the header.php file

$pageTitle = 'Training Results';
require_once('header.php'); ?>


</head>
<body>
<main class="container">
    <section class="jumbotron">
        <h1>Welcome to the Ski Tracker</h1>
        <p>We're building this app right now!</p>
    </section>
</main>



<?php
// you can get an error if you use require instead of include
require_once('anchored-footer.php');
ob_flush();     //this will "flush" the output buffer, which in other terms means that it will now take all the compiled HTML and the server will send tha to
//the requesting browser.
?>

