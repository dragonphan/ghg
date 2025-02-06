<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set page title and include header
$pageTitle = "Explore";
include 'includes/student-header.php'; 
?>

<!-- Main Content Container -->
<div class="col py-3">
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Climate News Section -->
                    <h2 class="mb-3">Climate News</h2>
                    
                    <!-- Category Filter Form -->
                    <form id="category-form">
                        <div class="mb-3">
                            <label for="category" class="form-label">Filter by Category:</label>
                            <select id="category" class="form-select">
                                <option value="">All Categories</option>
                                <option value="environment">Environment</option>
                                <option value="sustainability">Sustainability</option>
                                <option value="climate change">Climate Change</option>
                            </select>
                        </div>
                    </form>

                    <!-- News Articles Container -->
                    <div id="news">
                        <p>Loading news articles...</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- External Scripts -->
<!-- jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- News API Integration Script -->
<script>
    $(document).ready(function () {
        var apiKey = '326000ff7a6d441eb94044b96394d7df'; // News API key

        // Function to fetch news from API
        function fetchNews(category) {
            var query = category ? encodeURIComponent(category) : 'climate change';
            var url = `https://newsapi.org/v2/everything?q=${query}&apiKey=${apiKey}`;

            $.ajax({
                url: url,
                method: 'GET',
                success: function(data) {
                    if (data.status === 'ok') {
                        displayNews(data.articles);
                    } else {
                        $('#news').html("<p>Failed to fetch news articles.</p>");
                    }
                },
                error: function() {
                    $('#news').html("<p>Failed to fetch news articles.</p>");
                }
            });
        }

        // Function to validate image URLs
        function isValidImage(url, callback) {
            var img = new Image();
            img.onload = function() { callback(true); };
            img.onerror = function() { callback(false); };
            img.src = url;
        }

        // Function to display news articles
        function displayNews(articles) {
            var category = $('#category').val().toLowerCase();
            var filteredArticles = [];

            // Filter and validate articles
            articles.forEach(function(article) {
                if (article.urlToImage && article.urlToImage.startsWith('http')) {
                    isValidImage(article.urlToImage, function(isValid) {
                        if (isValid && (category === '' || article.title.toLowerCase().includes(category) || article.description.toLowerCase().includes(category))) {
                            filteredArticles.push(article);
                            renderNews();
                        }
                    });
                }
            });

            // Render filtered news articles
            function renderNews() {
                // Sort articles by date
                filteredArticles.sort(function(a, b) {
                    return new Date(b.publishedAt) - new Date(a.publishedAt);
                });

                // Generate HTML for articles
                var articlesHtml = '';
                filteredArticles.forEach(function(article) {
                    articlesHtml += `
                        <div class='card mb-3'>
                            <div class='row g-0'>
                                <div class='col-md-4'>
                                    <img src='${article.urlToImage}' alt='${article.title}' class='img-fluid'>
                                </div>
                                <div class='col-md-8'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>${article.title}</h5>
                                        <p class='card-text'>${article.description}</p>
                                        <a href='${article.url}' target='_blank' class='btn btn-primary'>Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                });

                // Display articles or no results message
                $('#news').html(articlesHtml.length > 0 ? articlesHtml : "<p>No articles available for this category.</p>");
            }
        }

        // Event handler for category change
        $('#category').change(function() {
            var selectedCategory = $(this).val();
            fetchNews(selectedCategory);
        });

        // Initial news fetch
        fetchNews('');
    });
</script>

<!-- Chatbot Styling -->
<style>
    /* Make the bot icon bigger */
    .ebot-box {
        width: 800px !important;  /* Increase from default */
        height: 800px !important; /* Increase from default */
        bottom: 20px !important; /* Adjust bottom position */
        right: 20px !important;  /* Adjust right position */
    }
    
    /* Adjust the icon inside */
    .ebot-box img {
        width: 100% !important;
        height: 100% !important;
    }
</style>

<!-- Engati Chatbot Script -->
<script>
    !function(e,t,a){var c=e.head||e.getElementsByTagName("head")[0],n=e.createElement("script");n.async=!0,n.defer=!0, n.type="text/javascript",n.src=t+"/static/js/widget.js?config="+JSON.stringify(a),c.appendChild(n)}(document,"https://app.engati.com",{bot_key:"b4e206a30d39493b",welcome_msg:true,branding_key:"default",server:"https://app.engati.com",e:"p" });
</script>

<?php include 'includes/student-footer.php'; ?>
