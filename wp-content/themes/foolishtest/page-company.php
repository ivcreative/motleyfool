<?php
/**
 * Template Name: company
 *
 * This is the template is only to display 
 * Companies and work as the test requires
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package foolishtest
 */

get_header();
?>

	<div id="primary" class="content-area foolrapper">
	<main id="main" class="site-main fool-row">
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'company' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
