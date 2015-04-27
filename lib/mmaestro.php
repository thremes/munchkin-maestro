<?php

//* Load main functionality
add_action( 'after_setup_theme', array( 'MMaestro_Main', 'get_instance' ) );

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
            'default-image' => trailingslashit( get_stylesheet_directory_uri() ) . 'lib/assets/images/headers/header-01.jpg',
        ) );

        //* Overrides the color primary
        add_filter( 'theme_mod_color_primary', array( $this, 'color_primary' ) );
    }

    /**
     * Get the Singleton instance
     */
    static function get_instance()
    {
        static $instance;
        if ( !isset( $instance ) ) {
            $instance = new MMaestro_Main();
        }

        return $instance;
    }

    /**
     * The color primary
     *
     * @param $hex
     *
     * @return string
     */
    function color_primary( $hex )
    {
        return $hex ? $hex : '555';
    }

}
