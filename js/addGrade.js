// assigning click function on page load
$(document).ready(function(){
    $('.add-button').click(function(){

        var gradeName = $("input[name=gradeName]").val();
        var gradeValue = $("input[name=gradeValue]").val();
        var gradeEC = $("input[name=gradeEC]").val();

        // checking whether the submitted EC and grade are numeric
        if (!jQuery.isNumeric(gradeValue)) {alert("Value must be integer"); return;}
        if (!jQuery.isNumeric(gradeEC)) {alert("EC must be integer"); return;}

        if (!gradeName || !gradeValue || !gradeEC) {
            alert("Please fill in all fields");
            return;
        }

        // get the csrf token of the user who submitted the form
        var csrf = $("[name=csrf_token]").val();

        // calling the addGrade php script
        $.ajax({
            url: 'post-files/addGrade-post.php',
            type: 'POST',
            data: { gradeName:gradeName, 
                    gradeValue:gradeValue, 
                    gradeEC:gradeEC, 
                    csrf:csrf },

            // upon success: fading out the table row
            success: function(response) {
                if (response == 'success'){
                    location.reload();
                }
                else {
                        alert(response);
                }
            }
        });
    });
});
