<?php
/**
 * Hypermarket WooCommerce Template Functions.
 *
 * @author  	Mahdi Yazdani
 * @package 	Hypermarket
 * @since 	    1.0.4
 */
// ======================================================================
// Hooked into "wp"
// ======================================================================

/**
 * Remove Sidebar on all the Single Product Pages.
 *
 * @package Hooked into "wp"
 * @since 1.0.2
 */
function hypermarket_remove_sidebar_shop()
{
	if (hypermarket_is_woocommerce_activated() && is_singular('product')):
		remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar');
	endif;
}
// ======================================================================
// Hooked into "hypermarket_items_present_in_cart"
// ======================================================================

/**
 * Ensure cart contents update when products are added to the cart via AJAX.
 *
 * @package Hooked into "hypermarket_items_present_in_cart"
 * @since 1.0
 */
if (!function_exists('hypermarket_cart_link_fragment')):
	function hypermarket_cart_link_fragment($fragments)
	{
		if (hypermarket_is_woocommerce_activated()):
			global $woocommerce;
			ob_start();
			hypermarket_cart_link();
			$fragments['a.cart-items'] = ob_get_clean();
			return $fragments;
		endif;
	}
endif;
/**
 * Displayed a link to the cart including the number of items present.
 *
 * @package Hooked into "hypermarket_items_present_in_cart"
 * @since 1.0
 */
if (!function_exists('hypermarket_cart_link')):
	function hypermarket_cart_link()
	{
		if (hypermarket_is_woocommerce_activated()):
?>
			<a class="cart-items" href="<?php
			echo hypermarket_sanitize_url(WC()->cart->get_cart_url()); ?>" target="_self">
	            <i>
	            	<span class="material-icons shopping_basket"></span>
	        		<?php
			// Number of items present and the cart total
			$cart_items = wp_kses_data(sprintf(_n('%d', '%d', WC()->cart->get_cart_contents_count() , 'hypermarket') , WC()->cart->get_cart_contents_count()));
			echo ($cart_items != 0) ? '<span class="count">' . $cart_items . '</span>' : '';
?>
	            </i>
	        </a><!-- .cart-items -->
		<?php
		endif;
	}
endif;
// ======================================================================
// Hooked into "woocommerce_before_main_content"
// ======================================================================

/**
 * Shop page featured image.
 *
 * @package Hooked into "woocommerce_before_main_content"
 * @since 1.0.2
 */
if (!function_exists('hypermarket_shop_featured_image')):
	function hypermarket_shop_featured_image()
	{
		if (hypermarket_is_woocommerce_activated() && is_shop() && !empty(get_the_post_thumbnail_url(get_option('woocommerce_shop_page_id')))):
			get_template_part('template-parts/hypermarket-featured-image-background-single-page');
		endif;
	}
endif;
// ======================================================================
// Hooked into "woocommerce_before_shop_loop_item"
// ======================================================================

/**
 * Shop thumbnail wrapper start tag.
 *
 * @package Hooked into "woocommerce_before_shop_loop_item"
 * @since 1.0
 */
if (!function_exists('hypermarket_shop_thumbnail_wrapper_start')):
	function hypermarket_shop_thumbnail_wrapper_start()
	{
		if (hypermarket_is_woocommerce_activated()):
			echo '<div class="shop-thumbnail">' . PHP_EOL;
		endif;
	}
endif;
/**
 * Display sale badge on product archive page(s) only.
 *
 * @package Hooked into "woocommerce_before_shop_loop_item"
 * @since 1.0
 */
if (!function_exists('woocommerce_show_product_loop_sale_flash')):
	function woocommerce_show_product_loop_sale_flash()
	{
		if (hypermarket_is_woocommerce_activated()):
			global $post, $product;
			if ($product->is_on_sale()):
				echo apply_filters('woocommerce_sale_flash', '<span class="shop-label text-danger onsale">' . __('Sale', 'hypermarket') . '</span>', $post, $product);
			endif;
		endif;
	}
endif;
// ======================================================================
// Hooked into "woocommerce_before_shop_loop_item_title"
// ======================================================================

/**
 * Shop tools (Button(s)) wrapper start tag.
 *
 * @package Hooked into "woocommerce_before_shop_loop_item_title"
 * @since 1.0
 */
if (!function_exists('hypermarket_shop_item_tools_wrapper_start')):
	function hypermarket_shop_item_tools_wrapper_start()
	{
		if (hypermarket_is_woocommerce_activated()):
			echo '<div class="shop-item-tools">' . PHP_EOL;
		endif;
	}
endif;
// ======================================================================
// Hooked into "woocommerce_after_shop_loop_item"
// ======================================================================

/**
 * Shop tools (Button(s)) and thumbnail wrapper end tag(s).
 *
 * @package Hooked into "woocommerce_after_shop_loop_item"
 * @since 1.0
 */
if (!function_exists('hypermarket_shop_thumbnail_item_tools_wrapper_end')):
	function hypermarket_shop_thumbnail_item_tools_wrapper_end()
	{
		if (hypermarket_is_woocommerce_activated()):
			echo '</div><!-- .shop-item-tools -->' . PHP_EOL;
			echo '</div><!-- .shop-thumbnail -->' . PHP_EOL;
		endif;
	}
endif;
/**
 * Shop item details wrapper start tag.
 *
 * @package Hooked into "woocommerce_after_shop_loop_item"
 * @since 1.0
 */
if (!function_exists('hypermarket_shop_item_details_wrapper_start')):
	function hypermarket_shop_item_details_wrapper_start()
	{
		if (hypermarket_is_woocommerce_activated()):
			echo '<div class="shop-item-details">' . PHP_EOL;
		endif;
	}
endif;
/**
 * Shop item title wrapped with product URL.
 *
 * @package Hooked into "woocommerce_after_shop_loop_item"
 * @since 1.0
 */
if (!function_exists('woocommerce_template_loop_product_title')):
	function woocommerce_template_loop_product_title()
	{
		if (hypermarket_is_woocommerce_activated()):
			global $product;
			echo '<h3 class="shop-item-title"><a href="' . get_permalink($product->get_id()) . '" target="_self">' . get_the_title() . '</a></h3><!-- .shop-item-title -->' . PHP_EOL;
		endif;
	}
endif;
/**
 * Shop item price(s).
 *
 * @package Hooked into "woocommerce_after_shop_loop_item"
 * @since 1.0
 */
if (!function_exists('woocommerce_template_loop_price')):
	function woocommerce_template_loop_price()
	{
		if (hypermarket_is_woocommerce_activated()):
			global $product;
			if ($price_html = $product->get_price_html()):
				echo '<span class="shop-item-price">' . $price_html . '</span>';
			endif;
		endif;
	}
endif;
/**
 * Shop item details wrapper end tag.
 *
 * @package Hooked into "woocommerce_after_shop_loop_item"
 * @since 1.0
 */
if (!function_exists('hypermarket_shop_item_details_wrapper_end')):
	function hypermarket_shop_item_details_wrapper_end()
	{
		if (hypermarket_is_woocommerce_activated()):
			echo '</div><!-- .shop-item-details -->' . PHP_EOL;
		endif;
	}
endif;
// ======================================================================
// Hooked into "woocommerce_before_shop_loop"
// ======================================================================

/**
 * Shop wrapper start tag(s) before main loop.
 *
 * @package Hooked into "woocommerce_before_shop_loop"
 * @since 1.0
 */
if (!function_exists('hypermarket_woocommerce_before_shop_loop')):
	function hypermarket_woocommerce_before_shop_loop()
	{
		if (hypermarket_is_woocommerce_activated()):
			if (is_active_sidebar('sidebar')):
				echo '<div class="row padding-top">' . PHP_EOL;
				echo '<!-- Products Grid -->' . PHP_EOL;
				echo '<div class="col-md-9 col-sm-8">' . PHP_EOL;
			else:
				echo '<!-- Products Grid -->' . PHP_EOL;
				// 4 Columns
				$GLOBALS['product_grid_classes'] = 'col-lg-3 col-md-4 col-sm-6 without-sidebar';
				$hypermarket_woocommerce_loop_columns = 4;
				add_filter('hypermarket_woocommerce_loop_columns', function ($arg) use($hypermarket_woocommerce_loop_columns)
				{
					return $hypermarket_woocommerce_loop_columns;
				});
			endif;
		endif;
	}
endif;
/**
 * Shop bar wrapper start tag.
 *
 * @package Hooked into "woocommerce_before_shop_loop"
 * @since 1.0
 */
if (!function_exists('hypermarket_shop_bar_wrapper_start')):
	function hypermarket_shop_bar_wrapper_start()
	{
		if (hypermarket_is_woocommerce_activated()):
			echo '<!-- Shop Bar -->' . PHP_EOL;
			echo '<div class="shop-bar">' . PHP_EOL;
		endif;
	}
endif;
/**
 * Shop bar wrapper end tag.
 *
 * @package Hooked into "woocommerce_before_shop_loop"
 * @since 1.0
 */
if (!function_exists('hypermarket_shop_bar_wrapper_end')):
	function hypermarket_shop_bar_wrapper_end()
	{
		if (hypermarket_is_woocommerce_activated()):
			echo '</div><!-- .shop-bar -->' . PHP_EOL;
		endif;
	}
endif;
/**
 * Main shop wrapper start tag.
 *
 * @package Hooked into "woocommerce_before_shop_loop"
 * @since 1.0.4
 */
if (!function_exists('hypermarket_shop_product_subcategories')):
	function hypermarket_shop_product_subcategories()
	{
		if (hypermarket_is_woocommerce_activated()):
			$args = apply_filters('hypermarket_shop_product_subcategories_args', array(
				'before' => '<div class="hypermarket-category-wrapper row padding-top padding-bottom-3x">',
				'after' => '</div><!-- .hypermarket-category-wrapper -->',
				'force_display' => true
			));
			woocommerce_product_subcategories($args);
			woocommerce_reset_loop();
		endif;
	}
endif;
/**
 * Main shop wrapper start tag.
 *
 * @package Hooked into "woocommerce_before_shop_loop"
 * @since 1.0
 */
if (!function_exists('hypermarket_shop_loop_wrapper_start')):
	function hypermarket_shop_loop_wrapper_start()
	{
		if (hypermarket_is_woocommerce_activated()):
			echo '<div class="row">' . PHP_EOL;
		endif;
	}
endif;
// ======================================================================
// Hooked into "woocommerce_after_shop_loop"
// ======================================================================

/**
 * Main shop wrapper start tag.
 *
 * @package Hooked into "woocommerce_after_shop_loop"
 * @since 1.0
 */
if (!function_exists('hypermarket_shop_loop_wrapper_end')):
	function hypermarket_shop_loop_wrapper_end()
	{
		if (hypermarket_is_woocommerce_activated()):
			echo '</div><!-- .row -->' . PHP_EOL;
			echo '<hr>' . PHP_EOL;
		endif;
	}
endif;
/**
 * Main shop wrapper end tag.
 *
 * @package Hooked into "woocommerce_after_shop_loop"
 * @since 1.0
 */
if (!function_exists('hypermarket_woocommerce_after_shop_loop')):
	function hypermarket_woocommerce_after_shop_loop()
	{
		if (hypermarket_is_woocommerce_activated()):
			if (is_active_sidebar('sidebar')):
				echo '</div><!-- .col-md-9 col-sm-8 -->' . PHP_EOL;
			endif;
		endif;
	}
endif;
/**
 * Shop catalog wrapper end tag.
 *
 * @package Hooked into "woocommerce_after_shop_loop"
 * @since 1.0
 */
if (!function_exists('hypermarket_shop_catalog_wrapper_end')):
	function hypermarket_shop_catalog_wrapper_end()
	{
		if (hypermarket_is_woocommerce_activated()):
			echo '</section><!-- .container -->' . PHP_EOL;
		endif;
	}
endif;
// ======================================================================
// Hooked into "woocommerce_before_subcategory"
// ======================================================================

/**
 * Add "category-link" class name to category link.
 *
 * @package Hooked into "woocommerce_before_subcategory"
 * @since 1.0.4
 */
if (!function_exists('hypermarket_loop_category_link_open')):
	function hypermarket_loop_category_link_open($category)
	{
		echo '<a href="' . get_term_link($category, 'product_cat') . '" class="category-link">';
	}
endif;
// ======================================================================
// Hooked into "subcategory_archive_thumbnail_size"
// ======================================================================

/**
 * Subcategory thumbnails size.
 *
 * @package Hooked into "subcategory_archive_thumbnail_size"
 * @since 1.0.4
 */
if (!function_exists('hypermarket_subcategory_archive_thumbnail_size')):
	function hypermarket_subcategory_archive_thumbnail_size()
	{
		return 'full';
	}
endif;
// ======================================================================
// Hooked into "woocommerce_shop_loop_subcategory_title"
// ======================================================================

/**
 * Show the subcategory title in the product loop.
 *
 * @package Hooked into "woocommerce_shop_loop_subcategory_title"
 * @since 1.0.4
 */
if (!function_exists('hypermarket_template_loop_subcategory_title')):
	function hypermarket_template_loop_subcategory_title($category)
	{
		echo $category->name;
	}
endif;
// ======================================================================
// Hooked into "woocommerce_before_single_product"
// ======================================================================

/**
 * Navigation to next/previous set of products.
 *
 * @package Hooked into "woocommerce_before_single_product"
 * @since 1.0
 */
if (!function_exists('hypermarket_product_paging_navigation')):
	function hypermarket_product_paging_navigation()
	{
		if (hypermarket_is_woocommerce_activated()):
			get_template_part('template-parts/woocommerce/hypermarket-product-paging-navigation');
		endif;
	}
endif;
/**
 * WooCommerce notice wrapper start tag(s).
 *
 * @package Hooked into "woocommerce_before_single_product"
 * @since 1.0.2
 */
if (!function_exists('hypermarket_product_notice_wrapper_start')):
	function hypermarket_product_notice_wrapper_start()
	{
		if (hypermarket_is_woocommerce_activated()):
			echo '<div id="hypermarket-single-product-notice" class="container">' . PHP_EOL;
			echo '<div class="row">' . PHP_EOL;
			echo '<div class="col-md-8 col-md-offset-2">' . PHP_EOL;
		endif;
	}
endif;
/**
 * WooCommerce notice wrapper end tag(s).
 *
 * @package Hooked into "woocommerce_before_single_product"
 * @since 1.0.2
 */
if (!function_exists('hypermarket_product_notice_wrapper_end')):
	function hypermarket_product_notice_wrapper_end()
	{
		if (hypermarket_is_woocommerce_activated()):
			echo '</div><!-- .col-md-8 -->';
			echo '</div><!-- .row -->' . PHP_EOL;
			echo '</div><!-- #hypermarket-single-product-notice -->' . PHP_EOL;
		endif;
	}
endif;
// ======================================================================
// Hooked into "woocommerce_before_single_product_summary"
// ======================================================================

/**
 * Single product image and thumbnails.
 *
 * @package Hooked into "woocommerce_before_single_product_summary"
 * @since 1.0
 */
if (!function_exists('woocommerce_show_product_images')):
	function woocommerce_show_product_images()
	{
		if (hypermarket_is_woocommerce_activated()):
			get_template_part('template-parts/woocommerce/hypermarket-single-product-gallery');
		endif;
	}
endif;
// ======================================================================
// Hooked into "woocommerce_single_product_summary"
// ======================================================================

/**
 * Product info wrapper start tag.
 *
 * @package Hooked into "woocommerce_single_product_summary"
 * @since 1.0
 */
if (!function_exists('hypermarket_single_product_summary_wrapper_start')):
	function hypermarket_single_product_summary_wrapper_start()
	{
		if (hypermarket_is_woocommerce_activated()):
			echo '<!-- Product Info -->' . PHP_EOL;
			echo '<div class="product-info padding-top-2x padding-bottom-3x text-center">' . PHP_EOL;
		endif;
	}
endif;
/**
 * Product tools wrapper start tag.
 *
 * @package Hooked into "woocommerce_single_product_summary"
 * @since 1.0
 */
if (!function_exists('hypermarket_single_add_to_cart_wrapper_start')):
	function hypermarket_single_add_to_cart_wrapper_start()
	{
		if (hypermarket_is_woocommerce_activated()):
			echo '<div class="product-tools shop-item">' . PHP_EOL;
		endif;
	}
endif;
/**
 * Product tools wrapper end tag.
 *
 * @package Hooked into "woocommerce_single_product_summary"
 * @since 1.0
 */
if (!function_exists('hypermarket_single_add_to_cart_wrapper_end')):
	function hypermarket_single_add_to_cart_wrapper_end()
	{
		if (hypermarket_is_woocommerce_activated()):
			echo '</div><!-- .product-tools -->' . PHP_EOL;
		endif;
	}
endif;
// ======================================================================
// Hooked into "woocommerce_after_single_product_summary"
// ======================================================================

/**
 * Product info and main section wrapper end tag(s).
 *
 * @package Hooked into "woocommerce_after_single_product_summary"
 * @since 1.0
 */
if (!function_exists('hypermarket_single_product_summary_wrapper_end')):
	function hypermarket_single_product_summary_wrapper_end()
	{
		if (hypermarket_is_woocommerce_activated()):
			echo '</div><!-- .product-info -->' . PHP_EOL;
			echo '</div><!-- .container -->' . PHP_EOL;
			echo '</section><!-- .fw-section.bg-gray -->' . PHP_EOL;
		endif;
	}
endif;
/**
 * Product tabs wrapper start tag.
 *
 * @package Hooked into "woocommerce_after_single_product_summary"
 * @since 1.0
 */
if (!function_exists('hypermarket_output_product_data_tabs_wrapper_start')):
	function hypermarket_output_product_data_tabs_wrapper_start()
	{
		if (hypermarket_is_woocommerce_activated()):
			echo '<!-- Product Tabs -->' . PHP_EOL;
			echo '<section class="container padding-top-2x">' . PHP_EOL;
		endif;
	}
endif;
/**
 * Single product main wrapper end tag.
 *
 * @package Hooked into "woocommerce_after_single_product_summary"
 * @since 1.0
 */
if (!function_exists('hypermarket_output_product_data_tabs_wrapper_end')):
	function hypermarket_output_product_data_tabs_wrapper_end()
	{
		if (hypermarket_is_woocommerce_activated()):
			echo '</section><!-- .container -->' . PHP_EOL;
		endif;
	}
endif;
// ======================================================================
// Hooked into "woocommerce_review_order_before_submit"
// ======================================================================

/**
 * Back to cart button.
 *
 * @package Hooked into "woocommerce_review_order_before_submit"
 * @since 1.0.2
 */
if (!function_exists('hypermarket_back_to_cart_btn_before_submit')):
	function hypermarket_back_to_cart_btn_before_submit()
	{
		if (hypermarket_is_woocommerce_activated()):
			echo '<a href="' . hypermarket_sanitize_url(WC()->cart->get_cart_url()) . '" class="btn btn-default btn-ghost icon-left btn-block waves-effect waves-light" target="_self">';
			echo '<i class="material-icons arrow_back"></i>';
			_e('Back To Cart', 'hypermarket');
			echo '</a><!-- .btn -->' . PHP_EOL;
		endif;
	}
endif;
// ======================================================================
// Hooked into "woocommerce_no_products_found"
// ======================================================================

/**
 * No products are found matching the current query.
 *
 * @package Hooked into "woocommerce_no_products_found"
 * @since 1.0.4
 */
if (!function_exists('hypermarket_no_products_found')):
	function hypermarket_no_products_found()
	{
		if (hypermarket_is_woocommerce_activated()):
			get_template_part('template-parts/woocommerce/hypermarket-no-products-found');
		endif;
	}
endif;