<?php

// first check whether the user has correctly posted the form
if (isset($_POST["submit"])) {
    $name = strip_tags($_POST["name"] . " " . $_POST["surname"]);
    $studentID = strip_tags($_POST["studentID"]);
    $pwd = strip_tags($_POST["pwd"]);
    $pwdrpt = strip_tags($_POST["pwdrpt"]);

    // email is not neccessary, so set to NULL if none are entered
    if (isset($_POST["email"]) && !empty($_POST["email"])){
        $email = strip_tags($_POST["email"]);
    }
    else {
        $email = NULL;
    }

    // establishing a connection to the database
    require_once "dbh-post.php";
    require_once "userhandler-post.php";
    require_once "checker-post.php";

    // checks the submitted fields using the FormChecker class
    $formchecker = new FormChecker();

    // if the form succeeds, signs up the user
    if ($formchecker->check_signup($name, $studentID, $email, $pwd, $pwdrpt) === true) {

        $userhandler = new UserHandler($conn);

        // checking whether the studentID already exists in the database
        if ($userhandler->get_user_data("userStudentID", $studentID) !== false) {
            header("location: ../signup.php?error=idexists");
            exit();
        }

        $userhandler->signup($name, $studentID, $email, $pwd);
    }

    // else, redirects to the signup page (also in case an error occurs)
    else {
        header("location: ../signup.php");
        exit();
    }

}

// if the user has not correctly posted the form, send back to signup page
else {
    header("location: ../signup.php");
}
