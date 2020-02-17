<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package foolishtest
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'foolishtest' ); ?></a>

		<header id="masthead" class="site-header">
			<div class="fool-row fool-flex-middle">

				<div class="fool-md-3 fool-flex-middle fool-flex">
					<?php if ( is_page_template( 'page-company.php' ) ) : ?>

						<?php 
						// If no featured image was set for a company use the API logo instead if it exsit, if not it will only show the title
						if (has_post_thumbnail()) :
							foolishtest_post_thumbnail();

						else :
							$slug_logo = get_the_terms( $post->ID, 'company_tag' );
							

							if ($slug_logo) :
								foreach ( $slug_logo as $logo ) :
									$term_logo = $logo->name;
									$slugcapslogo = strtoupper($term_logo);

									// Lets call the API
									MQ_Utilities::fool_api_logo($slugcapslogo);
								endforeach;	
							endif;
						endif; 

						?>
						<?php the_title( '<h1 class="entry-title">', '</h1>' );?>
						<?php
					else :
						?>
						<?php
						the_custom_logo();
						if ( is_front_page() && is_home() ) :
							?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
					else :
						?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>

					<?php endif; ?>
				<?php endif; ?>
			</div><!-- .site-branding -->

			<div class="fool-md-9">
				<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'foolishtest' ); ?>">
					
					<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'main-menu',
						'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					) );
					?>
				</nav><!-- #site-navigation -->
			</div><!-- .fool-md-9 -->
		</div><!-- .fool-row -->
		
	</header><!-- #masthead -->

	<div id="content" class="site-content">
