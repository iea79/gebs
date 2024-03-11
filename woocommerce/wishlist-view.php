<?php
/**
 * Wishlist page template - Standard Layout
 *
 * @author YITH
 * @package YITH\Wishlist\Templates\Wishlist\View
 * @version 3.0.0
 */

/**
 * Template variables:
 *
 * @var $wishlist                      \YITH_WCWL_Wishlist Current wishlist
 * @var $wishlist_items                array Array of items to show for current page
 * @var $wishlist_token                string Current wishlist token
 * @var $wishlist_id                   int Current wishlist id
 * @var $users_wishlists               array Array of current user wishlists
 * @var $pagination                    string yes/no
 * @var $per_page                      int Items per page
 * @var $current_page                  int Current page
 * @var $page_links                    array Array of page links
 * @var $is_user_owner                 bool Whether current user is wishlist owner
 * @var $show_price                    bool Whether to show price column
 * @var $show_dateadded                bool Whether to show item date of addition
 * @var $show_stock_status             bool Whether to show product stock status
 * @var $show_add_to_cart              bool Whether to show Add to Cart button
 * @var $show_remove_product           bool Whether to show Remove button
 * @var $show_price_variations         bool Whether to show price variation over time
 * @var $show_variation                bool Whether to show variation attributes when possible
 * @var $show_cb                       bool Whether to show checkbox column
 * @var $show_quantity                 bool Whether to show input quantity or not
 * @var $show_ask_estimate_button      bool Whether to show Ask an Estimate form
 * @var $show_last_column              bool Whether to show last column (calculated basing on previous flags)
 * @var $move_to_another_wishlist      bool Whether to show Move to another wishlist select
 * @var $move_to_another_wishlist_type string Whether to show a select or a popup for wishlist change
 * @var $additional_info               bool Whether to show Additional info textarea in Ask an estimate form
 * @var $price_excl_tax                bool Whether to show price excluding taxes
 * @var $enable_drag_n_drop            bool Whether to enable drag n drop feature
 * @var $repeat_remove_button          bool Whether to repeat remove button in last column
 * @var $available_multi_wishlist      bool Whether multi wishlist is enabled and available
 * @var $no_interactions               bool
 */

if ( ! defined( 'YITH_WCWL' ) ) {
	exit;
} // Exit if accessed directly
?><div class="woocommerce-page">
    <?php
    $ids = "";
	if ( $wishlist && $wishlist->has_items() ) :
        echo '<ul class="products columns-4">';
		foreach ( $wishlist_items as $item ) :
            // print_r($item['product_id']);
            // print_r('<br><br>');

            $ids.=$item['product_id'] . ',';

            global $product;

            $product      = $item->get_product();
            $availability = $product->get_availability();
            $stock_status = isset( $availability['class'] ) ? $availability['class'] : false;

            if ( $product && $product->exists() ) :
                ?>
                <li class="product" id="yith-wcwl-row-<?php echo esc_attr( $item->get_product_id() ); ?>" data-row-id="<?php echo esc_attr( $item->get_product_id() ); ?>">
                    <?php if ( $show_cb ) : ?>
                        <div class="product-checkbox">
                            <input type="checkbox" value="yes" name="items[<?php echo esc_attr( $item->get_product_id() ); ?>][cb]"/>
                        </div>
                    <?php endif ?>

                    <?php if ( $show_remove_product ) : ?>
                        <div class="product-remove">
                            <div>
                                <a href="<?php echo esc_url( $item->get_remove_url() ); ?>" class="remove remove_from_wishlist" title="<?php echo esc_html( apply_filters( 'yith_wcwl_remove_product_wishlist_message_title', __( 'Remove this product', 'yith-woocommerce-wishlist' ) ) ); ?>">&times;</a>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php
                        if ( ! wc_review_ratings_enabled() ) {
                        	return;
                        }

                        echo wc_get_rating_html( $product->get_average_rating() );
                    ?>
                    <a href="<?php echo esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $item->get_product_id() ) ) ); ?>" class="woocommerce-loop-product__link">
                        <div class="product-thumbnail">
                            <?php do_action( 'yith_wcwl_table_before_product_thumbnail', $item, $wishlist ); ?>

                            <?php echo wp_kses_post( $product->get_image() ); ?>

                            <?php do_action( 'yith_wcwl_table_after_product_thumbnail', $item, $wishlist ); ?>
                        </div>

                        <h2 class="woocommerce-loop-product__title">
                            <?php do_action( 'yith_wcwl_table_before_product_name', $item, $wishlist ); ?>

                            <?php echo wp_kses_post( apply_filters( 'woocommerce_in_cartproduct_obj_title', $product->get_title(), $product ) ); ?>

                            <?php
                            if ( $show_variation && $product->is_type( 'variation' ) ) {
                                /**
                                * Product is a Variation
                                *
                                * @var $product \WC_Product_Variation
                                */
                                echo wp_kses_post( wc_get_formatted_variation( $product ) );
                            }
                            ?>

                            <?php do_action( 'yith_wcwl_table_after_product_name', $item, $wishlist ); ?>
                        </h2>

                        <?php if ( $show_price || $show_price_variations ) : ?>
                            <div class="price">
                                <?php do_action( 'yith_wcwl_table_before_product_price', $item, $wishlist ); ?>

                                <?php
                                if ( $show_price ) {
                                    echo wp_kses_post( $item->get_formatted_product_price() );
                                }

                                if ( $show_price_variations ) {
                                    echo wp_kses_post( $item->get_price_variation() );
                                }
                                ?>

                                <?php do_action( 'yith_wcwl_table_after_product_price', $item, $wishlist ); ?>
                            </div>
                        <?php endif ?>
                    </a>

                    <?php if ( $show_quantity ) : ?>
                        <div class="product-quantity">
                            <?php do_action( 'yith_wcwl_table_before_product_quantity', $item, $wishlist ); ?>

                            <?php if ( ! $no_interactions && $wishlist->current_user_can( 'update_quantity' ) ) : ?>
                                <input type="number" min="1" step="1" name="items[<?php echo esc_attr( $item->get_product_id() ); ?>][quantity]" value="<?php echo esc_attr( $item->get_quantity() ); ?>"/>
                            <?php else : ?>
                                <?php echo esc_html( $item->get_quantity() ); ?>
                            <?php endif; ?>

                            <?php do_action( 'yith_wcwl_table_after_product_quantity', $item, $wishlist ); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( $show_last_column ) : ?>
                        <?php do_action( 'yith_wcwl_table_before_product_cart', $item, $wishlist ); ?>

                        <!-- Date added -->
                        <?php
                        if ( $show_dateadded && $item->get_date_added() ) :
                            // translators: date added label: 1 date added.
                            echo '<span class="dateadded">' . esc_html( sprintf( __( 'Added on: %s', 'yith-woocommerce-wishlist' ), $item->get_date_added_formatted() ) ) . '</span>';
                        endif;
                        ?>

                        <?php do_action( 'yith_wcwl_table_product_before_add_to_cart', $item, $wishlist ); ?>

                        <!-- Add to cart button -->
                        <?php $show_add_to_cart = apply_filters( 'yith_wcwl_table_product_show_add_to_cart', $show_add_to_cart, $item, $wishlist ); ?>
                        <?php if ( $show_add_to_cart && isset( $stock_status ) && 'out-of-stock' !== $stock_status ) : ?>
                            <?php woocommerce_template_loop_add_to_cart( array( 'quantity' => $show_quantity ? $item->get_quantity() : 1 ) ); ?>
                        <?php endif ?>

                        <?php do_action( 'yith_wcwl_table_product_after_add_to_cart', $item, $wishlist ); ?>

                        <!-- Change wishlist -->
                        <?php $move_to_another_wishlist = apply_filters( 'yith_wcwl_table_product_move_to_another_wishlist', $move_to_another_wishlist, $item, $wishlist ); ?>
                        <?php if ( $move_to_another_wishlist && $available_multi_wishlist && count( $users_wishlists ) > 1 ) : ?>
                            <?php if ( 'select' === $move_to_another_wishlist_type ) : ?>
                                <select class="change-wishlist selectBox">
                                    <option value=""><?php esc_html_e( 'Move', 'yith-woocommerce-wishlist' ); ?></option>
                                    <?php
                                    foreach ( $users_wishlists as $wl ) :
                                        /**
                                         * Each of customer's wishlists
                                         *
                                         * @var $wl \YITH_WCWL_Wishlist
                                         */
                                        if ( $wl->get_token() === $wishlist_token ) {
                                            continue;
                                        }
                                        ?>
                                        <option value="<?php echo esc_attr( $wl->get_token() ); ?>">
                                            <?php echo sprintf( '%s - %s', esc_html( $wl->get_formatted_name() ), esc_html( $wl->get_formatted_privacy() ) ); ?>
                                        </option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            <?php else : ?>
                                <a href="#move_to_another_wishlist" class="move-to-another-wishlist-button" data-rel="prettyPhoto[move_to_another_wishlist]">
                                    <?php echo esc_html( apply_filters( 'yith_wcwl_move_to_another_list_label', __( 'Move to another list &rsaquo;', 'yith-woocommerce-wishlist' ) ) ); ?>
                                </a>
                            <?php endif; ?>

                            <?php do_action( 'yith_wcwl_table_product_after_move_to_another_wishlist', $item, $wishlist ); ?>

                        <?php endif; ?>

                        <!-- Remove from wishlist -->
                        <?php if ( $repeat_remove_button ) : ?>
                            <a href="<?php echo esc_url( $item->get_remove_url() ); ?>" class="remove_from_wishlist button" title="<?php echo esc_html( apply_filters( 'yith_wcwl_remove_product_wishlist_message_title', __( 'Remove this product', 'yith-woocommerce-wishlist' ) ) ); ?>"><?php esc_html_e( 'Remove', 'yith-woocommerce-wishlist' ); ?></a>
                        <?php endif; ?>

                        <?php do_action( 'yith_wcwl_table_after_product_cart', $item, $wishlist ); ?>
                    <?php endif; ?>

                    <?php if ( $enable_drag_n_drop ) : ?>
                        <div class="product-arrange ">
                            <i class="fa fa-arrows"></i>
                            <input type="hidden" name="items[<?php echo esc_attr( $item->get_product_id() ); ?>][position]" value="<?php echo esc_attr( $item->get_position() ); ?>"/>
                        </div>
                    <?php endif; ?>
                </li>
                <?php
            endif;

		endforeach;

        echo "</ul>";
        // echo do_shortcode( '[products per_page="-1" ids='.$ids.']' );
	else :
		?>
			<div class="wishlist-empty"><?php echo esc_html( apply_filters( 'yith_wcwl_no_product_to_remove_message', __( 'No products added to the wishlist', 'yith-woocommerce-wishlist' ), $wishlist ) ); ?></div>
		<?php
	endif;

	if ( ! empty( $page_links ) ) :
		?>
		<div class="pagination-row wishlist-pagination">
			<div colspan="<?php echo esc_attr( $column_count ); ?>">
				<?php echo wp_kses_post( $page_links ); ?>
			</div>
		</div>
	<?php endif ?>
</div>
