<?php

// only an admin can view this page
if (isset(($_SESSION["admin"])) && $_SESSION["admin"]) {

    require "../dbh-inc.php";

    $sql = "SELECT `userID`, `userName`, `userStudentID`, `userEmail`, `admin` FROM users";

    $stmt = mysqli_stmt_init($conn);
    
    // checking whether the sql-statement preparation succeeds
    if (mysqli_stmt_prepare($stmt, $sql) !== true) {
        header("location: ../index.php?error=failedstmt");
        exit();
    }

    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    // returning the results as table rows
    while ($data = mysqli_fetch_array($resultData)) {
        $ID = htmlspecialchars($data['userID']);
        $name = htmlspecialchars($data['userName']);
        $studentID = htmlspecialchars($data['userStudentID']);
        $email = htmlspecialchars($data['userEmail']);
        $admin = htmlspecialchars($data['admin']);

        // giving the admin rows the admin class
        $id = "";
        if ($admin) {
            $id = "admin-row";
        }

        $deletebutton = "<span class='delete-button' id='$ID'>Delete</span>";
        $adminbutton = "<div class='admin-button' id='$ID'>Toggle Admin</div>";
        $buttons = $deletebutton . "</td><td>" . $adminbutton;
        echo ("<tr id='$id'><td>" . $name . "</td><td>" . $studentID .  "</td><td>" . $email .  "</td><td>" . $admin . "</td><td>" . $buttons . "</td></tr>");
    }
    mysqli_stmt_close($stmt);
    
}