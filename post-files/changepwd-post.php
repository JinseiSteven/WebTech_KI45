<?php

// first check whether the user has correctly posted the form
if (isset($_POST["submit"])) {
    $pwd = strip_tags($_POST["pwd"]);
    $newpwd = strip_tags($_POST["newpwd"]);
    $newpwdrpt = strip_tags($_POST["newpwdrpt"]);

    // establishing a connection to the database
    require_once "../../dbh-inc.php";
    require_once "../includes/userhandler-inc.php";
    require_once "../includes/formchecker-inc.php";
    require_once "../../csrf-inc.php";

    // first we check the csrf-token to stop malicious post requests
    if (!isset($_POST["csrf_token"]) || !validate_csrf($_POST["csrf_token"])) {
        header("location: ../edit.php?error=csrferror");
        exit();
    }

    // checks the submitted fields using the FormChecker class
    $formchecker = new FormChecker();

    // if the form succeeds, calls the change password function
    if ($formchecker->check_changepwd($newpwd, $newpwdrpt)) {

        $userhandler = new UserHandler($conn);
        $userhandler->change_pwd($pwd, $newpwd, $newpwdrpt);
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
