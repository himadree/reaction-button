<?php 
namespace ReactionButton;

/**
 * Frontend handler class
 */
class Frontend {

	/**
	 * Class constructor
	 */
    public function __construct(){
		
		add_action( 'wp_ajax_rb_reaction', [ $this,'reaction_button_react' ] );
		// add_action( 'wp_ajax_nopriv_rb_reaction', [ $this,'reaction_button_react' ] );

		add_action( 'wp_ajax_rb_get_reaction', [ $this,'get_reaction_button_react' ] );
		add_action( 'wp_ajax_nopriv_rb_get_reaction', [ $this,'get_reaction_button_react' ] );

		new Frontend\ReactionContent();
		new Frontend\Shortcode();
	}

	/**
	 * Get reaction amount from databage
	 *
	 * @param [string] $reaction
	 * @param [int] $id
	 * 
	 * @return void
	 */
	public function get_reaction_amount($reaction, $id) {

		$meta_key = "wd_reaction_".$reaction;
		$amount   = get_post_meta( $id, $meta_key, true ) ? intval( get_post_meta( $id, $meta_key, true ) ) : 0;

		return $amount;
	}

	/**
	 * Update reaction number increment and decriment
	 *
	 * @return void
	 */
	public function reaction_button_react() {

		//Nonce check
		if ( ! wp_verify_nonce( $_POST['nonce'], 'ajax-nonce' ) ) {
			wp_die ( 'die!');
		}

		//User login check
		if( ! is_user_logged_in() ){
			return;
		}

		if ( isset( $_POST["postid"] ) ) {
			$post_id  = intval( sanitize_text_field( $_POST["postid"] ) );
			$reaction = sanitize_text_field( $_POST["reaction"] );
			$unreact  = sanitize_text_field( $_POST["unreact"] );
		}

		$amount = $this->get_reaction_amount( $reaction, $post_id );
		
		if ( isset( $unreact ) && $unreact === "true" ) {
			$amount = (int) $amount - 1;
			if ( $amount >= 0 ) {
				update_post_meta( $post_id, "wd_reaction_".$reaction, $amount );
			}
		}else {
			$amount = (int) $amount + 1;
			if ($amount >=0) {
				update_post_meta( $post_id, "wd_reaction_".$reaction, $amount );
			}
		}
		
		wp_send_json( [ 'amount' => $amount ] );
	}

	/**
	 * Get reaction button react
	 *
	 * @return void
	 */
	public function get_reaction_button_react() {

		$response = [];

		// print_r($_POST["posts"]);

		foreach( (array) $_POST["posts"] as $id ) {
			$id   = intval( $id );
			$meta = get_post_meta( $id );
			$post = [];

			$reactions = array( "smile", "straight", "sad" );

			foreach( $reactions as $reaction ) {
				$post[ $reaction ] = isset( $meta[ "wd_reaction_".$reaction ] ) ? intval( $meta[ "wd_reaction_".$reaction ][ 0 ] ) : 0;
			}

			$response[$id] = $post;
		}
		
		wp_send_json( $response );
	}

    
}