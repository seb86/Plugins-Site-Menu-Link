<?php
/*
 * Plugin Name: Plugins Site Menu Link
 * Plugin URI: http://wordpress.org/plugins/plugins-site-menu-link/
 * Description: Adds a link to the Plugins management page to the site's toolbar admin menu.
 * Version: 1.0
 * Author: Sebastien Dumont
 * Author URI: http://www.sebastiendumont.com
 *
 * Requires at least: 3.8
 * Tested up to: 3.9.1
 *
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Hooks
add_filter( 'plugin_row_meta', 'plugin_row_meta', 10, 2 );
add_action( 'admin_bar_menu', 'sd_plugins_site_menu_link', 999 );

/**
 * Adds a link to the plugins management page in the site menu.
 */
function sd_plugins_site_menu_link( $wp_admin_bar ) {

	if( is_admin() || ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$args = array(
		'parent' => 'site-name',
		'id'     => 'plugins',
		'title'  => __( 'Plugins' ),
		'href'   => admin_url( 'plugins.php' )
	);
	$wp_admin_bar->add_node( $args );

}

/**
 * Plugin row meta links
 */
function plugin_row_meta( $input, $file ) {
	if ( plugin_basename( __FILE__ ) !== $file ) {
		return $input;
	}

	$links = array(
		'<a href="' . esc_url( 'http://profiles.wordpress.org/sebd86' ) . '" target="_blank">' . __( 'Other Plugins by Me' ) . '</a>',
		'<a href="' . esc_url( 'https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=mailme@sebastiendumont.com&currency_code=&amount=&return=&item_name=Buy+me+a+coffee+for+Plugins+Site+Menu+Link&page_style=paypal' ) . '" target="_blank">' . __( 'Donate to this plugin' ) . '</a>',
	);

	$input = array_merge( $input, $links );

	return $input;
}

?>