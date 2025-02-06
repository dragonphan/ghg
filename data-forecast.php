<?php 
// Set page title and include header
$pageTitle = "Data Forecast";
include 'includes/student-header.php';
?>

    <!-- GHG Graphs Container -->
    <div class="col-lg-12">
        <div class="mycontainer">

            <!-- Start View GHG data Bar -->
            <div class="row d-flex align-items-center">

                <!-- Input group with drop-down and display area -->
                <div class="mt-3 mb-3 d-flex justify-content-center">
                    <div class="input-group w-auto">
                        <!-- Sensor Selection Dropdown -->
                        <select id="sensorSelect" class="form-select" aria-label="Choose a sensor" required>
                            <option value="" selected disabled>Choose a sensor</option>
                            <option value="sensor1">Air Temperature</option>
                            <option value="sensor2">Humidity</option>
                            <option value="sensor3">Carbon Dioxide</option>
                            <option value="sensor4">Methane</option>
                        </select>
                        <!-- Submit Button -->
                        <button class="btn btn-primary" type="button" id="button-addon1" data-mdb-ripple-color="dark" onclick="displaySelectedSensor()">
                            Submit
                        </button>
                    </div>
                </div>
            </div>

            <!-- Include Chart JavaScript -->
            <script src="assets/js/forecastchart.js"></script>

            <!-- Data Display Area -->
            <div class="mb-3 tab-content" id="myTabContent">
                <!-- Overall Cases Tab -->
                <div class="tab-pane fade show active" id="overall-tab-content" role="tabpanel" aria-labelledby="overall-tab">
                    <!-- Selected Sensor Display and Refresh Button -->
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <strong>Selected Sensor:</strong>
                            <span id="selectedSensor">None</span>
                        </div>
                        <div class="col-12 col-md-4 inline">
                            <button class="btn btn-primary" onClick="window.location.reload();">Refresh Page</button>
                        </div>
                    </div>
                    <br>
                    <br>
                    <!-- Forecast Information Note -->
                    <h6>*Do take note that the red lines and area represents the forecasted data. Only data from 24 hour (1 Day) from the previous day is forecasted.</h6>
                    <br>
                    <!-- Data Visualization iframe -->
                    <iframe id="sensorIframe" title="GHG_DATAVISUAL" width="800" height="600" src="" frameborder="0" allowFullScreen="true"></iframe>
                </div>
            </div>
            <!-- End View GHG graphs -->
        </div>
    </div>

    <!-- Engati Chat Widget Script -->
    <script>!function(e,t,a){var c=e.head||e.getElementsByTagName("head")[0],n=e.createElement("script");n.async=!0,n.defer=!0, n.type="text/javascript",n.src=t+"/static/js/widget.js?config="+JSON.stringify(a),c.appendChild(n)}(document,"https://app.engati.com",{bot_key:"b4e206a30d39493b",welcome_msg:true,branding_key:"default",server:"https://app.engati.com",e:"p" });</script>

    <!-- Custom Alert Modal -->
    <div class="modal" tabindex="-1" role="dialog" id="alertModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Please select a sensor.</p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

<?php 
// Include footer
include 'includes/student-footer.php';
?>