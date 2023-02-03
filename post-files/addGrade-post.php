<?php 

    if (isset($_POST["gradeName"]) && 
        isset($_POST["gradeValue"]) && 
        isset($_POST["gradeEC"])) {
        
        session_start();
        $userID = $_SESSION["userID"];
        $Name = strip_tags($_POST["gradeName"]);
        $Value = round(strip_tags($_POST["gradeValue"]), 1);
        $EC = round(strip_tags($_POST["gradeEC"]));

        require_once "../../dbh-inc.php";
        require_once "../../csrf-inc.php";

        // first we check the csrf-token to stop malicious post requests
        if (!isset($_POST["csrf"]) || !validate_csrf($_POST["csrf"])) {
            echo 'ERROR: invalid csrf-token';
            exit();
        }

        // getting the users grade data
        $sql = "INSERT INTO grades (`userID`, `gradeName`, `gradeValue`, `gradeEC`) 
                VALUES (?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);

        // checking whether the sql-statement preparation succeeds
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'ERROR: sqli-statement prepare failure';
            exit();
        }

        // binding the paramaters to the sql-statement and executing it
        mysqli_stmt_bind_param($stmt, "isdi", $userID, $Name, $Value, $EC);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        echo 'success';
        exit();
    }

    echo 'ERROR: gradeID not set';
    exit();
?>