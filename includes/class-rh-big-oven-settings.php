<?php
/**
 * Recipe Hero BigOven Settings
 *
 * @package   Recipe Hero BigOven
 * @author    Captain Theme <info@captaintheme.com>
 * @license   GPL-2.0+
 * @link      http://captaintheme.com
 * @copyright 2014 Captain Theme
 * @since     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Recipe Hero BigOven Settings Class
 *
 * @package  Recipe Hero BigOven
 * @author   Bryce <bryce@bryce.se>
 * @since    1.0.0
 */

if ( ! class_exists( 'RH_Big_Oven_Settings' ) ) {

  class RH_Big_Oven_Settings extends RH_Integration {

	/**
	 * Init and hook in the integration.
	 */
	public function __construct() {

	  $this->id                 = 'rhbigoven';
	  $this->method_title       = __( 'BigOven', 'recipe-hero-big-oven' );
	  $this->method_description = __( 'Configure the settings below to integrate your site with', 'recipe-hero-big-oven' ) . ' <a href="http://bigoven.com/?utm_source=recipe_hero">BigOven</a>.';

	  // Load the settings.
	  $this->init_form_fields();
	  $this->init_settings();

	  /**
	   * Define user set variables.
	  **/

	  // General
	  $this->display_top = $this->get_option( 'display_top' );

	  // Actions.
	  add_action( 'recipe_hero_update_options_integration_' .  $this->id, array( $this, 'process_admin_options' ) );

	}

	/**
	 * Wrapper containing all settings for easy access
	 *
	 * @package Recipe Hero BigOven
	 * @author  Bryce <bryce@bryce.se>
	 * @since   1.0.0
	 * @return  array
	 */

	public function wrapper() {

	 	$wrapper = array(
			'display_top' => $this->get_option( 'display_top' ),
	 	);

	  	return $wrapper;

	}

	/**
	 * Initialize integration settings form fields.
	 *
	 * @return void
	 */
	public function init_form_fields() {

	  $this->form_fields = array(
		'display_top' => array(
		  'title'             => __( 'Display Top?', 'recipe-hero-big-oven' ),
		  'type'              => 'checkbox',
		  'description'       => __( 'If this option is checked, a \'Save to BigOven\' link will be added to the top of your recipe, below the title.', 'recipe-hero-big-oven' ),
		  'default'           => 'no',
		),
	  );

	}

  }

}