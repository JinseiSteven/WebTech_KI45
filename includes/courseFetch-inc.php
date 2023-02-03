<?php

function getCourses($userID) {

    require "../dbh-inc.php";

    // query to select all course-ids the user is in a class for
    $usercourses = "SELECT classes.courseID FROM classes
                    JOIN userclasses ON userclasses.classID = classes.classID 
                    JOIN users ON users.userID = userclasses.userID 
                    WHERE users.userID = ?";

    // query to get all course names, linked to the course IDs
    $sql = "SELECT courses.courseName FROM courses WHERE courses.courseID IN ($usercourses)";

    $stmt = mysqli_stmt_init($conn);
    
    // checking whether the sql-statement preparation succeeds
    if (mysqli_stmt_prepare($stmt, $sql) !== true) {
        exit();
    }

    // binding the paramaters to the sql-statement and executing it
    mysqli_stmt_bind_param($stmt, "i", $userID);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    // appending all results to an array and returning it
    $courses = array();
    while ($data = mysqli_fetch_array($resultData)) {
        $courses.array_push($data["courseName"]);
    }

    return $courses;
}
