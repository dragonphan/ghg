<?php 
    $pageTitle = "Manage Admin";
    include 'includes/admin-header.php';

    /**
     * Toast Notification Function
     * Creates a non-intrusive popup message at the bottom-right corner
     * @param string $message - The message to be displayed in the toast
     */
    function echoToast($message){
        // Container for toast with high z-index to appear above other elements
        echo '<div aria-live="polite" aria-atomic="true" class="position-relative" style="z-index: 100;">
        <!-- Toast container positioned at bottom-right -->
        <div class="toast-container position-fixed bottom-0 end-0 m-3">
            <!-- Individual toast element -->
            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="6000">
                <!-- Toast header with close button -->
                <div class="toast-header">
                    <span class="bg-primary px-2 rounded">&nbsp;</span>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <!-- Toast message body -->
                <div class="toast-body">
                    '.$message.'
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery script to automatically show the toast -->
    <script> $(document).ready(function() {
        $(".toast").toast("show");
    });</script>';
    }

    // Create Admin Function and insert into database
    if(isset($_POST['create_admin'])){
        // Get form data
        $ic = $_POST['new-ic'];
        $name = $_POST['new-name'];
        $dob = $_POST['new-dob'];
        $gender = $_POST['new-gender'];
        $race = $_POST['new-race'];
        $contact = $_POST['new-contact'];
        $email = $_POST['new-email'];
        $profilepic = 'assets/images/defaultProPic.jpg'; // Default profile picture
        $password = md5($_POST['new-password']); // Encrypt password using MD5

        // Check If The IC Already Exists in Database
        $checkIcQuery = "SELECT * FROM admin WHERE ic='$ic'";
        $checkIcQuery_run = mysqli_query($con, $checkIcQuery);

        if(mysqli_num_rows($checkIcQuery_run) > 0){
            // IC already exists - show error message
            echoToast("IC cannot be used as already found in database.");
        }else{
            // Insert new admin into database
            $query = mysqli_query($con, "INSERT INTO admin VALUES ('$ic','$name','$dob','$gender','$race','$contact','$email','$profilepic','$password')");
            echoToast("New admin added.");
        }
    }

    // Update Admin Function
    if(isset($_POST['update_admin'])){
        // Get updated form data
        $ic = $_POST['editAdmin-ic'];
        $name = $_POST['editAdmin-name'];
        $dob = $_POST['editAdmin-dob'];
        $gender = $_POST['editAdmin-gender'];
        $race = $_POST['editAdmin-race'];
        $contact = $_POST['editAdmin-contact'];
        $email = $_POST['editAdmin-email'];
        $profile_pic = $_POST['editAdmin-profile_pic'];
        $password = md5($_POST['editAdmin-password']); // Encrypt updated password
        
        // Update admin information in database
	$query = "UPDATE admin SET name='$name', contact='$contact' , dob='$dob', gender='$gender', race='$race', contact='$contact',
        email='$email', profile_pic='$profile_pic', password= '$password'
                    WHERE ic='$ic'";
        $query_run = mysqli_query($con, $query);
    
        // Show success or error message based on query result
        if($query_run) { 
            echoToast("Admin data updated.");
        }else{ 
            echoToast("Update failed. Please try again.");
        }
    }
?>

<!-- Prevent form resubmission on page refresh -->
<script>
	if ( window.history.replaceState ) {
		window.history.replaceState( null, null, window.location.href );
	}
</script>

<!-- Toast Notification Container -->
<div aria-live="polite" aria-atomic="true" class="position-relative" style="z-index: 100;">
    <div class="toast-container position-fixed bottom-0 end-0 m-3">
    </div>
</div>

<!-- Main Content Container -->
<div class="col-12 mycontainer mx-auto">
    <!-- Title and Add Admin Button -->
    <div class="title d-flex align-items-center mb-2">
        <h2>Admin Accounts</h2>
    
        <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#addAdminModal">
            <i class="bi bi-plus-square"></i> Register New Admin
        </button>
    </div>

    <!-- Admin Table -->
    <table class="display" id="AdminTable">
        <thead>
            <tr>
                <th scope="col">Admin Name</th>
                <th scope="col">Gender</th>
                <th scope="col">IC Number</th>
                <th scope="col">Contact Number</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody id="AdminTableBody">
            <!-- PHP code to fetch and display admin data -->
            <?php
                $data_query = mysqli_query($con, "SELECT * FROM admin");

                if(mysqli_num_rows($data_query) > 0)
                {
                    foreach($data_query as $admin)
                    {
            ?>
                        <tr>
                            <td><?= $admin['name'] ?></td>
                            <td><?= $admin['gender'] ?></td>
                            <td><?= $admin['ic'] ?></td>
                            <td><?= $admin['contact'] ?></td>
                            <td><?= $admin['email'] ?></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <!-- Edit and Delete buttons -->
                                    <button type="button" value="<?=$admin['ic'];?>" class='btn editAdminBtn'>
                                        <i class='bi bi-pencil-square text-white'></i>
                                    </button>
                                    <button type="button" value="<?=$admin['ic'];?>" class='btn deleteAdminBtn'>
                                        <i class='bi bi-trash3 text-white'></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
            <?php
                    }
                }
            ?>
        </tbody>
    </table>
</div>

<!-- ################################################################### -->
                        <!-- MODAL POPUP -->
<!-- ################################################################### -->

<!-- addAdminModal -->

<div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="AddModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddModalLabel">Add New Admin: </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" id="edit">
                <form method="POST" action="admin-manageadmin.php">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="name" class="col-form-label">Admin Name </label>
                            <input type="text" name="new-name" class="form-control" id="name" required placeholder="Full Name">
                        </div>
                        <div class="col">
                            <label for="ic" class="col-form-label">IC Number </label>
                            <input type="text" class="form-control" name="new-ic" id="ic" placeholder="010616-14-1303" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="race" class="col-form-label">Race</label>
                            <select name="new-race" id="race" class="form-select" required>
                                <option value="Malay">Malay</option>    
                                <option value="Chinese">Chinese</option>
                                <option value="Indian">Indian</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="" class="col-form-label">Gender</label>
                            <select name="new-gender" id="new-gender" class="form-select" required>
                                <option value="Male">Male</option>    
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="dob" class="col-form-label">Date Of Birth</label>
                            <input type="date" class="form-control" id="dob" name="new-dob" required>
                        </div>
                        <div class="col">
                            <label for="contact" class="col-form-label">Phone Number:</label>
                            <input type="text" class="form-control" id="contact" name="new-contact" placeholder="012-3456789" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="email" class="col-form-label">Email Address:</label>
                            <input type="email" class="form-control" id="email" name="new-email" placeholder="example@mail.com" required>
                        </div>
                        <div class="col">
                            <label for="password" class="col-form-label">Password:</label>
                            <input type="text" class="form-control" id="contact" name="new-password" placeholder="*************" required>
                        </div>
                    </div>
                    <div class="row mb-3">

                    </div>
                    <input type="submit"  class="me-lg-3 btn btn-primary" id="submit" name="create_admin">
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger"
                    data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- addAdminModal END -->

<!-- Include the script for IC format validation here -->
<script>
    // Function to validate IC format
    function validateIC(ic) {
        const icPattern = /^\d{6}-\d{2}-\d{4}$/; // Regular expression for IC format
        return icPattern.test(ic);
    }

    // Add event listener to the add admin form
    document.querySelector('form[action="admin-manageadmin.php"]').addEventListener('submit', function(event) {
        const icInput = document.getElementById('ic').value; // Get the IC input value

        if (!validateIC(icInput)) {
            event.preventDefault(); // Prevent form submission if IC format is incorrect

            // Display warning message
            const errorMessage = document.createElement('div');
            errorMessage.className = 'alert alert-danger';
            errorMessage.innerHTML = 'Please enter a valid IC number in the format XXXXXX-XX-XXXX.';
            document.querySelector('.modal-body').prepend(errorMessage);

            // Remove the error message after 6 seconds
            setTimeout(() => errorMessage.remove(), 6000);
        }
    });
</script>

<!-- Edit AdminModal Popup-->

    <div class="modal fade" id="editAdminModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">My Edit Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateAdmin" method="POST" action="admin-manageadmin.php">
                <div class="modal-body">

                    <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                    <input type="hidden" name="admin_ic" id="admin_ic" >
                    <div class="row mb-3">
                        <div class="col">
                            <label for="ic">IC</label>
                            <input type="text" name="editAdmin-ic" id="editAdmin-ic" class="form-control" required/>
                        </div>
                        <div class="col">
                            <label for="name">Name</label>
                            <input type="text" name="editAdmin-name" id="editAdmin-name" class="form-control" required/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="">Date of Birth</label>
                            <input type="date" name="editAdmin-dob" id="editAdmin-dob" class="form-control" required/>
                        </div>
                        <div class="col">
                            <label for="" class="col-form-label">Gender</label>
                            <select name="editAdmin-gender" id="editAdmin-gender" class="form-select" required>
                                <option value="Male">Male</option>    
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="race" class="col-form-label">Race</label>
                            <select name="editAdmin-race" id="editAdmin-race" class="form-select" required>
                                <option value="Malay">Malay</option>    
                                <option value="Chinese">Chinese</option>
                                <option value="Indian">Indian</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="">Contact</label>
                            <input type="text" name="editAdmin-contact" id="editAdmin-contact" class="form-control" required/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="">Email</label>
                            <input type="text" name="editAdmin-email" id="editAdmin-email" class="form-control" required />
                        </div>
                        <div class="col">
                            <label for="">Password</label>
                            <input type="text" name="editAdmin-password" id="editAdmin-password" class="form-control" required/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="">Profile Picture</label>
                            <input type="text" name="editAdmin-profile_pic" id="editAdmin-profile_pic" class="form-control" required/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" name="update_admin" value="Update Admin" />
                </div>
            </form>
            </div>
        </div>
    </div>
                        
<!-- Edit Modal Popup END-->



<!-- (Included In This file Only)Manage User JS -->
<script src="assets/js/manageadmin.js"></script>
<?php include 'includes/admin-footer.php';?>
