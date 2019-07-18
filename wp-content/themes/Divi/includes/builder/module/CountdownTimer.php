<?php

class ET_Builder_Module_Countdown_Timer extends ET_Builder_Module {
	function init() {
		$this->name       = esc_html__( 'Countdown Timer', 'et_builder' );
		$this->plural     = esc_html__( 'Countdown Timers', 'et_builder' );
		$this->slug       = 'et_pb_countdown_timer';
		$this->vb_support = 'on';

		$this->main_css_element = '%%order_class%%.et_pb_countdown_timer';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Text', 'et_builder' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'text' => esc_html__( 'Text', 'et_builder' ),
				),
			),
		);

		$this->advanced_fields = array(
			'fonts'                 => array(
				'header' => array(
					'label'    => esc_html__( 'Title', 'et_builder' ),
					'css'      => array(
						'main'      => "{$this->main_css_element} h4, {$this->main_css_element} h1.title, {$this->main_css_element} h2.title, {$this->main_css_element} h3.title, {$this->main_css_element} h5.title, {$this->main_css_element} h6.title",
						'important' => array( 'size', 'plugin_all' ),
					),
					'header_level' => array(
						'default' => 'h4',
					),
				),
				'numbers' => array(
					'label'    => esc_html__( 'Numbers', 'et_builder' ),
					'css'      => array(
						'main'        => ".et_pb_column {$this->main_css_element} .section p.value, .et_pb_column {$this->main_css_element} .section.sep p",
						'important'   => 'all',
					),
					'line_height' => array(
						'range_settings' => array(
							'min'  => '1',
							'max'  => '100',
							'step' => '1',
						),
					),
				),
				'separator' => array(
					'label'           => esc_html__( 'Separator', 'et_builder' ),
					'css'             => array(
						'main'      => ".et_pb_column {$this->main_css_element} .et_pb_countdown_timer_container .section.sep p",
						'important' => 'all',
					),
					'line_height' => array(
						'range_settings' => array(
							'min'  => '1',
							'max'  => '100',
							'step' => '1',
						),
					),
					'hide_text_align' => true,
				),
				'label' => array(
					'label'    => esc_html__( 'Label', 'et_builder' ),
					'css'      => array(
						'main'      => ".et_pb_column {$this->main_css_element} .section p.label",
						'important' => array(
							'size',
							'line-height',
						),
					),
					'line_height' => array(
						'range_settings' => array(
							'min'  => '1',
							'max'  => '100',
							'step' => '1',
						),
					),
				),
			),
			'background'            => array(
				'has_background_color_toggle' => true,
				'use_background_color' => true,
				'options' => array(
					'background_color' => array(
						'depends_show_if'  => 'on',
						'default'          => et_builder_accent_color(),
					),
					'use_background_color' => array(
						'default'          => 'on',
					),
				),
			),
			'margin_padding' => array(
				'css' => array(
					'important' => 'all',
				),
			),
			'text'                  => array(
				'use_background_layout' => true,
				'css' => array(
					'main' => '%%order_class%% .et_pb_countdown_timer_container, %%order_class%% .title',
					'text_orientation' => '%%order_class%% .et_pb_countdown_timer_container, %%order_class%% .title',
				),
				'options' => array(
					'text_orientation'  => array(
						'default' => 'center',
					),
					'background_layout' => array(
						'default' => 'dark',
						'hover' => 'tabs',
					),
				),
			),
			'button'                => false,
		);

		$this->custom_css_fields = array(
			'container' => array(
				'label'    => esc_html__( 'Container', 'et_builder' ),
				'selector' => '.et_pb_countdown_timer_container',
			),
			'title' => array(
				'label'    => esc_html__( 'Title', 'et_builder' ),
				'selector' => '.title',
			),
			'timer_section' => array(
				'label'    => esc_html__( 'Timer Section', 'et_builder' ),
				'selector' => '.section',
			),
		);

		$this->help_videos = array(
			array(
				'id'   => esc_html( 'irIXKlOw6JA' ),
				'name' => esc_html__( 'An introduction to the Countdown Timer module', 'et_builder' ),
			),
		);
	}

	function get_fields() {
		$fields = array(
			'title' => array(
				'label'           => esc_html__( 'Title', 'et_builder' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'This is the title displayed for the countdown timer.', 'et_builder' ),
				'toggle_slug'     => 'main_content',
				'dynamic_content' => 'text',
			),
			'date_time' => array(
				'label'           => esc_html__( 'Date', 'et_builder' ),
				'type'            => 'date_picker',
				'option_category' => 'basic_option',
				'description'     => et_get_safe_localization( sprintf( __( 'This is the date the countdown timer is counting down to. Your countdown timer is based on your timezone settings in your <a href="%1$s" target="_blank" title="WordPress General Settings">WordPress General Settings</a>', 'et_builder' ), esc_url( admin_url( 'options-general.php' ) ) ) ),
				'toggle_slug'     => 'main_content',
			),
		);

		return $fields;
	}

	function render( $attrs, $content = null, $render_slug ) {
		$title                           = $this->_esc_attr( 'title' );
		$date_time                       = $this->props['date_time'];
		$use_background_color            = $this->props['use_background_color'];
		$header_level                    = $this->props['header_level'];
		$end_date                        = gmdate( 'M d, Y H:i:s', strtotime( $date_time ) );
		$gmt_offset                      = get_option( 'gmt_offset' );
		$gmt_divider                     = '-' === substr( $gmt_offset, 0, 1 ) ? '-' : '+';
		$gmt_offset_hour                 = str_pad( abs( intval( $gmt_offset ) ), 2, "0", STR_PAD_LEFT );
		$gmt_offset_minute               = str_pad( ( ( abs( $gmt_offset ) * 100 ) % 100 ) * ( 60 / 100 ), 2, "0", STR_PAD_LEFT );
		$gmt                             = "GMT{$gmt_divider}{$gmt_offset_hour}{$gmt_offset_minute}";

		$background_layout               = $this->props['background_layout'];
		$background_layout_hover         = et_pb_hover_options()->get_value( 'background_layout', $this->props, 'light' );
		$background_layout_hover_enabled = et_pb_hover_options()->is_enabled( 'background_layout', $this->props );
		$background_layout_values        = et_pb_responsive_options()->get_property_values( $this->props, 'background_layout' );
		$background_layout_tablet        = isset( $background_layout_values['tablet'] ) ? $background_layout_values['tablet'] : '';
		$background_layout_phone         = isset( $background_layout_values['phone'] ) ? $background_layout_values['phone'] : '';

		if ( '' !== $title ) {
			$title = sprintf(
				'<%2$s class="title">%s</%2$s>',
				et_core_esc_previously( $title ),
				et_pb_process_header_level( $header_level, 'h4' )
			);
		}

		$video_background = $this->video_background();
		$parallax_image_background = $this->get_parallax_image_background();

		$data_background_layout       = '';
		$data_background_layout_hover = '';
		if ( $background_layout_hover_enabled ) {
			$data_background_layout = sprintf(
				' data-background-layout="%1$s"',
				esc_attr( $background_layout )
			);
			$data_background_layout_hover = sprintf(
				' data-background-layout-hover="%1$s"',
				esc_attr( $background_layout_hover )
			);
		}

		// Module classnames
		$this->add_classname( array(
			"et_pb_bg_layout_{$background_layout}",
		) );

		if ( ! empty( $background_layout_tablet ) ) {
			$this->add_classname( "et_pb_bg_layout_{$background_layout_tablet}_tablet" );
		}

		if ( ! empty( $background_layout_phone ) ) {
			$this->add_classname( "et_pb_bg_layout_{$background_layout_phone}_phone" );
		}

		if ( 'on' !== $use_background_color ) {
			$this->add_classname( 'et_pb_no_bg' );
		}

		$output = sprintf(
			'<div%1$s class="%2$s"%3$s data-end-timestamp="%4$s"%16$s%17$s>
				%15$s
				%14$s
				<div class="et_pb_countdown_timer_container clearfix">
					%5$s
					<div class="days section values" data-short="%13$s" data-full="%6$s">
						<p class="value"></p>
						<p class="label">%6$s</p>
					</div><div class="sep section">
						<p>:</p>
					</div><div class="hours section values" data-short="%8$s" data-full="%7$s">
						<p class="value"></p>
						<p class="label">%7$s</p>
					</div><div class="sep section">
						<p>:</p>
					</div><div class="minutes section values" data-short="%10$s" data-full="%9$s">
						<p class="value"></p>
						<p class="label">%9$s</p>
					</div><div class="sep section">
						<p>:</p>
					</div><div class="seconds section values" data-short="%12$s" data-full="%11$s">
						<p class="value"></p>
						<p class="label">%11$s</p>
					</div>
				</div>
			</div>',
			$this->module_id(),
			$this->module_classname( $render_slug ),
			'',
			esc_attr( strtotime( "{$end_date} {$gmt}" ) ),
			et_core_esc_previously( $title ), // #5
			esc_html__( 'Day(s)', 'et_builder' ),
			esc_html__( 'Hour(s)', 'et_builder' ),
			esc_attr__( 'Hrs', 'et_builder' ),
			esc_html__( 'Minute(s)', 'et_builder' ),
			esc_attr__( 'Min', 'et_builder' ), // #10
			esc_html__( 'Second(s)', 'et_builder' ),
			esc_attr__( 'Sec', 'et_builder' ),
			esc_attr__( 'Day', 'et_builder' ),
			$video_background,
			$parallax_image_background, // #15
			et_core_esc_previously( $data_background_layout ),
			et_core_esc_previously( $data_background_layout_hover )
		);

		return $output;
	}
}

new ET_Builder_Module_Countdown_Timer;
