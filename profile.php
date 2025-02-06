<?php

// Set page title and include header
$pageTitle = "Profile";
include 'includes/student-header.php';
?>

<div class="container main-content-container">
  <div class="profile_container row my_container p-4">
    <!-- Main Profile Content Section -->
    <div class="mycontainer col-9 d-flex flex-column justify-content-start">
      <!-- Profile Edit Form -->
      <form onsubmit="return confirmEdit();" method="POST" action="profile_Edit.php" id="mainForm">
        <!-- General Information Section -->
        <div class="generalInformationSection">
          <h3>General Information</h3>
          <hr />
          <!-- Name and IC Number Row -->
          <div class="row">
            <div class="col">
              <label for="profile-name" class="form-label">Name</label>
              <input type="text" class="form-control" value=<?= "'" . $student->getName() . "'"; ?> id="profile-name" name="profile-name" required disabled />
            </div>
            <div class="col">
              <label for="profile-ic" class="form-label">Identity Number</label>
              <input type="text" class="form-control" value="<?= $student->getIc(); ?>" id="profile-ic" name="profile-ic" disabled required />
            </div>
          </div>

          <!-- DOB and Gender Row -->
          <div class="row">
            <div class="col">
              <label for="profile-dob" class="form-label">Date Of Birth (mm/dd/YYYY)</label>
              <input type="date" class="form-control" value="<?= $student->getDob(); ?>" id="profile-dob" name="profile-dob" disabled required />
            </div>
            <div class="col">
              <label for="profile-gender" class="form-label">Gender</label>
              <select name="profile-gender" id="profile-gender" disabled class="form-select" disabled required>
                <?php
                // Generate gender selection options
                // Get current gender and create options array
                $currentGender = $student->getGender();
                $genderSelections = array("Male", "Female", "Other");

                $selectInputString = "";

                // Create options with current gender selected
                foreach ($genderSelections as $gender) {
                  if ($gender == $currentGender) {
                    $selectInputString .= "<option selected value='$currentGender'>$currentGender</option>";
                  } else {
                    $selectInputString .= "<option value='$gender'>$gender</option>";
                  }
                }
                echo $selectInputString;
                ?>
              </select>
            </div>
          </div>

          <!-- Email and Contact Number Row -->
          <div class="row">
            <div class="col">
              <label for="profile-email" class="form-label">Email</label>
              <input type="email" class="form-control" value="<?= $student->getEmail() ?>" id="profile-Email" name="profile-Email" disabled required />
            </div>
            <div class="col">
              <label for="profile-contact" class="form-label">Contact Number</label>
              <input type="text" class="form-control" value="<?= $student->getContact() ?>" id="profile-contact" name="profile-contact" disabled required />
            </div>
          </div>

          <!-- Emergency Contact and Race Row -->
          <div class="row">
            <div class="col">
              <label for="profile-emergencyContact" class="form-label">Emergency Contact</label>
              <input type="text" class="form-control" value="<?= $student->getEmergencyContact() ?>" id="profile-emergencyContact" name="profile-emergencyContact" disabled required />
            </div>
            <div class="col">
              <label for="profile-race" class="form-label">Race</label>
              <select name="profile-race" id="profile-race" name="profile-race" class="form-select" disabled required>
                <?php
                // Generate race selection options
                $currentRace = $student->getRace();
                $raceSelections = array("Malay", "Chinese", "Indian", "Other");

                $raceOptionString = "<option selected value='$currentRace'>$currentRace</option>";

                // Create options excluding current race
                foreach ($raceSelections as $race) {
                  if ($race != $currentRace) {
                    $raceOptionString .= "<option value='$race'>$race</option>";
                  }
                }
                echo $raceOptionString;
                ?>
              </select>
            </div>
          </div>

        <!-- Edit Button Section -->
        <div id="editValidationBtn"></div>
        <div id="editSuggestion"></div>
        <button class="btn btn-primary w-100 mt-4" id="editBtn" onclick="edit()" type="button">
          <i class="me-2 fa fa-edit" aria-hidden="true"></i>Edit
        </button>
      </form>
    
      <!-- Password Change Form -->
      <form onsubmit="return confirmChangePassword()" method="post" action="changePassword.php" id="changePasswordForm">
        <div class="changePasswordDiv" style="margin-top: 10%">
          <h3>Change Password</h3>
          <hr />
          <div class="row">
            <div class="col" style="display: none;">
              <label for="profile-password" class="form-label">Current Password</label>
              <div class="row">
                <div class="col">
                  <input type="password" class="form-control"  value=<?= "'" . $student->getPassword() . "'"; ?> id="profile-password" name="profile-password" required disabled />
                </div>
                <div class="col" style="margin-top:10px;">
                  <i class="bi bi-eye-slash" id="toggleOriginalPassword"></i>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="col">
                <label for="profile-newPassword" class="form-label">New Password</label>
                <div class="row">
                  <div class="col">
                    <input type="password" class="form-control" value="" placeholder="New Password Here" id="profile-newPassword" name="profile-newPassword" required />
                  </div>
                  <div class="col" style="margin-top:10px;">
                    <i class="bi bi-eye-slash" id="toggleNewPassword"></i>
                  </div>
                </div>
              </div>
              <p id="samePassword" style="color: red; font-size:10px;"></p>
            </div>
          </div>
          <button class="btn btn-warning w-100 mt-4" style="color:aliceblue;" id="chgPassBtn" type="submit"><i style="margin-right: 10px;" class="bi bi-pencil-fill"></i>Change Password</button>
          <br />
          

        </div>
      </form>
      <hr/>
    </div>

    <!-- Profile Sidebar Section -->
    <!-- Minimized Profile View -->
    <div class="minimizeProfileSide" id="minimizeProfileSide" onclick="toggleSide()">
      <div id="toggleSideButton2"></div>
      <img src=<?php echo $student->getProfilePic() ?> alt="profile-image" class="small_profile_picture">
      <h6><?php echo $student->getName() ?></h6>
    </div>

    <!-- Expanded Profile View -->
    <div class="profileImgSide" id="profileImgSide">
      <div onclick="toggleSide()" id="toggleSideButton"></div>

      <div class="image" style="margin-top: 20px;">
        <img src=<?php echo $student->getProfilePic() ?> alt="profile image" id="profile-image" class=""> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera-fill editImage button button_link" viewBox="0 0 16 16" onclick="changeProfileImage()">
          <path d="M10.5 8.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
          <path d="M2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2zm.5 2a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1zm9 2.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0z" />
        </svg> </img>   
      </div>
      <hr />

      <div class="details">
        <h3><?php echo $student->getName() ?></h2>
        <h3><?php echo $student->getGender() ?></h2>
        <h3><?php echo $student->getIc() ?></h2>
      </div>
    </div>
  </div>
</div>

<!-- Alert Modal -->
<div class="modal fade" id="alert-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body d-flex flex-column align-items-center">
        <div class="alert" role="alert"></div>
      </div>
      <div class="modal-footer" id="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="yes-button" onclick="">Yes</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript Section -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
<script type="text/javascript">
// Get user email and name from PHP
var email = "<?= $student->getEmail() ?>"; 
var name ="<?= $student->getName()  ?>"

// Password validation check
$("#profile-newPassword").on('keyup',function(){
  console.log("lol")
  let currentPass=document.getElementById("profile-newPassword").value

  let oriPass = document.getElementById("profile-password").value
  
  // Encrypt passwords for comparison
  var hash = CryptoJS.SHA1(oriPass);
  var encryptedCurrentPass = CryptoJS.MD5(currentPass)
  if(oriPass==encryptedCurrentPass){
    document.getElementById("samePassword").innerHTML="New password cannot same with previous password"
    document.getElementById("chgPassBtn").disabled=true;
    document.getElementById("chgPassBtn").className="btn btn-secondary w-25 mt-4";
  }
  else{
    document.getElementById("samePassword").innerHTML=""
    document.getElementById("chgPassBtn").disabled=false;
    document.getElementById("chgPassBtn").className="btn btn-warning w-25 mt-4"; 
  }
})
</script>

<!-- Include profile.js and footer -->
<script src="assets/js/profile.js"></script>
<?php include 'includes/student-footer.php'; ?>
