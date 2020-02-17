<?php
/**
 * Template part for displaying post archives and search results
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage WaltzConstruction
 * @since 1.0.0
 */

?>
<?php
	
	?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header fool-md-12">
		<?php
		if ( is_sticky() && is_home() && ! is_paged() ) {
			printf( '<span class="sticky-post">%s</span>', _x( 'Featured', 'post', 'foolishtest' ) );
		}

		$ticket = MQ_Utilities::tickernames(); 
		$company = MQ_Utilities::companynames();
		?>
		<h2 class="entry-title">
                    <a href="<?php the_permalink(); ?>" rel="bookmark">
                        <?php the_title(); ?> <?php if (isset($ticket) || isset($company)) { echo '(' .$ticket ;  } if (isset($ticket) && isset($company)) {echo ':';} if (isset($ticket) || isset($company)) { echo $company. ')'; } ?>
                    </a>
                </h2>
	</header><!-- .entry-header -->

	<?php foolishtest_post_thumbnail(); ?>

	<div class="entry-content fool-md-12">
		<?php the_excerpt(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer fool-row">
		<?php foolishtest_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-${ID} -->

