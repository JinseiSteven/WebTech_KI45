<?php

// first check whether the user has correctly posted the form
if (isset($_POST["submit"])) {
    $name = strip_tags($_POST["name"] . " " . $_POST["surname"]);
    $studentID = strip_tags($_POST["studentID"]);
    $pwd = strip_tags($_POST["pwd"]);
    $pwdrpt = strip_tags($_POST["pwdrpt"]);

    // establishing a connection to the database
    require_once "dbh-post.php";
    require_once "userhandler-post.php";
    require_once "checker-post.php";

    // checks the submitted fields using the FormChecker class
    $formchecker = new FormChecker();

    // if the form succeeds, logs in the user
    if ($formchecker->check_signup($name, $studentID, $pwd, $pwdrpt)) {

        $userhandler = new UserHandler($conn);
        $userhandler->signup($name, $studentID, $pwd);
    }

    // else, redirects to the login page
    else {
        header("location: ../signup.php");
        exit();
    }

}

// if the user has not correctly posted the form, send back to signup page
else {
    header("location: ../signup.php");
}
