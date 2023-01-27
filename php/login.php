<?php
    include_once 'layout-head.php';

    /* Content for the page below */
?>


<div class="content-wrapper logsign-wrapper active">

    <?php
        include_once 'includes/cross-anim.php';
        include_once "includes/errors.php";
    ?>
    <div class="flex--column login--container">
        <h1>Welcome to Datanose++!</h1>
        <div class="flex--column login-box">
            <h2>Log in to see your personalised overview</h2>
            <form action="db-files/login-post.php" class="flex--column" method="post">
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
                <label for="pwd">
                    <b>Your Password:</b>
                </label>
                <input
                    type="password"
                    placeholder="e.g. Datanose++isTheBest "
                    name="pwd"
                    required
                >
                <div class="remember-box flex--row">
                    <label for="remember">
                        <b>Stay logged in?</b>
                    </label>
                    <input 
                        type="checkbox" name="remember">
                </div>
                <button type="submit" name="submit">Sign in</button>
            </form>
            <h5>
                New to Datanose++?
                <a href="signup.php">Sign up!</a>
            </h5>
        </div>
    </div>
</div>


<?php
    include_once 'layout-foot.php';
?>