<?php

/**
 * Function for validating whether the user is logged in, or has active and
 * valid cookies.
 * Returns "true" if the user the user is logged in, "false" if not.
 */ 
function validate_login() {

    require "../dbh-inc.php";
    require_once "cookiehandler-inc.php";
    require_once "userhandler-inc.php";

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
        $cookiedata["cookieKey"])) {
        return false;
    }

    // validates whether the cookie has expired
    if ($cookiedata["cookieExpDate"] >= time()) {

        $userhandler = new UserHandler($conn);
        $userdata = $userhandler->get_user_data("userID", $_COOKIE["userID"]);

        $_SESSION["userID"] = $userdata["userID"];
        $_SESSION["userStudentID"] = $userdata["userStudentID"];
        $_SESSION["userName"] = $userdata["userName"];
        $_SESSION['userEmail'] = $userdata["userEmail"];
        $_SESSION['userImgPath'] = $userdata["userImgPath"];
        $_SESSION["admin"] = $userdata["admin"];
        return true;
    }

    // if the cookie has expired, clear it
    else {
        $cookiehandler->eat_cookies($cookiedata["userID"]);
        return false;
    }
}


$loggedin_pages = array("index.php", "edit.php");
// sending users to the login page from pages where login is needed
$current_page = basename($_SERVER["PHP_SELF"]);
if (in_array($current_page, $loggedin_pages) && !validate_login()) {
    header("location: login.php");
}

if ($current_page === "admin.php" && (!isset($_SESSION["admin"]) || !$_SESSION["admin"])) {
    header("location: index.php");
}