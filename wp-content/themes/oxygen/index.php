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


<section id="homepage">
<h1 class="hometitle text-center"><strong> Journal of a Pandemic Year </strong></h1>
    <div class ="row text-center">
        <h3>Browse by Date:</h3>
        <div class = "datebrowsebox">
        <nav>
            <ul id="datelist">
        <?php $pages = get_pages();
        foreach ( $pages as $page ) {
        echo '<li><a style="font-weight: bold" href="'. get_page_link($page->ID) . '"> '. $page->post_title . '</a></li>';
        }?>
            </ul>
        </nav>
        </div>
    </div>
</section>
</body>