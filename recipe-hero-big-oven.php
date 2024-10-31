<?php
/**
 * Plugin Name: Recipe Hero BigOven
 * Plugin URI: http://recipehero.in/
 * Description: Integration with the BigOven recipe / grocery list service
 * Author: Recipe Hero / Bryce Adams
 * Author URI: http://recipehero.in/
 * Version: 1.0.0
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Check if WooCommerce is active
 **/
if ( in_array( 'recipe-hero/recipe-hero.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	// Load plugin text domain
	add_action( 'init', 'rhbigoven_load_textdomain' );

	// Load up...
	require_once( plugin_dir_path( __FILE__ ) . 'includes/class-rh-big-oven.php' );

	// Vroom.. Vroom..
	add_action( 'plugins_loaded', array( 'RH_Big_Oven_Init', 'get_instance' ) );
	add_action( 'init', 'rhbigoven_init', 0 );

} else {

	add_action( 'admin_notices', 'rhbigoven_rh_deactivated' );

}

function rhbigoven_init() {
	require_once( plugin_dir_path( __FILE__ ) . 'includes/class-rh-big-oven-settings.php' );
	add_filter( 'recipe_hero_integrations', 'rhbigoven_add_integration' );
}

/**
* Recipe Hero Big Oven Include Settings
**/

function rhbigoven_add_integration( $integrations ) {
	$integrations[] = 'RH_Big_Oven_Settings';
	return $integrations;
}

/**
 * Load the plugin text domain for translation.
 *
 * @return void
 */
if ( ! function_exists( 'rhbigoven_load_textdomain' ) ) {
	function rhbigoven_load_textdomain() {
		$locale = apply_filters( 'plugin_locale', get_locale(), 'recipe-hero-big-oven' );

		load_textdomain( 'recipe-hero-big-oven', trailingslashit( WP_LANG_DIR ) . 'recipe-hero-big-oven/recipe-hero-big-oven-' . $locale . '.mo' );
		load_plugin_textdomain( 'recipe-hero-big-oven', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}
}

/**
 * Recipe Hero Deactivated Notice
 **/
if ( ! function_exists( 'rhbigoven_rh_deactivated' ) ) {
	function rhbigoven_rh_deactivated() {
		echo '<div class="error"><p>' . sprintf( __( 'Recipe Hero BigOven requires %s to be installed and active.', 'recipe-hero-big-oven' ), '<a href="http://www.recipehero.in/" target="_blank">Recipe Hero</a>' ) . '</p></div>';
	}
}

/**
 * Plugin Settings Links etc.
 *
 * @package  Recipe Hero Big OVen
 * @author   Bryce <bryce@bryce.se>
 * @since    1.0.0
 */

$plugin = plugin_basename( __FILE__ ); 
add_filter( 'plugin_action_links_' . $plugin, 'rhbigoven_plugin_links' );

// Add settings link on plugin page
if ( ! function_exists( 'rhbigoven_plugin_links' ) ) {
	function rhbigoven_plugin_links( $links ) {

	  $settings_link = '<a href="' . admin_url( 'admin.php?page=rh-settings&tab=integration&section=rhbigoven' ) . '">Settings</a>';
	  $settings_link .= ' | <a href="http://recipehero.in/docs/recipe-hero-big-oven" target="_blank">Docs</a>';
	  array_unshift( $links, $settings_link ); 
	  return $links;

	}
}