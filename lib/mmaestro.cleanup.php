<?php

/**
 * Class MMaestro_Cleanup
 */
final class MMaestro_Cleanup
{
    /**
     * The Constructor
     */
    private function __construct()
    {
        // TODO - Here goes any cleanup functionality of yours...
    }

    /**
     * Get the Singleton instance
     */
    function get_instance()
    {
        static $instance;
        if ( !isset( $instance ) ) {
            $instance = new MMaestro_Cleanup();
        }

        return $instance;
    }

}
