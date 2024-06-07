<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom styles for navbar spacing */
        .navbar-nav .nav-item:not(:last-child) {
            margin-right: 20px;
        }

        /* Ensure all cards are the same height and have some space around them */
        .card {
            height: 100%;
            margin: 15px;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .btn-review {
            margin-top: 10px;
        }

        /* Round off the search bar */
        .search-bar .input-group {
            border-radius: 20px;
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

    <div class="container mt-5">
        <h1 class="text-center">Welcome to History Book Reviews</h1>
        <p class="text-center">Explore and share your thoughts on historical books.</p>

        <!-- Search Bar Section -->
        <div class="row justify-content-center search-bar mb-5">
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control search-input rounded-pill" placeholder="Search books...">
                    <div class="input-group-append">
                        <button class="btn btn-primary search-btn rounded-pill" type="button">Search</button>
                    </div>
                </div>
            </div>
        </div>

     <!-- Cards Section -->
<div class="row row-cols-1 row-cols-md-3 row-cols-lg-3 g-4">
    <!-- Card 1 -->
    <div class="col">
        <div class="card">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card Title 1</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
                    additional content. This content is a little bit longer.</p>
                <button class="btn btn-primary btn-review" onclick="leaveReview()">Leave a Review!</button>
             <!-- CRUD Buttons -->
            <div class="mt-2">
                <button class="btn btn-success mr-2">Create</button>
                <button class="btn btn-info mr-2">Read</button>
                <button class="btn btn-warning mr-2">Update</button>
                <button class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>
    <!-- Card 2 -->
    <div class="col">
        <div class="card">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card Title 2</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
                    additional content. This content is a little bit longer.</p>
                <button class="btn btn-primary btn-review" onclick="leaveReview()">Leave a Review!</button>
           <!-- CRUD Buttons -->
            <div class="mt-2">
                <button class="btn btn-success mr-2">Create</button>
                <button class="btn btn-info mr-2">Read</button>
                <button class="btn btn-warning mr-2">Update</button>
                <button class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>
    <!-- Repeat Card 2 HTML structure 7 more times -->
    <!-- Card 3 -->
    <div class="col">
        <div class="card">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card Title 3</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
                    additional content. This content is a little bit longer.</p>
                <button class="btn btn-primary btn-review" onclick="leaveReview()">Leave a Review!</button>
             <!-- CRUD Buttons -->
            <div class="mt-2">
                <button class="btn btn-success mr-2">Create</button>
                <button class="btn btn-info mr-2">Read</button>
                <button class="btn btn-warning mr-2">Update</button>
                <button class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>
    <!-- Repeat Card 3 HTML structure 6 more times -->
    <!-- Card 4 -->
    <div class="col">
        <div class="card">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card Title 4</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
                    additional content. This content is a little bit longer.</p>
             <!-- CRUD Buttons -->
            <div class="mt-2">
                <button class="btn btn-success mr-2">Create</button>
                <button class="btn btn-info mr-2">Read</button>
                <button class="btn btn-warning mr-2">Update</button>
                <button class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>
    <!-- Repeat Card 4 HTML structure 5 more times -->
    <!-- Card 5 -->
    <div class="col">
        <div class="card">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card Title 5</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
                    additional content. This content is a little bit longer.</p>
                <button class="btn btn-primary btn-review" onclick="leaveReview()">Leave a Review!</button>
          <!-- CRUD Buttons -->
            <div class="mt-2">
                <button class="btn btn-success mr-2">Create</button>
                <button class="btn btn-info mr-2">Read</button>
                <button class="btn btn-warning mr-2">Update</button>
                <button class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>
    <!-- Repeat Card 5 HTML structure 4 more times -->
    <!-- Card 6 -->
    <div class="col">
        <div class="card">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card Title 6</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
                    additional content. This content is a little bit longer.</p>
                <button class="btn btn-primary btn-review" onclick="leaveReview()">Leave a Review!</button>
             <!-- CRUD Buttons -->
            <div class="mt-2">
                <button class="btn btn-success mr-2">Create</button>
                <button class="btn btn-info mr-2">Read</button>
                <button class="btn btn-warning mr-2">Update</button>
                <button class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>
    <!-- Repeat Card 6 HTML structure 3 more times -->
    <!-- Card 7 -->
    <div class="col">
        <div class="card">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card Title 7</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
                    additional content. This content is a little bit longer.</p>
                <button class="btn btn-primary btn-review" onclick="leaveReview()">Leave a Review!</button>
           <!-- CRUD Buttons -->
            <div class="mt-2">
                <button class="btn btn-success mr-2">Create</button>
                <button class="btn btn-info mr-2">Read</button>
                <button class="btn btn-warning mr-2">Update</button>
                <button class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>
    <!-- Repeat Card 7 HTML structure 2 more times -->
    <!-- Card 8 -->
    <div class="col">
        <div class="card">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card Title 8</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
                    additional content. This content is a little bit longer.</p>
                <button class="btn btn-primary btn-review" onclick="leaveReview()">Leave a Review!</button>
            <!-- CRUD Buttons -->
            <div class="mt-2">
                <button class="btn btn-success mr-2">Create</button>
                <button class="btn btn-info mr-2">Read</button>
                <button class="btn btn-warning mr-2">Update</button>
                <button class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>
    <!-- Repeat Card 8 HTML structure 1 more time -->
    <!-- Card 9 -->
    <div class="col">
        <div class="card">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card Title 9</h5
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
                    additional content. This content is a little bit longer.</p>
                <button class="btn btn-primary btn-review" onclick="leaveReview()">Leave a Review!</button>
             <!-- CRUD Buttons -->
            <div class="mt-2">
                <button class="btn btn-success mr-2">Create</button>
                <button class="btn btn-info mr-2">Read</button>
                <button class="btn btn-warning mr-2">Update</button>
                <button class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>
    <!-- Bootstrap JS (jQuery, Popper.js, Bootstrap JS) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
