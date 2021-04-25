<div class="preloader"> <i class="fa fa-circle-o-notch fa-spin"></i></div>
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
<?php
if (isset($_GET['date'])) {
    $date = $_GET['date'];
    if (preg_match("~^\d{2}-\d{2}-\d{4}$~", $date)) {
        $dateParts = explode("-", $date);
        $altDate = $dateParts[2] . "-" . $dateParts[0] . "-" . $dateParts[1];
        if(post_exists($altDate)) {
            header("Location: http://localhost/pandemicjournal/" . $altDate); }
        else { echo '<div class="alert alert-warning">
                        <strong>Date Not Found. Please try another</strong>
                   </div>'; }
    } else { echo '<div class="alert alert-warning">
                        <strong>Wrong Format! Use MM-DD-YYYY to search for a Date</strong>
                   </div>'; }
} ?>
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


<section id="splash">
    <div class="container">
        <strong><h1>Journal of a Pandemic Year</h1></strong>
        <h3>Search by date:</h3>
            <form class="input-group" method="=post">
                <strong><input type="text" name="date" style="background-color: white; height: 44px;" class="form-control width100" placeholder="Enter Date: MM-DD-YYYY"></strong>
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-lg btn-info">Search</button>
                </span>
            </form>
        <h3 style="padding-left: 70%"><a href="http://localhost/pandemicjournal/home">or continue on to the main site</a></h3>
    </div>
</section>
</body>