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

        //* Register default background/headers
        $this->default_headers();
        add_filter( 'hybrid_default_backgrounds', array( $this, 'default_backgrounds' ), 11 );
    }

    /**
     * Get the Singleton instance
     */
    function get_instance()
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

        $open_sans   = 'Open+Sans:300,400,600,700';
        $droid_serif = 'Droid+Serif:400,700,400italic,700italic';
        wp_enqueue_style( 'mmaestro-fonts', "//fonts.googleapis.com/css?family={$open_sans}|{$droid_serif}" );
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
            'sample-01' => array(
                'url'           => '%2$s/lib/assets/images/headers/sample.png',
                'thumbnail_url' => '%2$s/lib/assets/images/headers/sample-thumb.png',
                'description'   => __( 'Sample One', 'mmaestro' )
            ),
            'sample-02' => array(
                'url'           => '%2$s/lib/assets/images/headers/sample.png',
                'thumbnail_url' => '%2$s/lib/assets/images/headers/sample-thumb.png',
                'description'   => __( 'Sample Two', 'mmaestro' )
            )
        ) );
    }

    /**
     * Register Default Backgrounds
     */
    function default_backgrounds( $backgrounds )
    {
        $_backgrounds = array(
            'sample-01' => array(
                'url'           => '%2$s/lib/assets/images/backgrounds/sample.png',
                'thumbnail_url' => '%2$s/lib/assets/images/backgrounds/sample-thumb.png',
            ),
            'sample-02' => array(
                'url'           => '%2$s/lib/assets/images/backgrounds/sample.png',
                'thumbnail_url' => '%2$s/lib/assets/images/backgrounds/sample-thumb.png',
            )
        );

        return array_merge( $backgrounds, $_backgrounds );
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
