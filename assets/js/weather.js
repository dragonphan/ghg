/**
 * Weather object to handle OpenWeatherMap API interactions
 * and display weather information
 */
let weather = {
    // OpenWeatherMap API key
    "cityApiKey": "3b15d8ce3f661fd99ab639e77d08549d",


    fetchWeatherByCity: function(city) {
        // Make API call to OpenWeatherMap
        fetch(`https://api.openweathermap.org/data/2.5/weather?q=${city}&units=metric&appid=${this.cityApiKey}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(data => this.displayCityWeather(data))
            .catch(error => {
                console.error('Error fetching city data:', error);
                alert("Could not fetch weather data. Please try again.");
            });
    },

    displayCityWeather: function(data) {
        // Handle city not found error
        if (data.cod === "404") {
            document.querySelector(".weather .city").innerText = "City not found";
            alert("City not found. Please enter a valid city name.");
            return;
        }

        // Destructure weather data from API response
        const { name } = data;
        const { icon, description } = data.weather[0];
        const { temp, humidity, pressure } = data.main;
        const { speed } = data.wind;
        const { visibility } = data;
        const { all: cloudiness } = data.clouds;
        const { country } = data.sys;
        // Convert Unix timestamps to readable time
        const sunrise = new Date(data.sys.sunrise * 1000).toLocaleTimeString();
        const sunset = new Date(data.sys.sunset * 1000).toLocaleTimeString();

        // Update UI elements with weather data
        document.querySelector(".weather .city").innerText = "Weather in " + name + ", " + country;
        document.querySelector(".weather .icon").src = "http://openweathermap.org/img/wn/" + icon + ".png";
        document.querySelector(".weather .description").innerText = description;
        document.querySelector(".weather .temp").innerHTML = temp + "&deg;C";
        document.querySelector(".weather .humidity").innerText = "Humidity: " + humidity + "%";
        document.querySelector(".weather .pressure").innerText = "Pressure: " + pressure + " hPa";
        document.querySelector(".weather .wind").innerText = "Wind Speed: " + speed + " km/hr";
        document.querySelector(".weather .visibility").innerText = "Visibility: " + (visibility / 1000) + " km";
        document.querySelector(".weather .cloudiness").innerText = "Cloudiness: " + cloudiness + "%";
        document.querySelector(".weather .sunrise").innerText = "Sunrise: " + sunrise;
        document.querySelector(".weather .sunset").innerText = "Sunset: " + sunset;

        // Remove loading state
        document.querySelector(".weather").classList.remove("loading");
    },

    /**
     * Initiates weather search based on selected city
     * Validates city selection before making API call
     */
    search: function() {
        const selectedValue = document.querySelector(".search-dropdown").value;

        if (selectedValue) {
            this.fetchWeatherByCity(selectedValue);
        } else {
            alert("Please select a city name, country name.");
        }
    }
};

// Event listener for search button click
document.querySelector(".search button").addEventListener("click", function() {
    weather.search();
});
