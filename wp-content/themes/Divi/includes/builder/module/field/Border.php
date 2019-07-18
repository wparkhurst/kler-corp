<?php

class ET_Builder_Module_Field_Border extends ET_Builder_Module_Field_Base {

	/**
	 * @var ET_Core_Data_Utils
	 */
	protected static $_;

	/**
	 * @var ET_Builder_Module_Helper_ResponsiveOptions
	 *
	 * @since 3.23
	 */
	public static $responsive = null;

	protected static $_is_default = array();

	/**
	 * List of no border reset.
	 *
	 * @since 3.23 Remove pricing tables from the list to allow border reset.
	 *
	 * @var array
	 */
	protected static $_no_border_reset = array(
		'et_pb_accordion',
		'et_pb_accordion_item',
		'et_pb_pricing_table',
		'et_pb_tabs',
		'et_pb_toggle',
		'et_pb_social_media_follow',
	);

	/**
	 * ET_Builder_Module_Field_Border constructor.
	 */
	public function __construct() {
		self::$_ = ET_Core_Data_Utils::instance();
	}

	/**
	 * Get border fields.
	 *
	 * @since 3.23 Add support for responsive settings. Add allowed units for some range fields.
	 *
	 * @param  array $args Border settings arguments.
	 * @return array       Border fields.
	 */
	public function get_fields( array $args = array() ) {
		$settings = shortcode_atts( array(
			'suffix'          => '',
			'label_prefix'    => '',
			'tab_slug'        => 'advanced',
			'toggle_slug'     => 'border',
			'color_type'      => 'color-alpha',
			'depends_on'      => null,
			'depends_show_if' => null,
			'defaults'        => array(
				'border_radii'  => 'on||||',
				'border_styles' => array(
					'width' => '0px',
					'color' => '#333333',
					'style' => 'solid',
				),
			),
		), $args );

		$additional_options = array();
		$suffix             = $settings['suffix'];
		$defaults           = $settings['defaults']['border_styles'];
		$defaultUnit        = 'px';

		$additional_options["border_radii{$suffix}"] = array(
			'label'           => sprintf( '%1$s%2$s', '' !== $settings['label_prefix'] ? sprintf( '%1$s ', $settings['label_prefix'] ) : '', esc_html__( 'Rounded Corners', 'et_builder' ) ),
			'type'            => 'border-radius',
			'hover'           => 'tabs',
			'validate_input'  => true,
			'default'         => $settings['defaults']['border_radii'],
			'tab_slug'        => $settings['tab_slug'],
			'toggle_slug'     => $settings['toggle_slug'],
			'attr_suffix'     => $suffix,
			'option_category' => 'border',
			'description'     => esc_html__( 'Here you can control the corner radius of this element. Enable the link icon to control all four corners at once, or disable to define custom values for each.', 'et_builder' ),
			'tooltip'         => esc_html__( 'Sync values', 'et_builder' ),
			'mobile_options'  => true,
			'allowed_units'   => array( '%', 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw' ),
		);

		$additional_options["border_styles{$suffix}"] = array(
			'label'               => sprintf( '%1$s%2$s', '' !== $settings['label_prefix'] ? sprintf( '%1$s ', $settings['label_prefix'] ) : '', esc_html__( 'Border Styles', 'et_builder' ) ),
			'description'         => esc_html__( 'You can add borders to any element, customize their appearance and assign unique styles to each edge.', 'et_builder' ),
			'tab_slug'            => $settings['tab_slug'],
			'toggle_slug'         => $settings['toggle_slug'],
			'type'                => 'composite',
			'attr_suffix'         => $suffix,
			'option_category'     => 'border',
			'composite_type'      => 'tabbed',
			'composite_structure' => array(
				"border_all"    => array(
					'icon'     => 'border-all',
					'controls' => array(
						"border_width_all{$suffix}" => array(
							'label'          => sprintf( '%1$s%2$s', '' !== $settings['label_prefix'] ? sprintf( '%1$s ', $settings['label_prefix'] ) : '', esc_html__( 'Border Width', 'et_builder' ) ),
							'description'    => esc_html__( 'Increasing the width of the border will increase its size/thickness.', 'et_builder' ),
							'type'           => 'range',
							'hover'          => 'tabs',
							'default'        => $defaults['width'],
							'default_unit'   => $defaultUnit,
							'allowed_units'  => array( 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw' ),
							'range_settings' => array(
								'min'  => 0,
								'max'  => 50,
								'step' => 1,
							),
							'context' => "border_styles{$suffix}",
							'mobile_options' => true,
						),
						"border_color_all{$suffix}" => array(
							'label'   => sprintf( '%1$s%2$s', '' !== $settings['label_prefix'] ? sprintf( '%1$s ', $settings['label_prefix'] ) : '', esc_html__( 'Border Color', 'et_builder' ) ),
							'description' => esc_html__( 'Pick a color to be used for the border.', 'et_builder' ),
							'type'    => $settings['color_type'],
							'hover'   => 'tabs',
							'default' => $defaults['color'],
							'context' => "border_styles{$suffix}",
							'mobile_options' => true,
						),
						"border_style_all{$suffix}" => array(
							'label'   => sprintf( '%1$s%2$s', '' !== $settings['label_prefix'] ? sprintf( '%1$s ', $settings['label_prefix'] ) : '', esc_html__( 'Border Style', 'et_builder' ) ),
							'description' => esc_html__( 'Borders support various different styles, each of which will change the shape of the border element.', 'et_builder' ),
							'type'    => 'select',
							'options' => et_builder_get_border_styles(),
							'default' => $defaults['style'],
							'context' => "border_styles{$suffix}",
							'hover'   => 'tabs',
							'mobile_options' => true,
						),
					),
				),
				'border_top'    => array(
					'icon'     => 'border-top',
					'controls' => array(
						"border_width_top{$suffix}" => array(
							'label'          => sprintf( '%1$s%2$s', '' !== $settings['label_prefix'] ? sprintf( '%1$s ', $settings['label_prefix'] ) : '', esc_html__( 'Top Border Width', 'et_builder' ) ),
							'description'    => esc_html__( 'Increasing the width of the border will increase its size/thickness.', 'et_builder' ),
							'type'           => 'range',
							'hover'          => 'tabs',
							'allow_empty'    => true,
							'default_from'   => "border_all.controls.border_width_all{$suffix}",
							'default_unit'   => $defaultUnit,
							'allowed_units'  => array( 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw' ),
							'range_settings' => array(
								'min'  => 0,
								'max'  => 50,
								'step' => 1,
							),
							'context' => "border_styles{$suffix}",
							'mobile_options' => true,
						),
						"border_color_top{$suffix}" => array(
							'label'        => sprintf( '%1$s%2$s', '' !== $settings['label_prefix'] ? sprintf( '%1$s ', $settings['label_prefix'] ) : '', esc_html__( 'Top Border Color', 'et_builder' ) ),
							'description'  => esc_html__( 'Pick a color to be used for the border.', 'et_builder' ),
							'type'         => $settings['color_type'],
							'hover'        => 'tabs',
							'default_from' => "border_all.controls.border_color_all{$suffix}",
							'context'      => "border_styles{$suffix}",
							'mobile_options' => true,
						),
						"border_style_top{$suffix}" => array(
							'label'        => sprintf( '%1$s%2$s', '' !== $settings['label_prefix'] ? sprintf( '%1$s ', $settings['label_prefix'] ) : '', esc_html__( 'Top Border Style', 'et_builder' ) ),
							'description'  => esc_html__( 'Borders support various different styles, each of which will change the shape of the border element.', 'et_builder' ),
							'type'         => 'select',
							'options'      => et_builder_get_border_styles(),
							'default_from' => "border_all.controls.border_style_all{$suffix}",
							'context'      => "border_styles{$suffix}",
							'hover'        => 'tabs',
							'mobile_options' => true,
						),
					),
				),
				'border_right'  => array(
					'icon'     => 'border-right',
					'controls' => array(
						"border_width_right{$suffix}" => array(
							'label'          => sprintf( '%1$s%2$s', '' !== $settings['label_prefix'] ? sprintf( '%1$s ', $settings['label_prefix'] ) : '', esc_html__( 'Right Border Width', 'et_builder' ) ),
							'description'    => esc_html__( 'Increasing the width of the border will increase its size/thickness.', 'et_builder' ),
							'type'           => 'range',
							'hover'          => 'tabs',
							'allow_empty'    => true,
							'default_from'   => "border_all.controls.border_width_all{$suffix}",
							'default_unit'   => $defaultUnit,
							'allowed_units'  => array( 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw' ),
							'range_settings' => array(
								'min'  => 0,
								'max'  => 50,
								'step' => 1,
							),
							'context' => "border_styles{$suffix}",
							'mobile_options' => true,
						),
						"border_color_right{$suffix}" => array(
							'label'        => sprintf( '%1$s%2$s', '' !== $settings['label_prefix'] ? sprintf( '%1$s ', $settings['label_prefix'] ) : '', esc_html__( 'Right Border Color', 'et_builder' ) ),
							'description'  => esc_html__( 'Pick a color to be used for the border.', 'et_builder' ),
							'type'         => $settings['color_type'],
							'hover'        => 'tabs',
							'default_from' => "border_all.controls.border_color_all{$suffix}",
							'context'      => "border_styles{$suffix}",
							'mobile_options' => true,
						),
						"border_style_right{$suffix}" => array(
							'label'        => sprintf( '%1$s%2$s', '' !== $settings['label_prefix'] ? sprintf( '%1$s ', $settings['label_prefix'] ) : '', esc_html__( 'Right Border Style', 'et_builder' ) ),
							'description'  => esc_html__( 'Borders support various different styles, each of which will change the shape of the border element.', 'et_builder' ),
							'type'         => 'select',
							'options'      => et_builder_get_border_styles(),
							'default_from' => "border_all.controls.border_style_all{$suffix}",
							'context'      => "border_styles{$suffix}",
							'hover'        => 'tabs',
							'mobile_options' => true,
						),
					),
				),
				'border_bottom' => array(
					'icon'     => 'border-bottom',
					'controls' => array(
						"border_width_bottom{$suffix}" => array(
							'label'          => sprintf( '%1$s%2$s', '' !== $settings['label_prefix'] ? sprintf( '%1$s ', $settings['label_prefix'] ) : '', esc_html__( 'Bottom Border Width', 'et_builder' ) ),
							'description'    => esc_html__( 'Increasing the width of the border will increase its size/thickness.', 'et_builder' ),
							'type'           => 'range',
							'hover'          => 'tabs',
							'allow_empty'    => true,
							'default_from'   => "border_all.controls.border_width_all{$suffix}",
							'default_unit'   => $defaultUnit,
							'allowed_units'  => array( 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw' ),
							'range_settings' => array(
								'min'  => 0,
								'max'  => 50,
								'step' => 1,
							),
							'context' => "border_styles{$suffix}",
							'mobile_options' => true,
						),
						"border_color_bottom{$suffix}" => array(
							'label'        => sprintf( '%1$s%2$s', '' !== $settings['label_prefix'] ? sprintf( '%1$s ', $settings['label_prefix'] ) : '', esc_html__( 'Bottom Border Color', 'et_builder' ) ),
							'description'  => esc_html__( 'Pick a color to be used for the border.', 'et_builder' ),
							'type'         => $settings['color_type'],
							'hover'        => 'tabs',
							'default_from' => "border_all.controls.border_color_all{$suffix}",
							'context'      => "border_styles{$suffix}",
							'mobile_options' => true,
						),
						"border_style_bottom{$suffix}" => array(
							'label'        => sprintf( '%1$s%2$s', '' !== $settings['label_prefix'] ? sprintf( '%1$s ', $settings['label_prefix'] ) : '', esc_html__( 'Bottom Border Style', 'et_builder' ) ),
							'description'  => esc_html__( 'Borders support various different styles, each of which will change the shape of the border element.', 'et_builder' ),
							'type'         => 'select',
							'options'      => et_builder_get_border_styles(),
							'default_from' => "border_all.controls.border_style_all{$suffix}",
							'context'      => "border_styles{$suffix}",
							'hover'        => 'tabs',
							'mobile_options' => true,
						),
					),
				),
				'border_left'   => array(
					'icon'     => 'border-left',
					'controls' => array(
						"border_width_left{$suffix}" => array(
							'label'          => sprintf( '%1$s%2$s', '' !== $settings['label_prefix'] ? sprintf( '%1$s ', $settings['label_prefix'] ) : '', esc_html__( 'Left Border Width', 'et_builder' ) ),
							'description'    => esc_html__( 'Increasing the width of the border will increase its size/thickness.', 'et_builder' ),
							'type'           => 'range',
							'hover'          => 'tabs',
							'allow_empty'    => true,
							'default_from'   => "border_all.controls.border_width_all{$suffix}",
							'default_unit'   => $defaultUnit,
							'allowed_units'  => array( 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw' ),
							'range_settings' => array(
								'min'  => 0,
								'max'  => 50,
								'step' => 1,
							),
							'context' => "border_styles{$suffix}",
							'mobile_options' => true,
						),
						"border_color_left{$suffix}" => array(
							'label'        => sprintf( '%1$s%2$s', '' !== $settings['label_prefix'] ? sprintf( '%1$s ', $settings['label_prefix'] ) : '', esc_html__( 'Left Border Color', 'et_builder' ) ),
							'description'  => esc_html__( 'Pick a color to be used for the border.', 'et_builder' ),
							'type'         => $settings['color_type'],
							'hover'        => 'tabs',
							'default_from' => "border_all.controls.border_color_all{$suffix}",
							'context'      => "border_styles{$suffix}",
							'mobile_options' => true,
						),
						"border_style_left{$suffix}" => array(
							'label'        => sprintf( '%1$s%2$s', '' !== $settings['label_prefix'] ? sprintf( '%1$s ', $settings['label_prefix'] ) : '', esc_html__( 'Left Border Style', 'et_builder' ) ),
							'description'  => esc_html__( 'Borders support various different styles, each of which will change the shape of the border element.', 'et_builder' ),
							'type'         => 'select',
							'options'      => et_builder_get_border_styles(),
							'default_from' => "border_all.controls.border_style_all{$suffix}",
							'context'      => "border_styles{$suffix}",
							'hover'        => 'tabs',
							'mobile_options' => true,
						),
					),
				),
			),
		);

		// Override default_from. In some cases, we need to set different default from the parent
		// modules. For example, in Pricing Tables -> Pricing Area borders, we only want to set
		// default value for border bottom width, but keep the rest to inherit from border all.
		if ( ! empty( $settings['defaults']['composite'] ) ) {
			$composites     = $additional_options["border_styles{$suffix}"]['composite_structure'];
			$new_composites = array();
			foreach ( $settings['defaults']['composite'] as $border_position => $default_controls ) {
				// Make sure the border position property exists on additional_options.
				if ( ! isset( $composites[ $border_position ] ) ) {
					continue;
				}

				// Make sure it has controls.
				if ( ! isset( $composites[ $border_position ]['controls'] ) ) {
					continue;
				}

				// Make sure target controls are not empty.
				if ( ! empty( $default_controls ) ) {
					foreach ( $default_controls as $control_key => $control_default ) {
						// Make sure the target control exists on border_styles.
						$control_suffix = $control_key . $suffix;
						if ( isset( $composites[ $border_position ]['controls'][ $control_suffix ] ) ) {
							// Unset default_from and set default attribute.
							unset( $composites[ $border_position ]['controls'][ $control_suffix ]['default_from'] );
							$composites[ $border_position ]['controls'][ $control_suffix ]['default'] = $control_default;
						}
					}
				}
			}

			// Set composites structures back to additional options border styles.
			$additional_options["border_styles{$suffix}"]['composite_structure'] = $composites;
		}

		//Add options dependency
		if ( ! is_null( $settings['depends_on'] ) ) {
			foreach ( $additional_options as &$option ) {
				$option['depends_on']      = $settings['depends_on'];
				$option['depends_show_if'] = $settings['depends_show_if'];
			}
		}

		return $additional_options;
	}

	/**
	 * Get border radii CSS styles.
	 *
	 * @since 3.23 Add responsive setting support.
	 *
	 * @param  array   $atts            All module attributes.
	 * @param  array   $advanced_fields All module advanced fields definition.
	 * @param  string  $suffix          Border options group or toggle name.
	 * @param  boolean $overflow        Overflow status.
	 * @param  boolean $is_hover        Hover options status.
	 * @param  string  $device          Current active device.
	 * @return string                   Generated border radii styles.
	 */
	public function get_radii_style( array $atts, array $advanced_fields, $suffix = '', $overflow = true, $is_hover = false, $device = 'desktop' ) {
		$style = '';

		$important = '';

		if ( isset( $advanced_fields['border']['css']['important'] ) ) {
			if ( 'plugin_only' === $advanced_fields['border']['css']['important'] ) {
				$important = et_builder_has_limitation( 'force_use_global_important' ) ? '!important' : '';
			} else {
				$important = '!important';
			}
		}

		// Border Radius CSS
		$is_desktop   = 'desktop' === $device;
		$value_suffix = true === $is_hover ? et_pb_hover_options()->get_suffix() : '';
		$value_suffix = ! $is_hover && ! $is_desktop ? "_{$device}" : $value_suffix;
		$settings     = self::$_->array_get( $advanced_fields, "border{$suffix}.border_radii{$suffix}", array() );
		$radii        = isset( $atts["border_radii{$suffix}{$value_suffix}"] ) ? $atts["border_radii{$suffix}{$value_suffix}"] : false;

		// Bail early if current device value doesn't exist.
		if ( false === $radii || empty( $radii ) ) {
			return '';
		}

		// Bail early if current device is tablet/phone and responsive is disabled.
		if ( ! $is_desktop && ! et_pb_responsive_options()->is_responsive_enabled( $atts, "border_radii{$suffix}" ) ) {
			return '';
		}

		// Make sure current radii value is different with default value. Default of desktop is
		// default. Default of tablet is desktop and default of phone is tablet.
		if ( isset( $settings['default'] ) && ! $is_desktop ) {
			// Get previous device value.
			$previous_suffix = 'phone' === $device ? '_tablet' : '';
			$radii_previous  = isset( $atts["border_radii{$suffix}{$previous_suffix}"] ) ? $atts["border_radii{$suffix}{$previous_suffix}"] : false;
			if ( $radii_previous ) {
				$settings['default'] = $radii_previous;
			}
		}

		if ( isset( $settings['default'] ) && ( $settings['default'] !== $radii ) ) {
			$radii = explode( '|', $radii );
			if ( count( $radii ) === 5 ) {
				$top_left_radius     = empty( $radii[1] ) ? '0' : esc_html( $radii[1] );
				$top_right_radius    = empty( $radii[2] ) ? '0' : esc_html( $radii[2] );
				$bottom_right_radius = empty( $radii[3] ) ? '0' : esc_html( $radii[3] );
				$bottom_left_radius  = empty( $radii[4] ) ? '0' : esc_html( $radii[4] );

				$important = et_core_intentionally_unescaped( $important, 'fixed_string' );
				$style = "border-radius: {$top_left_radius} {$top_right_radius} {$bottom_right_radius} {$bottom_left_radius}{$important};";
				if ( true === $overflow ) {
					$style .= "overflow: hidden{$important};";
				}
			}
		}

		return $style;
	}

	/**
	 * Get border styles CSS styles.
	 *
	 * @since 3.23 Add responsive setting support.
	 *
	 * @param  array   $attrs           All module attributes.
	 * @param  array   $advanced_fields All module advanced fields definition.
	 * @param  string  $suffix          Border options group or toggle name.
	 * @param  boolean $is_hover        Hover options status.
	 * @param  string  $device          Current active device.
	 * @return string                   Generated border styles.
	 */
	public function get_borders_style( array $attrs, array $advanced_fields, $suffix = '', $is_hover = false, $device = 'desktop' ) {
		$style     = '';
		$important = '';
		$hover = et_pb_hover_options();
		$is_desktop    = 'desktop' === $device;
		$device_suffix = ! $is_desktop ? "_{$device}" : '';

		self::$_is_default = array();

		if ( isset( $advanced_fields['border']['css']['important'] ) ) {
			if ( 'plugin_only' === $advanced_fields['border']['css']['important'] ) {
				$important = et_builder_has_limitation( 'force_use_global_important' ) ? '!important' : '';
			} else {
				$important = '!important';
			}
		}

		// Border Style CSS
		$settings = self::$_->array_get( $advanced_fields, "border{$suffix}.border_styles{$suffix}", array() );

		if ( ! isset( $settings['composite_structure'] ) || ! is_array( $settings['composite_structure'] ) ) {
			return $style;
		}

		$styles        = array();
		$properties    = array( 'width', 'style', 'color' );
		$border_edges  = array( 'top', 'right', 'bottom', 'left' );

		// Individual edge tabs get their default values from the all edges tab. If a value in
		// the all edges tab has been changed from the default, that value will be used as the
		// default for the individual edge tabs, otherwise the all edges default value is used.
		$value_suffix = true === $is_hover ? et_pb_hover_options()->get_suffix() : '';

		foreach ( $border_edges as $edge ) {
			$edge = "{$edge}";

			foreach ( $properties as $property ) {
				// Set key to get all edges and edge value based on current active device.
				$all_edges_key        = "border_{$property}_all{$suffix}";
				$all_edges_key_device = "border_{$property}_all{$suffix}{$device_suffix}";
				$edge_key             = "border_{$property}_{$edge}{$suffix}";
				$edge_key_device      = "border_{$property}_{$edge}{$suffix}{$device_suffix}";
				
				$is_all_edges_responsive = et_pb_responsive_options()->is_responsive_enabled( $attrs, $all_edges_key );
				$is_edge_responsive      = et_pb_responsive_options()->is_responsive_enabled( $attrs, $edge_key );
				$all_edges_desktop_value = et_pb_responsive_options()->get_any_value( $attrs, $all_edges_key );
				$edge_desktop_value      = et_pb_responsive_options()->get_any_value( $attrs, $edge_key );

				// Don't output styles for default values unless the default value is actually
				// a custom value from the all edges tab.
				$value = false;
				if ( $is_hover ) {
					$default_hover_value = $hover->is_enabled( $edge_key, $attrs ) ? $edge_desktop_value : false;
					$value = $hover->get_value( $edge_key, $attrs, $default_hover_value );
				} else if ( ! $is_desktop ) {
					$value = $is_edge_responsive ? et_pb_responsive_options()->get_any_value( $attrs, $edge_key_device, '', true ) : et_pb_responsive_options()->get_any_value( $attrs, $edge_key );
				} else if ( $is_desktop ) {
					$value = $edge_desktop_value;
				}

				if ( ! $value ) {
					// If specific edge value doesn't exist, get from all active device.
					$value = false;
					if ( $is_hover ) {
						$default_hover_value = $hover->is_enabled( $all_edges_key, $attrs ) ? $all_edges_desktop_value : false;
						$value = $hover->get_value( $all_edges_key, $attrs, $default_hover_value );
					} else if ( $is_desktop || ( ! $is_desktop && $is_all_edges_responsive ) ) {
						$value = et_pb_responsive_options()->get_any_value( $attrs, $all_edges_key_device );
					}
	
					if ( ! $value ) {
						self::$_is_default[] = "{$edge_key}{$value_suffix}";
						self::$_is_default[] = "{$all_edges_key}{$value_suffix}";

						continue;
					}
				}

				// Don't output wrongly migrated border-color value
				if ( 'color' === $property && 'off' === $value ) {
					continue;
				}

				if ( ! isset( $styles[ $property ] ) ) {
					$styles[ $property ] = array();
				}

				// Sanitize value
				if ( 'width' === $property ) {
					$value = et_builder_process_range_value( $value );
				}

				$styles[ $property ][ $edge ] = esc_html( $value );
			}
		}

		foreach ( $styles as $prop => $edges ) {
			$all_values = array_values( $edges );
			$all_edges  = 4 === count( $all_values );

			if ( $all_edges && 1 === count( array_unique( $all_values ) ) ) {
				// All edges have the same value, so let's combine them into a single prop.
				$style .= "border-{$prop}:{$all_values[0]}{$important};";

			} else if ( $all_edges && $edges['top'] === $edges['bottom'] && $edges['left'] === $edges['right'] ) {
				// Let's combine them into a single prop.
				$style .= "border-{$prop}:{$edges['top']} {$edges['left']}{$important};";

			} else if ( $all_edges ) {
				// You know the drill.
				$style  .= "border-{$prop}:{$edges['top']} {$edges['right']} {$edges['bottom']} {$edges['left']}{$important};";

			} else {
				// We're not going to mess with the other shorthand variants, so separate styles it is!
				foreach ( $edges as $edge => $value ) {
					$style .= "border-{$edge}-{$prop}:{$value}{$important};";
				}
			}
		}

		return $style;
	}

	/**
	 * Whether or not the provided module needs the border reset CSS class.
	 *
	 * @param string $module_slug
	 * @param array  $attrs
	 *
	 * @return bool
	 */
	public function needs_border_reset_class( $module_slug, $attrs ) {
		if ( 'et_pb_blog' === $module_slug && 'off' === self::$_->array_get( $attrs, 'fullwidth' ) ) {
			return false;
		}

		if ( in_array( $module_slug, self::$_no_border_reset ) ) {
			return false;
		}

		foreach ( $attrs as $attr => $value ) {
			if ( ! $value || 0 === strpos( $attr, 'border_radii' ) ) {
				continue;
			}

			// don't use 2 === substr_count( $attr, '_' ) because in some cases border option may have 3 underscores ( in case we have several border options in module ).
			// It's enough to make sure we have more than 1 underscores.
			$is_new_border_attr = 0 === strpos( $attr, 'border_' ) && substr_count( $attr, '_' ) > 1;

			if ( $is_new_border_attr && ! in_array( $attr, self::$_is_default ) ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Add border reset class using filter. Obsolete method and only applied to old 3rd party modules without `modules_classname()` method
	 *
	 * @param string $output
	 * @param string $module_slug
	 *
	 * @return string
	 */
	public function add_border_reset_class( $output, $module_slug ) {
		if ( in_array( $module_slug,  ET_Builder_Element::$uses_module_classname ) ) {
			return $output;
		}

		remove_filter( "{$module_slug}_shortcode_output", array( $this, 'add_border_reset_class' ), 10 );

		return preg_replace( "/class=\"(.*?{$module_slug}_\d+.*?)\"/", 'class="$1 et_pb_with_border"', $output, 1 );
	}
}

return new ET_Builder_Module_Field_Border();
