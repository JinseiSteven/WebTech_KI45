<?php

// $serverName = "webtech-ki45";
// $dbUsername = "dblogin";
// $dbPassword = "XY4D)FN2]AeIgV)o";
// $dbName = "DataNoseDB";

$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "DataNoseDB";

// establishing a connection to the database
$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

// if the connection failed, show error message
if (!$conn) {
    die("connection failed: " . mysqli_connect_error());
}