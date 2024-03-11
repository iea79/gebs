<?php
/**
 * Optimize WooCommerce Scripts
 * Remove WooCommerce Generator tag, styles, and scripts from non WooCommerce pages.
 */
add_action( 'wp_enqueue_scripts', 'child_manage_woocommerce_styles', 99 );

function child_manage_woocommerce_styles() {
	//remove generator meta tag
	remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );

	//first check that woo exists to prevent fatal errors
	if ( function_exists( 'is_woocommerce' ) ) {
		//dequeue scripts and styles
		if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
			// wp_dequeue_style( 'woocommerce-layout' );
			wp_dequeue_style( 'woocommerce_chosen_styles' );
			wp_dequeue_style( 'woocommerce_fancybox_styles' );
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
			wp_dequeue_script( 'wc_price_slider' );
			wp_dequeue_script( 'wc-single-product' );
			wp_dequeue_script( 'wc-add-to-cart' );
			// wp_dequeue_script( 'wc-cart-fragments' );
			wp_dequeue_script( 'wc-checkout' );
			wp_dequeue_script( 'wc-add-to-cart-variation' );
			wp_dequeue_script( 'wc-single-product' );
			// wp_dequeue_script( 'wc-cart' );
			// wp_dequeue_script( 'wc-chosen' );
			wp_dequeue_script( 'woocommerce' );
			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'prettyPhoto-init' );
			wp_dequeue_script( 'jquery-blockui' );
			wp_dequeue_script( 'jquery-placeholder' );
			wp_dequeue_script( 'fancybox' );
			wp_dequeue_script( 'jqueryui' );
		}

        if ( is_checkout() ) {
			wp_dequeue_script( 'wc-chosen' );
            wp_enqueue_script( 'wc-cart' );
        }
	}

}

// Корзина в шапке
add_filter('woocommerce_add_to_cart_fragments', 'header_add_to_cart_fragment');
function header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;
    ob_start();
	if ($woocommerce->cart->cart_contents_count > 0) {
		?>
			<span class="cartHeader__count"><?php // echo $woocommerce->cart->cart_contents_count; ?></span>
		<?php
	}
    $fragments['.cartHeader__count'] = ob_get_clean();
    return $fragments;
}


// Cart page to checkout
add_action( 'woocommerce_before_checkout_form', 'fronendie_cart_on_checkout_page_only', 5 );

function fronendie_cart_on_checkout_page_only() {

    if ( is_wc_endpoint_url( 'order-received' ) ) return;

    echo '<div class="checkout__wrapper"><div class="checkout__content">' . do_shortcode('[woocommerce_cart]');

}
add_action( 'woocommerce_after_checkout_form', 'fronendie_wrap_checkout_form', 5 );

function fronendie_wrap_checkout_form() {

    if ( is_wc_endpoint_url( 'order-received' ) ) return;

    echo '</div><div class="checkout__aside"></div></div>';

}

/**
* Redirect Empty Cart/Checkout - WooCommerce
*/
add_action( 'template_redirect', 'fronendie_redirect_empty_cart_checkout_to_home' );
function fronendie_redirect_empty_cart_checkout_to_home() {
    if ( is_checkout() && 0 == WC()->cart->get_cart_contents_count() && ! is_wc_endpoint_url( 'order-pay' ) && ! is_wc_endpoint_url( 'order-received' ) ) {
		$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );

        wp_safe_redirect( $shop_page_url );
        exit;
    }
}

// смена ссылки корзины на checkout
add_filter( 'woocommerce_get_cart_url', 'wc_get_checkout_url' );

// Перенос вкладки с атрибутами на стр. товаров под табы
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );
function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['description'] ); // Удаление вкладки "Описание"
    // unset( $tabs['reviews'] ); // Удаление вкладки "Отзывы"
    unset( $tabs['additional_information'] ); // Удаление вкладки "Свойства"
    return $tabs;
}
add_action( 'woocommerce_single_product_summary', 'woocommerce_product_description_tab', 10 );

add_filter( 'woocommerce_before_quantity_input_field', 'add_quantity_plus_btn' );
function add_quantity_plus_btn() {
    ?>
    <span class="quantity__btn icon_plus"></span>
    <?php
}
add_filter( 'woocommerce_after_quantity_input_field', 'add_quantity_minus_btn' );
function add_quantity_minus_btn() {
    ?>
    <span class="quantity__btn icon_minus"></span>
    <?php
}


add_action( 'woocommerce_before_checkout_form', 'remove_checkout_coupon_form', 9 );
function remove_checkout_coupon_form(){
    remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
}

/**
 * Test product cards changes for variations as simple products
 * add to cart button
 */
add_filter( 'woocommerce_loop_add_to_cart_link', 'wcg_add_to_cart_link', 10, 2 );
function wcg_add_to_cart_link( $button, $product ) {
    if (!$product->is_type('variable')) {
        return $button;
    }
    else {
        $button_text = __("Add to cart", "woocommerce");
        $product_id = $GLOBALS['PRODUCT_VARIATION']['variation_id'];
        return '<a href="?add-to-cart='.$product_id.'" 
        data-quantity="1" 
        class="button product_type_simple add_to_cart_button ajax_add_to_cart" 
        data-product_id="'.$product_id.'" 
        data-product_sku="" 
        rel="nofollow">' . $button_text . '</a>';
    }
}

/**
 * Create link for current variation
 */
add_filter( 'woocommerce_loop_product_link', 'wcg_change_product_permalink_shop', 99, 2 );
function wcg_change_product_permalink_shop( $link, $product ) {
    if ($product->is_type('variable')) {
        $link .= '?';
        $attrs = $GLOBALS['PRODUCT_VARIATION']['attributes'];
        foreach ($attrs as $attrName => $attrValue) {
            $link .= $attrName.'='.$attrValue.'&';
        }
        $link = trim($link, '&');
    }
    return $link;
}

/**
 * Create unique title for current variation
 */
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'wcg_change_product_title' );
function wcg_change_product_title(){
    global $product;

    $productName = '<h2 class="woocommerce-loop-product__title">' . $product->get_title() . '</h2>';
    if ($product->is_type('variable')) {
        $attrs = implode(" ", $GLOBALS['PRODUCT_VARIATION']['attributes']);
        $productName = '<h2 class="woocommerce-loop-product__title">'.$product->get_title().' '.$attrs.'</h2>';
    }
    echo $productName;
}
/*
add_action( 'woocommerce_before_shop_loop', 'wcg_change_sort_array_in_shop_loop', 1 );
function wcg_change_sort_array_in_shop_loop($params){
    var_dump($GLOBALS);

    return "";
}*/
