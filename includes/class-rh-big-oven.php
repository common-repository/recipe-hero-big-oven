<?php
/**
 * Recipe Hero BigOven Main Class
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

class RH_Big_Oven_Init {

	protected static $instance = null;

    function __construct() {
 
 		add_action( 'wp_enqueue_scripts', array( $this, 'assets' ) );
 		
 		add_action( 'recipe_hero_single_recipe_content', array( $this, 'save_button' ) );

 		add_shortcode( 'rhbigoven', array( $this, 'shortcode' ) );

    }

    /**
	 * Start the Class when called
	 *
	 * @package Recipe Hero BigOven
	 * @author  Bryce Adams <bryce@bryce.se>
	 * @since   1.0.0
	 */

	public static function get_instance() {

	  // If the single instance hasn't been set, set it now.
	  if ( null == self::$instance ) {
		self::$instance = new self;
	  }

	  return self::$instance;

	}


	/**
	 * Enqueue assets
	 *
	 * @package Recipe Hero BigOven
	 * @author  Bryce Adams <bryce@bryce.se>
	 * @since   1.0.0
	 */

	public function assets() {
		
		wp_register_script( 'big-oven', plugins_url( '../assets/js/big-oven.min.js', __FILE__ ) );		

		if ( is_recipe_hero() ) {
			wp_enqueue_script( 'big-oven' );
		}

	}

	/** 
	 * Print Button
	 */

	public function save_button() {

		$settings = $this->wrapper();

		if ( $settings['display_top'] !== 'yes' ) {
			return;
		}

		$icon = '<span class="dashicons dashicons-external"></span> ';
		echo '<a title="Save recipe or add to grocery list" onclick="javascript:doSaveRecipe();" style="cursor:pointer; padding-right:12px; display:inline-block; margin-top:10px;" class="rh-bigoven-save">' . $icon . __( 'Save to BigOven', 'recipe-hero-big-oven' )  . '</a>';
	
	}

	/**
	 * Shortcode
	 */

	public function shortcode( $atts ) {

		$atts = extract( shortcode_atts( array(
			'image'	=> false,
		), $atts, 'rh_bigoven' ) );

		if ( $image == true ) {
			$content = '<img src="http://media.bigoven.com/assets/images/saverecipe.png" style="cursor:pointer" alt="'  . __( 'Save recipe or add to grocery list', 'recipe-hero-big-oven' ) . '" title="'  . __( 'Save recipe or add to grocery list', 'recipe-hero-big-oven' ) .  '" onclick="javascript:doSaveRecipe();"/>';
		} else {
			$icon = '<span class="dashicons dashicons-external" style="line-height: 2;"></span> ';
			$content = '<a title="' . __( 'Save recipe or add to grocery list', 'recipe-hero-big-oven' ) . '" onclick="javascript:doSaveRecipe();" style="cursor:pointer; padding-right:12px;" class="rh-bigoven-save">' . $icon . __( 'Save to BigOven', 'recipe-hero-big-oven' )  . '</a>';
		}

		return $content;

	}

	/**
	 * Settings Wrapper
	 */

	public function wrapper() {

		$settings 	= new RH_Big_Oven_Settings();
		$wrapper	= $settings->wrapper();

		return $wrapper;

	}

}