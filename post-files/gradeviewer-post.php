<?php

if (isset(($_SESSION["userID"]))) {
    $userID = $_SESSION["userID"];

    require "../dbh-inc.php";

    $sql = "SELECT `gradeID`, `gradeName`, `gradeValue`, `gradeEC` FROM grades WHERE userID = ?";

    $stmt = mysqli_stmt_init($conn);
    
    // checking whether the sql-statement preparation succeeds
    if (mysqli_stmt_prepare($stmt, $sql) !== true) {
        exit();
    }

    // binding the paramaters to the sql-statement and executing it
    mysqli_stmt_bind_param($stmt, "i", $userID);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    // returning the results as table rows
    while ($data = mysqli_fetch_array($resultData)) {
        $ID = htmlspecialchars($data['gradeID']);
        $name = htmlspecialchars($data['gradeName']);
        $value = htmlspecialchars($data['gradeValue']);
        $ec = htmlspecialchars($data['gradeEC']);

        $button = "<span class='delete-button' id='$ID'>Delete</span>";
        echo ("<tr id='$ID'><td>" . $name . "</td><td>" . $value . "</td><td>" . $ec . "</td><td>" . $button . "</td></tr>");
    }
    mysqli_stmt_close($stmt);
    
}