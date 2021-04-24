<?php get_header(); ?>
<body class="img-responsive" style="
        width: 100%;
        height: 100%;
        bottom: 0px;
        top: 0px;
        left: 0;
        position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        background-image: url('<?php echo get_template_directory_uri()?>/images/bg4.jpg');
        "
>
<?php
/**
 * Template Name: Splash Page
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
    /* width */
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
<section id="splash">
    <div class="container">
        <strong><h1>Journal of a Pandemic Year</h1></strong>
        <h3>Search by date:</h3>
        <div class="input-group">
            <strong><input style="background-color:white; height:44px" class="form-control width100" placeholder="Enter Date: MM-DD-YYY"></strong>
            <span class="input-group-btn">
                <button class="btn btn-lg btn-info">Search</button>
            </span>
        </div>
        <h3 style="padding-left: 70%"><a href="http://localhost/pandemicjournal/">or continue on to the main site</a></h3>
    </div>
</section>
</body>