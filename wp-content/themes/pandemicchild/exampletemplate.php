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
    </div>

 <?php
  if(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"videos.txt")) :
 ?>
<h2 style="text-align:center">Videos</h2>
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
<?php endif; ?>

<?php
if(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"images.txt")) :
?><div class="container mt-5">
    <div class="carousel-container position-relative row">
        <!-- Sorry! Lightbox doesn't work - yet. -->
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php getMediaForDate(wp_title($sep = '', $display = false, $seplocation = ''), "images") ?>

            <a class="carousel-control-prev" href="#carousel-thumbs" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel-thumbs" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

    </div> <!-- /row -->
</div> <!-- /container -->

<?php endif; ?>

   <?php
    if(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"images.txt")) :
   /*
                    <h2 style="text-align:center">Images</h2>
<div id="imagesCarousel" class="carousel slide" data-ride="carousel">
<h2 style="text-align:center">Images</h2>
<div id="imagesCarousel" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <?php getMediaForDate(wp_title($sep = '', $display = false, $seplocation = ''), "images") ?>
      <a class="carousel-control-prev" href="#imagesCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#imagesCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
      </a>

  </div>
    */ endif; ?>


       <?php
    if(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"audios.txt")) :
   ?>
<h2 style="text-align:center">Music</h2>
    <?php getMediaForDate(wp_title($sep = '', $display = false, $seplocation = ''), "audios") ?>
    <?php endif; ?>



        <?php
        if(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"snapshots.txt") == true) :
            ?>
            <!-- Page Content -->
            <div class="container">

                <h1 class="font-weight-light text-center text-lg-left mt-4 mb-0">Website Gallery</h1>
                <?php getMediaForDate(wp_title($sep = '', $display = false, $seplocation = ''), "snapshots") ?>
            </div>
            <!-- /.container -->
        <?php endif; ?>

    <?php
    if(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"gviewdocs.txt") == true) :
        ?>
        <!-- Page Content -->
        <div class="container">

            <h1 class="font-weight-light text-center text-lg-left mt-4 mb-0">Document Gallery</h1>

            <hr class="mt-2 mb-5">

            <div class="row text-center">

                <?php getMediaForDate(wp_title($sep = '', $display = false, $seplocation = ''), "gviewdocs") ?>

            </div>

        </div>
        <!-- /.container -->
    <?php endif; ?>

    <?php
    if(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"additional.txt")) :
        ?>
<h2 style="text-align:center">Additional Sources </h2>
    <?php endif; ?>


                </main><!-- .site-main -->
                
</div><!-- .content-area -->

<?php get_footer(); ?>
