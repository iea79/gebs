<?php
get_header();
?>
<main class="main blogPage">
    <div class="container_center">
        
        <?php breadcrumbs(); ?>

        <h1 class="page__title"><?php the_title(); ?></h1>

        <?php		
            global $post;

            $query = new WP_Query( [
                'posts_per_page' => -1,
                'post_type'      => 'post',
            ] );

            if ( $query->have_posts() ) {
                ?>
                    <div class="blog__list">
                    <?php
                        while ( $query->have_posts() ) {
                            $query->the_post();
                            get_template_part( 'template-parts/archive', get_post_type() );
                        }
                    ?>
                    </div>
                <?php
            }
            wp_reset_postdata(); // Сбрасываем $post
        ?>

    </div>
</main>
<?php
get_footer();
