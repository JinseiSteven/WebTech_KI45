<?php
include_once 'layout-head.php';
include_once 'includes/gradeCalc-inc.php';

/* Content for the page below */

list($EC, $GPA) = grade_info($_SESSION["userID"]);
?>

<div class="flex--row content-wrapper dash-wrapper active">
    <div class="flex--column wrapper--left">
        <div class="flex--column section-header ">
            <span class="header">Hi,
                <?php echo $_SESSION["userName"] ?> 👋
            </span>
            <span class="subheader">Welcome back to your personal calendar!</span>
        </div>
        <div class="flex--row profile--wrapper">
            <div class="flex--row profile-data-box">
                <div class="picture-box">
                    <img src="<?php echo $_SESSION["userImgPath"] ?>" class="profile-picture" alt="profile picture">
                </div>
                <div class="flex--column profile-data">
                    <span class="profile-data--name">
                        <?php echo $_SESSION['userName'] ?>
                    </span>
                    <span class="profile-data--email">
                        <?php if (isset($_SESSION['userEmail'])) {
                            echo $_SESSION['userEmail'];
                        } ?>
                    </span>
                    <span class="profile-data--ec"><?php echo $EC ?> EC</span>
                </div>
            </div>
            <div class="flex--column avg-gpa-box">
                <span class="box--header">Average GPA</span>
                <div class="avg-gpa-box--gpa">
                    <span>
                        <?php echo $GPA ?>
                    </span>
                </div>
            </div>
            <div class="flex--column avg-gpa-box">
                <span class="box--header">Random math fact</span>
                <blockquote>
                    <span id="quote"><?php
                        $quote=file_get_contents("http://numbersapi.com/random/math");
                        echo $quote; ?></span>
                </blockquote>
            </div>
        </div>
        <div class="courses--box">
            <span class="box--header">Courses</span>
            <div class="flex--row courses">
                <div class="flex--column course">
                    <span class="course--header">Academische Vaardigheden KI jaar 1</span>
                    <img src="./assets/img/practical-abilities-ki.png" alt="course image">
                    <span>50821PAV0Y</span>
                    <span>162 students, enrolled</span>
                    <div class="course-status">
                        Passed
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
include_once 'layout-foot.php';
?>