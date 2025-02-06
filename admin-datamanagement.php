<?php 
// Set page title and include header
$pageTitle = "Data Management";
include 'includes/admin-header.php';
?>
    <!-- Main Container for Sensor Data -->
    <div class="col-12 mycontainer mt-4" style='overflow-x:auto; width:100%;position:relative;'>
        <!-- Page Title -->
        <h2 class="text-decoration-none fs-1 mydarkgreen text-center">Latest Sensor Data</h2>

        <!-- Refresh Button Container -->
        <div class="col-12 col-md-4 inline">
            <button class="btn btn-primary" onClick="window.location.reload();">Refresh Page</button>
        </div>
        
        <!-- Sensor Data Table -->
        <table class="table" style="width: 100%; border-collapse: collapse;">
            <!-- Table Headers -->
            <thead>
                <tr>
                    <th style="text-align: center; vertical-align: middle; width: 20%;">Date</th>
                    <th style="text-align: center; vertical-align: middle; width: 20%;">Time</th>
                    <th style="text-align: center; vertical-align: middle;">Temperature</th>
                    <th style="text-align: center; vertical-align: middle;">Humidity</th>
                    <th style="text-align: center; vertical-align: middle;">Methane</th>
                    <th style="text-align: center; vertical-align: middle;">Carbon Dioxide</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query to fetch all arduino data ordered by ID in descending order
                $query = mysqli_query($con, "SELECT * FROM arduino_data ORDER BY ID DESC");

                // Check if data exists
                if(mysqli_num_rows($query) > 0)
                {
                    // Loop through each row of data
                    foreach($query as $arduino_data)
                    {
                        // Format date and time from timestamp
                        $Date = date('Y-m-d', strtotime($arduino_data['Date_Time']));
                        $Time = date('H:i:s', strtotime($arduino_data['Date_Time']));
                        // Get sensor readings
                        $Temperature = $arduino_data['Temperature'];
                        $Humidity = $arduino_data['Humidity'];
                        $Methane = $arduino_data['Methane'];
                        $Carbon_dioxide = $arduino_data['Carbon_dioxide'];
                ?>
                        <!-- Display sensor data in table row -->
                        <tr>
                            <td style="text-align: center; vertical-align: middle;"><?= $Date ?></td>
                            <td style="text-align: center; vertical-align: middle;"><?= $Time ?></td>
                            <td style="text-align: center; vertical-align: middle;"><?= $Temperature ?></td>
                            <td style="text-align: center; vertical-align: middle;"><?= $Humidity ?></td>
                            <td style="text-align: center; vertical-align: middle;"><?= $Methane ?></td>
                            <td style="text-align: center; vertical-align: middle;"><?= $Carbon_dioxide ?></td>
                        </tr>
                <?php
                    }
                } else {
                    // Display message if no data is available
                    echo "<td>You do not have any data at the moment</td>";
                }
                ?>
            </tbody>
        </table>
    </div>

<?php 
// Include footer
include 'includes/admin-footer.php';
?>
