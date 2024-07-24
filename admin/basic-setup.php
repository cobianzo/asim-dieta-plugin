<?php 
/**
 * Basic setup functions for the plugin
 *
 * @since 1.0
 * @function	prefix_activate_plugin()		Plugin activatation todo list
 * @function	prefix_load_plugin_textdomain()	Load plugin text domain
 * @function	prefix_settings_link()			Print direct link to plugin settings in plugins list in admin
 * @function	prefix_footer_text()			Admin footer text
 * @function	prefix_footer_version()			Admin footer version
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
 
/**
 * Plugin activatation todo list
 *
 * This function runs when user activates the plugin. Used in register_activation_hook in the main plugin file. 
 * @since 1.0
 */
function prefix_activate_plugin() {
	
}

/**
 * Load plugin text domain
 *
 * @since 1.0
 */
function prefix_load_plugin_textdomain() {
    load_plugin_textdomain( 'asim', false, '/asim-dieta/languages/' );
}
add_action( 'plugins_loaded', 'prefix_load_plugin_textdomain' );

/**
 * Print direct link to plugin settings in plugins list in admin
 *
 * @since 1.0
 */
function prefix_settings_link( $links ) {
	return array_merge(
		array(
			'settings' => '<a href="' . admin_url( 'options-general.php?page=asim-dieta' ) . '">' . __( 'Settings', 'asim-dieta' ) . '</a>'
		),
		$links
	);
}
add_filter( 'plugin_action_links_' . PREFIX_ASIM_PLUGIN . '/asim-dieta.php', 'prefix_settings_link' );

/**
 * Admin footer text
 *
 * A function to add footer text to the settings page of the plugin. Footer text contains plugin rating and donation links.
 * Note: Remove the rating link if the plugin doesn't have a WordPress.org directory listing yet. (i.e. before initial approval)
 *
 * @since 1.0
 * @refer https://codex.wordpress.org/Function_Reference/get_current_screen
 */
function prefix_footer_text($default) {
    
	// Retun default on non-plugin pages
	$screen = get_current_screen();
	if ( $screen->id !== "settings_page_asim-dieta" ) {
		return $default;
	}
	
    $prefix_footer_text = __('Plugin developed by Asim Srl.', 'asim');
								
	
	return $prefix_footer_text;
}
add_filter('admin_footer_text', 'prefix_footer_text');

/**
 * Admin footer version
 *
 * @since 1.0
 */
function prefix_footer_version($default) {
	
	// Retun default on non-plugin pages
	$screen = get_current_screen();
	if ( $screen->id !== 'settings_page_asim-dieta' ) {
		return $default;
	}
	
	return 'Plugin version ' . PREFIX_VERSION_NUM;
}
add_filter( 'update_footer', 'prefix_footer_version', 11 );