<?php 
namespace ReactionButton\Frontend;

/**
 * ReactionContent handler class
 */
class ReactionContent {

    /**
     * Class constructor
     */
    public function __construct() {

		add_action( 'the_content', [ $this,'reaction_button_html_content' ] );

		add_action( 'wp_ajax_rb_html_icon', [ $this,'reaction_button_icon_list' ] );
		add_action( 'wp_ajax_nopriv_rb_html_icon', [ $this,'reaction_button_icon_list' ] );
	}

    /**
     * Get the post id and title
     *
     * @param [int] $post_id
     * @return void
     */
	public function get_post_objects( $post_id ) {

		$title    = strip_tags( get_the_title( $post_id ) );

		$post_object = array(
			'id'         => $post_id,
			'title'      => $title,
		);

		return $post_object;
	}

    /**
     * Render reaction button html content
     *
     * @param [array] $content
     * @return void
     */
	public function reaction_button_html_content( $content ) {

		$options            = get_option( 'reaction_button_settings' );
		$show_on_every_post = isset( $options['rns_auto_enable'] ) ? $options['rns_auto_enable'] : 'on';
		$post_id            = get_the_ID();
		$enabled            = get_post_meta( $post_id, 'rns_enable', true );
		$enable_only_single = isset( $options['rns_enable_only_single'] ) ? $options['rns_enable_only_single'] : 'off';

		if ( ! is_page() && ( $enabled=="on" || ( empty( $enabled ) && $show_on_every_post=='on' ) ) && ( is_single() || ( ! is_single() && $enable_only_single != 'on' ) ) ) {
			
            $post_object = $this->get_post_objects($post_id);
			$plugin = $this->reaction_button_wrapper( $options, $post_object );
			$content .= $plugin;
		}

		return $content;
	}

    /**
     * Render html icon list
     *
     * @return HTML
     */
    public function reaction_button_icon_list() {
        
        include __DIR__ . '/views/reaction-button.php';

		die();
	}

    /**
     * Render html for wrapper content
     *
     * @param [type] $options
     * @param [array] $post_object
     * 
     * @return HTML
     */
	public function reaction_button_wrapper( $options, $post_object ) {

		$plugin  = '<div class="reaction_button"';
		$plugin .= ' data-post-id="'.$post_object['id'].'"';
		$plugin .= ' data-post-title="'.$post_object['title'].'"';
		$plugin .= '></div>';

		return $plugin;
	}

}