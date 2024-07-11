<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Explore and share your thoughts on historical books.">
    <meta name="keywords" content="History, Book Reviews, Historical Books">
    <title>History Book Reviews</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #fff;
            color: #000;
            margin-bottom: 100px;
        }
        .footer {
            background-color: #007bff;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
            font-size: 0.875rem;
        }
        .autocomplete-items {
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 99;
            position: absolute;
            width: 100%;
            max-height: 150px;
            overflow-y: auto;
            background-color: #fff;
        }
        .autocomplete-items div {
            padding: 10px;
            cursor: pointer;
            background-color: #fff;
            border-bottom: 1px solid #d4d4d4;
        }
        .autocomplete-items div:hover {
            background-color: #e9ecef;
        }
        .rating-label {
            font-size: 1rem;
            cursor: pointer;
            margin-right: 10px;
        }
        .truncate-text {
            max-height: 4.8em;
            overflow: hidden;
            position: relative;
        }
        .read-more {
            color: #007bff;
            cursor: pointer;
        }
        .review-box {
            margin-top: 20px;
        }
        .review-box input, .review-box textarea {
            margin-bottom: 10px;
        }
        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 15px;
        }
        .card {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            color: #000;
            min-height: 400px;
            display: flex;
            flex-direction: column;
        }
        .card-body {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .btn-secondary, .btn-primary, .btn-danger {
            color: #fff;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">History Book Reviews</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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

        <div class="row justify-content-center search-bar mb-5">
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control search-input rounded-pill" id="searchInput" placeholder="Search books..." oninput="autoSearch()">
                    <div class="input-group-append">
                        <button class="btn btn-primary search-btn rounded-pill" type="button" onclick="searchBooks()">Search</button>
                    </div>
                </div>
                <div id="autocompleteDropdown" class="autocomplete-items"></div>
            </div>
        </div>

        <div class="row card-container" id="cardContainer"></div>
    </div>

    <footer class="footer">
        <div class="container">
            <p>History Book Review Site 2024 &copy; .</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        const apiKey = 'AIzaSyCRlztYMPuGLgq93OqkOv6kkx914jAecLE';

        async function fetchBooks(query = 'history') {
            try {
                const response = await fetch(`https://www.googleapis.com/books/v1/volumes?q=${encodeURIComponent(query)}&key=${apiKey}`);
                if (!response.ok) {
                    throw new Error('Failed to fetch books');
                }
                const data = await response.json();
                return data.items || [];
            } catch (error) {
                console.error('Error fetching books:', error);
                return [];
            }
        }

        function createBookCard(book) {
            const bookInfo = book.volumeInfo;
            const newCard = document.createElement('div');
            newCard.classList.add('col');

            newCard.innerHTML = `
                <div class="card">
                    <img src="${bookInfo.imageLinks ? bookInfo.imageLinks.thumbnail : 'https://via.placeholder.com/128x192?text=No+Cover'}" class="card-img-top" alt="Cover of ${bookInfo.title}">
                    <div class="card-body">
                        <h5 class="card-title">${bookInfo.title}</h5>
                        <p class="card-text truncate-text" data-full-text="${bookInfo.description}" data-book-id="${book.id}">${truncateText(bookInfo.description, 100)}</p>
                        <span class="read-more" onclick="toggleReadMore(this, '${book.id}')">Read more</span>
                        <div class="star-rating" data-book-id="${book.id}">
                            ${['Poor', 'Fair', 'Good', 'Very Good', 'Excellent'].map((word, index) => `
                                <label class="rating-label" onclick="setStarRating('${book.id}', ${index + 1})">${word}</label>
                            `).join('')}
                        </div>
                        <div class="review-box">
                            <input type="text" class="form-control" placeholder="Enter a username" id="username-${book.id}">
                            <textarea class="form-control" placeholder="Leave a review here" id="review-${book.id}"></textarea>
                            <button class="btn btn-primary mt-2" onclick="addReview('${book.id}')">Add Review</button>
                            <div id="reviews-${book.id}"></div>
                        </div>
                    </div>
                </div>
            `;

            return newCard;
        }

        async function displayBooks(query) {
            const books = await fetchBooks(query);
            const cardContainer = document.getElementById('cardContainer');
            cardContainer.innerHTML = '';
            books.forEach(book => {
                const newCard = createBookCard(book);
                cardContainer.appendChild(newCard);
                loadReviews(book.id);
            });
            saveCurrentQuery(query);
        }

        let autoSearchTimer;
        async function autoSearch() {
            clearTimeout(autoSearchTimer);
            autoSearchTimer = setTimeout(async () => {
                const searchInput = document.getElementById('searchInput').value.trim();
                if (searchInput !== '') {
                    const suggestions = await fetchBooks(searchInput);
                    const autocompleteDropdown = document.getElementById('autocompleteDropdown');
                    autocompleteDropdown.innerHTML = '';
                    suggestions.forEach(book => {
                        const suggestionItem = document.createElement('div');
                        suggestionItem.textContent = book.volumeInfo.title;
                        suggestionItem.onclick = () => {
                            document.getElementById('searchInput').value = book.volumeInfo.title;
                            autocompleteDropdown.innerHTML = '';
                            displayBooks(book.volumeInfo.title);
                        };
                        autocompleteDropdown.appendChild(suggestionItem);
                    });
                }
            }, 500);
        }

        function searchBooks() {
            const searchInput = document.getElementById('searchInput').value.trim();
            if (searchInput !== '') {
                displayBooks(searchInput);
            }
        }

        async function toggleReadMore(element, bookId) {
            const cardText = element.previousElementSibling;
            const fullText = cardText.getAttribute('data-full-text');
            if (cardText.classList.contains('truncate-text')) {
                cardText.classList.remove('truncate-text');
                element.textContent = 'Read less';

                const bookInfo = await fetchBookInfo(bookId);
                if (bookInfo) {
                    const moreInfo = document.createElement('div');
                    moreInfo.innerHTML = `
                        <p><strong>Authors:</strong> ${bookInfo.authors ? bookInfo.authors.join(', ') : 'N/A'}</p>
                        <p><strong>Published Date:</strong> ${bookInfo.publishedDate}</p>
                        <p><strong>Page Count:</strong> ${bookInfo.pageCount}</p>
                        <p><strong>Publisher:</strong> ${bookInfo.publisher}</p>
                        <p><strong>Categories:</strong> ${bookInfo.categories ? bookInfo.categories.join(', ') : 'N/A'}</p>
                    `;
                    cardText.appendChild(moreInfo);
                }
            } else {
                cardText.classList.add('truncate-text');
                element.textContent = 'Read more';

                const moreInfo = cardText.querySelector('div');
                if (moreInfo) {
                    cardText.removeChild(moreInfo);
                }
            }
        }

        async function fetchBookInfo(bookId) {
            try {
                const response = await fetch(`https://www.googleapis.com/books/v1/volumes/${bookId}?key=${apiKey}`);
                if (!response.ok) {
                    throw new Error('Failed to fetch book info');
                }
                const data = await response.json();
                return data.volumeInfo;
            } catch (error) {
                console.error('Error fetching book info:', error);
                return null;
            }
        }

        function truncateText(text, maxLength) {
            if (text.length <= maxLength) {
                return text;
            }
            return text.slice(0, maxLength) + '...';
        }

        function setStarRating(bookId, rating) {
            const reviews = getReviews();
            reviews[bookId] = reviews[bookId] || {};
            reviews[bookId].rating = rating;
            saveReviews(reviews);
            updateStarRating(bookId);
        }

        function updateStarRating(bookId) {
            const reviews = getReviews();
            const rating = reviews[bookId]?.rating || 0;
            const starRating = document.querySelector(`.star-rating[data-book-id="${bookId}"]`);
            const ratingLabels = starRating.querySelectorAll('.rating-label');
            ratingLabels.forEach((label, index) => {
                label.style.fontWeight = (index + 1) === rating ? 'bold' : 'normal';
            });
        }

        function addReview(bookId) {
            const username = document.getElementById(`username-${bookId}`).value.trim();
            const review = document.getElementById(`review-${bookId}`).value.trim();
            if (username !== '' && review !== '') {
                const reviews = getReviews();
                reviews[bookId] = reviews[bookId] || {};
                reviews[bookId].reviews = reviews[bookId].reviews || [];
                reviews[bookId].reviews.push({ username, review, rating: reviews[bookId].rating || 0 });
                saveReviews(reviews);
                loadReviews(bookId);
                document.getElementById(`username-${bookId}`).value = '';
                document.getElementById(`review-${bookId}`).value = '';
            }
        }

        function loadReviews(bookId) {
            const reviews = getReviews();
            const reviewList = document.getElementById(`reviews-${bookId}`);
            reviewList.innerHTML = '';
            if (reviews[bookId]?.reviews) {
                reviews[bookId].reviews.forEach((review, index) => {
                    const reviewItem = document.createElement('div');
                    reviewItem.classList.add('mb-2');
                    reviewItem.innerHTML = `
                        <strong>${review.username}</strong> (${review.rating} stars): ${review.review}
                        <button class="btn btn-danger btn-sm ml-2" onclick="deleteReview('${bookId}', ${index})">Delete</button>
                        <button class="btn btn-secondary btn-sm ml-2" onclick="editReview('${bookId}', ${index})">Edit</button>
                    `;
                    reviewList.appendChild(reviewItem);
                });
            }
            updateStarRating(bookId);
        }

        function deleteReview(bookId, index) {
            const reviews = getReviews();
            if (reviews[bookId]?.reviews) {
                reviews[bookId].reviews.splice(index, 1);
                saveReviews(reviews);
                loadReviews(bookId);
            }
        }

        function editReview(bookId, index) {
            const reviews = getReviews();
            if (reviews[bookId]?.reviews) {
                const review = reviews[bookId].reviews[index];
                document.getElementById(`username-${bookId}`).value = review.username;
                document.getElementById(`review-${bookId}`).value = review.review;
                reviews[bookId].reviews.splice(index, 1);
                saveReviews(reviews);
                loadReviews(bookId);
            }
        }

        function getReviews() {
            return JSON.parse(localStorage.getItem('bookReviews') || '{}');
        }

        function saveReviews(reviews) {
            localStorage.setItem('bookReviews', JSON.stringify(reviews));
        }

        function saveCurrentQuery(query) {
            localStorage.setItem('currentQuery', query);
        }

        function getCurrentQuery() {
            return localStorage.getItem('currentQuery') || 'history';
        }

        document.addEventListener('DOMContentLoaded', () => {
            const currentQuery = getCurrentQuery();
            displayBooks(currentQuery);
        });
    </script>
</body>
</html>
