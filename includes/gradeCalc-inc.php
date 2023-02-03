<?php

/* Function for getting the users grade data and calculating their average GPA */
function grade_info($userID) {

    require "../dbh-inc.php";

    // getting all user grades from the database
    $sql = "SELECT `gradeValue`, `gradeEC` FROM grades WHERE userID = ?";

    $stmt = mysqli_stmt_init($conn);
    
    // checking whether the sql-statement preparation succeeds
    if (mysqli_stmt_prepare($stmt, $sql) !== true) {
        exit();
    }

    // binding the paramaters to the sql-statement and executing it
    mysqli_stmt_bind_param($stmt, "i", $userID);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    $tot_EC = 0;
    $GPA = 0;
    $tot_grade_amount = 0.0;
    $tot_grades = 0;

    // add all the ECs together and calculate the average grade value
    while ($data = mysqli_fetch_array($resultData)) {
        $tot_grade_amount += $data["gradeValue"];
        $tot_EC += $data["gradeEC"];
        $tot_grades++;
    }

    // rounding the GPA to 2 decimals
    if ($tot_grades > 0){
        $average = $tot_grade_amount / $tot_grades;
        $GPA = round($average, 2);
    }

    return [$tot_EC, $GPA];
}
