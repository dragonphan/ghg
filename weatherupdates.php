<?php 
// Set page title and include header file
$pageTitle = "Weather Updates";
include 'includes/student-header.php';?>

<head>
    <!-- Meta tags for character encoding and viewport -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WeatherCast</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/app_logo.png" type="image/x-icon">
    
    <!-- Google Fonts -->
    <!-- Lato font family -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&display=swap" rel="stylesheet" />
    
    <!-- Montserrat font family -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet" />
    
    <!-- Roboto font family -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" />
    
    <!-- Custom CSS and JavaScript -->
    <link rel="stylesheet" href="assets/css/weather.css" />
    <script src="assets/js/weather.js" defer></script>
</head>

<body>
    <!-- Main Weather Container -->
    <div class="myweathercontainer">
    <div class="col-18 col-lg-18 container-model mx-auto">

        <!-- Weather Search Card -->
        <div class="card">
            <!-- City Search Section -->
            <div class="search">
                <!-- Dropdown for City Selection -->
                <select class="search-dropdown">
<option value="">Select City Name, Country Name</option>

<option value="Kabul, Afghanistan">Kabul, Afghanistan</option>
<option value="Herat, Afghanistan">Herat, Afghanistan</option>
<option value="Kandahar, Afghanistan">Kandahar, Afghanistan</option>

<option value="Algiers, Algeria">Algiers, Algeria</option>
<option value="Oran, Algeria">Oran, Algeria</option>
<option value="Constantine, Algeria">Constantine, Algeria</option>

<option value="Tirana, Albania">Tirana, Albania</option>
<option value="Durres, Albania">Durres, Albania</option>
<option value="Shkoder, Albania">Shkoder, Albania</option>

<option value="Luanda, Angola">Luanda, Angola</option>
<option value="Lobito, Angola">Lobito, Angola</option>
<option value="Huambo, Angola">Huambo, Angola</option>

<option value="Buenos Aires, Argentina">Buenos Aires, Argentina</option>
<option value="Cordoba, Argentina">Cordoba, Argentina</option>
<option value="Rosario, Argentina">Rosario, Argentina</option>

<option value="Yerevan, Armenia">Yerevan, Armenia</option>
<option value="Gyumri, Armenia">Gyumri, Armenia</option>
<option value="Vanadzor, Armenia">Vanadzor, Armenia</option>

<option value="Canberra, Australia">Canberra, Australia</option>
<option value="Sydney, Australia">Sydney, Australia</option>
<option value="Melbourne, Australia">Melbourne, Australia</option>

<option value="Vienna, Austria">Vienna, Austria</option>
<option value="Graz, Austria">Graz, Austria</option>
<option value="Linz, Austria">Linz, Austria</option>

<option value="Baku, Azerbaijan">Baku, Azerbaijan</option>
<option value="Ganja, Azerbaijan">Ganja, Azerbaijan</option>
<option value="Lankaran, Azerbaijan">Lankaran, Azerbaijan</option>

<option value="Nassau, Bahamas">Nassau, Bahamas</option>
<option value="Freeport, Bahamas">Freeport, Bahamas</option>
<option value="West End, Bahamas">West End, Bahamas</option>

<option value="Manama, Bahrain">Manama, Bahrain</option>
<option value="Riffa, Bahrain">Riffa, Bahrain</option>
<option value="Muharraq, Bahrain">Muharraq, Bahrain</option>

<option value="Dhaka, Bangladesh">Dhaka, Bangladesh</option>
<option value="Chittagong, Bangladesh">Chittagong, Bangladesh</option>
<option value="Khulna, Bangladesh">Khulna, Bangladesh</option>

<option value="Bridgetown, Barbados">Bridgetown, Barbados</option>
<option value="Speightstown, Barbados">Speightstown, Barbados</option>
<option value="Oistins, Barbados">Oistins, Barbados</option>

<option value="Minsk, Belarus">Minsk, Belarus</option>
<option value="Gomel, Belarus">Gomel, Belarus</option>
<option value="Mogilev, Belarus">Mogilev, Belarus</option>

<option value="Beijing, China">Beijing, China</option>
<option value="Shanghai, China">Shanghai, China</option>
<option value="Shenzhen, China">Shenzhen, China</option>

<option value="Bogota, Colombia">Bogota, Colombia</option>
<option value="Medellin, Colombia">Medellin, Colombia</option>
<option value="Cali, Colombia">Cali, Colombia</option>

<option value="Moroni, Comoros">Moroni, Comoros</option>
<option value="Moutsamoudou, Comoros">Moutsamoudou, Comoros</option>
<option value="Domoni, Comoros">Domoni, Comoros</option>

<option value="Kinshasa, Democratic Republic of the Congo">Kinshasa, Democratic Republic of the Congo</option>
<option value="Lubumbashi, Democratic Republic of the Congo">Lubumbashi, Democratic Republic of the Congo</option>
<option value="Kananga, Democratic Republic of the Congo">Kananga, Democratic Republic of the Congo</option>

<option value="Brazzaville, Republic of the Congo">Brazzaville, Republic of the Congo</option>
<option value="Pointe Noire, Republic of the Congo">Pointe Noire, Republic of the Congo</option>
<option value="Dolisie, Republic of the Congo">Dolisie, Republic of the Congo</option>

<option value="Zagreb, Croatia">Zagreb, Croatia</option>
<option value="Split, Croatia">Split, Croatia</option>
<option value="Rijeka, Croatia">Rijeka, Croatia</option>

<option value="Havana, Cuba">Havana, Cuba</option>
<option value="Santiago de Cuba, Cuba">Santiago de Cuba, Cuba</option>
<option value="Camaguey, Cuba">Camaguey, Cuba</option>

<option value="Nicosia, Cyprus">Nicosia, Cyprus</option>
<option value="Limassol, Cyprus">Limassol, Cyprus</option>
<option value="Larnaca, Cyprus">Larnaca, Cyprus</option>

<option value="Prague, Czech Republic">Prague, Czech Republic</option>
<option value="Brno, Czech Republic">Brno, Czech Republic</option>
<option value="Ostrava, Czech Republic">Ostrava, Czech Republic</option>

<option value="Copenhagen, Denmark">Copenhagen, Denmark</option>
<option value="Aarhus, Denmark">Aarhus, Denmark</option>
<option value="Odense, Denmark">Odense, Denmark</option>

<option value="Djibouti, Djibouti">Djibouti, Djibouti</option>
<option value="Ali Sabieh, Djibouti">Ali Sabieh, Djibouti</option>
<option value="Dikhil, Djibouti">Dikhil, Djibouti</option>

<option value="Roseau, Dominica">Roseau, Dominica</option>
<option value="Portsmouth, Dominica">Portsmouth, Dominica</option>
<option value="Marigot, Dominica">Marigot, Dominica</option>

<option value="Santo Domingo, Dominican Republic">Santo Domingo, Dominican Republic</option>
<option value="Santiago, Dominican Republic">Santiago, Dominican Republic</option>
<option value="La Romana, Dominican Republic">La Romana, Dominican Republic</option>

<option value="Quito, Ecuador">Quito, Ecuador</option>
<option value="Guayaquil, Ecuador">Guayaquil, Ecuador</option>
<option value="Cuenca, Ecuador">Cuenca, Ecuador</option>

<option value="Cairo, Egypt">Cairo, Egypt</option>
<option value="Alexandria, Egypt">Alexandria, Egypt</option>
<option value="Giza, Egypt">Giza, Egypt</option>

<option value="San Salvador, El Salvador">San Salvador, El Salvador</option>
<option value="Santa Ana, El Salvador">Santa Ana, El Salvador</option>
<option value="San Miguel, El Salvador">San Miguel, El Salvador</option>

<option value="Malabo, Equatorial Guinea">Malabo, Equatorial Guinea</option>
<option value="Bata, Equatorial Guinea">Bata, Equatorial Guinea</option>
<option value="Ebebiyin, Equatorial Guinea">Ebebiyin, Equatorial Guinea</option>

<option value="Asuncion, Paraguay">Asuncion, Paraguay</option>
<option value="Ciudad del Este, Paraguay">Ciudad del Este, Paraguay</option>
<option value="Encarnacion, Paraguay">Encarnacion, Paraguay</option>

<option value="Tallinn, Estonia">Tallinn, Estonia</option>
<option value="Tartu, Estonia">Tartu, Estonia</option>
<option value="Narva, Estonia">Narva, Estonia</option>

<option value="Addis Ababa, Ethiopia">Addis Ababa, Ethiopia</option>
<option value="Dire Dawa, Ethiopia">Dire Dawa, Ethiopia</option>
<option value="Mekele, Ethiopia">Mekele, Ethiopia</option>

<option value="Suva, Fiji">Suva, Fiji</option>
<option value="Nadi, Fiji">Nadi, Fiji</option>
<option value="Lautoka, Fiji">Lautoka, Fiji</option>

<option value="Paris, France">Paris, France</option>
<option value="Marseille, France">Marseille, France</option>
<option value="Lyon, France">Lyon, France</option>

<option value="Tbilisi, Georgia">Tbilisi, Georgia</option>
<option value="Kutaisi, Georgia">Kutaisi, Georgia</option>
<option value="Zugdidi, Georgia">Zugdidi, Georgia</option>

<option value="Berlin, Germany">Berlin, Germany</option>
<option value="Munich, Germany">Munich, Germany</option>
<option value="Hamburg, Germany">Hamburg, Germany</option>

<option value="Accra, Ghana">Accra, Ghana</option>
<option value="Kumasi, Ghana">Kumasi, Ghana</option>
<option value="Tamale, Ghana">Tamale, Ghana</option>

<option value="Athens, Greece">Athens, Greece</option>
<option value="Thessaloniki, Greece">Thessaloniki, Greece</option>
<option value="Patras, Greece">Patras, Greece</option>

<option value="Guatemala City, Guatemala">Guatemala City, Guatemala</option>
<option value="Mixco, Guatemala">Mixco, Guatemala</option>
<option value="Villa Nueva, Guatemala">Villa Nueva, Guatemala</option>

<option value="Conakry, Guinea">Conakry, Guinea</option>
<option value="Nzerekore, Guinea">Nzerekore, Guinea</option>
<option value="Kindia, Guinea">Kindia, Guinea</option>

<option value="Georgetown, Guyana">Georgetown, Guyana</option>
<option value="Linden, Guyana">Linden, Guyana</option>
<option value="New Amsterdam, Guyana">New Amsterdam, Guyana</option>

<option value="Port-au-Prince, Haiti">Port-au-Prince, Haiti</option>
<option value="Cap-Haitien, Haiti">Cap-Haitien, Haiti</option>
<option value="Les Cayes, Haiti">Les Cayes, Haiti</option>

<option value="Helsinki, Finland">Helsinki, Finland</option>
<option value="Espoo, Finland">Espoo, Finland</option>
<option value="Tampere, Finland">Tampere, Finland</option>

<option value="Paris, France">Paris, France</option>
<option value="Marseille, France">Marseille, France</option>
<option value="Lyon, France">Lyon, France</option>

<option value="Yaounde, Cameroon">Yaounde, Cameroon</option>
<option value="Douala, Cameroon">Douala, Cameroon</option>
<option value="Limbe, Cameroon">Limbe, Cameroon</option>

<option value="Beirut, Lebanon">Beirut, Lebanon</option>
<option value="Tripoli, Lebanon">Tripoli, Lebanon</option>
<option value="Sidon, Lebanon">Sidon, Lebanon</option>

<option value="Kuala Lumpur, Malaysia">Kuala Lumpur, Malaysia</option>
<option value="George Town, Malaysia">George Town, Malaysia</option>
<option value="Kota Kinabalu, Malaysia">Kota Kinabalu, Malaysia</option>

<option value="Male, Maldives">Male, Maldives</option>
<option value="Addu City, Maldives">Addu City, Maldives</option>
<option value="Fuvahmulah, Maldives">Fuvahmulah, Maldives</option>

<option value="Mexico City, Mexico">Mexico City, Mexico</option>
<option value="Guadalajara, Mexico">Guadalajara, Mexico</option>
<option value="Monterrey, Mexico">Monterrey, Mexico</option>

<option value="Ulaanbaatar, Mongolia">Ulaanbaatar, Mongolia</option>
<option value="Erdenet, Mongolia">Erdenet, Mongolia</option>
<option value="Darhan, Mongolia">Darhan, Mongolia</option>

<option value="Podgorica, Montenegro">Podgorica, Montenegro</option>
<option value="Niksic, Montenegro">Niksic, Montenegro</option>
<option value="Herceg Novi, Montenegro">Herceg Novi, Montenegro</option>

<option value="Rabat, Morocco">Rabat, Morocco</option>
<option value="Casablanca, Morocco">Casablanca, Morocco</option>
<option value="Marrakesh, Morocco">Marrakesh, Morocco</option>

<option value="Maputo, Mozambique">Maputo, Mozambique</option>
<option value="Beira, Mozambique">Beira, Mozambique</option>
<option value="Nampula, Mozambique">Nampula, Mozambique</option>

<option value="Yangon, Myanmar">Yangon, Myanmar</option>
<option value="Mandalay, Myanmar">Mandalay, Myanmar</option>
<option value="Naypyidaw, Myanmar">Naypyidaw, Myanmar</option>

<option value="Manila, Philippines">Manila, Philippines</option>
<option value="Cebu City, Philippines">Cebu City, Philippines</option>
<option value="Davao City, Philippines">Davao City, Philippines</option>

<option value="Warsaw, Poland">Warsaw, Poland</option>
<option value="Krakow, Poland">Krakow, Poland</option>
<option value="Wroclaw, Poland">Wroclaw, Poland</option>

<option value="Lisbon, Portugal">Lisbon, Portugal</option>
<option value="Porto, Portugal">Porto, Portugal</option>
<option value="Coimbra, Portugal">Coimbra, Portugal</option>

<option value="Doha, Qatar">Doha, Qatar</option>
<option value="Al Rayyan, Qatar">Al Rayyan, Qatar</option>
<option value="Al Wakrah, Qatar">Al Wakrah, Qatar</option>

<option value="Bucharest, Romania">Bucharest, Romania</option>
<option value="Cluj-Napoca, Romania">Cluj-Napoca, Romania</option>
<option value="Timisoara, Romania">Timisoara, Romania</option>

<option value="Moscow, Russia">Moscow, Russia</option>
<option value="Saint Petersburg, Russia">Saint Petersburg, Russia</option>
<option value="Novosibirsk, Russia">Novosibirsk, Russia</option>

<option value="Belgrade, Serbia">Belgrade, Serbia</option>
<option value="Novi Sad, Serbia">Novi Sad, Serbia</option>
<option value="Nis, Serbia">Nis, Serbia</option>

<option value="Singapore, Singapore">Singapore, Singapore</option>
<option value="Johor Bahru, Malaysia">Johor Bahru, Malaysia</option>
<option value="Malacca City, Malaysia">Malacca City, Malaysia</option>

<option value="Bratislava, Slovakia">Bratislava, Slovakia</option>
<option value="Kosice, Slovakia">Kosice, Slovakia</option>
<option value="Nitra, Slovakia">Nitra, Slovakia</option>

<option value="Ljubljana, Slovenia">Ljubljana, Slovenia</option>
<option value="Maribor, Slovenia">Maribor, Slovenia</option>
<option value="Celje, Slovenia">Celje, Slovenia</option>

<option value="Helsinki, Finland">Helsinki, Finland</option>
<option value="Espoo, Finland">Espoo, Finland</option>
<option value="Tampere, Finland">Tampere, Finland</option>

<option value="Somalia">Somalia</option>

<option value="Johannesburg, South Africa">Johannesburg, South Africa</option>
<option value="Cape Town, South Africa">Cape Town, South Africa</option>
<option value="Durban, South Africa">Durban, South Africa</option>

<option value="Seoul, South Korea">Seoul, South Korea</option>
<option value="Busan, South Korea">Busan, South Korea</option>
<option value="Incheon, South Korea">Incheon, South Korea</option>

<option value="Madrid, Spain">Madrid, Spain</option>
<option value="Barcelona, Spain">Barcelona, Spain</option>
<option value="Valencia, Spain">Valencia, Spain</option>

<option value="Sri Jayawardenepura Kotte, Sri Lanka">Sri Jayawardenepura Kotte, Sri Lanka</option>
<option value="Colombo, Sri Lanka">Colombo, Sri Lanka</option>
<option value="Galle, Sri Lanka">Galle, Sri Lanka</option>

<option value="Khartoum, Sudan">Khartoum, Sudan</option>
<option value="Omdurman, Sudan">Omdurman, Sudan</option>
<option value="Nyala, Sudan">Nyala, Sudan</option>

<option value="Dar es Salaam, Tanzania">Dar es Salaam, Tanzania</option>
<option value="Dodoma, Tanzania">Dodoma, Tanzania</option>
<option value="Arusha, Tanzania">Arusha, Tanzania</option>

<option value="Bangkok, Thailand">Bangkok, Thailand</option>
<option value="Chiang Mai, Thailand">Chiang Mai, Thailand</option>
<option value="Phuket, Thailand">Phuket, Thailand</option>

<option value="Lima, Peru">Lima, Peru</option>
<option value="Arequipa, Peru">Arequipa, Peru</option>
<option value="Trujillo, Peru">Trujillo, Peru</option>

<option value="Tunis, Tunisia">Tunis, Tunisia</option>
<option value="Sfax, Tunisia">Sfax, Tunisia</option>
<option value="Sousse, Tunisia">Sousse, Tunisia</option>

<option value="Ankara, Turkey">Ankara, Turkey</option>
<option value="Istanbul, Turkey">Istanbul, Turkey</option>
<option value="Izmir, Turkey">Izmir, Turkey</option>

<option value="Ashgabat, Turkmenistan">Ashgabat, Turkmenistan</option>
<option value="Turkmenabat, Turkmenistan">Turkmenabat, Turkmenistan</option>
<option value="Mary, Turkmenistan">Mary, Turkmenistan</option>

<option value="Kingston, Jamaica">Kingston, Jamaica</option>
<option value="Montego Bay, Jamaica">Montego Bay, Jamaica</option>
<option value="Spanish Town, Jamaica">Spanish Town, Jamaica</option>

<option value="Abuja, Nigeria">Abuja, Nigeria</option>
<option value="Lagos, Nigeria">Lagos, Nigeria</option>
<option value="Port Harcourt, Nigeria">Port Harcourt, Nigeria</option>

<option value="Kiev, Ukraine">Kiev, Ukraine</option>
<option value="Odessa, Ukraine">Odessa, Ukraine</option>
<option value="Kharkiv, Ukraine">Kharkiv, Ukraine</option>

<option value="London, United Kingdom">London, United Kingdom</option>
<option value="Manchester, United Kingdom">Manchester, United Kingdom</option>
<option value="Birmingham, United Kingdom">Birmingham, United Kingdom</option>

<option value="Washington, United States">Washington, United States</option>
<option value="New York City, United States">New York City, United States</option>
<option value="Los Angeles, United States">Los Angeles, United States</option>

<option value="Montevideo, Uruguay">Montevideo, Uruguay</option>
<option value="Salto, Uruguay">Salto, Uruguay</option>
<option value="Punta del Este, Uruguay">Punta del Este, Uruguay</option>

<option value="Hanoi, Vietnam">Hanoi, Vietnam</option>
<option value="Ho Chi Minh City, Vietnam">Ho Chi Minh City, Vietnam</option>
<option value="Da Nang, Vietnam">Da Nang, Vietnam</option>

<option value="Sanaa, Yemen">Sanaa, Yemen</option>
<option value="Aden, Yemen">Aden, Yemen</option>
<option value="Taiz, Yemen">Taiz, Yemen</option>

</select>
                    <!-- Add more predefined cities here -->
                </select>
                <!-- Search Button with Magnifying Glass Icon -->
                <button>
                    <svg fill="#000000" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24px" height="1.2em">
                        <path d="M 9 2 C 5.1458514 2 2 5.1458514 2 9 C 2 12.854149 5.1458514 16 9 16 C 10.747998 16 12.345009 15.348024 13.574219 14.28125 L 14 14.707031 L 14 16 L 20 22 L 22 20 L 16 14 L 14.707031 14 L 14.28125 13.574219 C 15.348024 12.345009 16 10.747998 16 9 C 16 5.1458514 12.854149 2 9 2 z M 9 4 C 11.773268 4 14 6.2267316 14 9 C 14 11.773268 11.773268 14 9 14 C 6.2267316 14 4 11.773268 4 9 C 4 6.2267316 6.2267316 4 9 4 z"/>
                    </svg>
                </button>
            </div>

            <!-- Weather Information Display Section -->
            <div class="weather loading">
                <!-- City Name -->
                <h3 class="city"></h3>
                <!-- Temperature -->
                <h1 class="temp">Temperature :</h1>
                <!-- Weather Icon and Description -->
                <div class="flex">
                    <img src="" alt="" class="icon" />
                    <div class="description">Description :</div>
                </div>
                <!-- Weather Details -->
                <div class="cloudiness">Cloudiness:</div>
                <div class="humidity">Humidity :</div>
                <div class="wind">Wind Speed:</div>
                <div class="pressure">Pressure:</div>
                <div class="visibility">visibility:</div>
                <div class="sunrise ">Sunrise:</div>
                <div class="sunset">Sunset:</div>
            </div>
        </div>
    </div>
</div>

</body>

<!-- Engati Chatbot Integration -->
<script>
    !function(e,t,a){var c=e.head||e.getElementsByTagName("head")[0],n=e.createElement("script");
    n.async=!0,n.defer=!0,n.type="text/javascript",n.src=t+"/static/js/widget.js?config="+JSON.stringify(a),c.appendChild(n)}(document,"https://app.engati.com",{bot_key:"b4e206a30d39493b",welcome_msg:true,branding_key:"default",server:"https://app.engati.com",e:"p"});
</script>

<!-- Include footer -->
<?php include 'includes/student-footer.php';?>
