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
 include 'mediafunctions.php';

get_header(); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

<div id="primary" class="content-area">
                <main id="main" class="site-main" role="main">

    <div class="jumbotron text-center">
    <h1 class="display-4"><?php wp_title($sep = '', $display = true, $seplocation = ''); ?></h1>
    </p>
    </div>

    
<h2> Images </h2>
<!-- Gallery -->
<div class="row">
  <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
    <img
      src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(73).jpg"
      class="w-100 shadow-1-strong rounded mb-4"
      alt=""
    />

    <img
      src="https://mdbootstrap.com/img/Photos/Vertical/mountain1.jpg"
      class="w-100 shadow-1-strong rounded mb-4"
      alt=""
    />
  </div>

  <div class="col-lg-4 mb-4 mb-lg-0">
    <img
      src="https://mdbootstrap.com/img/Photos/Vertical/mountain2.jpg"
      class="w-100 shadow-1-strong rounded mb-4"
      alt=""
    />

    <img
      src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(73).jpg"
      class="w-100 shadow-1-strong rounded mb-4"
      alt=""
    />
  </div>

  <div class="col-lg-4 mb-4 mb-lg-0">
    <img
      src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg"
      class="w-100 shadow-1-strong rounded mb-4"
      alt=""
    />

    <img
      src="https://mdbootstrap.com/img/Photos/Vertical/mountain3.jpg"
      class="w-100 shadow-1-strong rounded mb-4"
      alt=""
    />
  </div>
</div>

<h2>Videos</h2>
<!--Carousel Wrapper-->
<div id="video-carousel-example2" class="carousel slide carousel-fade" data-ride="carousel">
  <!--Slides-->
  <div class="carousel-inner" role="listbox">
      <?php getMediaForDate(wp_title($sep = '', $display = false, $seplocation = ''), "videos") ?>
  </div>
  <!--/.Slides-->
  <!--Controls-->
  <a class="carousel-control-prev" href="#video-carousel-example2" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#video-carousel-example2" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  <!--/.Controls-->
</div>
<!--Carousel Wrapper-->

<h2>Images</h2>
<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <?php getMediaForDate(wp_title($sep = '', $display = false, $seplocation = ''), "images") ?>
  </div>


<h2> Websites </h2><!-- Page Content -->
                    <div class="container">

                        <h1 class="font-weight-light text-center text-lg-left mt-4 mb-0">Thumbnail Gallery</h1>

                        <hr class="mt-2 mb-5">

                        <div class="row text-center text-lg-left">

                            <?php getMediaForDate(wp_title($sep = '', $display = false, $seplocation = ''), "snapshots") ?>

                        </div>

                    </div>
                    <!-- /.container -->
<h2>Music</h2>
<h2>Additional Sources </h2>


                </main><!-- .site-main -->
                
</div><!-- .content-area -->

<?php get_footer(); ?>