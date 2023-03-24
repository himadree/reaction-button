<?php
namespace ReactionButton;

class Widget {

    /**
     * Class constructor
     */
    public function __construct() {
        add_action( 'elementor/widgets/register', [$this, 'register_reaction_button_widget' ] );
    }

    /**
     * Undocumented function
     *
     * @param [type] $widgets_manager
     * 
     * @return void
     */
    public function register_reaction_button_widget( $widgets_manager ) {

        require_once( __DIR__ . '/Elementor/reaction_button_widget.php' );
    
        $widgets_manager->register( new \Reaction_Button_Widget() );
    
    }
}