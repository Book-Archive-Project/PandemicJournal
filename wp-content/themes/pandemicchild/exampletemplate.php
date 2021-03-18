<?php
/**
 * Template Name: Date Page Displayer
 * The template for all date pages
 *
 *
 * @package    pandemicchild
 * @copyright  jopy
 *
 * @since    1.0.0
 * @version  1.0.0
 */


get_header(); ?>



<h1> If the title prints here: <?php wp_title(); ?> then it works </h1> 
<div id="primary" class="content-area">
                <main id="main" class="site-main" role="main">
                   <!-- Container for the image gallery -->
   <div class="container">

<!-- Full-width images with number text -->
<div class="mySlides">
<div class="numbertext">1 / 6</div>
<img src="https://upload.wikimedia.org/wikipedia/commons/4/41/Sunflower_from_Silesia2.jpg" style="width:100%">
</div>

<div class="mySlides">
<div class="numbertext">2 / 6</div>
<img src="https://upload.wikimedia.org/wikipedia/commons/4/41/Sunflower_from_Silesia2.jpg" style="width:100%">
</div>

<div class="mySlides">
<div class="numbertext">3 / 6</div>
<img src="https://upload.wikimedia.org/wikipedia/commons/4/41/Sunflower_from_Silesia2.jpg" style="width:100%">
</div>

<div class="mySlides">
<div class="numbertext">4 / 6</div>
<img src="https://upload.wikimedia.org/wikipedia/commons/4/41/Sunflower_from_Silesia2.jpg" style="width:100%">
</div>

<div class="mySlides">
<div class="numbertext">5 / 6</div>
<img src="https://upload.wikimedia.org/wikipedia/commons/4/41/Sunflower_from_Silesia2.jpg" style="width:100%">
</div>

<div class="mySlides">
<div class="numbertext">6 / 6</div>
<img src="https://upload.wikimedia.org/wikipedia/commons/4/41/Sunflower_from_Silesia2.jpg" style="width:100%">
</div>

<!-- Next and previous buttons -->
<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>

<!-- Image text -->
<div class="caption-container">
<p id="caption"></p>
</div>

<!-- Thumbnail images -->
<div class="row">
<div class="column">
<img class="demo cursor" src="https://upload.wikimedia.org/wikipedia/commons/4/41/Sunflower_from_Silesia2.jpg" style="width:100%" onclick="currentSlide(1)" alt="The Woods">
</div>
<div class="column">
<img class="demo cursor" src="https://upload.wikimedia.org/wikipedia/commons/4/41/Sunflower_from_Silesia2.jpg" style="width:100%" onclick="currentSlide(2)" alt="Cinque Terre">
</div>
<div class="column">
<img class="demo cursor" src="https://upload.wikimedia.org/wikipedia/commons/4/41/Sunflower_from_Silesia2.jpg" style="width:100%" onclick="currentSlide(3)" alt="Mountains and fjords">
</div>
<div class="column">
<img class="demo cursor" src="https://upload.wikimedia.org/wikipedia/commons/4/41/Sunflower_from_Silesia2.jpg" style="width:100%" onclick="currentSlide(4)" alt="Northern Lights">
</div>
<div class="column">
<img class="demo cursor" src="https://upload.wikimedia.org/wikipedia/commons/4/41/Sunflower_from_Silesia2.jpg" style="width:100%" onclick="currentSlide(5)" alt="Nature and sunrise">
</div>
<div class="column">
<img class="demo cursor" src="https://upload.wikimedia.org/wikipedia/commons/4/41/Sunflower_from_Silesia2.jpg" style="width:100%" onclick="currentSlide(6)" alt="Snowy Mountains">
</div>
</div>
</div>

<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="https://upload.wikimedia.org/wikipedia/commons/2/2b/Khaomanee_cat.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="https://upload.wikimedia.org/wikipedia/commons/2/2b/Khaomanee_cat.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="https://upload.wikimedia.org/wikipedia/commons/2/2b/Khaomanee_cat.jpg" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
                </main><!-- .site-main -->
                
</div><!-- .content-area -->

<?php get_footer(); ?>