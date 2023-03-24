<?php
namespace ReactionButton;

/**
 * Handel block editor class
 */
class Block {

    /**
     * Class constructor
     */
    public function __construct() {
        add_action( 'init', [ $this, 'reaction_button_blocks_editor_scripts' ] );
    }

    /**
     * Enqueue block JavaScript and CSS for the editor
     */
    public function reaction_button_blocks_editor_scripts() {

        wp_register_script(
            'reaction-button-blocks/editor-script',
            REACTION_BUTTON_ASSETS . '/js/block.js',
            [ 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n' ],
            filemtime( plugin_dir_path( __FILE__ ) ) 
        );

        register_block_type('reaction-button-blocks/block-library', array(
            'editor_script' => [
                'reaction-button-blocks/editor-script',
            ],
        ));
    
    }
}