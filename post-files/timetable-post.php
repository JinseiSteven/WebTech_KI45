<?php

if (isset($_GET["userID"]) && isset($_GET["beginDate"]) && isset($_GET["endDate"]) &&
    $_GET["userID"] != "" && $_GET["beginDate"] != "" && $_GET["endDate"] != "" ) {

    $userID = $_GET["userID"];
    $beginDate = $_GET["beginDate"];
    $endDate = $_GET["endDate"];

    // establishing a connection to the database
    require_once "../includes/dbh-inc.php";

    // initialising and preparing the sql-statement, to prevent sql-injections
    // sql-statement for getting the users classes
    $userclasses = "SELECT classes.classID FROM classes
                    JOIN userclasses ON userclasses.classID = classes.classID 
                    JOIN users ON users.userID = userclasses.userID 
                    WHERE users.userID = ?";

    // sql-statement for getting the users seminars in the chosen timeframe
    $sql = "SELECT classes.className, seminars.seminarLocation, 
            seminars.seminarStartTime, seminars.seminarEndTime, 
            seminars.seminarDate, seminars.seminarType 
            FROM seminars
            INNER JOIN classes ON classes.classID=seminars.classID
            WHERE seminars.classID in ($userclasses) 
            AND seminars.seminarDate BETWEEN ? AND ? 
            ORDER BY seminars.seminarDate, seminars.seminarStartTime ASC;";

    $stmt = mysqli_stmt_init($conn);

    // checking whether the sql-statement preparation succeeds
    if (mysqli_stmt_prepare($stmt, $sql) !== true) {
        echo "Statement preparation failed";
        exit();
    }

    // binding the paramaters to the sql-statement and executing it
    mysqli_stmt_bind_param($stmt, "iss", $userID, $beginDate, $endDate);
    mysqli_stmt_execute($stmt);

    // returning the results in the form of an associative array
    $resultData = mysqli_stmt_get_result($stmt);

    // formatting the output so it's easily parseable
    if ($data = mysqli_fetch_assoc($resultData)) {
        echo '[' .json_encode( $data);
        while ($data = mysqli_fetch_assoc($resultData)) {
            echo ', ';
            echo json_encode($data);
        }
        echo ']';
    }

    mysqli_stmt_close($stmt);
}

// if no data specifications have been set, return none, send back to login page
else {
    echo "No data specifications set";
}