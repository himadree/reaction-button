<?php 
namespace ReactionButton\Admin;

/**
 * Menu handler class
 */
class Menu {

    /**
     * Class constructor
     */
    public function __construct() {
        add_action( 'admin_menu', [ $this, 'admin_menu' ] );
    }

    /**
     * Register admin menu
     */
    public function admin_menu() {
        $capability = 'manage_options';
        $parent_slug = 'reaction-button';

        $hook = add_menu_page( __( 'Reaction Button', 'reaction-button' ), __( 'Reaction Button', 'reaction-button' ), $capability, $parent_slug, [ $this, 'render_setting_page' ] );

        add_action( 'admin_head-' . $hook, [ $this, 'enqueue_assets' ] );
    }

    /**
     * Handles setting page
     *
     * @return void
     */
    public function render_setting_page() {
        echo 'Setting page';
    }

    public function enqueue_assets() {
        wp_enqueue_style( 'reactionbutton-admin-style' );
    }
}