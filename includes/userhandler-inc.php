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
 *  - signup($name, $studentID, $pwd) -> None
 *      Adds a user to the user database.
 *  - login($studentID, $pwd) -> None
 *      Logs the user in and starts a session.
 *  - edit($userID, $name, $studentID, $email, $imagepath) -> None
 *      Updates the data of a user in the database.
 */
class UserHandler
{
    // refer to database connection
    private $conn;

    // instantiate object with database connection
    public function __construct($conn) {
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


    public function signup($name, $studentID, $email, $pwd) {

        // initialising and preparing the sql-statement, to prevent sql-injections
        $sql = "INSERT INTO users (userName, userStudentID, userEmail, userPwd) VALUES (?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($this->conn);

        // checking whether the sql-statement preparation succeeds
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../signup.php?error=failedstmt");
            exit();
        }

        //hashing the password
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        // binding the paramaters to the sql-statement and executing it
        mysqli_stmt_bind_param($stmt, "siss", $name, $studentID, $email, $hashedPwd);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // redirecting the user to the login page
        header("location: ../login.php");
        exit();
    }


    public function login($studentID, $pwd) {
        
        // getting the userd-data from the database
        $userdata = $this->get_user_data("userStudentID", $studentID);

        // hashing the submitted password and comparing it to the valid password
        $hashedPwd = $userdata["userPwd"];
        $checkPwd = password_verify($pwd, $hashedPwd);

        // if the passwords don't match, redirect to login page with error message
        if ($checkPwd !== true) {
            header("location: ../login.php?error=invalidpwd");
            exit();
        }

        // else, log the user in and redirect to the overview page
        session_start();
        $_SESSION["userID"] = $userdata["userID"];
        $_SESSION["userStudentID"] = $userdata["userStudentID"];
        $_SESSION["userName"] = $userdata["userName"];
        $_SESSION['userEmail'] = $userdata["userEmail"];
        $_SESSION['userImgPath'] = $userdata["userImgPath"];
        $_SESSION["admin"] = $userdata["admin"];

        header("location: ../index.php");
        exit();
    }


    public function edit($userID, $name, $studentID, $email, $imagepath) {

        // if no new image has been submitted, keep old image
        if ($imagepath === NULL) {
            $userdata = $this->get_user_data("userID", $userID);
            $imagepath = $userdata["userImgPath"];
        }

        // initialising and preparing the sql-statement, to prevent sql-injections
        $sql = "UPDATE users SET userName = ?, userStudentID = ?, 
                                 userEmail = ?, userImgPath = ?
                             WHERE userID = ?;";
        $stmt = mysqli_stmt_init($this->conn);

        // checking whether the sql-statement preparation succeeds
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../edit.php?error=failedstmt");
            exit();
        }

        // binding the paramaters to the sql-statement and executing it
        mysqli_stmt_bind_param($stmt, "sissi", $name, $studentID, $email, $imagepath, $userID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        session_start();
        // changes the current session details
        $_SESSION["userStudentID"] = $studentID;
        $_SESSION["userName"] = $name;
        $_SESSION['userEmail'] = $email;
        $_SESSION['userImgPath'] = $imagepath;

        // redirecting the user to the overview page
        header("location: ../index.php");
        exit();
    }

    public function change_pwd($pwd, $newpwd, $newpwdrpt) {
        session_start();
        $userdata = $this->get_user_data("userID", $_SESSION["userID"]);

        // hashing the submitted password and comparing it to the valid password
        $hashedPwd = $userdata["userPwd"];
        $checkPwd = password_verify($pwd, $hashedPwd);

        if ($checkPwd !== true) {
            header("location: ../edit.php?error=invalidpwd");
            exit();
        }
        
        // initialising and preparing the sql-statement, to prevent sql-injections
        $sql = "UPDATE users SET userPwd = ? WHERE userID = ?;";
        $stmt = mysqli_stmt_init($this->conn);

        // checking whether the sql-statement preparation succeeds
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../edit.php?error=failedstmt");
            exit();
        }

        //hashing the password
        $newhashedPwd = password_hash($newpwd, PASSWORD_DEFAULT);

        // binding the paramaters to the sql-statement and executing it
        mysqli_stmt_bind_param($stmt, "si", $newhashedPwd, $_SESSION["userID"]);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // redirecting the user to the overview page
        header("location: ../index.php");
        exit();
    }
}
