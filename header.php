<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Focus
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
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'focus' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php 
			if (!is_front_page() ) : ?>
			<a href="<?php echo get_home_url(); ?>" class="custom-logo-link logo-link--dark">
				<img src="<?php echo get_theme_mod('front_page_branding');?>"  alt="<?php bloginfo( 'name' ); ?> branding"/>
			</a>
			<?php endif;?>
			<?php 
			if ( is_front_page() ) :
				?>
				<?php the_custom_logo(); ?>		
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$focus_description = get_bloginfo( 'description', 'display' );
			if ( $focus_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $focus_description; /* WPCS: xss ok. */ ?></p>
			<?php endif; ?>
		</div>

		<nav id="site-navigation" class="main-navigation">
			
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
			) );
			?>
		</nav>
	</header>
