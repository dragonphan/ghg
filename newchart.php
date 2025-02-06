<?php  
$pageTitle = "Arduino Charts";
include 'includes/student-header.php';

// Initialize an empty array to store the data
$data = array(); 

// Query to fetch all sensor data from database
$query = "SELECT Date_Time, Temperature, Humidity, Methane, Carbon_dioxide FROM arduino_data";
$result = mysqli_query($con, $query);

// Store query results in data array
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Initialize arrays for each sensor type
$Date_Time = array();
$Temperature = array();
$Humidity = array();
$Methane = array();
$Carbon_dioxide = array();

// Separate data into individual arrays for each sensor
foreach ($data as $row) {
    $Date_Time[] = $row['Date_Time'];
    $Temperature[] = $row['Temperature'];
    $Humidity[] = $row['Humidity'];
    $Methane[] = $row['Methane'];
    $Carbon_dioxide[] = $row['Carbon_dioxide'];
}

// Convert the arrays to JSON format for Chart.js
$Date_Time_json = json_encode($Date_Time);
$Temperature_json = json_encode($Temperature);
$Humidity_json = json_encode($Humidity);
$Methane_json = json_encode($Methane);
$Carbon_dioxide_json = json_encode($Carbon_dioxide);
?>

<!-- Auto-refresh page every 10 seconds -->
<meta http-equiv="refresh" content="10">

<div class="container mt-4">
    <!-- Min/Max Cards Section -->
    <div class="row mb-4">
        <div class="col-12 mycontainer">
            <div class="row">
                <!-- Maximum Values Card -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header text-white" style="background-color: #277927;">
                            <h5 class="card-title mb-0 text-white">Maximum Values</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Temperature and Humidity Max Values -->
                                <div class="col-6">
                                    <p><strong>Temperature:</strong> <?php echo max($Temperature); ?>°C</p>
                                    <p><strong>Humidity:</strong> <?php echo max($Humidity); ?>%</p>
                                </div>
                                <!-- Gas Levels Max Values -->
                                <div class="col-6">
                                    <p><strong>Methane:</strong> <?php echo max($Methane); ?> ppm</p>
                                    <p><strong>CO2:</strong> <?php echo max($Carbon_dioxide); ?> ppm</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Minimum Values Card -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header text-white" style="background-color: #277927;">
                            <h5 class="card-title mb-0 text-white">Minimum Values</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Temperature and Humidity Min Values -->
                                <div class="col-6">
                                    <p><strong>Temperature:</strong> <?php echo min($Temperature); ?>°C</p>
                                    <p><strong>Humidity:</strong> <?php echo min($Humidity); ?>%</p>
                                </div>
                                <!-- Gas Levels Min Values -->
                                <div class="col-6">
                                    <p><strong>Methane:</strong> <?php echo min($Methane); ?> ppm</p>
                                    <p><strong>CO2:</strong> <?php echo min($Carbon_dioxide); ?> ppm</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <!-- Temperature Chart -->
    <div class="row">
        <div class="col-12 mycontainer">
            <h3>Graph of Temperature VS Time</h3>
            <div class="scrollable-graph" style="overflow-x:auto;">
                <canvas id="itemChart1" width="1200" height="400"></canvas>
            </div>
        </div>
    </div>

    <!-- Humidity Chart -->
    <div class="row mt-4">
        <div class="col-12 mycontainer">
            <h3>Graph of Humidity VS Time</h3>
            <div class="scrollable-graph" style="overflow-x:auto;">
                <canvas id="itemChart2" width="1200" height="400"></canvas>
            </div>
        </div>
    </div>

    <!-- Methane Chart -->
    <div class="row mt-4">
        <div class="col-12 mycontainer">
            <h3>Graph of Methane VS Time</h3>
            <div class="scrollable-graph" style="overflow-x:auto;">
                <canvas id="itemChart3" width="1200" height="400"></canvas>
            </div>
        </div>
    </div>

    <!-- Carbon Dioxide Chart -->
    <div class="row mt-4">
        <div class="col-12 mycontainer">
            <h3>Graph of Carbon Dioxide VS Time</h3>
            <div class="scrollable-graph" style="overflow-x:auto;">
                <canvas id="itemChart4" width="1200" height="400"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Chart.js Zoom Plugin -->
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@latest"></script>

<!-- Chart Configuration Script -->
<script>
// Get PHP data as JavaScript variables
var Date_Time = <?php echo $Date_Time_json; ?>;
var Temperature = <?php echo $Temperature_json; ?>;
var Humidity = <?php echo $Humidity_json; ?>;
var Methane = <?php echo $Methane_json; ?>;
var Carbon_dioxide = <?php echo $Carbon_dioxide_json; ?>;

// Function to create charts with common configuration
function createChart(ctx, label, data, borderColor) {
    return new Chart(ctx, {
        type: 'line',
        data: {
            labels: Date_Time,
            datasets: [{
                label: label,
                data: data,
                borderColor: borderColor,
                tension: 0.1
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio: false,
            plugins: {
                zoom: {
                    pan: {
                        enabled: true,
                        mode: 'xy',
                    },
                    zoom: {
                        enabled: true,
                        mode: 'xy',
                        wheel: {
                            enabled: true
                        },
                        pinch: {
                            enabled: true
                        },
                    }
                }
            }
        }
    });
}

// Create individual charts
var ctx1 = document.getElementById('itemChart1').getContext('2d');
createChart(ctx1, 'Temperature', Temperature, 'rgba(75, 192, 192)');

var ctx2 = document.getElementById('itemChart2').getContext('2d');
createChart(ctx2, 'Humidity', Humidity, 'rgba(255, 0, 0)');

var ctx3 = document.getElementById('itemChart3').getContext('2d');
createChart(ctx3, 'Methane', Methane, 'rgba(76, 0, 153)');

var ctx4 = document.getElementById('itemChart4').getContext('2d');
createChart(ctx4, 'Carbon Dioxide', Carbon_dioxide, 'rgba(0, 128, 0)');
</script>

<!-- Engati Chatbot Integration -->
<script>
    (function(e,t,a){
        var c = e.head || e.getElementsByTagName("head")[0], 
            n = e.createElement("script"); 
        n.async = !0, 
        n.defer = !0, 
        n.type = "text/javascript", 
        n.src = t + "/static/js/widget.js?config=" + JSON.stringify(a), 
        c.appendChild(n)
    })(document,"https://app.engati.com",{
        bot_key:"b4e206a30d39493b", 
        welcome_msg:true, 
        branding_key:"default", 
        server:"https://app.engati.com", 
        e:"p"
    });
</script>

<?php include 'includes/student-footer.php'; ?>
