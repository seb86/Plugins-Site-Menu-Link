<?php
/*
 * Plugin Name: Plugins Site Menu Link
 * Plugin URI:  https://wordpress.org/plugins/plugins-site-menu-link/
 * Description: Adds a link to the Plugins management page to the site's toolbar admin menu.
 * Version:     1.1.0
 * Author:      Sébastien Dumont
 * Author URI:  https://sebastiendumont.com
 * Text Domain: plugins-site-menu-link
 *
 * Copyright:   © 2017 Sébastien Dumont
 * License:     GNU General Public License v2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! defined('ABSPATH')) {
	exit;
}

// Hooks
add_action( 'admin_bar_menu', 'sd_plugins_site_menu_link', 999 );
add_filter( 'plugin_row_meta', 'sd_plugins_site_menu_link_plugin_row_meta', 10, 2 );

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
		'title'  => __( 'Plugins', 'plugins-site-menu-link' ),
		'href'   => admin_url( 'plugins.php' )
	);

	$wp_admin_bar->add_node( $args );
} // END sd_plugins_site_menu_link()

/**
 * Plugin row meta links
 */
function sd_plugins_site_menu_link_plugin_row_meta( $input, $file ) {
	if ( plugin_basename( __FILE__ ) !== $file ) {
		return $input;
	}

	$links = array(
		'<a href="' . esc_url( 'https://profiles.wordpress.org/sebd86' ) . '" target="_blank">' . __( 'Other Plugins by Me', 'plugins-site-menu-link' ) . '</a>',
		'<a href="' . esc_url( 'https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=mailme@sebastiendumont.com&currency_code=&amount=&return=&item_name=Buy+me+a+coffee+for+Plugins+Site+Menu+Link&page_style=paypal' ) . '" target="_blank">' . __( 'Donate to this plugin', 'plugins-site-menu-link' ) . '</a>',
	);

	$input = array_merge( $input, $links );

	return $input;
} // END sd_plugins_site_menu_link_plugin_row_meta()
