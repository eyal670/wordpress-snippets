<?php
/**
* Plugin Name: Divine Addon for Elementor
* Description: Divine Addon for Elementor
* Version: 1.0.0
* Author: Ariel Zusman
* Text Domain: divine-elementor
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'DIVINE_ADDON_PATH', plugin_dir_path( __FILE__ ) );

require_once DIVINE_ADDON_PATH.'inc/elementor-helper.php';

add_action( 'elementor/widgets/widgets_registered', function( $widgets_manager ) {
    require DIVINE_ADDON_PATH.'elements/card.php';
    
    $widgets_manager->register_widget_type( new Elementor\Widget_Card() );
} );
