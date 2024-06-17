<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    
    <!-- Google Maps API with Places Library -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnlKS79mHXDVy0GVW21QQm5XeZg6uihaA&libraries=places"></script>
    <!-- Replace 'AIzaSyCnlKS79mHXDVy0GVW21QQm5XeZg6uihaA' with your actual API key -->

    <!-- Inline CSS for the map container -->
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>

<body>
    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="<?= base_url() ?>">History Book Reviews</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link ajax-link" href="<?= base_url() ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ajax-link" href="<?= base_url('about') ?>">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBooks" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Books
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownBooks">
                        <a class="dropdown-item" href="#">All Books</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Featured Books</a>
                        <a class="dropdown-item" href="#">Best Sellers</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAuthors" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Authors
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownAuthors">
                        <a class="dropdown-item" href="#">All Authors</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Top Authors</a>
                        <a class="dropdown-item" href="#">New Authors</a>
                    </div>
                </li>
                <?php if (isset($_SESSION['user_id'])): ?>
                <li class="nav-item">
                    <a class="nav-link ajax-link" href="<?= base_url('logout') ?>">Sign Out</a>
                </li>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link ajax-link" href="<?= base_url('login') ?>">Sign In</a>
                </li>
                <?php endif; ?>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search books..." aria-label="Search">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <!-- Main content -->
    <div class="container mt-5">
        <h1 class="text-center">About Our History Book Review Site</h1>
        <p>Welcome to our website dedicated to reviewing and exploring the fascinating world of history books. Our mission is to provide insightful and engaging reviews that help readers discover captivating historical narratives and gain a deeper understanding of the past.</p>

        <h2>Our Passion for History</h2>
        <p>At our core, we are a team of passionate history enthusiasts who believe in the power of books to transport us through time and unravel the intricate tapestry of human experiences. We understand that history is not merely a collection of dates and events but a rich tapestry woven with stories of triumph, struggle, and the resilience of the human spirit.</p>

        <h2>Our Review Process</h2>
        <p>Our team of knowledgeable reviewers meticulously reads and evaluates each history book, ensuring that our reviews are comprehensive, unbiased, and insightful. We delve into the historical accuracy, literary style, and the author's ability to bring the past to life. Our goal is to provide readers with a well-rounded perspective, highlighting both the strengths and potential weaknesses of each book.</p>

        <h2>Our Team</h2>
        <ul>
            <li><strong>John Doe</strong> - Founder and Editor-in-Chief</li>
            <p>John is a lifelong history enthusiast with a passion for uncovering the untold stories of the past. With a Ph.D. in History, he brings a wealth of knowledge and expertise to our team.</p>
            <li><strong>Jane Smith</strong> - Senior Reviewer</li>
            <p>Jane's love for history stems from her travels around the world, where she has witnessed firsthand the remnants of ancient civilizations. Her reviews offer a unique perspective, blending historical insights with personal experiences.</p>
            <li><strong>Bob Johnson</strong> - Reviewer and Researcher</li>
            <p>Bob's meticulous research skills and attention to detail ensure that our reviews are thoroughly fact-checked and historically accurate. His passion for primary sources and archival materials adds depth to our analysis.</p>
        </ul>

        <p>Join us on this journey through time as we explore the rich tapestry of history, one book at a time.</p>
    </div>

    <!-- Map Section -->
    <div class="container mt-5">
        <h2 class="text-center">Find Local Libraries and Bookstores</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="text" id="locationInput" class="form-control" placeholder="Enter your postcode or address" aria-label="Location">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" onclick="findLocations()">Find</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="map"></div>
    </div>

    <!-- Footer -->
    <?= $this->include('templates/footer') ?>

    <!-- Bootstrap and jQuery scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Custom JavaScript file -->
    <script src="<?= base_url('assets/js/script.js') ?>"></script>

    <!-- JavaScript for Google Maps -->
    <script>
        let map;
        let service;
        let infowindow;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: -33.867, lng: 151.207 },
                zoom: 15
            });

            infowindow = new google.maps.InfoWindow();
        }

        function findLocations() {
            const address = document.getElementById('locationInput').value;
            const geocoder = new google.maps.Geocoder();

            geocoder.geocode({ 'address': address }, function (results, status) {
                if (status === 'OK') {
                    map.setCenter(results[0].geometry.location);

                    const request = {
                        location: results[0].geometry.location,
                        radius: '5000', // Adjust radius as needed
                        types: ['library', 'book_store']
                    };

                    service = new google.maps.places.PlacesService(map);
                    service.nearbySearch(request, function (results, status) {
                        if (status === google.maps.places.PlacesServiceStatus.OK) {
                            for (let i = 0; i < results.length; i++) {
                                createMarker(results[i]);
                            }
                        }
                    });
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });
        }

        function createMarker(place) {
            const placeLoc = place.geometry.location;
            const marker = new google.maps.Marker({
                map: map,
                position: placeLoc
            });

            google.maps.event.addListener(marker, 'click', function () {
                infowindow.setContent(place.name);
                infowindow.open(map, this);
            });
        }

        window.onload = initMap;
    </script>

</body>

</html>
