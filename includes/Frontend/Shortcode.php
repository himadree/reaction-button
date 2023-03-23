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
        wp_enqueue_style( 'reactionbutton-frontend-style' );
        wp_enqueue_script( 'reactionbutton-frontend-script' );

        ob_start();
        include __DIR__ . '/views/reaction-button.php';

        return ob_get_clean();
    }
}