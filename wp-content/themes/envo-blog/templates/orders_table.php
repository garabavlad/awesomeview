<?php
/* Template Name: Orders Table */
get_header(); ?>

<?php get_template_part( 'template-parts/template-part', 'head' ); ?>

<!-- start content container -->
<?php get_template_part( 'content', 'page' ); ?>
<!-- end content container -->

<?php echo do_shortcode("[orders_table]"); ?>

<?php get_footer(); ?>
