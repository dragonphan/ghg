// ########################################
// Navigation Menu Active State Handler

/**
 * Sets active state for current navigation menu item
 * Compares current URL with menu item links
 */
const currentLocation = location.href;
console.log('currentlocation = '+currentLocation);
const menuItem = document.querySelectorAll('.menu_a');
const menuLength = menuItem.length;
for(let i = 0; i< menuLength; i++){
    menuItem[i].classList.remove("active");
    if(menuItem[i].href === currentLocation){
        menuItem[i].className += " active";
    }
}

// Sweet alert
function showAlert(title,messageBody,type){
    Swal.fire(
        title,
        messageBody,
        type
      )
}

// Countdown toast
function showSweetToast(icon,title){
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      });
      
      Toast.fire({
        icon: icon,
        title: title
      });
}

// ########################################
// MD5 Encryption

/********************** MD5 Encrypt Function in JS **********************/ 
function md5(inputString) {
  // [MD5 function code here...]
}
/********************** END MD5 Function in JS **********************/ 

// ########################################
// City Search Autocomplete

/**
 * Event listener for city search input
 * Fetches city suggestions from OpenWeatherMap API
 */
const searchInput = document.querySelector('.search-bar');
searchInput.addEventListener('input', function() {
    let query = searchInput.value;
    // Only fetch suggestions if query is longer than 2 characters
    if (query.length > 2) {
        fetch(`https://api.openweathermap.org/geo/1.0/direct?q=${query}&limit=5&appid=YOUR_API_KEY`)
        .then(response => response.json())
        .then(data => {
            let suggestions = data.map(city => `${city.name}, ${city.country}`);
            showSuggestions(suggestions);
        })
        .catch(error => console.error('Error fetching city suggestions:', error));
    }
});

function showSuggestions(suggestions) {
    // Clear existing suggestions
    const suggestionBox = document.querySelector('.suggestions');
    suggestionBox.innerHTML = '';

    // Add new suggestions
    suggestions.forEach(suggestion => {
        const suggestionItem = document.createElement('div');
        suggestionItem.classList.add('suggestion-item');
        suggestionItem.textContent = suggestion;
        // Handle suggestion click
        suggestionItem.addEventListener('click', () => {
            searchInput.value = suggestion;
            suggestionBox.innerHTML = '';
        });
        suggestionBox.appendChild(suggestionItem);
    });
}

// Initialize suggestion box container
const searchContainer = document.querySelector('.search');
const suggestionBox = document.createElement('div');
suggestionBox.classList.add('suggestions');
searchContainer.appendChild(suggestionBox);
