<?php
    include_once 'layout-head.php';

    /* Content for the page below */
?>

<div class="flex--column admin-container">
    <table>
        <thead>
            <tr>
                <th><div class="head">ID</div></th>
                <th><div class="head">Name</div></th>
                <th><div class="head">StudentID</div></th>
                <th><div class="head">Email</div></th>
                <th><div class="head">Admin</div></th>
                <th><div class="head"></div></th>
            </tr>
        </thead>
    </table>
    <form action="#" method="post">
    <div class="table-wrapper"> 
        <table>
            <thead>
            </thead>
            <tbody>
                <?php
                    include_once 'post-files/adminpage-post.php';
                ?>
            </tbody>
        </table>
    </div>
    <input
        type="hidden"
        name="csrf_token"
        value=""
        >
    <button type="submit" name="submit">Delete</button>
    </form>
</div>

<?php
    include_once 'layout-foot.php';
?>