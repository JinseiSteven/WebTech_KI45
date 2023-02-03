// assigning click functions on page load
$(document).ready(function(){
    $('.admin-button').click(function(){

        // keeping track of the user row, to color the row later 
        var userRow = this;

        // getting the userID to find them in the database
        var userID = $(this).attr('id');

        // get the csrf token of the user who submitted the form
        var csrf = $("[name=csrf_token]").val();

        if (confirm("Are you sure you want to toggle this users admin privileges?")) {

            // calling the toggleAdmin php script with the user id as data
            $.ajax({
                url: 'post-files/toggleAdmin-post.php',
                type: 'POST',
                data: { userID:userID, csrf:csrf},

                // upon success: coloring the table row yellow
                success: function(response) {

                    // toggling the color of the row
                    if (response == 'success'){
                        if ($(userRow).closest('tr').attr("id") == "admin-row") {
                            $(userRow).closest('tr').attr("id", "");
                        }
                        else {
                            $(userRow).closest('tr').attr("id", "admin-row");
                        }
                    }
                    else {
                            alert(response);
                    }
                }
            });
        }
    });
});
