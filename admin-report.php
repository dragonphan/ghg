<?php 
// Set page title and include header
$pageTitle = "Admin Report";
include 'includes/admin-header.php';
?>

<!-- First Container - Generate Report -->
<div class="col-12 mycontainer mb-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0">
                <div class="card-body">
                    <h2>Generate Report</h2>
                    <h6 class="mb-3 text-black-50">Generate reports in PDF Format.</h6>

                    <!-- Report Generation Form -->
                    <form action="generate_passPDF.php" method="POST" class="GeneratePDFForm" onsubmit="return validateForm('date1', 'date2');">
                        <!-- Sensor Selection Section -->
                        <h4>Sensor Details</h4>
                        <div class="mb-3 sensorName">
                            <select id="sensorSelect" class="form-select" aria-label="Choose a sensor" name="sensor-name" required>
                                <option value="" selected disabled>Choose a sensor</option>
                                <option value="Air_Temperature">Air Temperature</option>
                                <option value="Humidity">Humidity</option>
                                <option value="Methane">Methane</option>
                                <option value="Carbon_dioxide">Carbon Dioxide</option>
                            </select>
                        </div>

                        <!-- Date Range Selection Section -->
                        <h4 class="mt-4">Choose Range of Date and Time</h4>
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-auto">
                                    <h6>Start Date:</h6>
                                    <input required type="date" class="form-control w-40" id="date1" name="report-startdate">
                                </div>
                                <div class="col-auto">
                                    <h6>End Date:</h6>
                                    <input required type="date" class="form-control w-40" id="date2" name="report-enddate">
                                </div>
                            </div>
                        </div>

                        <!-- Form Submission Section -->
                        <h6 class="mb-3 text-black-50">Please check whether the details are correct.</h6>
                        <input type="submit" class="me-lg-3 btn btn-primary" name="generatepdf_btn" value="Generate Report">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Second Container - Generate Graph -->
<div class="col-12 mycontainer">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0">
                <div class="card-body">
                    <h2>Generate Graph</h2>
                    <h6 class="mb-3 text-black-50">Generate sensor data visualization.</h6>

                    <!-- Graph Generation Form -->
                    <form action="generate_graph.php" method="POST" class="GenerateGraphForm" onsubmit="return validateForm('graphDate1', 'graphDate2');">
                        <!-- Sensor Selection Section -->
                        <h4>Sensor Details</h4>
                        <div class="mb-3 sensorName">
                            <select id="graphSensorSelect" class="form-select" aria-label="Choose a sensor" name="sensor-name" required>
                                <option value="" selected disabled>Choose a sensor</option>
                                <option value="Air_Temperature">Air Temperature</option>
                                <option value="Humidity">Humidity</option>
                                <option value="Methane">Methane</option>
                                <option value="Carbon_dioxide">Carbon Dioxide</option>
                            </select>
                        </div>

                        <!-- Date Range Selection Section -->
                        <h4 class="mt-4">Choose Range of Date and Time</h4>
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-auto">
                                    <h6>Start Date:</h6>
                                    <input required type="date" class="form-control w-40" id="graphDate1" name="graph-startdate">
                                </div>
                                <div class="col-auto">
                                    <h6>End Date:</h6>
                                    <input required type="date" class="form-control w-40" id="graphDate2" name="graph-enddate">
                                </div>
                            </div>
                        </div>

                        <!-- Output Format Selection Section -->
                        <h4 class="mt-4">Choose Output Format</h4>
                        <div class="mb-3">
                            <select class="form-select" name="output_format" required>
                                <option value="screen">View Graph on Screen</option>
                                <option value="pdf">Download as PDF</option>
                            </select>
                        </div>

                        <!-- Form Submission Section -->
                        <h6 class="mb-3 text-black-50">Please check whether the details are correct.</h6>
                        <input type="submit" class="me-lg-3 btn btn-primary" name="generategraph_btn" value="Generate Graph">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Date Validation Script -->
<script>
// Function to validate that start date is not later than end date
function validateForm(startDateId, endDateId) {
    const startDate = document.getElementById(startDateId).value;
    const endDate = document.getElementById(endDateId).value;

    if (startDate && endDate && new Date(startDate) > new Date(endDate)) {
        alert('Start Date cannot be later than End Date.');
        return false;
    }
    return true;
}
</script>

<?php 
// Include footer
include 'includes/admin-footer.php';
?>
