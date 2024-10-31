<?php
/**
 * Runs on Uninstall of Recipe Hero BigOven (deleted through WordPress admin)
 *
 * @package   Recipe Hero BigOven
 * @author    Bryce Adams <bryce@bryce.se>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

delete_option( 'recipe_hero_rhbigoven_settings' );

// Anyo!