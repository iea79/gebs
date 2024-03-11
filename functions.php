<?php

/**
 * frondendie functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package frondendie
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.5');
}

if (!function_exists('frondendie_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function frondendie_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on frondendie, use a find and replace
		 * to change 'frondendie' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('frondendie', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__('Primary', 'frondendie'),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'frondendie_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		add_theme_support('woocommerce');
		// add_theme_support( 'wc-product-gallery-zoom' );
		// add_theme_support( 'wc-product-gallery-lightbox' );
		// add_theme_support( 'wc-product-gallery-slider' );

	}
endif;
add_action('after_setup_theme', 'frondendie_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function frondendie_content_width()
{
	$GLOBALS['content_width'] = apply_filters('frondendie_content_width', 640);
}
add_action('after_setup_theme', 'frondendie_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function frondendie_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'frondendie'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'frondendie'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'frondendie_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function frondendie_scripts()
{
	wp_enqueue_style('frondendie-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('frondendie-style', 'rtl', 'replace');

	wp_deregister_script('jquery');
	wp_deregister_script('wp-embed-js');
	wp_register_script('jquery', get_template_directory_uri() . '/js/jquery.js', array(), _S_VERSION, true);
	wp_enqueue_script('jquery');

	wp_enqueue_script('slick-slider', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), _S_VERSION, true);
	wp_enqueue_script('modal', get_template_directory_uri() . '/js/modal.js', array('jquery'), _S_VERSION, true);
	wp_enqueue_script('site-js', get_template_directory_uri() . '/js/function.js', array('jquery'), _S_VERSION, true);

	if (is_front_page()) {
		wp_enqueue_style('home-style', get_template_directory_uri() . '/css/home.css', array(), _S_VERSION);
		wp_enqueue_script('smooth-scrollbar', get_template_directory_uri() . '/js/smooth-scrollbar.js', array(), _S_VERSION, true);
		wp_enqueue_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/gsap.min.js', '', _S_VERSION, true);
		wp_enqueue_script('gsap-st', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.7.1/ScrollTrigger.min.js', '', _S_VERSION, true);
		wp_enqueue_script('gsap-to', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/ScrollToPlugin.min.js', '', _S_VERSION, true);
		wp_enqueue_script('lottie', get_template_directory_uri() . '/js/lottie.js', array('site-js'), _S_VERSION, true);
		wp_enqueue_script('home', get_template_directory_uri() . '/js/home.js', array('gsap', 'gsap-st', 'gsap-to', 'site-js'), _S_VERSION, true);
	}

	if (is_shop() || is_product_category()) {
		wp_enqueue_script('selectWoo');
		wp_enqueue_style('select2');
		wp_enqueue_script('shop', get_template_directory_uri() . '/js/shop.js', array('jquery', 'selectWoo'), _S_VERSION, true);
		wp_enqueue_style('shop-style', get_template_directory_uri() . '/css/shop.css', array(), _S_VERSION);
	}

	if (is_product()) {
		wp_enqueue_script('product', get_template_directory_uri() . '/js/product.js', array('jquery', 'site-js'), _S_VERSION, true);
		wp_enqueue_style('product-style', get_template_directory_uri() . '/css/product.css', array(), _S_VERSION);
	}

	if (is_checkout()) {
		wp_enqueue_script('checkout', get_template_directory_uri() . '/js/checkout.js', array('jquery', 'site-js'), _S_VERSION, true);
		wp_enqueue_style('checkout-style', get_template_directory_uri() . '/css/checkout.css', array(), _S_VERSION);
	}

	if (is_account_page()) {
		wp_enqueue_script('account', get_template_directory_uri() . '/js/account.js', array('jquery'), _S_VERSION, true);
	}

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'frondendie_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * woocommerce settings.
 */
require get_template_directory() . '/woocommerce/wc-functions.php';

/**
 * Home fields.
 */
require get_template_directory() . '/scf/home.php';

/**
 * FAQs page fields.
 */
require get_template_directory() . '/scf/faqs.php';

/**
 * Contact page fields.
 */
require get_template_directory() . '/scf/contact.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Allow JSON File Uploads In WordPress
function cc_mime_types($mimes)
{
	$mimes['json'] = 'application/json';
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}

add_filter('upload_mimes', 'cc_mime_types');

function breadcrumbs()
{

	// получаем номер текущей страницы
	$page_num = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$separator = '<span class="breadcrumb__sep">•</span>'; //  разделяем обычным слэшем, но можете чем угодно другим

	echo '<nav class="breadcrumb">';
	// если главная страница сайта
	if (is_front_page()) {

		if ($page_num > 1) {
			echo '<a href="' . site_url() . '">Home</a>' . $separator . $page_num . '';
		} else {
			echo 'Вы находитесь на главной странице';
		}
	} else { // не главная

		echo '<a href="' . site_url() . '">Home</a>' . $separator;

		if (is_single() && !is_front_page()) { // записи

			echo '<a href="' . site_url() . '/blog">Blog</a>' . $separator . get_the_title();
		} elseif (is_page() && !is_front_page()) { // страницы WordPress

			the_title();
		} elseif (!is_front_page() && is_home()) { // страницы WordPress

			echo "Blog";
		} elseif (is_category()) {

			single_cat_title();
		} elseif (is_404()) { // если страницы не существует

			echo 'Error 404';
		}

		if ($page_num > 1) { // номер текущей страницы
			echo '' . $page_num . '';
		}
	}

	echo '</nav>';
}


// Replace from wc-functions.php
function woocommerce_breadcrumb($args = array())
{
	$args = wp_parse_args(
		$args,
		apply_filters(
			'woocommerce_breadcrumb_defaults',
			array(
				'delimiter'   => '<span class="breadcrumb__sep">•</span>',
				'wrap_before' => '<nav class="breadcrumb">',
				'wrap_after'  => '</nav>',
				'before'      => '',
				'after'       => '',
				'home'        => _x('Home', 'breadcrumb', 'woocommerce'),
			)
		)
	);

	$breadcrumbs = new WC_Breadcrumb();

	if (!empty($args['home'])) {
		$breadcrumbs->add_crumb($args['home'], apply_filters('woocommerce_breadcrumb_home_url', home_url()));
	}

	$args['breadcrumb'] = $breadcrumbs->generate();

	/**
	 * WooCommerce Breadcrumb hook
	 *
	 * @hooked WC_Structured_Data::generate_breadcrumblist_data() - 10
	 */
	do_action('woocommerce_breadcrumb', $breadcrumbs, $args);

	wc_get_template('global/breadcrumb.php', $args);
}

// Loop ==========================================================
add_filter('loop_shop_columns', 'frontendie_loop_columns');
function frontendie_loop_columns()
{
	if (is_shop() || is_product_category()) {
		return 3;
	} else {
		return 4;
	}
}

add_filter('loop_shop_per_page', 'new_loop_shop_per_page', 20);
function new_loop_shop_per_page($cols)
{
	$cols = 18;
	return $cols;
}

add_action('init', 'clean_products_loop_page');
function clean_products_loop_page()
{
	remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
	remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
}

add_action('woocommerce_before_shop_loop', 'create_before_wrapp_from_product_loop_page');
function create_before_wrapp_from_product_loop_page()
{
	$cats = get_categories([
		'taxonomy'     => 'product_cat',
	]);

	// print_r($cats);
?>
	<div class="woocommerceLoop">
		<div class="woocommerceLoop__aside">
			<div class="filter__toggle mobile">Filters</div>
			<div class="filter">
				<div class="filter__close mobile"><i class="icon_close"></i></div>
				<?php
				woocommerce_get_sidebar();
				?>
				<div class="filter__action">
					<?php echo do_shortcode('[br_filter_single filter_id=113]'); ?>
					<?php echo do_shortcode('[br_filter_single filter_id=117]'); ?>
				</div>
			</div>
		</div>
		<div class="woocommerceLoop__content">
		<?php
	}

	add_action('woocommerce_after_shop_loop', 'create_after_wrapp_from_product_loop_page');
	function create_after_wrapp_from_product_loop_page()
	{
		echo "</div></div>";
	}

	// Single product ==========================================================
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
	/**
	 *  Remove "Description" Title @ WooCommerce Single Product Tabs
	 */
	add_filter('woocommerce_product_description_heading', '__return_null');

	add_action('woocommerce_after_single_product', 'set_review_form_modal', 50);
	function set_review_form_modal()
	{
		?>
			<!-- begin Modal reviewModal -->
			<div class="modal fade reviewModal" id="reviewModal">
				<div class="modal-dialog">
					<div class="modal-content">
						<a href="#" class="modal-close" data-dismiss="modal"></a>
						<div class="modal-body">

						</div>
					</div>
				</div>
			</div>
			<!-- end Modal reviewModal -->
		<?php
	}

	add_action('woocommerce_product_after_tabs', 'set_review_modal_button');
	function set_review_modal_button()
	{
		global $product;

		if (!wc_review_ratings_enabled()) {
			return;
		}

		$rating_count = $product->get_rating_count();
		$review_count = $product->get_review_count();
		$average      = $product->get_average_rating();

		?>
			<div class="reviewScore">
				<div class="reviewScore__title">Overall product score</div>
				<?php if ($review_count) : ?>
					<div class="reviewScore__rate">
						<?php echo wc_get_rating_html($average, $rating_count); ?>
						<span class="reviewScore__count">(<?php echo $review_count; ?>)</span>
					</div>
					<div class="reviewScore__rezult">Based on <?php echo $review_count; ?> reviews for this product</div>
				<?php endif; ?>
				<div class="reviewScore__text">If you have experience using this product, you can leave your review.</div>
				<button class="btn btn_muted" data-toggle="modal" data-target="#reviewModal">Leave feedback</button>
			</div>
		<?php
	}

	add_filter('woocommerce_reviews_title', 'replace_review_title', 10, 3);
	function replace_review_title($reviews_title, $count, $product)
	{
		global $product;
		$count = $product->get_review_count();
		if ($count  && wc_review_ratings_enabled()) {
			$reviews_title = sprintf(esc_html(_n('Customer reviews %1$s', 'Customer reviews %1$s', $count, 'woocommerce')), '(' . esc_html($count) . ')', '');
		} else {
			$reviews_title = esc_html_e('Reviews', 'woocommerce');
		}
		return $reviews_title;
	}

	/**
	 * Change number of related products output
	 */
	add_filter('woocommerce_output_related_products_args', 'related_products_args', 20);
	function related_products_args($args)
	{
		$args['posts_per_page'] = 8;
		$args['columns'] = 4;
		return $args;
	}


	// меняем текст кнопки для страниц каталога товаров, категорий товаров и т д
	add_filter('woocommerce_product_add_to_cart_text', 'frontendie_product_btn_text', 20, 2);
	function frontendie_product_btn_text($text, $product)
	{
		if (
			$product->is_purchasable()
			&& $product->is_in_stock()
		) {
			if (WC()->cart->find_product_in_cart(WC()->cart->generate_cart_id($product->get_id()))) {
				$text = 'Added';
			}
		}

		return $text;
	}

	// меняем текст кнопки для страниц каталога товаров, категорий товаров и т д
	add_filter('woocommerce_loop_add_to_cart_link', 'frontendie_product_btn_link', 10, 3);
	function frontendie_product_btn_link($sprintf, $product)
	{
		if (
			$product->is_purchasable()
			&& $product->is_in_stock()
		) {
			if (WC()->cart->find_product_in_cart(WC()->cart->generate_cart_id($product->get_id()))) {
				$sprintf = '<span class="button add_to_cart_button added">Added</span>';
			}
		}

		return $sprintf;
	}

	function filter_woocommerce_cart_totals_coupon_html($coupon_html, $coupon, $discount_amount_html)
	{
		// Change text
		$coupon_html = str_replace('[Remove]', '<i class="icon_close"></i>', $coupon_html);

		return $coupon_html;
	}
	add_filter('woocommerce_cart_totals_coupon_html', 'filter_woocommerce_cart_totals_coupon_html', 10, 3);

	// Removes Order Notes Title
	add_filter('woocommerce_enable_order_notes_field', '__return_false', 9999);

	add_filter('woocommerce_checkout_fields', 'frontendie_rename_checkout_fields');
	// Change placeholder and label text
	function frontendie_rename_checkout_fields($fields)
	{
		// Billing fields
		unset($fields['billing']['billing_company']);
		unset($fields['billing']['billing_email']);
		unset($fields['billing']['billing_phone']);
		unset($fields['billing']['billing_state']);
		unset($fields['billing']['billing_first_name']);
		unset($fields['billing']['billing_last_name']);
		unset($fields['billing']['billing_country']);
		unset($fields['billing']['billing_address_1']);
		unset($fields['billing']['billing_address_2']);
		unset($fields['billing']['billing_city']);
		unset($fields['billing']['billing_postcode']);
		// Shipping fields
		// unset( $fields['shipping'] );
		unset($fields['shipping']['shipping_country']);
		unset($fields['shipping']['shipping_company']);
		unset($fields['shipping']['shipping_phone']);
		unset($fields['shipping']['shipping_state']);
		unset($fields['shipping']['shipping_first_name']);
		unset($fields['shipping']['shipping_last_name']);
		unset($fields['shipping']['shipping_address_1']);
		unset($fields['shipping']['shipping_address_2']);
		unset($fields['shipping']['shipping_city']);
		unset($fields['shipping']['shipping_postcode']);

		// Order fields
		unset($fields['order']['order_comments']);

		$fields = array(
			'billing' => [
				'billing_email' => [
					'required' => true,
					'placeholder' => 'Enter email adress',
					'label' => 'Email',
				],
				'billing_phone' => [
					'required' => true,
					'placeholder' => 'Enter your phone number',
					'label' => 'Phone',
				],
				// 'shipping_methods' => [
				// 	'type' => 'select',
				// 	'required' => false,
				// 	'placeholder' => 'Select shipping method',
				// 	'label' => 'Shipping method',
				// 	'class' => array('form-row update_totals_on_change'),
				// 	'options' => array(
				// 		'' => '',
				// 	),
				// 	'default' => '',
				// ],
				'billing_first_name' => [
					'required' => true,
					'placeholder' => 'Enter your first name',
					'label' => 'First name',
				],
				'billing_last_name' => [
					'required' => false,
					'placeholder' => 'Enter your last name',
					'label' => 'Last name',
				],
				'billing_address_1' => [
					'required' => true,
					'placeholder' => 'Enter street address',
					'label' => 'Street address',
				],
				'billing_address_2' => [
					'required' => false,
					'placeholder' => 'Enter apartment, suite, unit. etc.',
					'label' => 'Apartment, suite, unit. etc.',
				],
				'billing_company' => [
					'required' => false,
					'placeholder' => 'Enter company name',
					'label' => 'Company name',
				],
				'billing_country' => [
					'type' => 'country',
					'required' => true,
					'placeholder' => 'Select your country/region',
					'label' => 'Country/Region',
				],
				'billing_postcode' => [
					'required' => false,
					'placeholder' => 'Enter postal code',
					'label' => 'Postal code',
				],
				'billing_state' => [
					'type' => 'state',
					'required' => true,
					'placeholder' => 'Select a province',
					'label' => 'Province',
				],
				'billing_city' => [
					'required' => false,
					'placeholder' => 'Enter city/town',
					'label' => 'Town/city',
				],
			]
		);

		return $fields;
	}

	add_action('wp', function () {
		remove_action('woocommerce_checkout_terms_and_conditions', 'wc_checkout_privacy_policy_text', 20);
		remove_action('woocommerce_checkout_terms_and_conditions', 'wc_terms_and_conditions_page_content', 30);
	});

	// Privasy policy checkbox from page checkout
	add_action('woocommerce_review_order_before_submit', 'add_privacy_checkbox', 9);
	function add_privacy_checkbox()
	{
		woocommerce_form_field('privacy_policy', array(
			'type' => 'checkbox',
			'class' => array('form-row woocommerce-privacy-policy-text'),
			'label_class' => array('woocommerce-form__label woocommerce-form__label-for-checkbox checkbox'),
			'input_class' => array('woocommerce-form__input woocommerce-form__input-checkbox input-checkbox'),
			'required' => true,
			'custom_attributes' => array('checked' => 'checked'),
			'label' => wc_get_privacy_policy_text('checkout'),
		));
	}

	// add_action( 'woocommerce_checkout_process', 'privacy_checkbox_error_message' );
	function privacy_checkbox_error_message()
	{
		if (!(int) isset($_POST['privacy_policy'])) {
			wc_add_notice(__('You have to agree to our terms and conditions in order to proceed'), 'error');
		}
	}

	add_action('woocommerce_after_order_notes', 'add_subscribe_checkbox');
	// Добавим новое поле после примечания к заказу
	function add_subscribe_checkbox($checkout)
	{

		woocommerce_form_field('subscribed', [
			'type'  => 'checkbox',
			'class' => ['subscribe-field'],
			'label' => __('Keep me up to date on news and exclusive offers'),
		], $checkout->get_value('subscribed'));
	}

	add_action('woocommerce_checkout_update_order_meta', 'save_subscribe_field');
	// сохраним поле
	function save_subscribe_field($order_id)
	{

		if (!empty($_POST['subscribed']) && $_POST['subscribed'] == 1) {
			update_post_meta($order_id, 'subscribed', 1);
		}
	}

	//Change the 'Billing details' checkout label to 'Contact Information'
	add_filter('gettext', 'wc_billing_field_strings', 20, 3);
	function wc_billing_field_strings($translated_text, $text, $domain)
	{
		switch ($translated_text) {
			case 'Billing &amp; Shipping':
				$translated_text = __('Shipping information', $domain);
				break;
			case 'Your order':
				$translated_text = __('Payment', $domain);
				break;
		}
		return $translated_text;
	}

	add_action('woocommerce_before_checkout_billing_form', 'add_subtitle_from_shipping');
	function add_subtitle_from_shipping()
	{
		?>
			<div class="checkout-description">
				<p>Already have an account with us? <a href="/my-account">Log in</a> for a faster checkout experience.</p>
				<p>* - necessarily</p>
			</div>
		<?php
	}

	add_action('woocommerce_review_order_before_payment', 'add_subtitle_from_payment');
	function add_subtitle_from_payment()
	{
		?>
			<div class="checkout-description payment-description">
				<p>All transactions are secure and encrypted.</p>
				<h4>Select payment method</h4>
			</div>
			<?php
		}


		// Wishlist counter
		if (defined('YITH_WCWL') && !function_exists('yith_wcwl_get_items_count')) {
			function yith_wcwl_get_items_count()
			{
				ob_start();
			?>
				<a href="<?php echo esc_url(YITH_WCWL()->get_wishlist_url()); ?>" class="wishlist_link header__icon">
					<i class="icon_heart"></i>
					<?php if (yith_wcwl_count_all_products() > 0) {
						echo '<div class="wishlistHeader__count"></div>';
					} ?>
				</a>
		<?php
				return ob_get_clean();
			}

			add_shortcode('yith_wcwl_items_count', 'yith_wcwl_get_items_count');
		}

		if (defined('YITH_WCWL') && !function_exists('yith_wcwl_ajax_update_count')) {
			function yith_wcwl_ajax_update_count()
			{
				wp_send_json(array(
					'count' => yith_wcwl_count_all_products()
				));
			}

			add_action('wp_ajax_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count');
			add_action('wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count');
		}

		add_filter('excerpt_more', function ($more) {
			return '...';
		});
