<?php
session_start();

if (isset($_POST["logout"]) && !empty($_SESSION["userID"])) {

    require_once "../../dbh-inc.php";
    require_once "../includes/cookiehandler-inc.php";

    // removing the cookies
    $cookiehandler = new CookieHandler($conn);
    $cookiehandler->eat_cookies($_SESSION["userID"]);

    // ending the session
    session_destroy();
    header("location: ../login.php");
}
else {
    header("location: ../index.php");
}