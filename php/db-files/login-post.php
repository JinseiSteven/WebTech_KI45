<?php

// first check whether the user has correctly posted the form
if (isset($_POST["submit"])) {

    $studentID = $_POST["studentID"];
    $pwd = $_POST["pwd"];

    // establishing a connection to the database
    require_once "dbh-post.php";
    require_once "userhandler-post.php";
    require_once "checker-post.php";

    // checks the submitted fields using the FormChecker class
    $formchecker = new FormChecker();

    // if the form succeeds, logs in the user
    if ($formchecker->check_login($studentID, $pwd)) {

        $userhandler = new UserHandler($conn);
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