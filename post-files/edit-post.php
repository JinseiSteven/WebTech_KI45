<?php

// first check whether the user has correctly posted the form
if (isset($_POST["submit"])) {
    $name = strip_tags($_POST["name"] . " " . $_POST["surname"]);
    $studentID = strip_tags($_POST["studentID"]);
    $email = strip_tags($_POST["email"]);


    // establishing a connection to the database
    require_once "../includes/dbh-inc.php";
    require_once "../includes/userhandler-inc.php";
    require_once "../includes/formchecker-inc.php";
    require_once "../includes/csrf-inc.php";

    // first we check the csrf-token to stop malicious post requests
    if (!isset($_POST["csrf_token"]) || !validate_csrf($_POST["csrf_token"])) {
        header("location: ../edit.php?error=csrferror");
        exit();
    }

    // checks whether the current user has data in the database
    $userhandler = new UserHandler($conn);

    session_start();
    if (!isset($_SESSION["userID"]) || $userhandler->get_user_data("userID", $_SESSION["userID"]) === false) {
        header("location: ../login.php");
        exit();
    }

    // checks the submitted fields using the FormChecker class
    $formchecker = new FormChecker();

    // if the check succeeds, updates the users data
    if ($formchecker->check_edit($name, $studentID, $email, $image) === true) {
    
        // before adding any new data, check if the studentID is already taken
        if ($userhandler->get_user_data("userStudentID", $studentID) !== false &&
            $studentID != $_SESSION["userStudentID"]) {
            header("location: ../edit.php?error=idexists");
            exit();
        }

        // if an image has been set, saves it to the userimg folder
        if (isset($_FILES['profileimage']) && $_FILES['profileimage']['size'] > 0){
            $extension = pathinfo($_FILES["profileimage"]["name"], PATHINFO_EXTENSION);
            $img_file = $_FILES["profileimage"]["tmp_name"];

            // moves the file to the userimg folder, filename is linked to the userID
            $imgpath = "assets/userimg/" . $_SESSION["userID"] . "." . $extension;
            move_uploaded_file($img_file, "../" . $imgpath);
        }

        $userhandler->edit($_SESSION["userID"], $name, $studentID, $email, $imgpath);
    }

    // else, redirects to the edit page (also in case an error occurs)
    else {
        header("location: ../edit.php");
        exit();
    }
}

// if the user has not correctly posted the form, send back to edit page
else {
    header("location: ../edit.php");
    exit();
}
