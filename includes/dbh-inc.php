<?php

$serverName = "localhost";
$dbUsername = "root";
// $dbPassword = "XY4D)FN2]AeIgV)o";
$dbPassword = "";
$dbName = "dnppdatabase";

// establishing a connection to the database
$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

// if the connection failed, show error message
if (!$conn) {
    header("location: ../overview.php?error=noconnection");
    die("connection failed: " . mysqli_connect_error());
    exit();
}