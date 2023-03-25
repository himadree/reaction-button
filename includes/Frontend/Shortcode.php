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
    public function render_shortcode() {
        $obj = new ReactionContent();

		$options = get_option( 'rb_enable_single' );
		$post_id = get_the_ID();
		$post_object = $obj->get_post_objects($post_id);
		return $obj->reaction_button_wrapper($options, $post_object);

    }
}