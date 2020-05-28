<?php
namespace Elementor;
namespace BW_Modernaweb\Includes\Widgets;
use Elementor\Plugin;

use Elementor\Widget_Base;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Color;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Css_Filter;

/**
 * Elementor title Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class BW_Flip_Ix extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve button widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'b_flip_box';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve button widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Black Flip Box', 'bw' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve button widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-flip-box';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the button widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'bw' ];
	}

	/**
	 * Register button widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		// Start
		// Content section
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'bw' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		// Select type of the title
		$this->add_control(
			'widget_type',
			[
				'label' => __( 'Select Type', 'bw' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'fbtt',
				'options' => [
					'fbtt' 			=> __( 'Flip Bottom To Top', 'bw' ),
					'fttb' 			=> __( 'Flip Top To Bottom', 'bw' ),
					'fltr' 			=> __( 'Flip Left To Right', 'bw' ),
					'frtl' 			=> __( 'Flip Right To Left', 'bw' ),
				],
			]
		);

		// Enable 3D
		$this->add_control(
			'widget_3d',
			[
				'label' 		=> __( '3D Depth', 'bw' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Enable', 'bw' ),
				'label_off' 	=> __( 'Disable', 'bw' ),
				'return_value' 	=> 'ddd',
				'default' 		=> 'off',
			]
		);

		$this->add_control(
			'hr1',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->start_controls_tabs('flipbox_content_tab'); // Start Tabs
		$this->start_controls_tab(
			'face_tab_content',
			[
				'label' => __( 'Face', 'bw' ),
			]
		);

		$this->add_control(
			'widget_face_icon',
			[
				'label' => __( 'Icon', 'bw' ),
				'type' => Controls_Manager::ICONS,
			]
		);

		// Type title
		$this->add_control(
			'widget_face_title',
			[
				'label' => __( 'Title', 'bw' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Flipbox', 'bw' ),
				'placeholder' => __( 'Type your title here', 'bw' ),
			]
		);

		$this->add_control(
			'widget_face_description',
			[
				'label' => __( 'Description (limit character 159)', 'bw' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 5,
				'default' => __( 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.', 'bw' ),
				'placeholder' => __( 'Type your description here', 'bw' ),
			]
		);

		$this->add_control(
			'face_bg',
			[
				'label' => __( 'Face Background Options', 'bw' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);	

		// Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'flipbox_face_bg',
				'label' => __( 'Face Background', 'bw' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-front',
			]
		);

		$this->add_control(
			'flipbox_face_bg_opacity',
			[
				'label' => __( 'Opacity', 'bw' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-front' => 'opacity: {{SIZE}} !important;',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'flipbox_face_bg_filters',
				'label' => __( 'Overlay CSS Filters', 'bw' ),
				'selector' => '{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-front',
			]
		);

		$this->add_control(
			'face_overlay',
			[
				'label' => __( 'Face Overlay Options', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		// Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'flipbox_face_overlay',
				'label' => __( 'Background', 'bw' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-front:before',
			]
		);

		$this->add_control(
			'flipbox_face_overlay_opacity',
			[
				'label' => __( 'Opacity', 'bw' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-front:before' => 'opacity: {{SIZE}} !important;',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'flipbox_face_overlay_filters',
				'label' => __( 'Overlay CSS Filters', 'bw' ),
				'selector' => '{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-front:before',
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'back_tab_content',
			[
				'label' => __( 'Back', 'bw' ),
			]
		);

		$this->add_control(
			'widget_back_icon',
			[
				'label' => __( 'Icon', 'bw' ),
				'type' => Controls_Manager::ICONS,
			]
		);

		// Type title
		$this->add_control(
			'widget_back_title',
			[
				'label' => __( 'Title', 'bw' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Know More', 'bw' ),
				'placeholder' => __( 'Type your title here', 'bw' ),
			]
		);

		$this->add_control(
			'widget_back_description',
			[
				'label' => __( 'Description (limit character 300)', 'bw' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 5,
				'default' => __( 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.', 'bw' ),
				'placeholder' => __( 'Type your description here', 'bw' ),
			]
		);

		$this->add_control(
			'back_bg',
			[
				'label' => __( 'Back Background Options', 'bw' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);	

		// Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'flipbox_back_bg',
				'label' => __( 'Back Background', 'bw' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-back',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'flipbox_back_bg_filters',
				'label' => __( 'Overlay CSS Filters', 'bw' ),
				'selector' => '{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-back',
			]
		);

		$this->add_control(
			'btn_txt',
			[
				'label' => __( 'Button Text', 'bw' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Click Here', 'bw' ),
				'placeholder' => __( 'Type your title here', 'bw' ),
			]
		);

		$this->add_control(
			'btn_link',
			[
				'label' => __( 'Link', 'bw' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'bw' ),
				'show_external' => true,
				'show_nofollow' => false,
				'default' => [
					'url' => '',
					'is_external' => true,
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs(); // End Tabs

		$this->end_controls_section();
		// End

		// Start
		// Style section
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Box Style', 'bw' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Margin
		$this->add_responsive_control(
			'widget_box_margin',
			[
				'label' => __( 'Margin', 'bw' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Padding
		$this->add_responsive_control(
			'widget_box_padding',
			[
				'label' => __( 'Padding', 'bw' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'widget_box_background',
				'label' => __( 'Background', 'bw' ),
				'types' => [ 'classic', 'gradient', ],
				'selector' => '{{WRAPPER}} .bw-flipbox',
			]
		);

		// Alignment
		$this->add_responsive_control(
			'widget_alignment',
			[
				'label'     => __( 'Text Alignment', 'bw' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'bw' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'bw' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'bw' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'toggle'    => true,
			]
		);

		// Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'widget_box_border',
				'label' => __( 'Border', 'bw' ),
				'selector' => '{{WRAPPER}} .bw-flipbox',
			]
		);

		// Border Radius
		$this->add_control(
			'widget_box_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'bw' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Box shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'widget_box_box_shadow',
				'label' => __( 'Box Shadow', 'bw' ),
				'selector' => '{{WRAPPER}} .bw-flipbox',
			]
		);

		$this->end_controls_section();
        // End

		// Start
		// Main Text Typography
		$this->start_controls_section(
			'style_section_icon_typo',
			[
				'label' => __( 'Front Icon Settings', 'bw' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Color
		$this->add_control(
			'style_main_icon_color',
			[
				'label' => __( 'Color', 'bw' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-front .title-box i' => 'color: {{VALUE}}',
				],
			]
		);

		// Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'icon_front_bg',
				'label' => __( 'Back Background', 'bw' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-front .title-box i',
			]
		);

		$this->add_control(
			'style_icon',
			[
				'label' => __( 'Size', 'bw' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 3,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 2,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-front .title-box i' => 'font-size: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'hr2',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		// Margin
		$this->add_responsive_control(
			'style_main_icon_margin',
			[
				'label' => __( 'Margin', 'bw' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-front .title-box i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Padding
		$this->add_responsive_control(
			'style_main_icon_padding',
			[
				'label' => __( 'Padding', 'bw' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-front .title-box i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'hr3',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		// Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'style_main_icon_border',
				'label' => __( 'Border', 'bw' ),
				'selector' => '{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-front .title-box i',
			]
		);

		// Border Radius
		$this->add_control(
			'style_main_icon_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'bw' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-front .title-box i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Box shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'style_main_icon_box_shadow',
				'label' => __( 'Box Shadow', 'bw' ),
				'selector' => '{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-front .title-box i',
			]
		);

		$this->end_controls_section();
        // End

		// Start
		// Main Text Typography
		$this->start_controls_section(
			'style_section_main_typo',
			[
				'label' => __( 'Front Title Typography', 'bw' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Color
		$this->add_control(
			'style_main_title_color',
			[
				'label' => __( 'Color', 'bw' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-front .title-box h4' => 'color: {{VALUE}}',
				],
			]
		);

		// Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'style_main_title_typography1',
				'label' => __( 'Typography', 'bw' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-front .title-box h4',
			]
		);

		// Text shadow
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'style_main_title_text_shadow',
				'label' => __( 'Text Shadow', 'bw' ),
				'selector' => '{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-front .title-box h4',
			]
		);

		$this->add_control(
			'hr4',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		// Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'style_main_title_background',
				'label' => __( 'Background', 'bw' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-front .title-box h4',
			]
		);

		$this->add_control(
			'hr5',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		// Margin
		$this->add_responsive_control(
			'style_main_title_margin',
			[
				'label' => __( 'Margin', 'bw' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-front .title-box h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Padding
		$this->add_responsive_control(
			'style_main_title_padding',
			[
				'label' => __( 'Padding', 'bw' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-front .title-box h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'hr6',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		// Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'style_main_title_border',
				'label' => __( 'Border', 'bw' ),
				'selector' => '{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-front .title-box h4',
			]
		);

		// Border Radius
		$this->add_control(
			'style_main_title_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'bw' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-front .title-box h4' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Box shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'style_main_title_box_shadow',
				'label' => __( 'Box Shadow', 'bw' ),
				'selector' => '{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-front .title-box h4',
			]
		);

		$this->end_controls_section();
		// End

		// Start
		// Main Text Typography
		$this->start_controls_section(
			'style_section_paragraph_typo',
			[
				'label' => __( 'Front Paragraph Typography', 'bw' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Color
		$this->add_control(
			'style_main_paragraph_color',
			[
				'label' => __( 'Color', 'bw' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-front .title-box p' => 'color: {{VALUE}}',
				],
			]
		);

		// Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'style_main_paragraph_typography1',
				'label' => __( 'Typography', 'bw' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-front .title-box p',
			]
		);

		// Text shadow
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'style_main_paragraph_text_shadow',
				'label' => __( 'Text Shadow', 'bw' ),
				'selector' => '{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-front .title-box p',
			]
		);

		$this->add_control(
			'hr7',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		// Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'style_main_paragraph_background',
				'label' => __( 'Background', 'bw' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-front .title-box p',
			]
		);

		$this->add_control(
			'hr8',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		// Margin
		$this->add_responsive_control(
			'style_main_paragraph_margin',
			[
				'label' => __( 'Margin', 'bw' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-front .title-box p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Padding
		$this->add_responsive_control(
			'style_main_paragraph_padding',
			[
				'label' => __( 'Padding', 'bw' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-front .title-box p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'hr9',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		// Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'style_main_paragraph_border',
				'label' => __( 'Border', 'bw' ),
				'selector' => '{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-front .title-box p',
			]
		);

		// Border Radius
		$this->add_control(
			'style_main_paragraph_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'bw' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-front .title-box p' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Box shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'style_main_paragraph_box_shadow',
				'label' => __( 'Box Shadow', 'bw' ),
				'selector' => '{{WRAPPER}} .bw-flipbox .bw-flip-card .bw-front .title-box p',
			]
		);

		$this->end_controls_section();
		// End

		// Start
		// Main Text Typography
		$this->start_controls_section(
			'style_section_back_icon_typo',
			[
				'label' => __( 'Back Icon Settings', 'bw' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Color
		$this->add_control(
			'style_main_back_icon_color',
			[
				'label' => __( 'Color', 'bw' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description i' => 'color: {{VALUE}}',
				],
			]
		);

		// Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'icon_back_bg',
				'label' => __( 'Back Background', 'bw' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description i',
			]
		);

		$this->add_control(
			'style_back_icon',
			[
				'label' => __( 'Size', 'bw' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 3,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 2,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description i' => 'font-size: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'hr10',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		// Margin
		$this->add_responsive_control(
			'style_main_back_icon_margin',
			[
				'label' => __( 'Margin', 'bw' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Padding
		$this->add_responsive_control(
			'style_main_back_icon_padding',
			[
				'label' => __( 'Padding', 'bw' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'hr11',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		// Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'style_main_back_icon_border',
				'label' => __( 'Border', 'bw' ),
				'selector' => '{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description i',
			]
		);

		// Border Radius
		$this->add_control(
			'style_main_back_icon_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'bw' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Box shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'style_main_back_icon_box_shadow',
				'label' => __( 'Box Shadow', 'bw' ),
				'selector' => '{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description i',
			]
		);

		$this->end_controls_section();
        // End

		// Start
		// Main Text Typography
		$this->start_controls_section(
			'style_section_back_main_typo',
			[
				'label' => __( 'Back Title Typography', 'bw' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Color
		$this->add_control(
			'style_main_back_title_color',
			[
				'label' => __( 'Color', 'bw' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description h4' => 'color: {{VALUE}}',
				],
			]
		);

		// Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'style_main_back_title_typography1',
				'label' => __( 'Typography', 'bw' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description h4',
			]
		);

		// Text shadow
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'style_main_back_title_text_shadow',
				'label' => __( 'Text Shadow', 'bw' ),
				'selector' => '{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description h4',
			]
		);

		$this->add_control(
			'hr12',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		// Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'style_main_back_title_background',
				'label' => __( 'Background', 'bw' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description h4',
			]
		);

		$this->add_control(
			'hr13',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		// Margin
		$this->add_responsive_control(
			'style_main_back_title_margin',
			[
				'label' => __( 'Margin', 'bw' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Padding
		$this->add_responsive_control(
			'style_main_back_title_padding',
			[
				'label' => __( 'Padding', 'bw' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'hr14',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		// Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'style_main_back_title_border',
				'label' => __( 'Border', 'bw' ),
				'selector' => '{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description h4',
			]
		);

		// Border Radius
		$this->add_control(
			'style_main_back_title_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'bw' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description h4' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Box shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'style_main_back_title_box_shadow',
				'label' => __( 'Box Shadow', 'bw' ),
				'selector' => '{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description h4',
			]
		);

		$this->end_controls_section();
		// End

		// Start
		// Main Text Typography
		$this->start_controls_section(
			'style_section_back_paragraph_typo',
			[
				'label' => __( 'Back Paragraph Typography', 'bw' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Color
		$this->add_control(
			'style_main_back_paragraph_color',
			[
				'label' => __( 'Color', 'bw' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description p' => 'color: {{VALUE}}',
				],
			]
		);

		// Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'style_main_back_paragraph_typography1',
				'label' => __( 'Typography', 'bw' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description p',
			]
		);

		// Text shadow
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'style_main_back_paragraph_text_shadow',
				'label' => __( 'Text Shadow', 'bw' ),
				'selector' => '{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description p',
			]
		);

		$this->add_control(
			'hr15',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		// Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'style_main_back_paragraph_background',
				'label' => __( 'Background', 'bw' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description p',
			]
		);

		$this->add_control(
			'hr16',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		// Margin
		$this->add_responsive_control(
			'style_main_back_paragraph_margin',
			[
				'label' => __( 'Margin', 'bw' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Padding
		$this->add_responsive_control(
			'style_main_back_paragraph_padding',
			[
				'label' => __( 'Padding', 'bw' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'hr17',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		// Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'style_main_back_paragraph_border',
				'label' => __( 'Border', 'bw' ),
				'selector' => '{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description p',
			]
		);

		// Border Radius
		$this->add_control(
			'style_main_back_paragraph_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'bw' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description p' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Box shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'style_main_back_paragraph_box_shadow',
				'label' => __( 'Box Shadow', 'bw' ),
				'selector' => '{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description p',
			]
		);

		$this->end_controls_section();
		// End

		// Start
		// Main Text Typography
		$this->start_controls_section(
			'style_section_back_button_typo',
			[
				'label' => __( 'Button Typography', 'bw' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Color
		$this->add_control(
			'style_main_back_button_color',
			[
				'label' => __( 'Color', 'bw' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description .bw-button' => 'color: {{VALUE}}',
				],
			]
		);

		// Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'style_main_back_button_typography1',
				'label' => __( 'Typography', 'bw' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description .bw-button',
			]
		);

		// Text shadow
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'style_main_back_button_text_shadow',
				'label' => __( 'Text Shadow', 'bw' ),
				'selector' => '{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description .bw-button',
			]
		);

		$this->add_control(
			'hr18',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		// Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'style_main_back_button_background',
				'label' => __( 'Background', 'bw' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description .bw-button',
			]
		);

		$this->add_control(
			'hr19',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		// Margin
		$this->add_responsive_control(
			'style_main_back_button_margin',
			[
				'label' => __( 'Margin', 'bw' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description .bw-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Padding
		$this->add_responsive_control(
			'style_main_back_button_padding',
			[
				'label' => __( 'Padding', 'bw' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description .bw-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'hr20',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		// Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'style_main_back_button_border',
				'label' => __( 'Border', 'bw' ),
				'selector' => '{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description .bw-button',
			]
		);

		// Border Radius
		$this->add_control(
			'style_main_back_button_border_radius', //param_name
			[
				'label' 		=> __( 'Border Radius', 'bw' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description .bw-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Box shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'style_main_back_button_box_shadow',
				'label' => __( 'Box Shadow', 'bw' ),
				'selector' => '{{WRAPPER}} .bw-flipbox.fbtt .bw-flip-card .bw-back .description .bw-button',
			]
		);

		$this->end_controls_section();
		// End

	}

	/**
	 * Render title widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings   	= $this->get_settings_for_display();

		// Variables
		$type 	        = isset($settings['widget_type'])				? $settings['widget_type']					: '';
		$title 			= isset($settings['widget_face_title'])			? $settings['widget_face_title']			: '';
		$description	= isset($settings['widget_face_description'])	? $settings['widget_face_description']		: '';
		$backtitle		= isset($settings['widget_back_title'])			? $settings['widget_back_title']			: '';
		$backdesc		= isset($settings['widget_back_description'])	? $settings['widget_back_description']		: '';
		$enable3d		= isset($settings['widget_3d'])					? $settings['widget_3d']					: '';
		$iconset		= isset($settings['widget_face_icon'])			? $settings['widget_face_icon']				: '';
        $text			= isset($settings['btn_txt']) 					? $settings['btn_txt'] 						: '';
		$target			= $settings['btn_link']['is_external'] 			? 'target="_blank"' 						: '';
		$nofollow		= $settings['btn_link']['nofollow'] 			? ' rel="nofollow"'							: '';
?>
<div class="bw-flipbox <?php echo $type . ' ' . $enable3d; ?> ">
	<div class="bw-flip-card">
		<div class="bw-front" id="bwflipbox">
			<div class="title-box">
				<?php \Elementor\Icons_Manager::render_icon( $iconset, [ 'aria-hidden' => 'true' ] ); ?>
				<h4><?php echo $title; ?></h4>
				<p><?php 
						if( strlen($description)<= 159 ) {
							echo $description;
						} else {
							$finish=substr( $description, 0, 159 ) . '...';
							echo $finish;
						}
				?></p>
			</div>
		</div>
		<div class="bw-back">
			<div class="description">
				<?php \Elementor\Icons_Manager::render_icon( $settings['widget_back_icon'], [ 'aria-hidden' => 'true' ] ); ?>
				<h4><?php echo $backtitle; ?></h4>
				<p><?php 
						if( strlen($backdesc)<= 300 ) {
							echo $backdesc;
						} else {
							$finish=substr( $backdesc, 0, 300 ) . '...';
							echo $finish;
						}
				?></p>
				<a class="bw-button" href="<?php echo $settings['btn_link']['url']; ?>" <?php echo $target; ?> <?php echo $nofollow; ?>><?php echo $text; ?></a>
			</div>
		</div>
	</div>
</div>
<?php

	}

}