<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Focus
 */

get_header();
?>
<main class="front-page__background-image" style="background-image: url(<?php the_field('front_page_image'); ?>);"></main>

<?php
get_footer();
