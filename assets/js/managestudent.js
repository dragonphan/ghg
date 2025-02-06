/* Initialize DataTable when document is ready */
$(document).ready(function () {
    buildTable('#StudentTable')
})

/* 
 * Build DataTable with custom configuration
 * @param {string} tableID - The ID selector of the table to initialize
 */
function buildTable(tableID) {
    //initialize datatable with custom settings
    $(tableID).DataTable({
        // Add wrapper for horizontal scrolling
        "initComplete": function (settings, json) {
            $(tableID).wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");
        },
        // Enable vertical scrolling collapse
        "scrollCollapse": true,
        // Custom pagination icons using Font Awesome
        language: {
            paginate: {
                next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
            }
        }
    })
}

// ########################################
// Student CRUD Operations

/**
 * Delete Student Event Handler
 * Handles click events on delete student buttons
 * Sends AJAX request to delete student after confirmation
 */
$(document).on('click', '.deleteStudentBtn', async function (e) {
    e.preventDefault();

    if(confirm('Are you sure you want to delete this data?')){
        var student_id = $(this).val();
        // Send DELETE request to student controller
        $.ajax({
            type: "POST",
            url: "includes/controllers/student_controller.php",
            data: {
                'delete_student': true,
                'student_id': student_id
            },
            success: function (response) {
                var res = jQuery.parseJSON(response);
                
                // Handle error response
                if(res.status == 500) {
                    alert(res.message);
                } else {
                    // Show success toast notification
                    $('.toast-container').empty()
                    var toastr = `
                    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="6000">
                            <div class="toast-header">
                                <span class="bg-primary px-2 rounded">&nbsp;</span>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                ${res.message}
                            </div>
                        </div>
                    `
                    $('.toast-container').append(toastr);
                    $('.toast').toast('show');

                    // Refresh table and redirect after successful deletion
                    $('#StudentTable').load(location.href + " #StudentTable");
                    setTimeout(function(){ window.location="admin-managestudent.php";}, 2000);
                }
            }
        });
    }
});

/**
 * Edit Student Event Handler
 * Handles click events on edit student buttons
 * Fetches student data and populates edit modal
 */
$(document).on('click', '.editStudentBtn', function () {
    var student_id = $(this).val();
    // Fetch student data from controller
    $.ajax({
        type: "GET",
        url: "includes/controllers/student_controller.php?student_id=" + student_id,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            
            // Handle error response
            if(res.status == 404) {
                alert(res.message);
            } 
            // Populate edit modal with student data
            else if(res.status == 200){
                // Set form field values
                document.getElementById("editStudent-dob").value = res.data.dob;
                document.getElementById("editStudent-gender").value = res.data.gender;
                document.getElementById("editStudent-race").value = res.data.race;
                $('#editStudent-ic').val(res.data.ic);
                $('#editStudent-name').val(res.data.name);
                $('#editStudent-contact').val(res.data.contact);
                $('#editStudent-emergencycontact').val(res.data.emergencycontact);
                $('#editStudent-email').val(res.data.email);
                $('#editStudent-profile_pic').val(res.data.profile_pic);
                $('#editStudent-password').val(res.data.password);
                
                // Make IC field readonly and show modal
                document.getElementById("editStudent-ic").readOnly = true;
                $('#editStudentModal').modal('show');
            }
        }
    });
});


