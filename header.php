<!DOCTYPE html>

<html lang="en">
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;1,400&display=swap" rel="stylesheet">
        <title>BetterNose</title>
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <div class="navbar">
            <ul>
                <li id="icon"><a href="index.php"><img src="betternoselogo.png" alt="Logo" height="45" width="264"></a></li>
                <li><a href="timetable.php">TimeTable</a></li>
                <li><a href="scheduler.php">Scheduler</a></li>

                <li id="account">
                    <div class="profile" onclick="openMenu();">
                        <img src="userimage.svg" alt="userimage" height="50" width="50">
                    </div>

                    <div class="menu">
                        <h3>
                            User Account
                        </h3>
                        <ul>
                            <li>
                                <a href="#">My Profile</a>
                            </li>
                            <li>
                                <a href="#">Edit Account</a>
                            </li>
                            <li>
                                <a href="#">Logout</a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
        
        <div class="content">
