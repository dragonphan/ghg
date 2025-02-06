<?php
// Include required configuration and library files
include 'config/config.php';
require 'vendor/fpdf/fpdf.php';

class PDF extends FPDF {
    /**
     * Page header
     * Adds logo and title to each page
     */
    function Header() {
        // Add logo image
        $this->Image('assets/images/ghgmonitoring3.png', 10, 4, 33);
        // Set font for title
        $this->SetFont('Arial', 'B', 20);
        $this->Cell(80);
        // Add report title
        $this->Cell(50, 10, 'GreenHouse Gas Data Emission Report', 0, 0, 'C');
        $this->Ln(20);
    }
    
    /**
     * Page footer
     * Adds page numbers to each page
     */
    function Footer() {
        // Position footer at 15mm from bottom
        $this->SetY(-15);
        // Set font for footer
        $this->SetFont('Arial', 'I', 8);
        // Add page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    public function generatePDF($sensor_name, $start_date, $end_date, $con) {
        // Map user-friendly sensor names to the actual database column names
        $sensor_map = [
            'Air_Temperature' => 'Temperature',
            'Humidity' => 'Humidity',
            'Methane' => 'Methane',
            'Carbon_dioxide' => 'Carbon_dioxide'
        ];

        // Convert the friendly name to the column name
        if (!array_key_exists($sensor_name, $sensor_map)) {
            die("Error: Invalid sensor name.");
        }
        $column_name = $sensor_map[$sensor_name];

        // Adjust the end date for the query to include the full end date
        $end_date .= ' 23:59:59';
        $start_date .= ' 00:00:00';

        // Prepare the SQL query to fetch sensor data
        if ($stmt = $con->prepare("SELECT `Date_Time`, `$column_name` FROM arduino_data WHERE `Date_Time` BETWEEN ? AND ?")) {
            $stmt->bind_param('ss', $start_date, $end_date);
            $stmt->execute();
            $result = $stmt->get_result();
            
            // Store query results
            $sensor_data = array();
            while ($row = $result->fetch_assoc()) {
                $sensor_data[] = $row;
            }

            // Start generating the PDF
            $pdf = new PDF();
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->SetFont('Arial', '', 12);

            // Handle case when no data is available
            if (empty($sensor_data)) {
                $pdf->Cell(0, 10, 'Sorry, no data available for the provided date range.', 0, 1, 'C');
            } else {
                // Display table headers
                $pdf->Cell(70, 10, 'Date and Time', 1, 0, 'C');
                $pdf->Cell(105, 10, $sensor_name, 1, 1, 'C');

                // Display the sensor data
                foreach ($sensor_data as $row) {
                    $pdf->Cell(70, 10, $row['Date_Time'], 1, 0, 'C');
                    $pdf->Cell(105, 10, $row[$column_name], 1, 1, 'C');
                }
            }

            // Add confidentiality notice
            $pdf->Ln();
            $pdf->Cell(0, 10, "The report generated is confidential.", 0, 1, 'C');
            $pdf->Cell(0, 10, "All the information rights belong to GHG MONITOR UMS", 0, 1, 'C');

            // Output the PDF to download
            $pdf->Output('D', 'Sensor_Report.pdf');
        } else {
            echo "Error preparing statement: " . $con->error;
        }
    }
}

// Check if form is submitted and generate PDF
if (isset($_POST['generatepdf_btn'])) {
    $sensorName = $_POST['sensor-name'];
    $start_date = $_POST['report-startdate'];
    $end_date = $_POST['report-enddate'];

    $pdf = new PDF();
    $pdf->generatePDF($sensorName, $start_date, $end_date, $con);
}
?>
