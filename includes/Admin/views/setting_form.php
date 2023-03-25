<div class="wrap">
    <h1><?php esc_html_e( 'Reaction Button Setting', 'reaction-button' ); ?></h1>
    <div class="rd-shortcode-view">
        <h4><?php esc_html_e( 'Use this shortcode to deploy your reaction buttons in a widget, or editor.', 'reaction-button' ); ?></h4>
        <h4><code><?php esc_html_e( '[reaction-button]', 'reaction-button' ); ?></code></h4>
        
    </div>

    <?php settings_errors(); ?>

    <form action="options.php" method="post">
        <?php
            settings_fields( 'reaction_button' );
            do_settings_sections( 'reaction_button' );
            submit_button();
        ?>
    </form>
</div>