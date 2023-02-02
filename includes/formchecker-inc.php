<?php

/**
 *  A class for checking login and signup form submissions for invalid
 *  or malicious inputs.
 *  
 *  Usage: FormChecker()
 *  ...
 * 
 *  Properties:
 *  - "adress": The webpage url to which the user will be redirected.
 *
 *  Methods:
 *  - check_signup($name, $studentID, $pwd, $pwdrpt) -> None | true
 *      Checks whether the submitted signup form is valid.
 *  - check_login($studentID, $pwd) -> None | true
 *      Checks whether the submitted login form is valid.
 *  - check_edit($name, $studentID, $email, $image) -> None | true
 *      Checks whether the submitted edit form is valid.
 *  - check_changepwd($pwd, $pwdrpt) -> None | true
 *      Checks whether the submitted "change password" form is valid.
 * 
 *  - already_logged_in() -> true | None
 *      Checks whether the user is already logged in.
 *  - empty_field($fields) -> None
 *      Checks whether the form has any empty fields.
 *  - invalid_name($name) -> None
 *      Checks the submitted name consists of only letters.
 *  - invalid_id($studentID) -> None
 *      Checks whether the submitted id consists of only numbers.
 *  - invalid_email($email) -> None
 *      Checks whether the submitted email is a valid email.
 *  - invalid_image($image) -> None
 *      Checks whether the submitted image is under 2MB and it's width and
 *      height are under 500px.
 *  - pwd_match($pwd, $pwdrpt) -> None
 *      Checks whether the password and repeat password match.
 *  - pwd_strength($pwd) -> None
 *      Checks whether the users password contains at least 1 digit and
 *      is longer than 8 characters.
 *  - redirect($message) -> None
 *      Redirects the user to a page with an error message.
 */
class FormChecker {

    private $adress;
    
    public function check_signup($name, $studentID, $email, $pwd, $pwdrpt) {

        $this->adress = "signup.php";

        $this->already_logged_in();
        $this->empty_field(array($name, $studentID, $pwd, $pwdrpt));
        $this->invalid_name($name);
        $this->invalid_id($studentID);
        $this->invalid_email($email);
        $this->pwd_strength($pwd);
        $this->pwd_match($pwd, $pwdrpt);
        
        return true;
    }

    public function check_login($studentID, $pwd) {

        $this->adress = "login.php";

        $this->already_logged_in();
        $this->empty_field(array($studentID, $pwd));
        $this->invalid_id($studentID);

        return true;
    }

    public function check_edit($name, $studentID, $email, $image) {

        $this->adress = "edit.php";
        
        $this->empty_field(array($name, $studentID));
        $this->invalid_name($name);
        $this->invalid_id($studentID);
        $this->invalid_email($email);
        $this->invalid_image($image);

        return true;
    }

    public function check_changepwd($pwd, $pwdrpt) {

        $this->adress = "edit.php";
        
        $this->empty_field(array($pwd, $pwdrpt));
        $this->pwd_strength($pwd);
        $this->pwd_match($pwd, $pwdrpt);

        return true;
    }


    public function already_logged_in() {
        if (isset($_SESSION['userID'])) {
            $this->redirect("alreadylogged");
            exit();
        }
    }


    public function empty_field($fields) {
        foreach ($fields as $field) {
            if (empty($field)) {
                $this->redirect("emptyfield");
                exit();
            }
        }
    }

    public function invalid_name($name) {

        // only capital and lower letters a-z are allowed
        if (!preg_match("/^[a-zA-Z\s]*$/", $name)) {
            $this->redirect("invalidname");
            exit();
        }
    }

    public function invalid_id($studentID) {

        // only numbers between 0 and 9 inclusive are allowed
        if (!preg_match("/^[0-9]*$/", $studentID)) {
            $this->redirect("invalidid");
            exit();
        }
    }

    public function invalid_email($email) {
        if (!is_null($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->redirect("invalidemail");
            exit();
        }
    }

    public function invalid_image($image) {

        if ($image === NULL) {
            return;
        }

        $imageinfo = getimagesize($image["tmp_name"]);
        // 2MB maximum filesize
        if ($image["size"] > 2000000 || $imageinfo[0] > 500 || $imageinfo[1] > 500) {
            $this->redirect("invalidimage");
            exit();
        }
    }

    public function pwd_match($pwd, $pwdrpt) {

        // passwords must match
        if ($pwd !== $pwdrpt) {
            $this->redirect("pwdmatch");
            exit();
        }
    }

    public function pwd_strength($pwd) {
        if (strlen($pwd) < 8 || !preg_match("#[0-9]+#", $pwd) ||
            !preg_match("#[A-Z]+#", $pwd)) {
            $this->redirect("pwdstrength");
            exit();
        }
    }

    public function redirect($message) {
        $url = $this->adress . "?error=" . $message; 
        header("location: ../" . $url);
    }
}