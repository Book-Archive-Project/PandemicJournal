<?php get_header(); ?>
<body style="
        width: 100%;
        bottom: 0px;
        top: 0px;
        left: 0;
        position: absolute;
        background-image: url('<?php echo get_template_directory_uri()?>/images/back1.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        height: 100vh;
        "
>
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

<style>
    /* width /
    ::-webkit-scrollbar {
        width: 10px;
    }

    / Track /
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    / Handle /
    ::-webkit-scrollbar-thumb {
        background: #888;
    }

    / Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>

<div class="preloader"> <i class="fa fa-circle-o-notch fa-spin"></i></div>
<section id="homepage">
<h1 class="hometitle text-center"><strong> Journal of a Pandemic Year </strong></h1>
    <div class ="row text-center">
        <h2>Browse by Date:</h2>
        <div class = "datebrowsebox">
            <ul id="datelist">
                <?php $pages = get_pages();
                  addDropdown($pages); ?>
            </ul>
        </div>
    </div>
</section>
</body>