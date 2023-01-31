<?php
session_start();

if (isset($_POST["logout"]) && !empty($_SESSION["userID"])) {

    include_once "dbh-post.php";
    include_once "cookiehandler-post.php";

    // removing the cookies
    $cookiehandler = new CookieHandler($conn);
    $cookiehandler->eat_cookies($_SESSION["userID"]);

    // ending the session
    session_destroy();
    header("location: ../login.php");
}
else {
    header("location: ../overview.php");
}