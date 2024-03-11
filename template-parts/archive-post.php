<div class="blog__item">
	<a href="<?php the_permalink(); ?>" class="blog__img"><?php
			the_post_thumbnail();
		// if (the_post_thumbnail()) {
		// } else {
		// 	$media = get_attached_media( 'image' );
		// 	$media = array_shift( $media );
		// 	if ($media) {
		// 		echo wp_get_attachment_image($media->ID, 'large');
		// 	}
		// }
	?></a>
	<div class="blog__descr">
		<!-- <div class="blog__cat"><?php the_category(' > ', 'single');  ?></div> -->
		<div class="blog__name"><?php the_title(); ?></div>
		<div class="blog__text"><?php the_excerpt(); ?></div>
		<a href="<?php the_permalink(); ?>" class="blog__more">Continue reading</a>
	</div>
</div>
