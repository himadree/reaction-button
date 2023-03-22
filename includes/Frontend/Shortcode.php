<?php 
namespace ReactionButton\Frontend;

/**
 * Shortcode handler class
 */
class Shortcode {
    /**
     * Initialize the class
     */
    public function __construct() {
        add_shortcode( 'reaction-button', [ $this, 'render_shortcode' ] );
    }

    /**
     * Shortcode render function
     *
     * @param [array] $atts
     * @param string $content
     * 
     * @return string
     */
    public function render_shortcode( $atts, $content = '' ) {
        return 'Hello form Shortcode';
    }
}