<?php

/**
 * Class MMaestro_Assets
 */
final class MMaestro_Assets
{
    /**
     * The Constructor
     */
    private function __construct()
    {
        //* Enqueue/Dequeue fonts and styles
        add_action( 'wp_enqueue_scripts', array( $this, 'fonts' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'styles' ) );

        //* Style Trump
        add_action( 'wp_enqueue_scripts', array( $this, 'style_trump' ), 99 );

        //* Register default headers
        $this->default_headers();
    }

    /**
     * Get the Singleton instance
     */
    static function get_instance()
    {
        static $instance;
        if ( !isset( $instance ) ) {
            $instance = new MMaestro_Assets();
        }

        return $instance;
    }

    /**
     * Enqueue Fonts
     */
    function fonts()
    {
        wp_dequeue_style( 'stargazer-fonts' );

        $open_sans = 'Open+Sans:400,700';
        $raleway   = 'Raleway:200,300,400,500';
        wp_enqueue_style( 'mmaestro-fonts', "//fonts.googleapis.com/css?family={$open_sans}|{$raleway}" );
    }

    /**
     * Enqueue Styles
     */
    function styles()
    {
        $this->enqueue_style( 'mmaestro-base', 'base.css', array( 'parent' ) );
    }

    /**
     * Style Trump
     */
    function style_trump()
    {
        wp_dequeue_style( 'style' );
        wp_enqueue_style( 'style' );
    }

    /**
     * Register Default Headers
     */
    function default_headers()
    {
        register_default_headers( array(
            'header-01' => array(
                'url'           => '%2$s/lib/assets/images/headers/header-01.jpg',
                'thumbnail_url' => '%2$s/lib/assets/images/headers/header-01-thumb.jpg',
                'description'   => __( 'The River', 'mmaestro' )
            ),
            'header-02' => array(
                'url'           => '%2$s/lib/assets/images/headers/header-02.jpg',
                'thumbnail_url' => '%2$s/lib/assets/images/headers/header-02-thumb.jpg',
                'description'   => __( 'The Tower', 'mmaestro' )
            )
        ) );
    }

    /**
     * Enqueue Style
     *
     * @param        $handle
     * @param        $src
     * @param array  $deps
     * @param string $media
     */
    private function enqueue_style( $handle, $src, $deps = array(), $media = 'all' )
    {
        if ( file_exists( trailingslashit( get_stylesheet_directory() ) . "lib/assets/css/{$src}" ) ) {
            $src = trailingslashit( get_stylesheet_directory_uri() ) . "lib/assets/css/{$src}";
            wp_enqueue_style( $handle, $src, $deps, FALSE, $media );
        }
    }

}
