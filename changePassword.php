<?php 
    // Include profile page for user data
    include "profile.php";

    // Get new password from POST request
    $newPassword = $_POST["profile-newPassword"];
    // Hash the password using MD5 for security
    $newPassword = md5($newPassword);

    // Check if the new password is different from current password
    if($newPassword != $student->getPassword()){
        // Prepare SQL query to update password
        $sql = "UPDATE student SET password='".$newPassword."' WHERE ic='".$student->getIc()."'";
        
        // Execute query and check if successful
        if(mysqli_query($con,$sql)) {
            // Show success message and redirect
            echo "<script>
                $(document).ready(function() {
                    buildSuccessPasswordAlert();
                    $('#alert-modal').modal('show');
                    $('.modal-footer button').click(function() {
                        window.location.href='profile.php';
                    });
                });
            </script>";
            exit();
        }
    } else {
        // Show error message if new password is same as current password
        echo "<script>
            $(document).ready(function() {
                buildWrongVerificationAlert();
                $('#alert-modal').modal('show');
                setTimeout(function() {
                    window.location.href='profile.php';
                }, 3000);
            });
        </script>";
    }
?>