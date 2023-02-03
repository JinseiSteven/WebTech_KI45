<?php
include_once 'layout-head.php';

    /* Content for the page below */
?>

<div class="flex--row edit-container">
    <?php
    include_once "includes/errors-inc.php";
    ?>
    <div class="flex--column grades-box"> 
        <table class="table-header">
            <thead>
                <tr>
                    <th><div class="head">Name</div></th>
                    <th><div class="head">Grade</div></th>
                    <th><div class="head">EC</div></th>
                    <th><div class="head"></div></th>
                </tr>
            </thead>
        </table>
        <div class="table-wrapper grade-table"> 
            <table id="grades">
                <thead>
                </thead>
                <tbody>
                    <?php
                        include_once 'post-files/gradeviewer-post.php';
                    ?>
                </tbody>
            </table>
        </div>
        <input
            style="width:41%;"
            type="text"
            name="gradeName"
            placeholder="Course name"
            value=""
            >
        <div class="flex--row">
            <input
            type="text"
            name="gradeValue"
            placeholder="Acquired Grade"
            value=""
            >
            <input
            type="text"
            name="gradeEC"
            placeholder="Total EC"
            value=""
            >
        </div>
        <span class='add-button'>Add Grade to Table</span>
    </div>
    <input
        type="hidden"
        name="csrf_token"
        value=""
        >
    <script src="./js/deleteGrade.js"></script>
    <script src="./js/addGrade.js"></script>
</div>
    </div>
</div>

<?php
include_once 'layout-foot.php';
?>