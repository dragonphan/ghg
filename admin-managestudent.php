<?php 
    $pageTitle = "Manage Students";
    include 'includes/admin-header.php';

    /**
     * Toast Notification Function
     * Creates a non-intrusive popup message at the bottom-right corner
     * @param string $message - The message to be displayed in the toast
     */
    function echoToast($message){
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
    }

    // Create Student Function and insert into database
    if(isset($_POST['create_student'])){
        // Get form data
        $ic = $_POST['new-ic'];
        $name = $_POST['new-name'];
        $dob = $_POST['new-dob'];
        $gender = $_POST['new-gender'];
        $race = $_POST['new-race'];
        $contact = $_POST['new-contact'];
        $emergency = $_POST['new-emergency'];
        $email = $_POST['new-email'];
        $profilepic = 'assets/images/defaultProPic.jpg'; // Default profile picture
        $password = md5($_POST['new-password']); // Encrypt password using MD5

        // Check If The IC Already Exists
        $checkIcQuery = "SELECT * FROM student WHERE ic='$ic'";
        $checkIcQuery_run = mysqli_query($con, $checkIcQuery);

        if(mysqli_num_rows($checkIcQuery_run)>0){
            // IC already exists - show error message
            echoToast("IC cannot be used as already found in database.");
        }else{
            // Insert new student into database
            $query = mysqli_query($con, "INSERT INTO student VALUES ('$ic','$name','$dob','$gender','$race','$contact','$emergency','$email','$profilepic','$password')");
            echoToast("New Student added.");
        }
    }

    // Update Student Function
    if(isset($_POST['update_student'])){
        // Get updated form data
        $ic = $_POST['editStudent-ic'];
        $name = $_POST['editStudent-name'];
        $dob = $_POST['editStudent-dob'];
        $gender = $_POST['editStudent-gender'];
        $race = $_POST['editStudent-race'];
        $contact = $_POST['editStudent-contact'];
        $email = $_POST['editStudent-email'];
        $profile_pic = $_POST['editStudent-profile_pic'];
        $password = md5($_POST['editStudent-password']);
        
        // Update student information in database
        $query = "UPDATE student SET name='$name', contact='$contact' , dob='$dob', gender='$gender', race='$race', contact='$contact',
        email='$email', profile_pic='$profile_pic', password= '$password'
                    WHERE ic='$ic'";
        $query_run = mysqli_query($con, $query);
    
        if($query_run) { 
            echoToast("Student data updated.");
        }else{ 
            echoToast("Update failed. Please try again.");
        }
    }
?>

<!-- Prevent form resubmission -->
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
    <!-- Title and Add Student Button -->
    <div class="title d-flex align-items-center mb-2">
        <h2>Student Accounts</h2>
    
        <button type="button" class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#addStudentModal">
            <i class="bi bi-plus-square"></i> Register New Student
        </button>
    </div>

    <!-- Student Table -->
    <table class="display" id="StudentTable">
        <!-- Table Headers -->
        <thead>
            <tr>
                <th scope="col">Student Name</th>
                <th scope="col">Gender</th>
                <th scope="col">IC Number</th>
                <th scope="col">Contact Number</th>
                <th scope="col">Emergency Number</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody id="StudentTableBody">
            <!-- PHP code to fetch and display student data -->
            <?php
                $data_query = mysqli_query($con, "SELECT * FROM student");

                if(mysqli_num_rows($data_query) > 0)
                {
                    foreach($data_query as $student)
                    {
            ?>
                        <tr>
                            <td><?= $student['name'] ?></td>
                            <td><?= $student['gender'] ?></td>
                            <td><?= $student['ic'] ?></td>
                            <td><?= $student['contact'] ?></td>
                            <td><?= $student['emergency_contact'] ?></td>
                            <td><?= $student['email'] ?></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <!-- Edit and Delete buttons -->
                                    <button type="button" value="<?=$student['ic'];?>" class="btn editStudentBtn">
                                        <i class="bi bi-pencil-square text-white"></i>
                                    </button>
                                    <button type="button" value="<?=$student['ic'];?>" class="btn deleteStudentBtn">
                                        <i class="bi bi-trash3 text-white"></i>
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

<!-- Modal Popups Section -->
<!-- Add Student Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="AddModalLabel" aria-hidden="true">
    <!-- Modal content for adding new student -->
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddModalLabel">Add New Student: </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" id="edit">
                <form method="POST" action="admin-managestudent.php">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="name" class="col-form-label">Student Name </label>
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
                            <label for="emergency" class="col-form-label">Emergency Phone Number: </label>
                            <input type="text" class="form-control" id="emergency" name="new-emergency" placeholder="012-3456789" required>
                        </div>
                        <div class="col">
                            <label for="email" class="col-form-label">Email Address:</label>
                            <input type="email" class="form-control" id="email" name="new-email" placeholder="example@mail.com" required>
                        </div>
                        </div>
                        <div class="row mb-3">
                        <div class="col">
                            <label for="password" class="col-form-label">Password:</label>
                            <input type="text" class="form-control" id="contact" name="new-password" placeholder="*************" required>
                        </div>
                    </div>
                    <div class="row mb-3">

                    </div>
                    <input type="submit"  class="me-lg-3 btn btn-primary" id="submit" name="create_student">
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger"
                    data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Student Modal -->
<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <!-- Modal content for editing student -->
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">My Edit Student</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="updateStudent" method="POST" action="admin-managestudent.php">
            <div class="modal-body">

                <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                <input type="hidden" name="student_ic" id="student_ic" >
                <div class="row mb-3">
                    <div class="col">
                        <label for="ic">IC</label>
                        <input type="text" name="editStudent-ic" id="editStudent-ic" class="form-control" required/>
                    </div>
                    <div class="col">
                        <label for="name">Name</label>
                        <input type="text" name="editStudent-name" id="editStudent-name" class="form-control" required/>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label for="">Date of Birth</label>
                        <input type="date" name="editStudent-dob" id="editStudent-dob" class="form-control" required/>
                    </div>
                    <div class="col">
                        <label for="" class="col-form-label">Gender</label>
                        <select name="editStudent-gender" id="editStudent-gender" class="form-select" required>
                            <option value="Male">Male</option>    
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label for="race" class="col-form-label">Race</label>
                        <select name="editStudent-race" id="editStudent-race" class="form-select" required>
                            <option value="Malay">Malay</option>    
                            <option value="Chinese">Chinese</option>
                            <option value="Indian">Indian</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="">Contact</label>
                        <input type="text" name="editStudent-contact" id="editStudent-contact" class="form-control" required/>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label for="">Email</label>
                        <input type="text" name="editStudent-email" id="editStudent-email" class="form-control" required />
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label for="">Profile Picture</label>
                        <input type="text" name="editStudent-profile_pic" id="editStudent-profile_pic" class="form-control" required/>
                    </div>
                    <div class="col">
                        <label for="">Password</label>
                        <input type="text" name="editStudent-password" id="editStudent-password" class="form-control" required/>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" name="update_student" value="Update Student" />
            </div>
        </form>
        </div>
    </div>
</div>
                        
<!-- Edit Modal Popup END-->

<!-- IC Format Validation Script -->
<script>
    // Function to validate IC format using regex
    function validateIC(ic) {
        const icPattern = /^\d{6}-\d{2}-\d{4}$/;
        return icPattern.test(ic);
    }

    // Add event listener to the add student form
    document.querySelector('form[action="admin-managestudent.php"]').addEventListener('submit', function(event) {
        const icInput = document.getElementById('ic').value;

        if (!validateIC(icInput)) {
            event.preventDefault();
            // Display warning message
            const errorMessage = document.createElement('div');
            errorMessage.className = 'alert alert-danger';
            errorMessage.innerHTML = 'Please enter a valid IC number in the format XXXXXX-XX-XXXX.';
            document.querySelector('.modal-body').prepend(errorMessage);

            // Remove error message after 6 seconds
            setTimeout(() => errorMessage.remove(), 6000);
        }
    });
</script>

<!-- Include External JavaScript -->
<script src="assets/js/managestudent.js"></script>

<?php include 'includes/student-footer.php';?>
