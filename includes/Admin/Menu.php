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
		add_action( 'admin_init', array( $this, 'rb_setup_sections' ) );
		add_action( 'admin_init', array( $this, 'rb_setup_fields' ) );
	}

    /**
     * Register admin menu
     */
	public function admin_menu() {
        $capability = 'manage_options';
        $parent_slug = 'reaction_button';

        $hook = add_menu_page( __( 'Reaction Button', 'reaction-button' ), __( 'Reaction Button', 'reaction-button' ), $capability, $parent_slug, [ $this, 'render_setting_page' ] );

        add_action( 'admin_head-' . $hook, [ $this, 'enqueue_assets' ] );	
	}

    /**
     * Undocumented function
     *
     * @return void
     */
    public function enqueue_assets() {
        wp_enqueue_style( 'reactionbutton-admin-style' );
    }
    
    /**
     * Undocumented function
     *
     * @return void
     */
	public function render_setting_page() {
        // check user capabilities
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        include __DIR__ . '/views/setting_form.php';
	}

    /**
     * Undocumented function
     *
     * @return void
     */
	public function rb_setup_sections() {
		add_settings_section( 'reaction_button_section', '', array(), 'reaction_button' );
	}

    /**
     * Undocumented function
     *
     * @return void
     */
	public function rb_setup_fields() {
		$fields = [
            [
                'section' => 'reaction_button_section',
                'label'   => __( 'Reaction Label Smile', 'reaction-button' ),
                'id'      => 'rb_smile',
                'type'    => 'text',
            ],
            [
                'section' => 'reaction_button_section',
                'label'   => __( 'Reaction Label Straight', 'reaction-button' ),
                'id'      => 'rb_straight',
                'type'    => 'text',
            ],
            [
                'section' => 'reaction_button_section',
                'label'   => __( 'Reaction Label Sad', 'reaction-button' ),
                'id'      => 'rb_sad',
                'type'    => 'text',
            ],
            [
                'section' => 'reaction_button_section',
                'label' => 'Disable on every single posts',
                'id' => 'rb_enable_single',
                'type' => 'checkbox',
            ],
        ];

		foreach( $fields as $field ){
			add_settings_field( $field['id'], $field['label'], array( $this, 'rb_field_callback' ), 'reaction_button', $field['section'], $field );
			register_setting( 'reaction_button', $field['id'] );
		}
	}

    /**
     * Undocumented function
     *
     * @param [type] $field
     * @return void
     */
	public function rb_field_callback( $field ) {

		$value       = get_option( $field['id'] );
		$placeholder = '';

		if ( isset($field['placeholder']) ) {
			$placeholder = $field['placeholder'];
		}

		switch ( $field['type'] ) {
            case 'checkbox':
                printf('<input %s id="%s" name="%s" type="checkbox" value="off">',
                    $value === 'off' ? 'checked' : '',
                    $field['id'],
                    $field['id']
                );
            break;

			default:
				printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />',
					$field['id'],
					$field['type'],
					$placeholder,
					$value
				);
		}

		if( isset($field['desc']) ) {
			if( $desc = $field['desc'] ) {
				printf( '<p class="description">%s </p>', $desc );
			}
		}
	}
    
}