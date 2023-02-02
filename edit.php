<?php
    include_once 'layout-head.php';

    /* Content for the page below */
    if (!strpos($_SESSION["userName"], ' ')) {
        list($name, $surname) = preg_split('#\s+#', $_SESSION["userName"], 2);
    }
    else {
        $name = $_SESSION["userName"];
        $surname = "";
    }
?>

<div class="flex--row edit-container">
    <?php 
        include_once "includes/errors-inc.php";
    ?>
    <div class="profile-settings-box">
        <form action="post-files/edit-post.php" 
              class="flex--column" 
              enctype="multipart/form-data" 
              method="post">
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
                        value="<?php echo $name ?>"
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
                        value="<?php echo $surname ?>"
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
                        value="<?php echo $_SESSION["userStudentID"] ?>"
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
                        value="<?php echo $_SESSION["userEmail"] ?>"
                    >
                </div>
            </div>
            <label for="profileimage">
                <b>Choose profile picture</b>
            </label>
            <input
                type="file"
                accept="image/png"
                class="profileimage-input"
                name="profileimage"
            >
            <button type="submit" name="submit">Enter</button>
        </form>
    </div>
    <div class="flex--column password-change-box">
        <h3>Change Password</h3>
        <form action="post-files/changepwd-post.php" class="flex--column" method="post">
            <input 
                type="hidden"
                name="csrf_token"
                value=""
                >
            <label for="pwd">
                <b>Your current Password:</b>
            </label>
            <input
                type="password"
                placeholder="e.g. Datanose++isTheBest "
                name="pwd"
                required
            >
            <label for="newpwd">
                <b>Your new Password:</b>
            </label>
            <input
                type="password"
                placeholder="e.g. Datanose++isTheBest "
                name="newpwd"
                required
            >
            <label for="pwd">
                <b>Repeat new Password:</b>
            </label>
            <input
                type="password"
                placeholder="e.g. Datanose++isTheBest "
                name="newpwdrpt"
                required
            >
            <button type="submit" name="submit">Enter</button>
        </form>
    </div>
</div>

<?php
    include_once 'layout-foot.php';
?>