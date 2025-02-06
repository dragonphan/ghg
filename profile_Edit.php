<?php
    // Include the header file for student pages
    include 'includes/student-header.php';

    // Get the logged-in student's IC number
    $loginIC = $student->getIc();

    // Get form data from POST request
    $name = $_POST["profile-name"];
    $gender = $_POST["profile-gender"];
    $DOB = $_POST["profile-dob"];
    $email = $_POST["profile-Email"];
    $phone_Number = $_POST["profile-contact"];
    $emergency_contact = $_POST["profile-emergencyContact"];
    $profile_race = $_POST["profile-race"];

    // Update student information in the database
    $sql = "UPDATE student SET ic='".$loginIC."', name='".$name."', dob='".$DOB."', gender='".$gender."', race='".$profile_race."', contact='".$phone_Number."', emergency_contact='".$emergency_contact."', email='".$email."' WHERE ic='".$loginIC."'";
    $result = mysqli_query($con, $sql);  

    // Redirect back to profile page after update
    header("Location:profile.php");
?>