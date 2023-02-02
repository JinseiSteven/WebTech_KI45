<?php
session_start();
require_once "includes/csrf-inc.php";
include_once 'includes/validator-inc.php';
include_once 'cookie-popup.php';
?>

<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="./assets/favicon/site.webmanifest">
    <link rel="mask-icon" href="./assets/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta name="csrf_token" content="<?php echo generate_csrf() ?>">
    <title>Datanose++</title>
    <link rel="stylesheet" href="./css/globals.css">
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/content.css">
    <link rel="stylesheet" href="./css/overview.css">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/personal-timetable.css">
    <link rel="stylesheet" href="./css/cookie-popup.css">
    <link rel="stylesheet" href="./css/cross-animation.css">
    <link rel="stylesheet" href="./css/table-styling.css">
    <link rel="stylesheet" href="./css/edit.css">
    <link rel="stylesheet" href="./css/admin.css">
</head>

<body>

    <div class="flex--row body--wrapper">
        <div class="flex--column nav-bar">
            <div class="header">
                <img src="./assets/img/logo.png" alt="Datanose++">
            </div>
            <div class="section">
                <div class="header">Home</div>
                <div class="flex--column nav-bar--items ">
                    <a href="overview.php">
                        <div class="item" id="dash-wrapper">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_100_199)">
                                    <path opacity="0.4"
                                        d="M14.0756 0H17.4616C18.8638 0 20.0001 1.14585 20.0001 2.55996V5.97452C20.0001 7.38864 18.8638 8.53449 17.4616 8.53449H14.0756C12.6733 8.53449 11.5371 7.38864 11.5371 5.97452V2.55996C11.5371 1.14585 12.6733 0 14.0756 0Z"
                                        fill="#114455" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M2.53852 0H5.92449C7.32676 0 8.46301 1.14585 8.46301 2.55996V5.97452C8.46301 7.38864 7.32676 8.53449 5.92449 8.53449H2.53852C1.13626 8.53449 0 7.38864 0 5.97452V2.55996C0 1.14585 1.13626 0 2.53852 0ZM2.53852 11.4655H5.92449C7.32676 11.4655 8.46301 12.6114 8.46301 14.0255V17.44C8.46301 18.8532 7.32676 20 5.92449 20H2.53852C1.13626 20 0 18.8532 0 17.44V14.0255C0 12.6114 1.13626 11.4655 2.53852 11.4655ZM17.4615 11.4655H14.0755C12.6732 11.4655 11.537 12.6114 11.537 14.0255V17.44C11.537 18.8532 12.6732 20 14.0755 20H17.4615C18.8637 20 20 18.8532 20 17.44V14.0255C20 12.6114 18.8637 11.4655 17.4615 11.4655Z"
                                        fill="#114455" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_100_199">
                                        <rect width="20" height="20" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                            <span href="index.html">Dashboard</span>
                        </div>
                    </a>
                    <div class="section">
                        <div class="header">Options</div>
                        <div class="flex--column nav-bar--items">
                            <a href="timetable.php">
                                <div class="item" id="personal-timetable">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M5.70884 4.04395C6.35135 4.04395 6.87239 3.53731 6.87239 2.91219V1.13141C6.87239 0.506641 6.35135 0 5.70884 0C5.06596 0 4.54492 0.506641 4.54492 1.13141V2.91223C4.54492 3.53731 5.06596 4.04395 5.70884 4.04395Z"
                                            fill="#114455" />
                                        <path
                                            d="M14.2911 4.04395C14.9336 4.04395 15.4546 3.53731 15.4546 2.91219V1.13141C15.4547 0.506641 14.9336 0 14.2911 0C13.6482 0 13.1272 0.506641 13.1272 1.13141V2.91223C13.1272 3.53731 13.6482 4.04395 14.2911 4.04395Z"
                                            fill="#114455" />
                                        <path
                                            d="M17.1975 1.61328H16.4774V2.9127C16.4774 4.08523 15.4966 5.03895 14.2911 5.03895C13.0852 5.03895 12.1044 4.08523 12.1044 2.9127V1.61328H7.89557V2.9127C7.89557 4.08523 6.9148 5.03895 5.7093 5.03895C4.50349 5.03895 3.52264 4.08523 3.52264 2.9127V1.61328H2.80255C1.25479 1.61328 0 2.83336 0 4.3384V17.2754C0 18.7804 1.25483 20.0005 2.80255 20.0005H17.1975C18.7452 20.0005 20 18.7804 20 17.2754V4.3384C20 2.8334 18.7452 1.61328 17.1975 1.61328ZM17.7944 16.7969C17.7944 17.4932 17.2118 18.0598 16.4956 18.0598H3.50436C2.78825 18.0598 2.20563 17.4932 2.20563 16.7969V6.67535H17.7944L17.7944 16.7969Z"
                                            fill="#114455" />
                                        <path d="M9.4344 14.5225H7.37793V16.5221H9.4344V14.5225Z" fill="#114455" />
                                        <path d="M9.4344 11.4229H7.37793V13.4225H9.4344V11.4229Z" fill="#114455" />
                                        <path d="M6.24637 14.5225H4.18994V16.5221H6.24637V14.5225Z" fill="#114455" />
                                        <path d="M6.24637 11.4229H4.18994V13.4225H6.24637V11.4229Z" fill="#114455" />
                                        <path d="M15.8096 8.32227H13.7532V10.3219H15.8096V8.32227Z" fill="#114455" />
                                        <path d="M12.6227 8.32227H10.5659V10.3219H12.6227V8.32227Z" fill="#114455" />
                                        <path d="M12.6227 11.4229H10.5659V13.4225H12.6227V11.4229Z" fill="#114455" />
                                        <path d="M15.8096 14.5225H13.7532V16.5221H15.8096V14.5225Z" fill="#114455" />
                                        <path d="M15.8096 11.4229H13.7532V13.4225H15.8096V11.4229Z" fill="#114455" />
                                        <path d="M12.6227 14.5225H10.5659V16.5221H12.6227V14.5225Z" fill="#114455" />
                                        <path d="M9.4344 8.32227H7.37793V10.3219H9.4344V8.32227Z" fill="#114455" />
                                        <path d="M6.24637 8.32227H4.18994V10.3219H6.24637V8.32227Z" fill="#114455" />
                                    </svg>
                                    <span href="index.html">Personal timetable</span>
                                </div>
                            </a>
                            <a href="programme-list.php">
                                <div class="item" id="programme-list">
                                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_100_268)">
                                            <path
                                                d="M19.428 13.4294C19.428 13.4294 16.6946 10.6425 12.928 10.6425C9.24762 10.6425 5.60952 13.4294 5.60952 13.4294L3.56607 12.5764V15.0788C3.8881 15.1883 4.12381 15.4847 4.12381 15.8436C4.12381 16.2061 3.88333 16.5032 3.55655 16.6103L4.16071 18.2954H2.37738L2.9869 16.596C2.69405 16.4716 2.48929 16.1823 2.48929 15.8436C2.48929 15.5121 2.6881 15.23 2.97202 15.1014V12.3282L0 11.0889L13.0768 5.21924L25.0744 11.1627L19.428 13.4294ZM12.7792 12.0544C16.5685 12.0544 18.4256 14.0603 18.4256 14.0603V18.221C18.4256 18.221 16.494 19.7811 12.4821 19.7811C8.47024 19.7811 7.13274 18.221 7.13274 18.221V14.0603C7.13274 14.0603 8.98988 12.0544 12.7792 12.0544ZM12.7048 18.8895C15.331 18.8895 17.4601 18.3567 17.4601 17.7008C17.4601 17.0448 15.331 16.5121 12.7048 16.5121C10.0786 16.5121 7.95 17.0448 7.95 17.7008C7.95 18.3567 10.0786 18.8895 12.7048 18.8895Z"
                                                fill="#114455" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_100_268">
                                                <rect width="25" height="25" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span href="index.html">Programme list</span>
                                </div>
                            </a>


                        </div>
                    </div>
                </div>

            </div>
            <div class="color-mode-box">
                <label class="color-switch" for="color-checkbox">
                    <input type="checkbox" id="color-checkbox" />
                    <div class="ball-switch"></div>
                </label>
            </div>
            <div class="profile-status flex--column">



                <?php
                if (isset($_SESSION["admin"]) && $_SESSION["admin"]) {
                    echo "<span>ADMIN VIEW</span>";
                }
                if (validate_login()) {
                    echo "<form action='post-files/logout-post.php' method='post'>
                                <button class='logout-button' type='submit' name='logout'>Logout</button>
                              </form>";
                } else {
                    echo "<div class='profile-header flex--row'>
                            <img src='./assets/img/guest-icon.png' alt='profile'>
                            <span>Guest account</span>
                        </div>
                        <span id='profile-subheader'>Login to access personalized data!</span>
                        <div class='guest-login-btns flex--row'>
                            <button><a href='login.php'>Login</a></button>
                            <button><a href='signup.php'>Register</a></button>
                        </div>
                        ";
                }
                ?>

            </div>
        </div>
        <div class="flex--column content-main">