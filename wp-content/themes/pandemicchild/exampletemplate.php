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





get_header();

?> <h1> If the title prints here: <?php wp_title(); ?> then it works </h1> <?php

	while ( have_posts() ) : the_post();

		get_template_part( 'templates/parts/content/content', 'page' );

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}

	endwhile;

get_footer();