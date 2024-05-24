<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        .wrapper {
            min-height: 100vh;
            /* Viewport height */
            display: flex;
            flex-direction: column;
        }

        .content {
            flex: 1;
            /* This will make the content section grow to fill the remaining space */
        }
    </style>
</head>

<body>
    <?= $this->include('templates/navbar') ?>
    <div class="wrapper">
        <div class="content">
            <div class="container mt-5">
                <h1 class="text-center">Welcome to History Book Reviews</h1>
                <p class="text-center">Explore and share your thoughts on historical books.</p>
                <h2 class="mt-5">Featured Books</h2>

                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col mb-4">
                        <div class="card h-100">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural
                                    lead-in to additional content. This content is a little bit longer.</p>
                            </div>
                            <div class="card-footer">
                                <small class="text-body-secondary">Last updated 3 mins ago</small>
                                <a href="#" class="btn btn-primary float-right">Add Review</a>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-4">
                        <div class="card h-100">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This card has supporting text below as a natural lead-in to
                                    additional content.</p>
                            </div>
                            <div class="card-footer">
                                <small class="text-body-secondary">Last updated 3 mins ago</small>
                                <a href="#" class="btn btn-primary float-right">Add Review</a>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-4">
                        <div class="card h-100">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural
                                    lead-in to additional content. This card has even longer content than the first to
                                    show that equal height action.</p>
                            </div>
                            <div class="card-footer">
                                <small class="text-body-secondary">Last updated a few minutes ago</small>
                                <a href="#" class="btn btn-primary float-right">Add Review</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col mb-4">
                        <div class="card h-100">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural
                                    lead-in to additional content. This content is a little bit longer.</p>
                            </div>
                            <div class="card-footer">
                                <small class="text-body-secondary">Last updated 3 mins ago</small>
                                <a href="#" class="btn btn-primary float-right">Add Review</a>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-4">
                        <div class="card h-100">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This card has supporting text below as a natural lead-in to
                                    additional content.</p>
                            </div>
                            <div class="card-footer">
                                <small class="text-body-secondary">Last updated 3 mins ago</small>
                                <a href="#" class="btn btn-primary float-right">Add Review</a>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-4">
                        <div class="card h-100">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural
                                    lead-in to additional content. This card has even longer content than the first to
                                    show that equal height action.</p>
                            </div>
                            <div class="card-footer">
                                <small class="text-body-secondary">Last updated a few minutes ago</small>
                                <a href="#" class="btn btn-primary float-right">Add Review</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col mb-4">
                        <div class="card h-100">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural
                                    lead-in to additional content. This content is a little bit longer.</p>
                            </div>
                            <div class="card-footer">
                                <small class="text-body-secondary">Last updated 3 mins ago</small>
                                <a href="#" class="btn btn-primary float-right">Add Review</a>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-4">
                        <div class="card h-100">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This card has supporting text below as a natural lead-in to
                                    additional content.</p>
                            </div>
                            <div class="card-footer">
                                <small class="text-body-secondary">Last updated 3 mins ago</small>
                                <a href="#" class="btn btn-primary float-right">Add Review</a>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-4">
                        <div class="card h-100">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural
                                    lead-in to additional content. This card has even longer content than the first to
                                    show that equal height action.</p>
                            </div>
                            <div class="card-footer">
                                <small class="text-body-secondary">Last updated a few hours ago</small>
                                <a href="#" class="btn btn-primary float-right">Add Review</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <?php foreach ($books as $book): ?>
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h3 class="card-title"><?= $book['title'] ?></h3>
                                <p class="card-text">Author: <?= $book['author'] ?></p>
                                <p class="card-text"><?= $book['description'] ?></p>
                            </div>
                            <div class="card-footer">
                                <a href="<?= base_url('book/' . $book['id']) ?>" class="btn btn-primary">View
                                    Details</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?= $this->include('templates/footer') ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
</body>

</html>