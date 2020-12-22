<html>

<head>
    <link rel="stylesheet" href="./css/owl.carousel.min.css">
    <link rel="stylesheet" href="./css/owl.theme.default.min.css">
    <!--AOS Library-->
    <link rel="stylesheet" href="./css/aos.css">
</head>
<?php
include "navbar.php";
?>

<body>
    <main>
        <section class="site-title">
            <div class="text-center site-text">
                <h1 class="py-2">Publish Yourself in Your Way</h1>
                <h3 class="py-2">Create Beautiful & Unique Blog. It's Free</h3>
                <button class="btn btn-info ">Create Your Blog</button>
            </div>
        </section>

        <section>
            <div class="recent-blog">
                <div class="container">
                    <div class="owl-carousel owl-theme blog-post">
                        <div class="blog-content" data-aos="fade-right" data-aos-delay="200">
                            <img src="./Assets/joshua.jpg" alt="rcpost-1">
                            <div class="blog-title">
                                <h3>Share Your Travelling Experience</h3>
                                <button class="btn btn-blog">Travel</button>

                            </div>
                        </div>
                        <div class="blog-content" data-aos="fade-in" data-aos-delay="200">
                            <img src="./Assets/movie-review.jpg" alt="rcpost-1">
                            <div class="blog-title">
                                <h3>Share About Your Favourit Movie</h3>
                                <button class="btn btn-blog">Movie</button>

                            </div>
                        </div>
                        <div class="blog-content" data-aos="fade-left" data-aos-delay="200">
                            <img src="./Assets/healthyfood.jpg" alt="rcpost-1">
                            <div class="blog-title">
                                <h3>Eat Healthy Stay Healthy.</h3>
                                <button class="btn btn-blog">Health</button>

                            </div>
                        </div>
                        <div class="blog-content" data-aos="fade-right" data-aos-delay="200">
                            <img src="./Assets/food1.jpg" alt="rcpost-1">
                            <div class="blog-title">
                                <h3>Share Your Favourit Restaurant</h3>
                                <button class="btn btn-blog">Food</button>

                            </div>
                        </div>

                        <div class="blog-content data-aos=" fade-right" data-aos-delay="200"">
                            <img src=" ./Assets/gaming.jpg" alt="rcpost-1">
                            <div class="blog-title">
                                <h3>Games That Makes You Cazy</h3>
                                <button class="btn btn-blog">Gaming</button>
                            </div>
                        </div>

                        <div class="blog-content data-aos=" fade-right" data-aos-delay="200"">
                            <img src=" ./Assets/sports.jpg" alt="rcpost-1">
                            <div class="blog-title">
                                <h3>Sports That You Love The Most</h3>
                                <button class="btn btn-blog">Sports</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php
    include_once "footer.php";
    ?>




    <script src="./js/jquery-3.4.1.min.js"></script>
    <!--Owl Carousel-->
    <script src="./js/owl.carousel.min.js"></script>
    <!--Aos JS-->
    <script src="./js/aos.js"></script>
    <!--Custom Jquery-->
    <script src="./js/main.js"></script>
</body>

</html>