<?php 
    // Include header file with student data
    include 'includes/student-header.php';

    // Set target directory for image uploads
    $target_Dir = "assets/images/";
    
    // Clean filename by replacing spaces with underscores
    $filename = str_replace(" ", "_", basename($_FILES["newProfilePic"]["name"]));
    
    // Create complete file path
    $target_file_path = $target_Dir.$filename;

    // Check if form was submitted and file was selected
    if(isset($_POST["submit"]) && !empty($_FILES["newProfilePic"]["name"])){
        // Move uploaded file to target directory
        if(move_uploaded_file($_FILES["newProfilePic"]["tmp_name"], $target_file_path)){
            // Update database with new profile picture path
            $sql = "UPDATE student SET profile_pic='".$target_file_path."' WHERE ic='".$student->getIc()."'";
            
            // Execute query and redirect on success
            mysqli_query($con, $sql);
            header("Location:profile.php");
        }
    }
?>
