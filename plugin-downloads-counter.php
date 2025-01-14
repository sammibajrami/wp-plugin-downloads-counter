<?php
/**
 * @package Plugin Downloads Counter
 * @version 1.0.0
 * @author Sammi Bajrami <contact@sammibajrami.me>
 */
/*
 * @wordpress-plugin
 * Plugin Name:       Plugin Downloads Counter
 * Plugin URI:        https://thegeneration.com
 * Description:       See the number of downloads of the "Svea Checkout for WooCommerce" by The Generation.
 * Version:           1.0.0
 * Author:            Sammi Bajrami
 * Author URI:        https://thegeneration.com/
 * Text Domain:       plugin-downloads-counter
*/

/**
 * Register admin pages
 * @return void
 */
function register_admin_pages(){
	add_menu_page( 
		__( 'Plugin Downloads Counter', 'plugin-downloads-counter' ),
		'Plugin Downloads',
		'manage_options',
		'plugin-downloads-counter',
		'display_counter',
		'dashicons-download'
	);
	return;
}
add_action( 'admin_menu', 'register_admin_pages' );

/**
 * Display the number of plugin downloads
 * @return void
 */
function display_counter() {
	$plugin_info = get_plugin_info(); ?>

	<p style="font-size:2rem;">
		<?php
			$downloads_string = printf(
				esc_html__( 'The "%s" plugin, developed by %s, has been downloaded a total of %s times.', 'plugin-downloads-counter' ),
				esc_html( $plugin_info->name ),
				$plugin_info->author,
				esc_html( $plugin_info->downloaded ),
			);
		?>
	</p><?php
	return;
};

/**
 * Get data of specified plugin downloads
 * @param string $plugin_slug
 * @return object|array
 */
function get_plugin_info($plugin_slug = 'svea-checkout-for-woocommerce') {

	if( !function_exists('plugins_api') ){
    require_once( ABSPATH.'wp-admin/includes/plugin-install.php' );
	}

	$plugin_info = plugins_api('plugin_information', array(
		'slug' => $plugin_slug,
		'is_ssl' => false,
		'fields' => array(
			'downloaded' => true,
			'active_installs' => false,
			'added' => false,
			'banners' => false,
			'business_model' => false,
			'commercial_support_url' => false,
			'compatibility' => false,
			'contributors' => false,
			'description' => false,
			'donate_link' => false,
			'downloadlink' => false,
			'homepage' => false,
			'icons' => false,
			'last_updated' => false,
			'num_ratings' => false,
			'preview_link' => false,
			'rating' => false,
			'ratings' => false,
			'repository_url' => false,
			'requires_php' => false,
			'requires' => false,
			'reviews' => false,
			'screenshots' => false,
			'sections' => false,
			'short_description' => false,
			'support_threads_resolved' => false,
			'support_threads' => false,
			'support_url' => false,
			'tags' => false,
			'tested' => false,
			'upgrade_notice' => false,
			'versions' => false
		)
	));

	return $plugin_info;
}
