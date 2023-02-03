<?php 
    if (isset($_POST["userID"])) {
        $userID = intval($_POST["userID"]);

        require_once "../../dbh-inc.php";
        require_once "../../csrf-inc.php";

        // first we check the csrf-token to stop malicious post requests
        if (!isset($_POST["csrf"]) || !validate_csrf($_POST["csrf"])) {
            echo 'ERROR: invalid csrf-token';
            exit();
        }

        $sql = "UPDATE users SET `admin` = 
                CASE WHEN `admin` = 1 THEN 0
                ELSE 1 END
                WHERE userID = ?;";
        $stmt = mysqli_stmt_init($conn);

        // checking whether the sql-statement preparation succeeds
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'ERROR: sqli-statement prepare failure';
            exit();
        }

        // binding the paramaters to the sql-statement and executing it
        mysqli_stmt_bind_param($stmt, "i", $userID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        echo 'success';
        exit();
    }

    echo 'ERROR: userID not set';
    exit();
?>