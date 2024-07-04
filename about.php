<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Google Maps API with Places Library -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnlKS79mHXDVy0GVW21QQm5XeZg6uihaA&libraries=places"></script>
    <style>
        /* Set the height of the html and body elements to 100% and apply a flexbox layout */
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        /* Make the container take up the remaining vertical space */
        .container {
            flex: 1 0 auto;
        }

        /* Set the map height and width */
        #map {
            height: 400px; /* Adjust as needed */
            width: 100%;
        }

        /* Style the footer */
        footer {
            background-color: #007bff;
            padding: 20px 0;
            text-align: center;
            width: 100%;
            flex-shrink: 0; /* Prevent the footer from shrinking */
        }

        /* Add some spacing between nav items */
        .navbar-nav .nav-item:not(:last-child) {
            margin-right: 20px;
        }

        /* Add some spacing below the search container */
        #search-container {
            margin-bottom: 15px;
        }

        /* Round off the search bar */
        #postcode {
            border-radius: 20px;
        }

        /* Style the autocomplete results */
        #autocomplete-results {
            position: absolute;
            background-color: #fff;
            border: 1px solid #ccc;
            border-top: none;
            z-index: 1;
            max-height: 200px;
            overflow-y: auto;
            width: 100%;
        }

        #autocomplete-results .autocomplete-item {
            padding: 5px 10px;
            cursor: pointer;
        }

        #autocomplete-results .autocomplete-item:hover {
            background-color: #f1f1f1;
        }

        /* Style the search button */
        #searchButton {
            border-radius: 20px;
            padding: 10px 20px;
        }

        #searchButton:hover {
            background-color: #0056b3;
        }

        #searchButton:focus {
            outline: none;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">History Book Reviews</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('about') ?>">About</a>
                    </li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('logout') ?>">Sign Out</a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('login') ?>">Sign In</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">
        <h1>About Us</h1>
        <p>Welcome to History Book Reviews! Our mission is to provide detailed and insightful reviews of history books
            from various periods and regions. Our team of historians and book enthusiasts works hard to bring you the
            best recommendations.</p>

        <!-- Search Bar Section -->
        <div id="search-container" class="row justify-content-center">
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" id="postcode" class="form-control" placeholder="Enter your postcode or address">
                    <div class="input-group-append">
                        <button class="btn btn-primary" id="searchButton">Search</button>
                    </div>
                </div>
                <div id="autocomplete-results"></div>
            </div>
        </div>

        <!-- Bold search instruction -->
        <p class="text-center font-weight-bold">Type your postcode or address to find local libraries and bookstores</p>

        <!-- Map Container -->
        <div id="map"></div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>History Book Review Site  2024 &copy;</p>
        </div>
    </footer>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        let map;
        let service;
        let infowindow;
        let autocomplete;

        // Initialize the map
        function initMap() {
            const initialLocation = new google.maps.LatLng(-25.344, 131.036);
            map = new google.maps.Map(document.getElementById('map'), {
                center: initialLocation,
                zoom: 4
            });
            infowindow = new google.maps.InfoWindow();

            // Initialize the Autocomplete service
            autocomplete = new google.maps.places.Autocomplete(
                document.getElementById('postcode'),
                { types: ['geocode'] }
            );

            // Listen for the place_changed event and retrieve the autocomplete result
            autocomplete.addListener('place_changed', function() {
                const place = autocomplete.getPlace();
                if (place.geometry) {
                    // Update the map with the selected location
                    map.setCenter(place.geometry.location);
                    map.setZoom(14);

                    // Perform the search for nearby locations
                    searchLocations(place.formatted_address);
                }
            });
        }

        // Search for locations based on the entered postcode or address
        function searchLocations(address) {
            const geocoder = new google.maps.Geocoder();

            geocoder.geocode({
                'address': address
            }, function(results, status) {
                if (status === 'OK') {
                    map.setCenter(results[0].geometry.location);
                    map.setZoom(14);

                    const request = {
                        location: results[0].geometry.location,
                        radius: '5000',
                        query: 'library OR bookstore'
                    };

                    service = new google.maps.places.PlacesService(map);
                    service.textSearch(request, callback);
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });
        }

        // Callback function for the Places Service
        function callback(results, status) {
            if (status === google.maps.places.PlacesServiceStatus.OK) {
                for (let i = 0; i < results.length; i++) {
                    createMarker(results[i]);
                }
            }
        }

        // Create a marker for each place
        function createMarker(place) {
            const marker = new google.maps.Marker({
                map: map,
                position: place.geometry.location
            });

            google.maps.event.addListener(marker, 'click', function() {
                service.getDetails({
                    placeId: place.place_id
                }, function(details, status) {
                    if (status === google.maps.places.PlacesServiceStatus.OK) {
                        const contentString = '<div><strong>' + details.name + '</strong><br>' +
                            'Address: ' + details.formatted_address + '<br>' +
                            (details.photos && details.photos.length > 0 ?
                                '<img src="' + details.photos[0].getUrl({
                                    maxWidth: 200,
                                    maxHeight: 200
                                }) + '" alt="Image of ' + details.name + '">' : '') +
                            '</div>';
                        infowindow.setContent(contentString);
                        infowindow.open(map, marker);
                    }
                });
            });
        }

        $(document).ready(function() {
            // Initialize the map when the page loads
            initMap();

            // Event listener for the "Search" button
            $('#searchButton').click(function() {
                const postcode = $('#postcode').val();

                // Search for locations based on the entered postcode or address
                searchLocations(postcode);

                // Make an AJAX request to handle the search results
                $.ajax({
                    url: '<?= $_SERVER['PHP_SELF'] ?>',
                    type: 'POST',
                    data: { postcode: postcode },
                    dataType: 'json',
                    success: function(data) {
                        // Handle the search results
                        if (data.error) {
                            // Display the error message
                            $('#searchResults').html('<p>' + data.error + '</p>');
                        } else {
                            // Display the search results
                            let resultsHTML = '<ul>';
                            $.each(data.locations, function(index, location) {
                                resultsHTML += '<li>' + location.name + ' - ' + location.address + '</li>';
                            });
                            resultsHTML += '</ul>';
                            $('#searchResults').html(resultsHTML);
                        }
                    },
                    error: function() {
                        // Handle the AJAX error
                        $('#searchResults').html('<p>An error occurred while searching for locations.</p>');
                    }
                });
            });

            // Event listener for the input field
            $('#postcode').on('input', function() {
                const inputValue = $(this).val();

                // Clear the autocomplete results
                $('#autocomplete-results').empty();

                // Check if the input value is not empty
                if (inputValue.trim() !== '') {
                    // Make an AJAX request to fetch autocomplete suggestions
                    $.ajax({
                        url: 'https://maps.googleapis.com/maps/api/place/autocomplete/json',
                        type: 'GET',
                        data: {
                            input: inputValue,
                            types: 'geocode',
                            key: 'AIzaSyCnlKS79mHXDVy0GVW21QQm5XeZg6uihaA'
                        },
                        dataType: 'json',
                        success: function(data) {
                            // Populate the autocomplete results
                            if (data.status === 'OK' && data.predictions.length > 0) {
                                const resultsContainer = $('#autocomplete-results');
                                $.each(data.predictions, function(index, prediction) {
                                    const item = $('<div>').addClass('autocomplete-item').text(prediction.description);
                                    item.on('click', function() {
                                        $('#postcode').val(prediction.description);
                                        resultsContainer.empty();
                                    });
                                    resultsContainer.append(item);
                                });
                            }
                        },
                        error: function() {
                            // Handle the AJAX error
                            console.log('Error fetching autocomplete suggestions');
                        }
                    });
                }
            });
        });
    </script>

    <?php
    // Handle the AJAX request
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if the postcode is provided
        if (isset($_POST['postcode'])) {
            $postcode = $_POST['postcode'];

            // Perform the necessary operations to search for locations based on the postcode
            // This could involve querying a database, using an API, or any other logic

            // For demonstration purposes, let's assume we have an array of locations
            $locations = [
                ['name' => 'Library A', 'address' => '123 Main St, City'],
                ['name' => 'Bookstore B', 'address' => '456 Oak Ave, Town'],
                // Add more locations as needed
            ];

            // Return the search results as JSON
            echo json_encode(['locations' => $locations]);
        } else {
            // Handle the case when the postcode is not provided
            echo json_encode(['error' => 'Postcode is required']);
        }
        exit;
    }
    ?>
</body>

</html>
