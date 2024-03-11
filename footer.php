<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package frondendie
 */

?>

	<footer id="colophon" class="footer">
		<div class="footer__content">
			<div class="footer__logo logo"><?php the_custom_logo(); ?></div>
			<nav class="footer__nav">
				<?php
				wp_nav_menu(
					array(
						'menu' => 'footer-menu',
						'container'       => '',
						'menu_class'      => 'menu menu_footer',
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					)
				);
				?>
			</nav>
			<div class="footer__soc">
				<div class="soc">
					<?php
					wp_nav_menu(
						array(
							'menu' => 'socials-menu',
							'container'       => '',
							'menu_class'      => 'menu menu_soc',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						)
					);
					?>
				</div>
			</div>
		</div>
		<div class="footer__bottom">
			<div class="footer__content">
				<div class="footer__copy">All rights reserved <?php echo date('Y') ?></div>

				<a href="<?php echo get_privacy_policy_url(); ?>">Privacy policy</a>
			</div>
		</div>
	</footer>
	<!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
