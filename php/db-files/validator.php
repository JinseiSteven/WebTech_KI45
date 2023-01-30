<?php
require_once "dbh-post.php";
require_once "cookiehandler-post.php";
require_once "userhandler-post.php";

/**
 * Function for validating whether the user is logged in, or has active and
 * valid cookies.
 * Returns "true" if the user the user is logged in, "false" if not.
 */ 
function validate_login() {

    global $conn;

    // checks if a session already exists
    if (!empty($_SESSION["userID"])) {
        return true;
    }

    // checks whether any of the cookies are empty
    else if (empty($_COOKIE["userID"]) || empty($_COOKIE["random_key"])) {
        return false;
    }
    
    // gets the cookie data from the database
    $cookiehandler = new CookieHandler($conn);
    $cookiedata = $cookiehandler->get_cookie_data($_COOKIE["userID"]);

    // returning false if no data can be found
    if ($cookiedata === false) {
        return false;
    }

    // validates random cookie key with database
    if (!password_verify($_COOKIE["random_key"],
        $cookiedata["cookiesKey"])) {
        return false;
    }

    // validates whether the cookie has expired
    if ($cookiedata["cookiesExpDate"] >= time()) {

        $userhandler = new UserHandler($conn);
        $userdata = $userhandler->get_user_data("usersID", $_COOKIE["userID"]);

        $_SESSION["userID"] = $userdata["usersID"];
        $_SESSION["userStudentID"] = $userdata["usersStudentID"];
        $_SESSION["userName"] = $userdata["usersName"];
        return true;
    }

    // if the cookie has expired, clear it
    else {
        $cookiehandler->eat_cookies($cookiedata["userID"]);
        return false;
    }
}

$loggedin = validate_login();

// sending users to the login page from pages where login is needed
$current_page = basename($_SERVER["PHP_SELF"]); 
if ($current_page == "overview.php" && !$loggedin) {
    header("location: login.php");
}