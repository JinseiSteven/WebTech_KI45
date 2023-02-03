<?php 

    if (isset($_POST["gradeID"])) {
        $gradeID = intval($_POST["gradeID"]);

        require_once "../../dbh-inc.php";
        require_once "../../csrf-inc.php";

        // first we check the csrf-token to stop malicious post requests
        if (!isset($_POST["csrf"]) || !validate_csrf($_POST["csrf"])) {
            echo 'ERROR: invalid csrf-token';
            exit();
        }
        
        $sql = "DELETE FROM grades WHERE gradeID = ?;";
        $stmt = mysqli_stmt_init($conn);

        // checking whether the sql-statement preparation succeeds
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'ERROR: sqli-statement prepare failure';
            exit();
        }

        // binding the paramaters to the sql-statement and executing it
        mysqli_stmt_bind_param($stmt, "i", $gradeID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        echo 'success';
        exit();
    }

    echo 'ERROR: gradeID not set';
    exit();
?>