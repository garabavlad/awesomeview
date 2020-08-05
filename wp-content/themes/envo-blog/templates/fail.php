<?php
/* Template Name: Fail page */
get_header(); ?>

<?php get_template_part( 'template-parts/template-part', 'head' ); ?>

<!-- start content container -->
<?php get_template_part( 'content', 'page' ); ?>
<!-- end content container -->

<?php echo do_shortcode("[fail_page]"); ?>

<?php get_footer(); ?>
