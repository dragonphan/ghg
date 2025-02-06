<?php
// Set page title and include header
$pageTitle = "Edit Announcement";
include 'includes/admin-header.php';

// Check if the announcement ID and source are provided in URL parameters
if (!isset($_GET['id']) || !isset($_GET['source'])) {
    echo "Invalid request.";
    exit();
}

// Get announcement ID and source from URL
$announcementId = $_GET['id'];
$source = $_GET['source'];

// Fetch the announcement details based on the ID and source
if ($source === 'Student') {
    // Query for student announcements
    $query = "SELECT * FROM student_announcement WHERE announcement_id = ?";
} else {
    // Invalid source handling
    echo "Invalid source.";
    exit();
}

// Prepare and execute the query to fetch announcement details
if ($stmt = $con->prepare($query)) {
    $stmt->bind_param("i", $announcementId);
    $stmt->execute();
    $result = $stmt->get_result();
    $announcement = $result->fetch_assoc();
} else {
    // Handle query preparation error
    echo "Error preparing statement: " . $con->error;
    exit();
}

// Handle form submission for updating the announcement
if (isset($_POST['update-announcement-btn'])) {
    // Get updated data from form
    $updatedTitle = $_POST['announcement-title'];
    $updatedContent = $_POST['announcement-content'];

    // Prepare update query based on source
    if ($source === 'Student') {
        $updateQuery = "UPDATE student_announcement SET title = ?, description = ? WHERE announcement_id = ?";
    } else {
        echo "Invalid source.";
        exit();
    }

    // Execute update query
    if ($stmt = $con->prepare($updateQuery)) {
        $stmt->bind_param("ssi", $updatedTitle, $updatedContent, $announcementId);
        $query_run = $stmt->execute();

        if ($query_run) {
            // Redirect to dashboard after successful update
            header("Location: admin-dashboard.php?update=success");
            exit();
        } else {
            // Display error message if update fails
            echo "<p class='text-danger'>Failed to update announcement. Please try again.</p>";
        }
    } else {
        echo "Error preparing statement: " . $con->error;
    }
}
?>

<!-- Edit Announcement Form Container -->
<div class="container mt-4">
    <h2>Edit Announcement</h2>

    <!-- Edit Form -->
    <form method="POST" action="admin-edit-announcement.php?id=<?=$announcementId?>&source=<?=$source?>">
        <!-- Title Input -->
        <div class="input-group mb-3">
            <input type="text" 
                   class="form-control" 
                   name="announcement-title" 
                   value="<?=$announcement['title']?>" 
                   required>
        </div>
        <!-- Content Input -->
        <div class="input-group mb-3">
            <textarea class="form-control" 
                      name="announcement-content" 
                      required><?=$announcement['description']?></textarea>
        </div>
        <!-- Update Button -->
        <button type="submit" 
                class="btn btn-primary" 
                name="update-announcement-btn">Update</button>
    </form>
</div>

<?php 
// Include footer
include 'includes/admin-footer.php';
?>
