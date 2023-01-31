<?php

/**
 *  A class for handling the generation, information retrieval 
 *  and destruction for a cookies.
 *  Takes a connection to the database as parameter.
 *  
 *  Usage: CookieHandler(<connection>)
 *  ...
 *
 *  Properties:
 *  - "conn": An object representing the connection to the database
 *
 *  Methods:
 *  - get_cookie_data($userID) -> Array | false
 *      Gets cookie data based on the usersID.
 *      Returns an associative array of the data, or "false" if no data exists.
 *  - bake_cookies($userID) -> None
 *      Generates cookies for the user, using a cryptographically secure
 *      string generator and saves them in the database.
 *  - eat_cookies($userID) -> bool
 *      Provided a userID, it will remove the users cookies.
 *      Returning "true" upon success, "false" upon failure.
 */
class CookieHandler
{
    // refer to database connection
    private $conn;

    // instantiate object with database connection
    public function __construct($conn)
    {
        $this->conn = $conn;
    }


    public function get_cookie_data($userID) {
        // initialising and preparing the sql-statement, to prevent sql-injections
        $sql = "SELECT * FROM cookies WHERE userID = ?;";
        $stmt = mysqli_stmt_init($this->conn);
        
        // checking whether the sql-statement preparation succeeds
        if (mysqli_stmt_prepare($stmt, $sql) !== true) {
            return false;
        }

        // binding the paramaters to the sql-statement and executing it
        mysqli_stmt_bind_param($stmt, "i", $userID);
        mysqli_stmt_execute($stmt);

        // returning the results in the form of an associative array
        $resultData = mysqli_stmt_get_result($stmt);
        if ($data = mysqli_fetch_assoc($resultData)) {
            mysqli_stmt_close($stmt);
            return $data;
        }
        else {
            mysqli_stmt_close($stmt);
            return false;
        }
    }


    public function bake_cookies($userID) {

        // set standard cookie expiration time to 1 week (86400 = 1 day)
        $cookieExpDate = time() + (86400 * 7);

        setcookie("userID", $userID, $cookieExpDate, '/');
        
        // generating a key using a cryptographically secure generator
        $random_key = bin2hex(random_bytes(10));
        setcookie("random_key", $random_key, $cookieExpDate, '/');

        // hashing the key for storage in the database
        $random_key_hash = password_hash($random_key, PASSWORD_DEFAULT);
        
        // if a cookie already exists, deletes it
        $this->eat_cookies($userID);


        // initialising and preparing the sql-statement, to prevent sql-injections
        $sql = "INSERT INTO cookies (cookieKey, cookieExpDate, userID) VALUES (?, ?, ?);";
        $stmt = mysqli_stmt_init($this->conn);

        // checking whether the sql-statement preparation succeeds
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            exit();
        }

        // binding the paramaters to the sql-statement and executing it
        mysqli_stmt_bind_param($stmt, "sii", $random_key_hash, $cookieExpDate, $userID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }


    public function eat_cookies($userID) {
        
        // initialising and preparing the sql-statement, to prevent sql-injections
        $sql = "DELETE FROM cookies WHERE userID = ?;";
        $stmt = mysqli_stmt_init($this->conn);
        
        // checking whether the sql-statement preparation succeeds
        if (mysqli_stmt_prepare($stmt, $sql) !== true) {
            return false;
        }

        // binding the paramaters to the sql-statement and executing it
        mysqli_stmt_bind_param($stmt, "i", $userID);
        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
        return true;
    }
}
