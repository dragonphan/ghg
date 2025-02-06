function displaySelectedSensor() {
    var selectedSensorElement = document.getElementById("selectedSensor");
    var sensorSelectElement = document.getElementById("sensorSelect");
    var iframeElement = document.getElementById("sensorIframe");

           // Check if the 'Choose a sensor' option is selected or if no option is selected
    if (sensorSelectElement.selectedIndex === 0 || !sensorSelectElement.value) {
        $('#alertModal').modal('show');
        selectedSensorElement.textContent = "None"; // Reset the text to "None" or any placeholder text you prefer
        iframeElement.src = ""; // Reset the iframe src to empty or a default page
        return; // Prevent the function from proceeding further
    }

    var selectedSensor = sensorSelectElement.options[sensorSelectElement.selectedIndex].text;

    selectedSensorElement.textContent = selectedSensor;

    // Update iframe src based on the selected sensor
    switch (selectedSensor) {
        case "Carbon Dioxide":
            iframeElement.src = "https://app.powerbi.com/view?r=eyJrIjoiZWVkYzQ3ZjItNDk4ZC00MThmLWIwZGYtNGNlYmJlNmQwOGIyIiwidCI6IjI4YzZkZjUyLWIzMTItNDQ0Mi1hZjU5LTIwNzI1OGJmNjRhYiIsImMiOjEwfQ%3D%3D";
            break;
        case "Air Temperature":
            iframeElement.src = "https://app.powerbi.com/view?r=eyJrIjoiN2ViYTk3NDAtZWM2OS00MDJhLTk1MDItYTY5ZTg5MGNkZDA2IiwidCI6IjI4YzZkZjUyLWIzMTItNDQ0Mi1hZjU5LTIwNzI1OGJmNjRhYiIsImMiOjEwfQ%3D%3D";
            break;
        case "Humidity":
            iframeElement.src = "https://app.powerbi.com/view?r=eyJrIjoiYTQ0OGEzZjYtYmZiZC00OGMzLTg5OTgtYzlhNjNiYTc2MGQyIiwidCI6IjI4YzZkZjUyLWIzMTItNDQ0Mi1hZjU5LTIwNzI1OGJmNjRhYiIsImMiOjEwfQ%3D%3D";
            break;
        case "Methane":
            iframeElement.src = "https://app.powerbi.com/view?r=eyJrIjoiZTM0MWJjOTgtOGRjNy00ZTYwLTk2YWYtNTE3MjgyZTExNTE3IiwidCI6IjI4YzZkZjUyLWIzMTItNDQ0Mi1hZjU5LTIwNzI1OGJmNjRhYiIsImMiOjEwfQ%3D%3D";
            break;
        default:
            // Set a default or handle other cases accordingly
            break;
    }
}


