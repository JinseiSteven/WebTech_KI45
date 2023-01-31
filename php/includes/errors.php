<?php

$error_dict = array("alreadylogged"=>"You are already logged in!", 
                    "emptyfield"=>"Please fill in all fields.", 
                    "invalidname"=>"That name is invalid, please use alpabetical characters.",
                    "invalidid"=>"That id is invalid, please use numbers only.",
                    "pwdmatch"=>"The entered passwords don't match.",
                    "failedstmt"=>"Due to unknown reasons the request has failed.",
                    "idexists"=>"A user with that id exists already.",
                    "nouser"=>"No user with that id exist.",
                    "invalidpwd"=>"Invalid Password.",
                    "pwdstrength"=>"Password must be longer than 8 characters and must contain at least one digit",
                    "invalidemail"=>"That email is invalid");

if (isset($_GET["error"])) {
    echo "<div class='alert'> 
        <p> <strong>Error</strong>: " . $error_dict[$_GET["error"]] . "</p>
        <span class='closebutton' onclick='this.parentElement.style.display=\"none\";'>&times;</span> 
    </div>";
}