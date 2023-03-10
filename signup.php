<?php
include_once 'layout-head.php';

/* Content for the page below */
?>


<div class="content-wrapper logsign-wrapper active">

    <?php
    include_once 'includes/crossanim-inc.php';
    include_once "includes/errors-inc.php";
    ?>

    <div class="flex--column login--container">
        <h1>Welcome to Datanose++!</h1>
        <div class="flex--column signup-box">
            <h2>Register your account</h2>
            <form action="post-files/signup-post.php" class="flex--column" method="post">
                <input 
                    type="hidden"
                    name="csrf_token"
                    value=""
                    >
                <div class="flex--row">
                    <div class="flex--column">
                        <label for="name">
                            <b>First name:</b>
                        </label>
                        <input 
                            type="text" 
                            placeholder="e.g. Max" 
                            name="name" 
                            required
                            >
                    </div>
                    <div class="flex--column">
                        <label for="surname">
                            <b>Last name:</b>
                        </label>
                        <input 
                            type="text" 
                            placeholder="e.g. Rutte" 
                            name="surname" 
                            required
                            >
                    </div>
                </div>
                <div class="flex--row">
                    <div class="flex--column">
                        <label for="studentID">
                            <b>Your Student number:</b>
                        </label>
                        <input 
                            type="text" 
                            class="studentid-input" 
                            placeholder="e.g. 13977571" 
                            name="studentID"
                            required
                            >
                    </div>
                    <div class="flex--column">
                        <label for="email">
                            <b>Your email adress:</b>
                        </label>
                        <input 
                            type="text" 
                            placeholder="e.g. maxrutte1@gmail.com" 
                            name="email"
                            >
                    </div>
                </div>
                <div class="flex--row">
                    <div class="flex--column">
                        <label for="pwd">
                            <b>Your Password:</b>
                        </label>
                        <input 
                            type="password" 
                            placeholder="e.g. Datanose++isTheBest" 
                            name="pwd" 
                            required
                            >
                    </div>
                    <div class="flex--column">
                        <label for="pwdrpt">
                            <b>Repeat Password:</b>
                        </label>
                        <input 
                            type="password" 
                            placeholder="..." 
                            name="pwdrpt" 
                            required
                            >
                    </div>
                </div>
                <button type="submit" name="submit">Sign up</button>
            </form>
            <h5>
                Already have an account?
                <a href="login.php">Log in!</a>
            </h5>
        </div>
    </div>
</div>


<?php
include_once 'layout-foot.php';
?>