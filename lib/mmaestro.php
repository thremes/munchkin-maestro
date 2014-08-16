<?php

//* Load main functionality
add_action( 'after_setup_theme', array( 'MMaestro_Main', 'get_instance' ) );

//* Load cleanup functionality
require_once( 'mmaestro.cleanup.php' );
add_action( 'after_setup_theme', array( 'MMaestro_Cleanup', 'get_instance' ), 15 );

//* Load later functionality
require_once( 'mmaestro.later.php' );
add_action( 'after_setup_theme', array( 'MMaestro_Later', 'get_instance' ), 15 );

//* Load assets functionality
require_once( 'assets/assets.php' );
add_action( 'after_setup_theme', array( 'MMaestro_Assets', 'get_instance' ) );

/**
 * Class MMaestro_Main
 */
final class MMaestro_Main
{
    /**
     * The Constructor
     */
    private function __construct()
    {
        //* Add custom background
        add_theme_support( 'custom-background', array(
            'default-color' => '3B3F41',
        ) );

        //* Add custom header
        add_theme_support( 'custom-header', array(
            'default-image' => '',
        ) );

        //* Overrides the color primary
        add_filter( 'theme_mod_color_primary', array( __CLASS__, 'color_primary' ) );
    }

    /**
     * Get the Singleton instance
     */
    function get_instance()
    {
        static $instance;
        if ( !isset( $instance ) ) {
            $instance = new MMaestro_Main();
        }

        return $instance;
    }

    /**
     * Color Primary
     */
    function color_primary( $hex )
    {
        return $hex ? $hex : '555';
    }

}
