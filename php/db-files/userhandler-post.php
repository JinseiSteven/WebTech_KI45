<?php

/**
 *  A class for handling the register and login operations for a user.
 *  Takes a connection to the database as parameter.
 *  
 *  Usage: UserHandler(<connection>)
 *  ...
 *
 *  Properties:
 *  - "conn": An object representing the connection to the database
 *
 *  Methods:
 *  - get_user_data($key, $data) -> Array | false
 *      gets user data based on their studentID.
 *      Returns an associative array of the data, or "false" if no data exists.
 *  - signup($name, $student-ID, $pwd) -> None
 *      Adds a user to the user database.
 *  - login($studentID, $pwd) -> None
 *      Logs the user in and starts a session.
 */
class UserHandler
{
    // refer to database connection
    private $conn;

    // instantiate object with database connection
    public function __construct($conn)
    {
        $this->conn = $conn;
    }


    public function get_user_data($key, $value) {

        // initialising and preparing the sql-statement, to prevent sql-injections
        $sql = "SELECT * FROM users WHERE " . $key  ." = ?;";
        $stmt = mysqli_stmt_init($this->conn);
        
        // checking whether the sql-statement preparation succeeds
        if (mysqli_stmt_prepare($stmt, $sql) !== true) {
            header("location: ../login.php?error=failedstmt");
            exit();
        }

        // binding the paramaters to the sql-statement and executing it
        mysqli_stmt_bind_param($stmt, "i", $value);
        mysqli_stmt_execute($stmt);

        // returning the results in the form of an associative array
        $resultData = mysqli_stmt_get_result($stmt);
        if ($data = mysqli_fetch_assoc($resultData)) {
            mysqli_stmt_close($stmt);
            return $data;
        }
        else {
            mysqli_stmt_close($stmt);
            return false;
        }
    }


    public function signup($name, $studentID, $pwd)
    {
        // checking whether the studentID already exists in the database
        if ($this->get_user_data("usersStudentID", $studentID) !== false) {
            header("location: ../signup.php?error=idexists");
            exit();
        }

        // initialising and preparing the sql-statement, to prevent sql-injections
        $sql = "INSERT INTO users (usersName, usersStudentID, usersPwd) VALUES (?, ?, ?);";
        $stmt = mysqli_stmt_init($this->conn);

        // checking whether the sql-statement preparation succeeds
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../signup.php?error=failedstmt");
            exit();
        }

        //hashing the password
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        // binding the paramaters to the sql-statement and executing it
        mysqli_stmt_bind_param($stmt, "sis", $name, $studentID, $hashedPwd);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // redirecting the user to the login page
        header("location: ../login.php");
        exit();
    }


    public function login($studentID, $pwd)
    {
        
        // checking whether the student-Id exists in the database
        $userdata = $this->get_user_data("usersStudentID", $studentID);

        // if not, redirecting the user to the login page with an error message
        if ($userdata === false) {
            header("location: ../login.php?error=nouser");
            exit();
        }

        // hashing the submitted password and comparing it to the valid password
        $hashedPwd = $userdata["usersPwd"];
        $checkPwd = password_verify($pwd, $hashedPwd);

        // if the passwords don't match, redirect to login page with error message
        if ($checkPwd !== true) {
            header("location: ../login.php?error=invalidpwd");
            exit();
        }

        // else, log the user in and redirect to the overview page
        else {
            session_start();
            $_SESSION["userID"] = $userdata["usersID"];
            $_SESSION["userStudentID"] = $userdata["usersStudentID"];
            $_SESSION["userName"] = $userdata["usersName"];
            header("location: ../overview.php");
            exit();
        }
    }
}
