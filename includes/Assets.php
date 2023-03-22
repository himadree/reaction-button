<?php
namespace ReactionButton;

/**
 * Assets handler class
 */
class Assets {

    /**
     * Class constructor
     */
    public function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'register_assets' ] );
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function get_scripts() {
        return [
            'reactionbutton-frontend-script' => [
                'src'     => REACTION_BUTTON_ASSETS . '/js/frontend.js',
                'version' => filemtime( REACTION_BUTTON_PATH . '/assets/js/frontend.js'),
                'deps'    => [ 'jquery' ],
            ]
        ];
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function get_styles() {
        return [
            'reactionbutton-frontend-style' => [
                'src'     => REACTION_BUTTON_ASSETS . '/css/frontend.css',
                'version' => filemtime( REACTION_BUTTON_PATH . '/assets/css/frontend.css'),
            ]
        ];
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function register_assets() {
        $scripts = $this->get_scripts();
        $styles = $this->get_styles();

        foreach ( $scripts as $handle => $script ) {
            $version = isset( $script['version'] ) ? $script['version'] : false;
            $deps = isset( $script['deps'] ) ? $script['deps'] : false;

            wp_register_script( $handle, $script['src'], $deps, $version, true );
        }

        foreach ( $styles as $handle => $style ) {
            $deps = isset( $style['deps'] ) ? $style['deps'] : false;

            wp_register_style( $handle, $style['src'], $deps, $style['version'] );
        }
    }
}