<?php
/* Template Name: Reservation SPA */
get_header(); ?>

<?php get_template_part( 'template-parts/template-part', 'head' ); ?>

<!-- start content container -->
<?php get_template_part( 'content', 'page' ); ?>
<!-- end content container -->

<?php echo do_shortcode("[reservation_spa]"); ?>

<?php get_footer(); ?>
