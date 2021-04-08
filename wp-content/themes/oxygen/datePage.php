<?php
/**
 * Template Name: Date Page
 * The template for all date pages
 *
 *
 * @package    oxygen
 * @copyright  Journal of a Pandemic Year
 *
 * @since    1.0.0
 * @version  1.0.0
 */

include 'mediaFunctions.php';
?>

<?php get_header(); ?>
<body>
<div class="area"></div>
<nav class="main-menu">
    <ul>
        <?php
        if(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"manuscripts.txt")) :
            ?>
        <li>
            <a href="#manuscripts">
                <i class="fa fa-book nav-icon"></i>
                <span class="nav-text">
                    Manuscripts
                </span>
            </a>
        </li>
        <?php endif; ?>

        <?php
            if(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"images.txt")) :
        ?>
        <li>
            <a href="#images">
                <i class="fa fa-picture-o nav-icon"></i>
                <span class="nav-text">
                            Images
                </span>
            </a>
        </li>
        <?php endif; ?>

        <?php
            if(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"videos.txt")) :
        ?>
        <li>
            <a href="#videos">
                <i class="fa fa-play nav-icon"></i>
                <span class="nav-text">
                            Videos
                </span>
            </a>
        </li>
        <?php endif; ?>

        <?php
            if(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"audios.txt")) :
        ?>
        <li>
            <a href="#audios">
                <i class="fa fa-headphones nav-icon"></i>
                <span class="nav-text">
                            Audios
                </span>
            </a>
        </li>
        <?php endif; ?>

        <?php
        if(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"snapshots.txt")) :
            ?>
            <li>
                <a href="#snapshots">
                    <i class="fa fa-link nav-icon"></i>
                    <span class="nav-text">
                            Websites
                </span>
                </a>
            </li>
        <?php endif; ?>

        <?php
            if(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"gviewdocs.txt")) :
        ?>
        <li>
            <a href="#documents">
                <i class="fa fa-file-text nav-icon"></i>
                <span class="nav-text">
                            Documents
                </span>
            </a>
        </li>
        <?php endif; ?>

        <?php
             if(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"links.txt")) :
        ?>
        <li>
            <a href="#live-links">
                <i class="fa fa-external-link nav-icon"></i>
                <span class="nav-text">
                            Additional Sources
                </span>
            </a>
        </li>
        <?php endif; ?>
    </ul>
</nav>

<style>
    /* width */
    ::-webkit-scrollbar {
        width: 10px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #888;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>
<!--.preloader-->
<div class="preloader"> <i class="fa fa-circle-o-notch fa-spin"></i></div>
<!--/.preloader-->

<header id="home">
    <div id="home-slider" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active" style="background-image: url(<?php echo get_template_directory_uri().'/images/background.png'?>)">
                <div class="caption">
                    <h1 class="animated fadeInLeftBig"><?php showTitle(wp_title($sep = '', $display = false, $seplocation = '')); ?></h1>
                </div>
            </div>
        </div>

        <?php
        if(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"manuscripts.txt")) :?>
            <a id="tohash" href="#manuscripts"><i class="fa fa-angle-down"></i></a>
        <?php elseif(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"images.txt")) :?>
            <a id="tohash" href="#images"><i class="fa fa-angle-down"></i></a>
        <?php elseif(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"videos.txt")) :?>
            <a id="tohash" href="#videos"><i class="fa fa-angle-down"></i></a>
        <?php elseif(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"audios.txt")) :?>
            <a id="tohash" href="#audios"><i class="fa fa-angle-down"></i></a>
        <?php elseif(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"snapshots.txt")) :?>
            <a id="tohash" href="#snapshots"><i class="fa fa-angle-down"></i></a>
        <?php elseif(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"gviewdocs.txt")) :?>
            <a id="tohash" href="#documents"><i class="fa fa-angle-down"></i></a>
        <?php elseif(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"links.txt")) :?>
            <a id="tohash" href="#live-links"><i class="fa fa-angle-down"></i></a>
        <?php endif; ?>
    </div><!--/#home-slider-->
</header><!--/#home-->

<?php
if(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"manuscripts.txt")) :?>
    <section id="manuscripts">
        <div class="container">
            <div class="row">
                <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                    <h2>Manuscripts</h2>
                    <hr class="mt-2 mb-5">
                </div>
            </div>
        </div>
        <div class="wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
            <div class="container-fluid">
                <?php getMediaForDate(wp_title($sep = '', $display = false, $seplocation = ''), "manuscripts") ?>
            </div>
        </div>
    </section><!--/#manuscripts-->

<?php endif; ?>

<?php
if(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"images.txt")) :
    ?>
    <section id="images">
        <div class="wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
        <div class="container-fluid">
            <div class="row imgbox">
                <?php getMediaForDate(wp_title($sep = '', $display = false, $seplocation = ''), "images") ?>
            </div>
        </div>
        <div id="images-single-wrap">
            <div id="image-single">
            </div>
        </div><!-- /#images-single-wrap -->
        </div>
    </section><!--/#image-->
<?php endif; ?>


<?php
if(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"videos.txt")) :
?>

    <section id="videos">
        <!--The data-interval="false" attribute and value turns off the automatic slide animation -->
        <div id="myCarousel" class="carousel slide" data-interval="false">

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">

                <?php getMediaForDate(wp_title($sep = '', $display = false, $seplocation = ''), "videos") ?>

            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">

      <span class="glyphicon glyphicon-chevron-left" >
	  <!--This <i> tag is template specific within my template conditions. Check yours to see if it renders icons differently within its library, otherwise, comment this line out and stick with the simple bootstrap glyphs-->
	  <!-- <i class="fa fa-arrow-left"></i> -->
	  </span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right">
	  <!--This <i> tag is template specific within my template conditions. Check yours to see if it renders icons differently within its library, otherwise, comment this line out and stick with the simple bootstrap glyphs-->
	  <!-- <i class="fa fa-arrow-right"></i> -->
	  </span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
<?php endif; ?>
<?php
if(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"audios.txt")) :
    ?>
    <section id="audios">
        <div class="container audio">
            <div class="row">
                <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" style="padding: 0;" data-wow-duration="1000ms" data-wow-delay="300ms">
                    <h2 class="audio">Audio</h2>
                </div>
            </div>
        </div>
        <div class="wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
        <div class="container-fluid audio">
            <div class="row audiobox">
                <?php getMediaForDate(wp_title($sep = '', $display = false, $seplocation = ''), "audios") ?>
            </div>
        </div>
        </div>
    </section>
<?php endif; ?>


<?php
if(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"snapshots.txt")) :
    ?>
    <section id="snapshots">
        <div class="container websourcecontainer">
            <div class="row">
                <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                    <h2>Web Sources</h2>

                </div>
            </div>
        </div>

        <div class="wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
            <div class="container-fluid">
                <div class="row snapshotbox">
                    <?php getMediaForDate(wp_title($sep = '', $display = false, $seplocation = ''), "snapshots") ?>
                </div>
            </div>
        </div>
        <div id="snapshots-single-wrap">
            <div id="snapshot-single">
            </div>
        </div><!-- /#snapshots-single-wrap -->

    </section><!--/#snapsots-->
<?php endif; ?>

<?php
if(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"gviewdocs.txt")) :
?>
    <!-- Page Content -->
    <section id="documents">
        <div class="container">
            <div class="wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                <h2 class="font-weight-light text-center text-lg-left mt-4 mb-0">Document Gallery</h2>
                <hr class="mt-2 mb-5">
            </div>

            <div class="wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
            <div class="row text-center">
                <?php getMediaForDate(wp_title($sep = '', $display = false, $seplocation = ''), "gviewdocs") ?>
            </div>
        </div>
        </div>
    </section>
<?php endif; ?>

<?php
if(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"links.txt")) :
    ?>
    <!-- Page Content -->
    <section style="max-width: 100%;" id="live-links">
        <div class="container">
            <div class="wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                <h2 class="font-weight-light text-center text-lg-left mt-4 mb-0">Additional Sources</h2>
                <hr class="mt-2 mb-5">
            </div>
            <div class="wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                <div class="row text-center">
                    <?php getMediaForDate(wp_title($sep = '', $display = false, $seplocation = ''), "links") ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

</body>

<?php get_footer(); ?>
