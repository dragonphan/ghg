/* Initialize DataTable when document is ready */
$(document).ready(function () {
    buildTable('#AdminTable')
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
// Admin CRUD Operations

/**
 * Delete Admin Event Handler
 * Handles click events on delete admin buttons
 * Sends AJAX request to delete admin after confirmation
 */
$(document).on('click', '.deleteAdminBtn', async function (e) {
    e.preventDefault();

    if(confirm('Are you sure you want to delete this data?')){
        var admin_id = $(this).val();
        // Send DELETE request to admin controller
        $.ajax({
            type: "POST",
            url: "includes/controllers/admin_controller.php",
            data: {
                'delete_admin': true,
                'admin_id': admin_id
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
                    $('#AdminTable').load(location.href + " #AdminTable");
                    setTimeout(function(){ window.location="admin-manageadmin.php";}, 2000);
                }
            }
        });
    }
});

/**
 * Edit Admin Event Handler
 * Handles click events on edit admin buttons
 * Fetches admin data and populates edit modal
 */
$(document).on('click', '.editAdminBtn', function () {
    var admin_id = $(this).val();
    // Fetch admin data from controller
    $.ajax({
        type: "GET",
        url: "includes/controllers/admin_controller.php?admin_id=" + admin_id,
        success: function (response) {
            var res = jQuery.parseJSON(response);
            
            // Handle error response
            if(res.status == 404) {
                alert(res.message);
            } 
            // Populate edit modal with admin data
            else if(res.status == 200){
                // Set form field values
                document.getElementById("editAdmin-dob").value = res.data.dob;
                document.getElementById("editAdmin-gender").value = res.data.gender;
                document.getElementById("editAdmin-race").value = res.data.race;
                $('#editAdmin-ic').val(res.data.ic);
                $('#editAdmin-name').val(res.data.name);
                $('#editAdmin-contact').val(res.data.contact);
                $('#editAdmin-email').val(res.data.email);
                $('#editAdmin-profile_pic').val(res.data.profile_pic);
                $('#editAdmin-password').val(res.data.password);
                
                // Make IC field readonly and show modal
                document.getElementById("editAdmin-ic").readOnly = true;
                $('#editAdminModal').modal('show');
            }
        }
    });
});


