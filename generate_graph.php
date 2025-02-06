<?php
// Include required configuration and library files
include 'config/config.php';
require 'vendor/jpgraph-4.4.2/src/jpgraph.php';
require 'vendor/jpgraph-4.4.2/src/jpgraph_line.php';
require 'vendor/jpgraph-4.4.2/src/jpgraph_date.php';
require 'vendor/fpdf/fpdf.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

class GraphGenerator {
    private $con; // Database connection object
    
    public function __construct($con) {
        $this->con = $con;
    }

    public function generateAreaGraph($sensor_name, $start_date, $end_date, $output_format) {
        // Map user-friendly sensor names to database columns and units
        $sensor_map = [
            'Air_Temperature' => ['column' => 'Temperature', 'unit' => 'Temperature (°C)'],
            'Humidity' => ['column' => 'Humidity', 'unit' => 'Humidity (%)'],
            'Methane' => ['column' => 'Methane', 'unit' => 'Methane (ppm)'],
            'Carbon_dioxide' => ['column' => 'Carbon_dioxide', 'unit' => 'Carbon Dioxide (ppm)']
        ];

        // Validate sensor name
        if (!array_key_exists($sensor_name, $sensor_map)) {
            die("Error: Invalid sensor name.");
        }
        
        // Get column name and unit from sensor map
        $column_name = $sensor_map[$sensor_name]['column'];
        $unit = $sensor_map[$sensor_name]['unit'];
        $end_date .= ' 23:59:59';
        $start_date .= ' 00:00:00';

        // Fetch data from database
        $query = "SELECT UNIX_TIMESTAMP(Date_Time) as timestamp, $column_name as value 
                 FROM arduino_data 
                 WHERE Date_Time BETWEEN ? AND ? 
                 ORDER BY Date_Time";
        
        // Prepare and execute query
        $stmt = $this->con->prepare($query);
        $stmt->bind_param('ss', $start_date, $end_date);
        $stmt->execute();
        $result = $stmt->get_result();

        // Process query results
        $dates = array();
        $values = array();

        while ($row = $result->fetch_assoc()) {
            $dates[] = $row['timestamp'];
            $values[] = (float)$row['value'];
        }

        // Check if data exists
        if (empty($values)) {
            die("No data available for the selected date range.");
        }

        // Create the graph object
        $graph = new Graph(800, 400);
        $graph->SetMargin(80, 80, 40, 140);
        
        // Use datlin scale for date/linear plotting
        $graph->SetScale('datlin');
        
        // Basic graph settings
        $graph->SetFrame(false); // Remove frame
        $graph->SetBox(true); // Add box around plot area
        
        // Configure graph title
        $graph->title->Set("$sensor_name Readings");
        $graph->title->SetFont(FF_VERDANA, FS_NORMAL, 14);
        
        // Configure Y-axis
        $graph->yaxis->title->Set($unit);
        $graph->yaxis->title->SetFont(FF_VERDANA, FS_NORMAL, 11);
        $graph->yaxis->SetTitleMargin(45);
        $graph->yaxis->SetFont(FF_VERDANA, FS_NORMAL, 9);
        $graph->yaxis->SetColor('black');
        
        // Configure X-axis
        $graph->xaxis->SetLabelAngle(60);
        $graph->xaxis->SetFont(FF_VERDANA, FS_NORMAL, 9);
        $graph->xaxis->SetColor('black');
        
        // Set date format based on time span
        $timespan = max($dates) - min($dates);
        if ($timespan > SECPERDAY) {
            $graph->xaxis->scale->SetDateFormat('Y-m-d H:i');
        } else {
            $graph->xaxis->scale->SetDateFormat('H:i');
        }

        // Configure grid
        $graph->ygrid->SetFill(true, '#EFEFEF@0.5', '#FFFFFF@0.5');
        $graph->ygrid->Show(true, false);

        // Create and configure line plot
        $lineplot = new LinePlot($values, $dates);
        $lineplot->SetColor('blue');
        $lineplot->SetFillColor('lightblue@0.5');
        $lineplot->SetWeight(2);

        // Add plot to graph
        $graph->Add($lineplot);

        // Handle output format
        if ($output_format === 'pdf') {
            // Clear output buffers
            while (ob_get_level()) {
                ob_end_clean();
            }

            // Create temp directory if needed
            if (!file_exists('temp_graphs')) {
                mkdir('temp_graphs', 0777, true);
            }

            // Generate temporary PNG file
            $tempPng = 'temp_graphs/temp_' . uniqid() . '.png';
            $graph->Stroke($tempPng);

            // Create PDF with graph
            $pdf = new FPDF('L');
            $pdf->AddPage();
            $pdf->Image($tempPng, 10, 10, 280);
            
            // Output PDF
            $pdf->Output('D', 'sensor_graph.pdf');
            
            // Clean up temporary file
            if (file_exists($tempPng)) {
                unlink($tempPng);
            }
        } else {
            // Output graph directly to screen
            if (ob_get_length()) ob_clean();
            header('Content-Type: image/png');
            $graph->Stroke();
        }
    }
}

// Handle form submission
if (isset($_POST['generategraph_btn'])) {
    // Create temp directory if needed
    if (!file_exists('temp_graphs')) {
        mkdir('temp_graphs', 0777, true);
    }

    // Get form data
    $sensorName = $_POST['sensor-name'];
    $start_date = $_POST['graph-startdate'];
    $end_date = $_POST['graph-enddate'];
    $output_format = $_POST['output_format'] ?? 'screen';

    // Generate graph
    $graphGenerator = new GraphGenerator($con);
    $graphGenerator->generateAreaGraph($sensorName, $start_date, $end_date, $output_format);
}
?>