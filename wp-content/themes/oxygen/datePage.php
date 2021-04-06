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
            if(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"images.txt")) :
        ?>
        <li>
            <a href="#images">
                <i class="fa fa-picture-o fa-2x"></i>
                <span class="nav-text">
                            Images
                </span>
            </a>
        </li>
        <?php endif; ?>


        <?php
            if(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"videos.txt")) :
        ?>
        <li class="has-subnav">
            <a href="#videos">
                <i class="fa fa-play fa-2x"></i>
                <span class="nav-text">
                            Videos
                </span>
            </a>
        </li>
        <?php endif; ?>


        <?php
            if(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"audios.txt")) :
        ?>
        <li class="has-subnav">
            <a href="#audio">
                <i class="fa fa-headphones fa-2x"></i>
                <span class="nav-text">
                            Audios
                </span>
            </a>
        </li>
        <?php endif; ?>

        <?php
            if(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"gviewdocs.txt")) :
        ?>
        <li class="has-subnav">
            <a href="#documents">
                <i class="fa fa-file-text fa-2x"></i>
                <span class="nav-text">
                            Documents
                </span>
            </a>
        </li>
        <?php endif; ?>

        <?php
            if(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"snapshots.txt")) :
        ?>
        <li>
            <a href="#snapshots">
                <i class="fa  fa-link fa-2x"></i>
                <span class="nav-text">
                            Websites
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
                    <h1   style="font-size: 100px" class="animated fadeInLeftBig"><?php showTitle(wp_title($sep = '', $display = false, $seplocation = '')); ?></h1>
                </div>
            </div>
        </div>
        <a id="tohash" href="#services"><i class="fa fa-angle-down"></i></a>
    </div><!--/#home-slider-->
</header><!--/#home-->

<?php
if(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"images.txt")) :
    ?>
    <section id="images">
        <div class="container">
            <div class="row">
                <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                    <h2>Images</h2>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row imgbox">
                <?php getMediaForDate(wp_title($sep = '', $display = false, $seplocation = ''), "images") ?>
            </div>
        </div>
        <div id="images-single-wrap">
            <div id="image-single">
            </div>
        </div><!-- /#images-single-wrap -->
    </section><!--/#image-->
<?php endif ?>


<?php
if(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"videos.txt")) :
?>

    <section id="videos">

        <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
            <h2 style="color: white; text-align: center; margin-top: -20px; margin-bottom: 50px;">Videos</h2>
        </div>

        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <?php getMediaForDate(wp_title($sep = '', $display = false, $seplocation = ''), "videos") ?>
            </div>
            <!-- Controls -->
            <a id="controls" class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a id="controls" class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div> <!-- Carousel -->
    </section>
<?php endif ?>
<?php
if(hasMediaFile(wp_title($sep = '', $display = false, $seplocation = ''),"audios.txt")) :
    ?>
    <section id="audios">
        <div container">
            <div class="row">
                <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                    <h2 id="videocaption">Audio From <?php showTitle(wp_title($sep = '', $display = false, $seplocation = '')); ?></h2>
                </div>
            </div>
        </div>
        <div container">
            <div class="row imgbox">
                <?php getMediaForDate(wp_title($sep = '', $display = false, $seplocation = ''), "audios") ?>
            </div>
        </div>
    </section>
<?php endif ?>


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
        <div class="container-fluid">
            <div class="row snapshotbox form-group">
                <?php getMediaForDate(wp_title($sep = '', $display = false, $seplocation = ''), "snapshots") ?>
            </div>
        </div>
        </div>
        <div id="snapshots-single-wrap">
            <div id="snapshot-single">
            </div>
        </div><!-- /#snapshots-single-wrap -->
    </section><!--/#snapsots-->
<?php endif ?>

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

            <div class="row text-center">
                <?php getMediaForDate(wp_title($sep = '', $display = false, $seplocation = ''), "gviewdocs") ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<section id="features" class="parallax">
    <div class="container">
        <div class="row count">
            <div class="col-sm-3 col-xs-6 wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="300ms">
                <i class="fa fa-user"></i>
                <h3 class="timer">4000</h3>
                <p>Happy Clients</p>
            </div>
            <div class="col-sm-3 col-xs-6 wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="500ms">
                <i class="fa fa-desktop"></i>
                <h3 class="timer">200</h3>
                <p>Modern Websites</p>
            </div>
            <div class="col-sm-3 col-xs-6 wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="700ms">
                <i class="fa fa-trophy"></i>
                <h3 class="timer">10</h3>
                <p>WINNING AWARDS</p>
            </div>
            <div class="col-sm-3 col-xs-6 wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="900ms">
                <i class="fa fa-comment-o"></i>
                <h3>24/7</h3>
                <p>Fast Support</p>
            </div>
        </div>
    </div>
</section><!--/#features-->

<section id="pricing">
    <div class="container">
        <div class="row">
            <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="300ms">
                <h2>Pricing Table</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ut enim ad minim veniam</p>
            </div>
        </div>
        <div class="pricing-table">
            <div class="row">
                <div class="col-sm-3">
                    <div class="single-table wow flipInY" data-wow-duration="1000ms" data-wow-delay="300ms">
                        <h3>Basic</h3>
                        <div class="price">
                            $9<span>/Month</span>
                        </div>
                        <ul>
                            <li>Free Setup</li>
                            <li>10GB Storage</li>
                            <li>100GB Bandwith</li>
                            <li>5 Products</li>
                        </ul>
                        <a href="#" class="btn btn-lg btn-primary">Sign up</a>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="single-table wow flipInY" data-wow-duration="1000ms" data-wow-delay="500ms">
                        <h3>Standard</h3>
                        <div class="price">
                            $19<span>/Month</span>
                        </div>
                        <ul>
                            <li>Free Setup</li>
                            <li>10GB Storage</li>
                            <li>100GB Bandwith</li>
                            <li>5 Products</li>
                        </ul>
                        <a href="#" class="btn btn-lg btn-primary">Sign up</a>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="single-table featured wow flipInY" data-wow-duration="1000ms" data-wow-delay="800ms">
                        <h3>Featured</h3>
                        <div class="price">
                            $29<span>/Month</span>
                        </div>
                        <ul>
                            <li>Free Setup</li>
                            <li>10GB Storage</li>
                            <li>100GB Bandwith</li>
                            <li>5 Products</li>
                        </ul>
                        <a href="#" class="btn btn-lg btn-primary">Sign up</a>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="single-table wow flipInY" data-wow-duration="1000ms" data-wow-delay="1100ms">
                        <h3>Professional</h3>
                        <div class="price">
                            $49<span>/Month</span>
                        </div>
                        <ul>
                            <li>Free Setup</li>
                            <li>10GB Storage</li>
                            <li>100GB Bandwith</li>
                            <li>5 Products</li>
                        </ul>
                        <a href="#" class="btn btn-lg btn-primary">Sign up</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--/#pricing-->

<section id="twitter" class="parallax">
    <div>
        <a class="twitter-left-control" href="#twitter-carousel" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
        <a class="twitter-right-control" href="#twitter-carousel" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="twitter-icon text-center">
                        <i class="fa fa-twitter"></i>
                        <h4>Themeum</h4>
                    </div>
                    <div id="twitter-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="item active wow fadeIn" data-wow-duration="1000ms" data-wow-delay="300ms">
                                <p>Introducing Shortcode generator for Helix V2 based templates <a href="#"><span>#helixframework #joomla</span> http://bit.ly/1qlgwav</a></p>
                            </div>
                            <div class="item">
                                <p>Introducing Shortcode generator for Helix V2 based templates <a href="#"><span>#helixframework #joomla</span> http://bit.ly/1qlgwav</a></p>
                            </div>
                            <div class="item">
                                <p>Introducing Shortcode generator for Helix V2 based templates <a href="#"><span>#helixframework #joomla</span> http://bit.ly/1qlgwav</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--/#twitter-->

<section id="blog">
    <div class="container">
        <div class="row">
            <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="300ms">
                <h2>Blog Posts</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ut enim ad minim veniam</p>
            </div>
        </div>
        <div class="blog-posts">
            <div class="row">
                <div class="col-sm-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="400ms">
                    <div class="post-thumb">
                        <a href="#"><img class="img-responsive" src="images/blog/1.jpg" alt=""></a>
                        <div class="post-meta">
                            <span><i class="fa fa-comments-o"></i> 3 Comments</span>
                            <span><i class="fa fa-heart"></i> 0 Likes</span>
                        </div>
                        <div class="post-icon">
                            <i class="fa fa-pencil"></i>
                        </div>
                    </div>
                    <div class="entry-header">
                        <h3><a href="#">Lorem ipsum dolor sit amet consectetur adipisicing elit</a></h3>
                        <span class="date">June 26, 2014</span>
                        <span class="cetagory">in <strong>Photography</strong></span>
                    </div>
                    <div class="entry-content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                    </div>
                </div>
                <div class="col-sm-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="post-thumb">
                        <div id="post-carousel"  class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#post-carousel" data-slide-to="0" class="active"></li>
                                <li data-target="#post-carousel" data-slide-to="1"></li>
                                <li data-target="#post-carousel" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <a href="#"><img class="img-responsive" src="images/blog/2.jpg" alt=""></a>
                                </div>
                                <div class="item">
                                    <a href="#"><img class="img-responsive" src="images/blog/1.jpg" alt=""></a>
                                </div>
                                <div class="item">
                                    <a href="#"><img class="img-responsive" src="images/blog/3.jpg" alt=""></a>
                                </div>
                            </div>
                            <a class="blog-left-control" href="#post-carousel" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                            <a class="blog-right-control" href="#post-carousel" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
                        </div>
                        <div class="post-meta">
                            <span><i class="fa fa-comments-o"></i> 3 Comments</span>
                            <span><i class="fa fa-heart"></i> 0 Likes</span>
                        </div>
                        <div class="post-icon">
                            <i class="fa fa-picture-o"></i>
                        </div>
                    </div>
                    <div class="entry-header">
                        <h3><a href="#">Lorem ipsum dolor sit amet consectetur adipisicing elit</a></h3>
                        <span class="date">June 26, 2014</span>
                        <span class="cetagory">in <strong>Photography</strong></span>
                    </div>
                    <div class="entry-content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                    </div>
                </div>
                <div class="col-sm-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="800ms">
                    <div class="post-thumb">
                        <a href="#"><img class="img-responsive" src="images/blog/3.jpg" alt=""></a>
                        <div class="post-meta">
                            <span><i class="fa fa-comments-o"></i> 3 Comments</span>
                            <span><i class="fa fa-heart"></i> 0 Likes</span>
                        </div>
                        <div class="post-icon">
                            <i class="fa fa-video-camera"></i>
                        </div>
                    </div>
                    <div class="entry-header">
                        <h3><a href="#">Lorem ipsum dolor sit amet consectetur adipisicing elit</a></h3>
                        <span class="date">June 26, 2014</span>
                        <span class="cetagory">in <strong>Photography</strong></span>
                    </div>
                    <div class="entry-content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                    </div>
                </div>
            </div>
            <div class="load-more wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="500ms">
                <a href="#" class="btn-loadmore"><i class="fa fa-repeat"></i> Load More</a>
            </div>
        </div>
    </div>
</section><!--/#blog-->

<section id="contact">
    <div id="google-map" class="wow fadeIn" data-latitude="52.365629" data-longitude="4.871331" data-wow-duration="1000ms" data-wow-delay="400ms"></div>
    <div id="contact-us" class="parallax">
        <div class="container">
            <div class="row">
                <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                    <h2>Contact Us</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ut enim ad minim veniam</p>
                </div>
            </div>
            <div class="contact-form wow fadeIn" data-wow-duration="1000ms" data-wow-delay="600ms">
                <div class="row">
                    <div class="col-sm-6">
                        <form id="main-contact-form" name="contact-form" method="post" action="#">
                            <div class="row  wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" placeholder="Name" required="required">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Email Address" required="required">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="subject" class="form-control" placeholder="Subject" required="required">
                            </div>
                            <div class="form-group">
                                <textarea name="message" id="message" class="form-control" rows="4" placeholder="Enter your message" required="required"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn-submit">Send Now</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6">
                        <div class="contact-info wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                            <ul class="address">
                                <li><i class="fa fa-map-marker"></i> <span> Address:</span> 2400 South Avenue A </li>
                                <li><i class="fa fa-phone"></i> <span> Phone:</span> +928 336 2000  </li>
                                <li><i class="fa fa-envelope"></i> <span> Email:</span><a href="mailto:someone@yoursite.com"> support@oxygen.com</a></li>
                                <li><i class="fa fa-globe"></i> <span> Website:</span> <a href="#">www.sitename.com</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--/#contact-->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="js/jquery.inview.min.js"></script>
<script type="text/javascript" src="js/wow.min.js"></script>
<script type="text/javascript" src="js/mousescroll.js"></script>
<script type="text/javascript" src="js/smoothscroll.js"></script>
<script type="text/javascript" src="js/jquery.countTo.js"></script>
<script type="text/javascript" src="js/lightbox.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>

</body>

<?php get_footer(); ?>
