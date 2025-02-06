<?php
$pageTitle = "Admin Dashboard";
include 'includes/admin-header.php';

// Handle announcement submission
if (isset($_POST['announcement_btn'])) {
    // Get form data
    $title = $_POST['announcement-title'];
    $content = $_POST['announcement-content'];
    $targetAudience = $_POST['target-audience'];

    // Get current timestamp
    $time = date("Y-m-d h:i:s");

    // Prepare SQL statement based on target audience
    if ($targetAudience === 'student') {
        $stmt = $con->prepare("INSERT INTO student_announcement (title, description, date_time) VALUES (?, ?, ?)");
    } else {
        $stmt = $con->prepare("INSERT INTO announcement (title, description, date_time) VALUES (?, ?, ?)");
    }

    // Bind parameters and execute query
    $stmt->bind_param("sss", $title, $content, $time);
    $query_run = $stmt->execute();

    // Show success/failure message
    if ($query_run) { 
        echoToast("New announcement posted.");
    } else { 
        echoToast("Post failed. Please try again.");
    }
}

/**
 * Toast Notification Function
 * Creates a non-intrusive popup message at the bottom-right corner
 * @param string $message - The message to be displayed in the toast
 */
function echoToast($message) {
    echo '<div aria-live="polite" aria-atomic="true" class="position-relative" style="z-index: 100;">
        <div class="toast-container position-fixed bottom-0 end-0 m-3">
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="6000">
                <div class="toast-header">
                    <span class="bg-primary px-2 rounded">&nbsp;</span>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    '.$message.'
                </div>
            </div>
        </div>
    </div>
    <script> $(document).ready(function() {
        $(".toast").toast("show");
    });</script>';
    $_POST = array();
}
?>

<!-- Main Content Container -->
<div class="row p-0">
    <div class="col-12 mx-lg-auto mt-4">
        <!-- Announcement Submit Form -->
        <div class="mycontainer">
            <h2>Post A New Announcement</h2>
            <form id="announcement" method="POST" action="admin-dashboard.php">
                <!-- Title Input -->
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Title" name="announcement-title" required>
                </div>
                <!-- Content Input -->
                <div class="input-group mb-3">
                    <textarea class="form-control" placeholder="Your Announcement Content Here" name="announcement-content" required></textarea>
                </div>
                <!-- Target Audience Selection -->
                <div class="mb-3">
                    <span class="text-muted">For : Student</span>
                    <input type="hidden" name="target-audience" value="student">
                </div>
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary" name="announcement_btn">Post</button>
            </form>
        </div>

        <!-- Announcements Display Container -->
        <div id="announcement_container">
            <?php
            $studentAnnouncements = [];

            // Fetch announcements from the 'student_announcement' table
            $studentQuery = mysqli_query($con, "SELECT * FROM student_announcement ORDER BY date_time DESC");
            while ($row = mysqli_fetch_assoc($studentQuery)) {
                $row['source'] = 'Student';
                $studentAnnouncements[] = $row;
            }

            // Sort announcements by date in descending order
            usort($studentAnnouncements, function ($a, $b) {
                return strtotime($b['date_time']) - strtotime($a['date_time']);
            });

            // Display announcements
            if (count($studentAnnouncements) > 0) {
                foreach ($studentAnnouncements as $key => $announcement) {
                    $formattedDate = htmlspecialchars($announcement['date_time']);
                    ?>
                    <!-- Individual Announcement Card -->
                    <div class="card mt-4 mycontainer">
                        <div class="card-body">
                            <h5><?php echo htmlspecialchars($announcement['title']); ?></h5>
                            <span class="text-muted ms-auto"><?php echo $formattedDate; ?></span>
                            <p class="card-text mt-3" style="white-space: pre-line"><?php echo htmlspecialchars($announcement['description']); ?></p>
                            <p class="text-muted">For: <?php echo htmlspecialchars($announcement['source']); ?></p>

                            <!-- Announcement Management Buttons -->
                            <form method="POST" action="admin-dashboard.php">
                                <input type="hidden" name="delete-announcement-id" value="<?php echo $key; ?>">
                                <button type="submit" class="btn btn-danger" name="delete-announcement-btn">Delete</button>
                                <a href="admin-edit-announcement.php?id=<?php echo htmlspecialchars($announcement['announcement_id']); ?>&source=<?php echo urlencode($announcement['source']); ?>" class="btn btn-primary">Edit</a>
                            </form>
                        </div>
                    </div>  
                    <?php
                }
            } else {
                echo '<p class="text-center">No announcements available.</p>';
            }

            // Handle announcement deletion
            if (isset($_POST['delete-announcement-btn'])) {
                $deleteAnnouncementId = $_POST['delete-announcement-id'];
                if (isset($studentAnnouncements[$deleteAnnouncementId])) {
                    $announcementId = $studentAnnouncements[$deleteAnnouncementId]['announcement_id'];

                    // Prepare delete query
                    $deleteQuery = "DELETE FROM student_announcement WHERE announcement_id = ?";

                    if ($stmt = $con->prepare($deleteQuery)) {
                        $stmt->bind_param("i", $announcementId);
                        $query_run = $stmt->execute();

                        // Show success/failure message and redirect
                        if ($query_run) { 
                            echoToast("Announcement deleted.");
                            header("Location: admin-dashboard.php");
                            exit(); // Ensure script execution stops after redirect
                        } else { 
                            echoToast("Failed to delete announcement. Please try again.");
                        }
                    } else {
                        echo "Error preparing statement: " . $con->error;
                    }
                } else {
                    echoToast("Invalid announcement ID.");
                }
            }
            ?>
        </div>
    </div>
</div>

<?php include 'includes/admin-footer.php';?>
