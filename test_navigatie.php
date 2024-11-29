<?php
session_start();
$_SESSION['test'] = 'test';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session test</title>
</head>

<body> <?php session_status();
        echo '<p>Hello world!</p>';

        print_r($_SESSION);

        ?> </body>

</html>