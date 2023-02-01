<?php

$error_dict = array(
    "alreadylogged" => "You are already logged in!",
    "emptyfield" => "Please fill in all fields.",
    "noconnection" => "Could not connect to the database.",
    "invalidname" => "Invalid name, please use alphabetical characters.",
    "invalidid" => "Invalid id, please use numbers only.",
    "pwdmatch" => "The entered passwords don't match.",
    "failedstmt" => "Due to unknown reasons the request has failed.",
    "idexists" => "A user with that id exists already.",
    "nouser" => "User not registered, please register first.",
    "invalidpwd" => "Invalid Password.",
    "pwdstrength" => "Password must be longer than 8 characters and must contain at least one digit",
    "invalidemail" => " Invalid email, please check your email address.",
    "invalidimage" => "The image must be below 5MB and under 500px by 500px",
    "csrferror" => "Invalid CSRF-Token. Please try again later."
);

if (isset($_GET["error"]) && array_key_exists($_GET["error"], $error_dict)) {
    echo "<div class='alert'> 
        <img src='./assets/img/error-icon.png'>
        <p>    " . $error_dict[$_GET["error"]] . "</p>
        <span class='closebutton' onclick='this.parentElement.style.display=\"none\";'>&times;</span> 
    </div>";
}