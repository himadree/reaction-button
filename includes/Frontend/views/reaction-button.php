<?php
    $label_smile    = ( get_option( 'rb_smile' ) != null ) ? get_option( 'rb_smile' ) : __( 'Smile', 'reaction-button' );
    $label_straight = ( get_option( 'rb_straight' ) != null ) ? get_option( 'rb_straight' ) : __( 'Straight', 'reaction-button' );
    $label_sad      = ( get_option( 'rb_sad' ) != null ) ? get_option( 'rb_sad' ) : __( 'Sad', 'reaction-button' );
?>

<ul>
    <li class="reaction-button-list" data-reaction="smile">
        <a href="">
            <em><?php echo esc_html( $label_smile ); ?></em>
            <img src="<?php echo REACTION_BUTTON_ASSETS . '/images/love.png' ?>" />
            <span><?php esc_html_e( '0', 'reaction-button' ); ?></span>
        </a>
    </li>

    <li class="reaction-button-list" data-reaction="straight">
        <a href="">
            <em><?php echo esc_html( $label_straight ); ?></em>
            <img src="<?php echo REACTION_BUTTON_ASSETS . '/images/surprised.png' ?>" />
            <span><?php esc_html_e( '0', 'reaction-button' ); ?></span>
        </a>
    </li>
    
    <li class="reaction-button-list" data-reaction="sad">
        <a href="">
            <em><?php echo esc_html( $label_sad ); ?></em>
            <img src="<?php echo REACTION_BUTTON_ASSETS . '/images/sad.png' ?>" />
            <span><?php esc_html_e( '0', 'reaction-button' ); ?></span>
        </a>
    </li>
</ul>