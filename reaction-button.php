<?php
/**
 * Plugin Name: Reaction Button
 * Plugin URI: https://reaction.com
 * Description: This plugin generate reaction button
 * Version: 1.0.0
 * Author: Himadree
 * Author URI: https://himadree.com
 * License: GPL v2 or later
 * Text Domain: reaction-button
 * Domain Path: /languages
 */

if( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * Plugin main class
 */
final class Reaction_Button {

    /**
     * Plugin version
     * @var string
     */
    const version = '1.0.0';

    /**
     * Class constructor
     */
    private function __construct() {
        $this->define_constants();

        register_activation_hook( __FILE__, [ $this, 'activate' ] );

        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
    }

    /**
     * Define the required plugin constants
     *
     * @return void
     */
    public function define_constants() {
        define( 'REACTION_BUTTON_VERSION', self::version );
        define( 'REACTION_BUTTON_FILE', __FILE__ );
        define( 'REACTION_BUTTON_PATH', __DIR__ );
        define( 'REACTION_BUTTON_URL', plugins_url( '', REACTION_BUTTON_FILE ) );
        define( 'REACTION_BUTTON_ASSETS', REACTION_BUTTON_URL .'/assets' );
    }

    /**
     * Do stuff plugin activation
     *
     * @return int
     */
    public function activate() {
        $intalled = get_option( 'reaction_button_installed' );

        if( ! $intalled ){
            update_option( 'reaction_button_installed', time() );
        }

        update_option( 'reaction_button_version', REACTION_BUTTON_VERSION );
    }

    /**
     * Initalize the plugin class
     *
     * @return void
     */
    public function init_plugin() {

        new ReactionButton\Assets();

        new ReactionButton\Frontend();

        if( is_admin() ) {
            new ReactionButton\Admin();
        }else {
            
        }
    }

    /**
     * Initialize a singleton instance
     *
     * @return \Reaction_Button
     */
    public static function init() {
        static $instance = false;

        if( ! $instance ){
            $instance = new self();
        }

        return $instance;
    }
}

/**
 * Initializes the main plugin
 *
 * @return \Reaction_Button
 */
function reaction_button() {
    return Reaction_Button::init();
}

// Plugin start
reaction_button();