<?php

// first check whether the user has correctly posted the form
if (isset($_POST["submit"])) {

    $studentID = strip_tags($_POST["studentID"]);
    $pwd = strip_tags($_POST["pwd"]);

    // establishing a connection to the database
    require_once "dbh-post.php";
    require_once "userhandler-post.php";
    require_once "cookiehandler-post.php";
    require_once "checker-post.php";

    // checks the submitted fields using the FormChecker class
    $formchecker = new FormChecker();

    // if the form succeeds, logs in the user
    if ($formchecker->check_login($studentID, $pwd) === true) {

        $userhandler = new UserHandler($conn);
        $userdata = $userhandler->get_user_data("userStudentID", $studentID);

        // redirecting the user to the login page if no user is found
        if ($userdata === false) {
            header("location: ../login.php?error=nouser");
            exit();
        }

        // if the user clicked the "stay logged in" checkbox, generates cookies
        if (isset($_POST["remember"]) && !$userdata["admin"]) {
            $cookiehandler = new CookieHandler($conn);
            $userdata = $userhandler->get_user_data("userStudentID", $studentID);
            $cookiehandler->bake_cookies($userdata["userID"]);
        }

        $userhandler->login($studentID, $pwd);
    }

    // else, redirects to the login page
    else {
        header("location: ../login.php");
        exit();
    }
}

// if the user has not correctly posted the form, send back to login page
else {
    header("location: ../login.php");
    exit();
}