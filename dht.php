<?php
class arduino_data {
    // Database connection property
    public $link = '';

    // Constructor now accepts a fourth parameter for carbon_dioxide
    function __construct($temperature, $humidity, $methane, $carbon_dioxide) {
        $this->connect();
        $this->storeInDB($temperature, $humidity, $methane, $carbon_dioxide);
    }
    
    /**
     * Establishes database connection
     * Connects to MySQL database using specified credentials
     */
    function connect() {
        $this->link = mysqli_connect('localhost', 'root', '123') or die('Cannot connect to the DB');
        mysqli_select_db($this->link, 'ghg') or die('Cannot select the DB');
    }
    
    // Modified storeInDB function to include carbon_dioxide
    function storeInDB($temperature, $humidity, $methane, $carbon_dioxide) {
        $query = "INSERT INTO arduino_data (humidity, temperature, methane, Carbon_dioxide) VALUES ('" . $humidity . "', '" . $temperature . "', '" . $methane . "', '" . $carbon_dioxide . "')";
        $result = mysqli_query($this->link, $query) or die('Errant query:  ' . $query);
    }
}

// Check if all required sensor parameters are present
if (isset($_GET['temperature']) && $_GET['temperature'] != '' &&
    isset($_GET['humidity']) && $_GET['humidity'] != '' &&
    isset($_GET['methane']) && $_GET['methane'] != '' &&
    isset($_GET['carbon_dioxide']) && $_GET['carbon_dioxide'] != '') {

    // Create new arduino_data object with sensor readings
    $arduino_data = new arduino_data($_GET['temperature'], $_GET['humidity'], $_GET['methane'], $_GET['carbon_dioxide']);
}
?>
