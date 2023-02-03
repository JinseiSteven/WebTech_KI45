// assigning click functions on page load
$(document).ready(function(){
    $('.delete-button').click(function(){

        // keeping track of the grade row, to delete the row later 
        var gradeRow = this;

        // getting the gradeID to find it in the database
        var gradeID = $(this).attr('id');

        // get the csrf token of the user who submitted the form
        var csrf = $("[name=csrf_token]").val();

        if (confirm("Are you sure you want to delete this grade?")) {

            // calling the deleteGrade php script with the grade id as data
            $.ajax({
                url: 'post-files/deleteGrade-post.php',
                type: 'POST',
                data: { gradeID:gradeID, csrf:csrf },

                // upon success: fading out the table row
                success: function(response) {
                    if (response == 'success'){
                        $(gradeRow).closest('tr').fadeOut(800,function(){ 
                            $(this).remove(); 
                        });
                    }
                    else {
                            alert(response);
                    }
                }
            });
        }
    });
});
