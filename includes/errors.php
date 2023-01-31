<?php

$error_dict = array(
    "alreadylogged" => "You are already logged in!",
    "emptyfield" => "Please fill in all fields.",
    "invalidname" => "Invalid name, please use alphabetical characters.",
    "invalidid" => "Invalid id, please use numbers only.",
    "pwdmatch" => "The entered passwords don't match.",
    "failedstmt" => "Due to unknown reasons the request has failed.",
    "idexists" => "A user with that id exists already.",
    "nouser" => "User not registered, please register first.",
    "invalidpwd" => "Invalid Password.",
    "pwdstrength" => "Password must be longer than 8 characters and must contain at least one digit",
    "invalidemail" => " Invalid email, please check your email address.",
);

if (isset($_GET["error"])) {
    echo "<div class='alert'> 
        <img src='./assets/img/error-icon.png'>
        <p>    " . $error_dict[$_GET["error"]] . "</p>
        <span class='closebutton' onclick='this.parentElement.style.display=\"none\";'>&times;</span> 
    </div>";
}