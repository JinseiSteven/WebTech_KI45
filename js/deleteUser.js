// assigning click functions on page load
$(document).ready(function(){
    $('.delete-button').click(function(){

        // keeping track of the user row, to delete the row later 
        var userRow = this;

        // getting the userID to find them in the database
        var userID = $(this).attr('id');

        // get the csrf token of the user who submitted the form
        var csrf = $("[name=csrf_token]").val();

        if (confirm("Are you sure you want to delete this user?")) {

            // calling the deleteuser php script with the user id as data
            $.ajax({
                url: 'post-files/deleteUser-post.php',
                type: 'POST',
                data: { userID:userID, csrf:csrf },

                // upon success: fading out the table row
                success: function(response) {
                    if (response == 'success'){
                        $(userRow).closest('tr').fadeOut(800,function(){ $(this).remove(); });
                    }
                    else {
                            alert(response);
                    }
                }
            });
        }
    });
});
