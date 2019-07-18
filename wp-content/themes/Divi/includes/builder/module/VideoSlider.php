<?php

class ET_Builder_Module_Video_Slider extends ET_Builder_Module {
	function init() {
		$this->name            = esc_html__( 'Video Slider', 'et_builder' );
		$this->plural          = esc_html__( 'Video Sliders', 'et_builder' );
		$this->slug            = 'et_pb_video_slider';
		$this->vb_support 	   = 'on';
		$this->child_slug      = 'et_pb_video_slider_item';
		$this->child_item_text = esc_html__( 'Video', 'et_builder' );
		$this->main_css_element = '.et_pb_video_slider%%order_class%%';
		$this->has_box_shadow  = false;
		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'elements' => esc_html__( 'Elements', 'et_builder' ),
					'overlay'  => esc_html__( 'Overlay', 'et_builder' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'colors' => esc_html__( 'Controls Colors', 'et_builder' ),
				),
			),
		);

		$this->custom_css_fields = array(
			'play_button' => array(
				'label'    => esc_html__( 'Play Button', 'et_builder' ),
				'selector' => '.et_pb_video_play',
			),
			'thumbnail_item' => array(
				'label'    => esc_html__( 'Thumbnail Item', 'et_builder' ),
				'selector' => '.et_pb_carousel_item',
			),
			'arrows' => array(
				'label'    => esc_html__( 'Slider Arrows', 'et_builder' ),
				'selector' => '.et-pb-slider-arrows a',
			),
		);

		$this->advanced_fields = array(
			'borders'               => array(
				'default' => array(
					'css' => array(
						'main' => array(
							'border_radii'  => "{$this->main_css_element} .et_pb_slider, {$this->main_css_element} .et_pb_carousel_item",
							'border_styles' => "{$this->main_css_element} .et_pb_slider, {$this->main_css_element} .et_pb_carousel_item",
						),
					),
				),
			),
			'margin_padding' => array(
				'css' => array(
					'important' => array( 'custom_margin' ), // needed to overwrite last module margin-bottom styling
				),
			),
			'max_width'             => array(
				'css' => array(
					'module_alignment' => "%%order_class%%.et_pb_video_slider.et_pb_module",
				),
			),
			'fonts'                 => false,
			'text'                  => false,
			'button'                => false,
			'box_shadow'            => array(
				'default' => array(
					'css' => array(
						'main' => '%%order_class%%>.et_pb_slider, %%order_class%%>.et_pb_carousel .et_pb_carousel_item',
						'overlay' => 'inset',
					),
				),
			),
			'link_options'          => false,
		);

		$this->help_videos = array(
			array(
				'id'   => esc_html( 'gwTruYDcxoE' ),
				'name' => esc_html__( 'An introduction to the Video Slider module', 'et_builder' ),
			),
		);
	}

	function get_fields() {
		$fields = array(
			'show_image_overlay' => array(
				'label'           => esc_html__( 'Show Image Overlays on Main Video', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on' => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'default_on_front' => 'off',
				'toggle_slug'     => 'overlay',
				'description'     => esc_html__( 'This option will cover the player UI on the main video. This image can either be uploaded in each video setting or auto-generated by Divi.', 'et_builder' ),
			),
			'show_arrows' => array(
				'label'           => esc_html__( 'Show Arrows', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'default_on_front' => 'on',
				'toggle_slug'        => 'elements',
				'description'        => esc_html__( 'This setting will turn on and off the navigation arrows.', 'et_builder' ),
			),
			'show_thumbnails' => array(
				'label'             => esc_html__( 'Slider Controls', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'configuration',
				'options'           => array(
					'on'  => esc_html__( 'Use Thumbnail Track', 'et_builder' ),
					'off' => esc_html__( 'Use Dot Navigation', 'et_builder' ),
				),
				'default_on_front' => 'on',
				'toggle_slug'        => 'elements',
				'description'        => esc_html__( 'This setting will let you choose to use the thumbnail track controls below the slider or dot navigation at the bottom of the slider.', 'et_builder' ),
			),
			'controls_color' => array(
				'label'             => esc_html__( 'Slider Controls Color', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'color_option',
				'options'           => array(
					'light' => esc_html__( 'Light', 'et_builder' ),
					'dark'  => esc_html__( 'Dark', 'et_builder' ),
				),
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'colors',
				'description'       => esc_html__( 'This setting will make your slider controls either light or dark in color. Slider controls are either the arrows on the thumbnail track or the circles in dot navigation.', 'et_builder' ),
			),
			'play_icon_color' => array(
				'label'             => esc_html__( 'Play Icon Color', 'et_builder' ),
				'description'       => esc_html__( 'Here you can define a custom color for the play icon.', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'colors',
				'hover'             => 'tabs',
				'mobile_options'    => true,
			),
			'use_icon_font_size'      => array(
				'label'            => esc_html__( 'Use Play Icon Font Size', 'et_builder' ),
				'description'      => esc_html__( 'If you would like to control the size of the icon, you must first enable this option.', 'et_builder' ),
				'type'             => 'yes_no_button',
				'options'          => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
				),
				'default_on_front' => 'off',
				'affects'          => array(
					'icon_font_size',
				),
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'colors',
				'option_category'  => 'font_option',
			),
			'icon_font_size'          => array(
				'label'            => esc_html__( 'Play Icon Font Size', 'et_builder' ),
				'description'      => esc_html__( 'Control the size of the icon by increasing or decreasing the font size.', 'et_builder' ),
				'type'             => 'range',
				'option_category'  => 'font_option',
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'colors',
				'allowed_units'    => array( '%', 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw' ),
				'default'          => '96px',
				'default_unit'     => 'px',
				'default_on_front' => '',
				'range_settings'   => array(
					'min'  => '1',
					'max'  => '120',
					'step' => '1',
				),
				'mobile_options'   => true,
				'depends_show_if'  => 'on',
				'responsive'       => true,
				'hover'            => 'tabs',
			),
			'thumbnail_overlay_color' => array(
				'label'             => esc_html__( 'Thumbnail Overlay Color', 'et_builder' ),
				'description'       => esc_html__( 'Pick a color to use for the overlay that appears behind the play icon when hovering over the video.', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'colors',
				'mobile_options'    => true,
			),
		);
		return $fields;
	}

	public function get_transition_fields_css_props() {
		$fields = parent::get_transition_fields_css_props();

		$fields['play_icon_color'] = array( 'color' => '%%order_class%% .et_pb_video_play, %%order_class%% .et_pb_carousel .et_pb_video_play' );
		$fields['icon_font_size']  = array(
			'font-size'   => '%%order_class%% .et_pb_video_play, %%order_class%% .et_pb_carousel .et_pb_video_play',
			'margin-left' => '%%order_class%% .et_pb_video_play, %%order_class%% .et_pb_carousel .et_pb_video_play',
			'margin-top'  => '%%order_class%% .et_pb_video_play, %%order_class%% .et_pb_carousel .et_pb_video_play',
			'line-height' => '%%order_class%% .et_pb_video_play, %%order_class%% .et_pb_carousel .et_pb_video_play',
		);

		return $fields;
	}

	function before_render() {
		global $et_pb_slider_image_overlay;

		$show_image_overlay = $this->props['show_image_overlay'];

		$et_pb_slider_image_overlay = $show_image_overlay;

	}

	function render( $attrs, $content = null, $render_slug ) {
		$show_arrows              = $this->props['show_arrows'];
		$show_thumbnails          = $this->props['show_thumbnails'];
		$controls_color           = $this->props['controls_color'];
		$use_icon_font_size       = $this->props['use_icon_font_size'];
		$play_icon_color_values   = et_pb_responsive_options()->get_property_values( $this->props, 'play_icon_color' );
		$play_icon_color_hover    = $this->get_hover_value( 'play_icon_color' );
		$icon_font_size_values    = et_pb_responsive_options()->get_property_values( $this->props, 'icon_font_size' );
		$icon_font_size_hover     = $this->get_hover_value( 'icon_font_size' );
		$thumbnail_overlay_colors = et_pb_responsive_options()->get_property_values( $this->props, 'thumbnail_overlay_color' );

		global $et_pb_slider_image_overlay;

		$video_background          = $this->video_background();
		$parallax_image_background = $this->get_parallax_image_background();

		// Play Icon color.
		et_pb_responsive_options()->generate_responsive_css( $play_icon_color_values, '%%order_class%% .et_pb_video_play, %%order_class%% .et_pb_carousel .et_pb_video_play', 'color', $render_slug, ' !important;', 'color' );

		if ( et_builder_is_hover_enabled( 'play_icon_color', $this->props ) ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .et_pb_video_play:hover, %%order_class%% .et_pb_carousel .et_pb_video_play:hover',
				'declaration' => sprintf(
					'color: %1$s !important;',
					esc_html( $play_icon_color_hover )
				),
			) );
		}

		// Icon Size.
		$icon_selector = '%%order_class%% .et_pb_video_play, %%order_class%% .et_pb_carousel .et_pb_video_play';
		if ( 'off' !== $use_icon_font_size ) {
			// Proccess for each devices.
			foreach ( $icon_font_size_values as $font_size_key => $font_size_value ) {
				if ( '' === $font_size_value ) {
					continue;
				}

				$media_query = 'general';
				if ( 'tablet' === $font_size_key ) {
					$media_query = ET_Builder_Element::get_media_query( 'max_width_980' );
				} elseif ( 'phone' === $font_size_key ) {
					$media_query = ET_Builder_Element::get_media_query( 'max_width_767' );
				}

				$font_size_value_int  = (int) $font_size_value;
				$font_size_value_unit = str_replace( $font_size_value_int, '', $font_size_value );
				$font_size_value_half = 0 < $font_size_value_int ? $font_size_value_int / 2 : 0;
				$font_size_value_half = (string) $font_size_value_half . $font_size_value_unit;
				ET_Builder_Element::set_style( $render_slug, array(
					'selector'    => '%%order_class%% .et_pb_video_play',
					'declaration' => sprintf(
						'font-size:%1$s; line-height:%1$s;',
						esc_html( $font_size_value ),
						esc_html( $font_size_value_half )
					),
					'media_query' => $media_query,
				) );
			}

			// Icon hover styles.
			if ( et_builder_is_hover_enabled( 'icon_font_size', $this->props ) && '' !== $icon_font_size_hover ) {
				$icon_font_size_hover_int  = (int) $icon_font_size_hover;
				$icon_font_size_hover_unit = str_replace( $icon_font_size_hover_int, '', $icon_font_size_hover );
				$icon_font_size_hover_half = 0 < $icon_font_size_hover_int ? $icon_font_size_hover_int / 2 : 0;
				$icon_font_size_hover_half = (string) $icon_font_size_hover_half . $icon_font_size_hover_unit;
				ET_Builder_Element::set_style( $render_slug, array(
					'selector'    => $this->add_hover_to_selectors( $icon_selector ),
					'declaration' => sprintf(
						'font-size:%1$s; line-height:%1$s; margin-top:-%2$s; margin-left:-%2$s;',
						esc_html( $icon_font_size_hover ),
						esc_html( $icon_font_size_hover_half )
					),
				) );
			}
		}

		// Thumbnail Overlay Color.
		et_pb_responsive_options()->generate_responsive_css( $thumbnail_overlay_colors, '%%order_class%% .et_pb_carousel_item .et_pb_video_overlay_hover:hover, %%order_class%%.et_pb_video_slider .et_pb_slider:hover .et_pb_video_overlay_hover, %%order_class%% .et_pb_carousel_item.et-pb-active-control .et_pb_video_overlay_hover', 'background-color', $render_slug, '', 'color' );

		$slider_classname  = '';
		$slider_classname .= 'off' === $show_arrows ? ' et_pb_slider_no_arrows' : '';
		$slider_classname .= 'on' === $show_thumbnails ? ' et_pb_slider_carousel et_pb_slider_no_pagination' : '';
		$slider_classname .= 'off' === $show_thumbnails ? ' et_pb_slider_dots' : '';
		$slider_classname .= " et_pb_controls_{$controls_color}";

		$content = $this->content;

		// Module classnames
		if ( $this->has_box_shadow ) {
			$this->add_classname( 'et_pb_has_box_shadow' );
		}

		$output = sprintf(
			'<div%3$s class="%4$s">
				%6$s
				%5$s
				<div class="et_pb_slider et_pb_preload%1$s">
					<div class="et_pb_slides">
						%2$s
					</div> <!-- .et_pb_slides -->
				</div> <!-- .et_pb_slider -->
			</div> <!-- .et_pb_video_slider -->
			',
			esc_attr( $slider_classname ),
			$content,
			$this->module_id(),
			$this->module_classname( $render_slug ),
			$video_background,
			$parallax_image_background
		);

		return $output;
	}
}

new ET_Builder_Module_Video_Slider;
