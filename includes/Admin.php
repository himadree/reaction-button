<?php
namespace ReactionButton;

/**
 * Admin handler class
 */
class Admin {

    /**
     * Class constructor
     */
    public function __construct() {

        add_filter( 'manage_posts_columns', [ $this, 'reaction_button_post_columns' ] );
        add_filter( 'manage_pages_columns', [ $this, 'reaction_button_page_columns' ] );

        add_action( 'manage_posts_custom_column', [ $this, 'reaction_button_post_columns_data' ], 10, 2 );
        add_action( 'manage_pages_custom_column', [ $this, 'reaction_button_page_columns_data' ], 10, 2 );

        new Admin\Menu();
    }

    /**
     * Add new custom column into post column
     *
     * @param [array] $columns
     * 
     * @return void
     */
    public function reaction_button_post_columns( $columns ) {
        $columns['reaction'] = __( 'Reaction', 'reaction-button' );
        return $columns;
    }

    /**
     * Add reaction data into post column
     *
     * @param [array] $columns
     * @param [id] $post_id
     * 
     * @return void
     */
    public function reaction_button_post_columns_data( $columns, $post_id ){
        
        if( 'reaction' == $columns ){
            $meta_keys = [
                'wd_reaction_smile',
                'wd_reaction_straight',
                'wd_reaction_sad',
            ];
            
            foreach ( $meta_keys as $meta_key ) {
                $amount[]   = get_post_meta( $post_id, $meta_key, true ) ? intval( get_post_meta( $post_id, $meta_key, true ) ) : 0;
            }
            ?>
            <ul>
                <li><?php printf( __( "Smile (%d)", 'reaction-button'), $amount[0] );?></li>
                <li><?php printf( __( "Straight(%d)", 'reaction-button'), $amount[1] ); ?></li>
                <li><?php printf( __( "Sad(%d)", 'reaction-button'), $amount[2] ); ?></li>
            </ul>
            <?php
        }
    }

    /**
     * Add new custom column into page column
     *
     * @param [array] $columns
     * 
     * @return void
     */
    public function reaction_button_page_columns( $columns ) {
        $columns['reaction'] = __( 'Reaction', 'reaction-button' );
        return $columns;
    }

    /**
     * Add reaction data into post column
     *
     * @param [array] $columns
     * @param [int] $post_id
     * 
     * @return void
     */
    public function reaction_button_page_columns_data( $columns, $post_id ){
        
        if( 'reaction' == $columns ){
            $meta_keys = [
                'wd_reaction_smile',
                'wd_reaction_straight',
                'wd_reaction_sad',
            ];
            
            foreach ( $meta_keys as $meta_key ) {
                $amount[]   = get_post_meta( $post_id, $meta_key, true ) ? intval( get_post_meta( $post_id, $meta_key, true ) ) : 0;
            }
            ?>
            <ul>
                <li><?php printf( __( "Smile (%d)", 'reaction-button'), $amount[0] );?></li>
                <li><?php printf( __( "Straight(%d)", 'reaction-button'), $amount[1] ); ?></li>
                <li><?php printf( __( "Sad(%d)", 'reaction-button'), $amount[2] ); ?></li>
            </ul>
            <?php
        }
    }
}