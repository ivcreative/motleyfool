<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
			$ipage = get_post_type();

			//get_template_part( 'template-parts/content', get_post_type() );
			switch ($ipage) :
				case "fool_stocks":
				get_template_part('template-parts/content', 'side');
				break;
				default:
				get_template_part( 'template-parts/content', get_post_type() );
				break;
			endswitch;

			//the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
		endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
