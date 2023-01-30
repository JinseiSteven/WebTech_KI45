<?php
    include_once 'layout-head.php';

    /* Content for the page below */
?>

<div class="flex--row content-wrapper dash-wrapper active">
    <div class="flex--column wrapper--left">
        <div class="flex--column welcome-header">
            <span class="header">Hi, <?php echo $_SESSION['userName']?> 👋</span>
            <span class="subheader">Welcome back to your personal calendar!</span>
        </div>
        <div class="flex--row profile--wrapper">
            <div class="flex--row profile-data-box">
                <div class="picture-box">
                    <img src="../assets/img/profile-picture1.png" class="profile-picture" alt="profile picture">
                </div>
                <div class="flex--column profile-data">
                    <span class="profile-data--name"><?php echo $_SESSION['userName']?></span>
                    <span class="profile-data--email">remolovdplasse@gmail.com</span>
                    <span class="profile-data--ec">24 EC</span>
                </div>
            </div>
            <div class="flex--column avg-gpa-box">
                <span class="box--header">Average GPA</span>
                <div class="avg-gpa-box--gpa">
                    <span>
                        7.56
                    </span>
                </div>
            </div>
        </div>
        <div class="courses--box">
            <span class="box--header">Courses</span>
            <div class="flex--row courses">
                <div class="flex--column course">
                    <span class="course--header">Academische Vaardigheden KI jaar 1</span>
                    <img src="../assets/img/practical-abilities-ki.png" alt="course image">
                    <span>50821PAV0Y</span>
                    <span>162 students, enrolled</span>
                    <div class="course-status">
                        Passed
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex--column wrapper--right">
        <div class="attendance--box">
            <span class="box--header">Attendance</span>
            <div class="attendance--content">
                cool
            </div>
        </div>
    </div>
</div>



<?php
    include_once 'layout-foot.php';
?>