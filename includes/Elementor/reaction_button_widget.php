<?php

/**
 * Elementor widget handler class
 */
class Reaction_Button_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'reaction_button_widget';
	}

	public function get_title() {
		return esc_html__( 'Reaction Button', 'reaction-button' );
	}

	public function get_icon() {
		return 'eicon-parallax';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	public function get_keywords() {
		return [ 'reaction', 'button' ];
	}

	protected function register_controls() {

		// Content Tab Start

		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Title', 'reaction-button' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'reaction-button' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Hello world', 'reaction-button' ),
			]
		);

		$this->end_controls_section();

		// Content Tab End


		// Style Tab Start

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Title', 'reaction-button' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Text Color', 'reaction-button' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hello-world' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// Style Tab End

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

		<p class="hello-world">
			<?php echo do_shortcode('[reaction-button]'); ?>
		</p>

		<?php
	}
}