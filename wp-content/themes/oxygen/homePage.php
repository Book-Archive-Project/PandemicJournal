<?php get_header(); ?>
<body style="
        width: 100%;
        bottom: 0px;
        top: 0px;
        left: 0;
        position: absolute;
        background-color: white;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        height: 100vh;
        "
>
<?php
/**
 * Template Name: Home Page
 * A Home page template
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

<style>
    /*width */
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
<div class="preloader"> <i class="fa fa-circle-o-notch fa-spin"></i></div>

<header id="home">
        <div class="main-nav" style="background-color:black;">
      <div class="container" style="width:95%;">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">
            <h1 style="color:white;">Pandemic Journal</h1>
          </a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="scroll"><a href="#about">About Us</a></li>
            <li class="scroll"><a href="#people">People</a></li>
            <li class="scroll"><a href="#contact">Contact Us</a></li>
              <li class="scroll"><a href="#contribute">Contribute</a></li>
          </ul>
        </div>
      </div>
    </div><!--/#main-nav-->
</header><!--/#home-->

<section id="services">
    <div class="container">
      <div class="heading wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
        <div class="row">
          <div class="text-center col-sm-8 col-sm-offset-2">
            <h2>Browse by Date</h2>
              <hr class="mt-2 mb-5">
          </div>
        </div>
          <div class="text-left">
              <ul id="datelist">
                  <?php $pages = get_pages();
                  addDropdown($pages); ?>
              </ul>
          </div>
      </div>
    </div>
</section><!--/#services-->

<section id="about">
    <div class="container">
        <div class="heading wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
            <div class="row">
                <div class="text-center col-sm-8 col-sm-offset-2">
                    <h2>About Us</h2>
                    <hr class="mt-2 mb-5">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="people">
    <div class="container">
        <div class="heading wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
            <div class="row">
                <div class="text-center col-sm-8 col-sm-offset-2">
                    <h2>People</h2>
                    <hr class="mt-2 mb-5">
                    <div class="people-left">
                        <img src="<?php echo get_template_directory_uri()?>/images/Margaret_Peacock2.jpg" alt="Dr. Margaret Peacock" style="max-width: 80%; height: auto; padding-bottom: 10px;">
                        <p><strong>Dr. Margaret Peacock</strong></p>
                    </div>
                    <div class="people-right">
                        <img src="<?php echo get_template_directory_uri()?>/images/Erik_L_Peterson.jpg" alt="Dr. Eric L. Peterson" style="max-width: 82%; height: auto; padding-bottom: 10px;">
                        <p><strong>Dr. Erik L. Peterson</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="contact">
    <div class="container">
        <div class="heading wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
            <div class="row">
                <div class="text-center col-sm-8 col-sm-offset-2">
                    <h2>Contact Us</h2>
                    <hr class="mt-2 mb-5">
                    <p>email: example@gmail.com<br>phone: (***)-***-****</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="contribute">
    <div class="container">
        <div class="heading wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
            <div class="row">
                <div class="text-center col-sm-8 col-sm-offset-2">
                    <h2>Contribute</h2>
                    <hr class="mt-2 mb-5">
                    <p>In Progress. You will soon be able to input your own stories. Check back later!</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- <section id="homepage">
<h1 class="hometitle text-center"><strong> Journal of a Pandemic Year </strong></h1>
    <div class ="row text-center">
        <h2>Browse by Date:</h2>
        <div class = "datebrowsebox">
            <ul id="datelist">
                <?php// $pages = get_pages();
                  //addDropdown($pages); ?>
            </ul>
        </div>
    </div>
</section> -->
</body>