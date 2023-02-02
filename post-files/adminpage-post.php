<?php

if ($_SESSION["admin"]) {

    require "includes/dbh-inc.php";

    $sql = "SELECT `userID`, `userName`, `userStudentID`, `userEmail`, `admin` FROM users";

    $stmt = mysqli_stmt_init($conn);
    
    // checking whether the sql-statement preparation succeeds
    if (mysqli_stmt_prepare($stmt, $sql) !== true) {
        header("location: ../overview.php?error=failedstmt");
        exit();
    }

    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    while ($data = mysqli_fetch_array($resultData)) {
        $ID = htmlspecialchars($data['userID']);
        $name = htmlspecialchars($data['userName']);
        $studentID = htmlspecialchars($data['userStudentID']);
        $email = htmlspecialchars($data['userEmail']);
        $admin = htmlspecialchars($data['admin']);

        $checkbox = "<input type='checkbox' name='$ID' value=''>";
        echo ("<tr><td>" . $ID . "</td><td>" . $name . "</td><td>" . $studentID .  "</td><td>" . $email .  "</td><td>" . $admin . "</td><td>" . $checkbox . "</td></tr>");
    }
    mysqli_stmt_close($stmt);
    
}
else {

}