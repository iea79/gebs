<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package frondendie
 */

?>

<div class="page__content <?php post_class(); ?>">
	<!-- <div class="container_center"> -->
		<?php
			breadcrumbs();
			the_title( '<h1 class="page__title">', '</h1>' );
		?>
		<div class="page__body">
			<?php
			// print_r($post);
			// echo $post->post_name;
			switch ( $post->post_name ) {
				case 'faqs':
					require get_template_directory() . '/inc/page-faqs.php';
					break;
				default:
					the_content();
					break;
			}
			?>
		</div>
	<!-- </div> -->
</div>
