<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package frondendie
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://use.typekit.net/utk6jro.css">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
	<header id="masthead" class="header">
		<div class="header__content">
			<div class="menu__toggle"></div>
			<div class="header__logo logo">
				<?php the_custom_logo(); ?>
			</div><!-- .site-branding -->
			<div class="header__nav">
				<nav id="site-navigation" class="nav">
					<?php
					wp_nav_menu(
						array(
							'menu' => 'menu-1',
							'container'       => '',
							'menu_class'      => 'menu',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						)
					);
					?>
					<div class="header__account mobile">
						<a href="/my-account" class="btn btn_border_white">My account</a>
					</div>
				</nav><!-- #site-navigation -->
			</div>

			<div class="header__right">
				<?php echo do_shortcode( '[yith_wcwl_items_count]' ); ?>

				<a href="/checkout" class="cart_link header__icon">
					<i class="icon_cart"></i>
					<div class="cartHeader__count"></div>
				</a>
				<a href="/my-account" class="btn btn_border_white desktop">My account</a>
			</div>

		</div>
	</header><!-- #masthead -->
