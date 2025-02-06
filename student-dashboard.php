<?php 
// Set page title and include header file
$pageTitle = "Student Dashboard";
include 'includes/student-header.php';
?>

<div class="col p-0 m-0">
    <!-- Welcome Message Section -->
    <div class="col-15 col-lg-10 mycontainer mx-auto">
        <h2>Hi 
            <!-- Display student name with XSS protection -->
            <span><?php echo htmlspecialchars($student->getName()); ?></span> 
        , Welcome to GHG MONITOR for UMS </h2>
        <p class="text-muted m-0">Get in touch with us!</p>
    </div>
    
    <!-- Announcements Section -->
    <h1 class="mt-4 text-center">Admin Announcements:</h1>
    <!-- Announcements Container -->
    <div class="col-15 col-lg-10 mt-4 mx-auto">
        <?php
        // Fetch announcements from database in descending order by date
        $data_query = mysqli_query($con, "SELECT * FROM student_announcement ORDER BY date_time DESC");

        // Check if there are any announcements
        if(mysqli_num_rows($data_query) > 0)
        {
            // Loop through each announcement
            while($announcement = mysqli_fetch_assoc($data_query))
            {
                // Sanitize data to prevent XSS attacks
                $formattedDate = htmlspecialchars($announcement['date_time']);
                $title = htmlspecialchars($announcement['title']);
                $description = htmlspecialchars($announcement['description']);
        ?>
                <!-- Display announcement card -->
                <div class="card mt-4 mycontainer">
                    <div class="card-body">
                        <h5><?php echo $title; ?></h5>
                        <span class="text-muted ms-auto"><?php echo $formattedDate; ?></span>
                        <!-- Display description with preserved line breaks -->
                        <p class="card-text mt-3" style="white-space: pre-line"><?php echo $description; ?></p>
                    </div>
                </div>  
        <?php
            }
        }
        else
        {
            // Display message if no announcements are found
            echo '<p class="text-center">No announcements available.</p>';
        }
        ?>
    </div>
    
</div>

<!-- Engati Chat Widget Integration -->
<script>
!function(e,t,a){
    var c=e.head||e.getElementsByTagName("head")[0],
        n=e.createElement("script");
    // Set script attributes for async loading
    n.async=!0;
    n.defer=!0;
    n.type="text/javascript";
    // Configure widget with bot key and server settings
    n.src=t+"/static/js/widget.js?config="+JSON.stringify(a);
    c.appendChild(n);
}(document,"https://app.engati.com",{bot_key:"b4e206a30d39493b",welcome_msg:true,branding_key:"default",server:"https://app.engati.com",e:"p" });
</script>

<!-- Include footer -->
<?php include 'includes/student-footer.php';?>
