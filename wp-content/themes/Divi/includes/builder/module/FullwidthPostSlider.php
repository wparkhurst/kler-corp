<?php

class ET_Builder_Module_Fullwidth_Post_Slider extends ET_Builder_Module_Type_PostBased {
	function init() {
		$this->name       = esc_html__( 'Fullwidth Post Slider', 'et_builder' );
		$this->plural     = esc_html__( 'Fullwidth Post Sliders', 'et_builder' );
		$this->slug       = 'et_pb_fullwidth_post_slider';
		$this->vb_support = 'on';
		$this->fullwidth  = true;

		// need to use global settings from the fullwidth slider module
		$this->global_settings_slug = 'et_pb_fullwidth_slider';

		$this->main_css_element = '%%order_class%%.et_pb_slider';

		$this->settings_modal_toggles = array(
			'general'  => array(
				'toggles' => array(
					'main_content'   => esc_html__( 'Content', 'et_builder' ),
					'elements'       => esc_html__( 'Elements', 'et_builder' ),
					'featured_image' => esc_html__( 'Featured Image', 'et_builder' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'layout'     => esc_html__( 'Layout', 'et_builder' ),
					'overlay'    => esc_html__( 'Overlay', 'et_builder' ),
					'navigation' => esc_html__( 'Navigation', 'et_builder' ),
					'image'      => esc_html__( 'Image', 'et_builder' ),
					'text'       => array(
						'title'    => esc_html__( 'Text', 'et_builder' ),
						'priority' => 49,
					),
				),
			),
			'custom_css' => array(
				'toggles' => array(
					'animation' => array(
						'title'    => esc_html__( 'Animation', 'et_builder' ),
						'priority' => 90,
					),
				),
			),
		);

		$this->advanced_fields = array(
			'fonts'                 => array(
				'header' => array(
					'label'    => esc_html__( 'Title', 'et_builder' ),
					'css'      => array(
						'main' => "{$this->main_css_element} .et_pb_slide_description .et_pb_slide_title, {$this->main_css_element} .et_pb_slide_description .et_pb_slide_title a",
						'important' => array( 'size', 'font-size' ),
					),
					'header_level' => array(
						'default' => 'h2',
					),
				),
				'body'   => array(
					'label'          => esc_html__( 'Body', 'et_builder' ),
					'css'            => array(
						'line_height' => "{$this->main_css_element}",
						'main'        => "{$this->main_css_element} .et_pb_slide_content, {$this->main_css_element} .et_pb_slide_content div",
						'important'   => 'all',
					),
					'block_elements' => array(
						'tabbed_subtoggles' => true,
						'css'               => array(
							'link'  => "{$this->main_css_element} .et_pb_slide_content a",
							'ul'    => "{$this->main_css_element} .et_pb_slide_content ul",
							'ol'    => "{$this->main_css_element} .et_pb_slide_content ol",
							'quote' => "{$this->main_css_element} .et_pb_slide_content blockquote",
						),
					),
				),
				'meta'   => array(
					'label'    => esc_html__( 'Meta', 'et_builder' ),
					'css'      => array(
						'main' => "{$this->main_css_element} .et_pb_slide_content .post-meta, {$this->main_css_element} .et_pb_slide_content .post-meta a",
						'limited_main' => "{$this->main_css_element} .et_pb_slide_content .post-meta, {$this->main_css_element} .et_pb_slide_content .post-meta a, {$this->main_css_element} .et_pb_slide_content .post-meta span",
						'important' => 'all',
					),
					'line_height' => array(
						'default' => '1em',
					),
					'font_size' => array(
						'default' => '16px',
					),
					'letter_spacing' => array(
						'default' => '0',
					),
				),
			),
			'button'                => array(
				'button' => array(
					'label' => esc_html__( 'Button', 'et_builder' ),
					'css' => array(
						'limited_main' => "{$this->main_css_element} .et_pb_more_button.et_pb_button",
						'alignment' => "{$this->main_css_element} .et_pb_button_wrapper",
					),
					'use_alignment' => true,
					'box_shadow'    => array(
						'css' => array(
							'main' => '%%order_class%% .et_pb_button',
						),
					),
					'margin_padding' => array(
						'css' => array(
							'important' => 'all',
						),
					),
				),
			),
			'box_shadow'            => array(
				'default' => array(
					'css' => array(
						'overlay' => 'inset',
					),
				),
				'image'   => array(
					'label'             => esc_html__( 'Image Box Shadow', 'et_builder' ),
					'option_category'   => 'layout',
					'tab_slug'          => 'advanced',
					'toggle_slug'       => 'image',
					'css'               => array(
						'main' => '%%order_class%% .et_pb_slide_image',
					),
					'default_on_fronts' => array(
						'color'    => '',
						'position' => '',
					),
				),
			),
			'background'            => array(
				'css'     => array(
					'main' => '%%order_class%%, %%order_class%%.et_pb_bg_layout_dark, %%order_class%%.et_pb_bg_layout_light',
				),
				'options' => array(
					'background_color' => array(
						'default'      => et_builder_accent_color(),
					),
					'background_position' => array(
						'default'         => 'center',
					),
					'parallax_method' => array(
						'default'         => 'off',
					),
				),
			),
			'margin_padding' => array(
				'css' => array(
					'main' => '%%order_class%%',
					'padding' => '%%order_class%% .et_pb_slide_description, .et_pb_slider_fullwidth_off%%order_class%% .et_pb_slide_description',
					'important' => array( 'custom_margin' ), // needed to overwrite last module margin-bottom styling
				),
			),
			'text'                  => array(
				'use_background_layout' => true,
				'css'   => array(
					'main'             => implode( ', ', array(
						'%%order_class%% .et_pb_slide .et_pb_slide_description .et_pb_slide_title',
						'%%order_class%% .et_pb_slide .et_pb_slide_description .et_pb_slide_title a',
						'%%order_class%% .et_pb_slide .et_pb_slide_description .et_pb_slide_content',
						'%%order_class%% .et_pb_slide .et_pb_slide_description .et_pb_slide_content .post-meta',
						'%%order_class%% .et_pb_slide .et_pb_slide_description .et_pb_slide_content .post-meta a',
						'%%order_class%% .et_pb_slide .et_pb_slide_description .et_pb_slide_content .et_pb_button',
					) ),
					'text_orientation' => '%%order_class%% .et_pb_slide .et_pb_slide_description',
					'text_shadow'      => '%%order_class%% .et_pb_slide .et_pb_slide_description',
				),
				'options' => array(
					'text_orientation'  => array(
						'default'         => 'center',
					),
					'background_layout' => array(
						'default' => 'dark',
						'hover' => 'tabs',
					),
				),
			),
			'borders'               => array(
				'default' => array(
					'css' => array(
						'main' => array(
							'border_radii'  => "%%order_class%%, %%order_class%% .et_pb_slide, %%order_class%% .et_pb_slide_overlay_container",
						),
					),
				),
				'image'   => array(
					'css'             => array(
						'main' => array(
							'border_radii'  => '%%order_class%% .et_pb_slide .et_pb_slide_image',
							'border_styles' => '%%order_class%% .et_pb_slide .et_pb_slide_image',
						)
					),
					'label_prefix'    => esc_html__( 'Image', 'et_builder' ),
					'tab_slug'        => 'advanced',
					'toggle_slug'     => 'image',
					'depends_show_if' => 'off',
					'defaults'        => array(
						'border_radii'  => 'on||||',
						'border_styles' => array(
							'width' => '0px',
							'color' => '#333333',
							'style' => 'solid',
						),
					),
				),
			),
			'filters'               => array(
				'child_filters_target' => array(
					'tab_slug'    => 'advanced',
					'toggle_slug' => 'image',
				),
			),
			'image'                 => array(
				'css' => array(
					'main' => '%%order_class%% .et_pb_slide_image',
				),
			),
			'height' => array(
				'css' => array(
					'main' => '%%order_class%%, %%order_class%% .et_pb_slide',
				)
			),
		);

		$this->custom_css_fields = array(
			'slide_description' => array(
				'label'    => esc_html__( 'Slide Description', 'et_builder' ),
				'selector' => '.et_pb_slide_description',
			),
			'slide_title' => array(
				'label'    => esc_html__( 'Slide Title', 'et_builder' ),
				'selector' => '.et_pb_slide_description .et_pb_slide_title',
			),
			'slide_meta' => array(
				'label'    => esc_html__( 'Slide Meta', 'et_builder' ),
				'selector' => '.et_pb_slide_description .post-meta',
			),
			'slide_button' => array(
				'label'    => esc_html__( 'Slide Button', 'et_builder' ),
				'selector' => '.et_pb_slider a.et_pb_more_button.et_pb_button',
				'no_space_before_selector' => true,
			),
			'slide_controllers' => array(
				'label'    => esc_html__( 'Slide Controllers', 'et_builder' ),
				'selector' => '.et-pb-controllers',
			),
			'slide_active_controller' => array(
				'label'    => esc_html__( 'Slide Active Controller', 'et_builder' ),
				'selector' => '.et-pb-controllers .et-pb-active-control',
			),
			'slide_image' => array(
				'label'    => esc_html__( 'Slide Image', 'et_builder' ),
				'selector' => '.et_pb_slide_image',
			),
			'slide_arrows' => array(
				'label'    => esc_html__( 'Slide Arrows', 'et_builder' ),
				'selector' => '.et-pb-slider-arrows a',
			),
		);

		$this->help_videos = array(
			array(
				'id'   => esc_html( 'rDaVUZjDaGQ' ),
				'name' => esc_html__( 'An introduction to the Fullwidth Post Slider module', 'et_builder' ),
			),
		);
	}

	static function get_blog_posts( $args = array(), $conditional_tags = array(), $current_page = array(), $is_ajax_request = true ) {
		global $wp_query, $paged;

		$defaults = array(
			'posts_number'       => '',
			'include_categories' => '',
			'orderby'            => '',
			'content_source'     => '',
			'use_manual_excerpt' => '',
			'excerpt_length'     => '',
			'offset_number'      => '',
		);

		$args = wp_parse_args( $args, $defaults );

		$query_args = array(
			'posts_per_page' => (int) $args['posts_number'],
			'post_status'    => 'publish',
		);

		if ( '' !== $args['include_categories'] ) {
			$query_args['cat'] = $args['include_categories'];
		}

		if ( 'date_desc' !== $args['orderby'] ) {
			switch( $args['orderby'] ) {
				case 'date_asc' :
					$query_args['orderby'] = 'date';
					$query_args['order'] = 'ASC';
					break;
				case 'title_asc' :
					$query_args['orderby'] = 'title';
					$query_args['order'] = 'ASC';
					break;
				case 'title_desc' :
					$query_args['orderby'] = 'title';
					$query_args['order'] = 'DESC';
					break;
				case 'rand' :
					$query_args['orderby'] = 'rand';
					break;
			}
		}

		if ( '' !== $args['offset_number'] && ! empty( $args['offset_number'] ) ) {
			/**
			 * Offset + pagination don't play well. Manual offset calculation required
			 * @see: https://codex.wordpress.org/Making_Custom_Queries_using_Offset_and_Pagination
			 */
			if ( $paged > 1 ) {
				$query_args['offset'] = ( ( $paged - 1 ) * intval( $args['posts_number'] ) ) + intval( $args['offset_number'] );
			} else {
				$query_args['offset'] = intval( $args['offset_number'] );
			}
		}

		$query = new WP_Query( $query_args );

		// Keep page's $wp_query global
		$wp_query_page = $wp_query;

		// Turn page's $wp_query into this module's query
		$wp_query = $query; //phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited

		if ( $query->have_posts() ) {
			$post_index = 0;
			while ( $query->have_posts() ) {
				$query->the_post();

				$post_author_id = $query->posts[ $post_index ]->post_author;

				$categories = array();

				$categories_object = get_the_terms( get_the_ID(), 'category' );

				if ( ! empty( $categories_object ) ) {
					foreach ( $categories_object as $category ) {
						$categories[] = array(
							'id' => $category->term_id,
							'label' => $category->name,
							'permalink' => get_term_link( $category ),
						);
					}
				}

				$query->posts[ $post_index ]->post_featured_image = esc_url( wp_get_attachment_url( get_post_thumbnail_id() ) );
				$query->posts[ $post_index ]->has_post_thumbnail  = has_post_thumbnail();
				$query->posts[ $post_index ]->post_permalink      = get_the_permalink();
				$query->posts[ $post_index ]->post_author_url     = get_author_posts_url( $post_author_id );
				$query->posts[ $post_index ]->post_author_name    = get_the_author_meta( 'display_name', $post_author_id );
				$query->posts[ $post_index ]->post_date_readable  = get_the_date();
				$query->posts[ $post_index ]->categories          = $categories;
				$query->posts[ $post_index ]->post_comment_popup  = et_core_maybe_convert_to_utf_8( sprintf( esc_html( _nx( '%s Comment', '%s Comments', get_comments_number(), 'number of comments', 'et_builder' ) ), number_format_i18n( get_comments_number() ) ) );

				$post_content = et_strip_shortcodes( get_the_content(), true );

				global $et_fb_processing_shortcode_object, $et_pb_rendering_column_content;

				$global_processing_original_value = $et_fb_processing_shortcode_object;

				// reset the fb processing flag
				$et_fb_processing_shortcode_object = false;
				// set the flag to indicate that we're processing internal content
				$et_pb_rendering_column_content = true;

				if ( $is_ajax_request ) {
					// reset all the attributes required to properly generate the internal styles
					ET_Builder_Element::clean_internal_modules_styles();
				}

				if ( 'on' === $args['content_source'] ) {
					global $more;

					// page builder doesn't support more tag, so display the_content() in case of post made with page builder
					if ( et_pb_is_pagebuilder_used( get_the_ID() ) ) {

						// do_shortcode for Divi Plugin instead of applying `the_content` filter to avoid conflicts with 3rd party themes
						$builder_post_content = et_is_builder_plugin_active() ? do_shortcode( $post_content ) : apply_filters( 'the_content', $post_content );

						// Overwrite default content, in case the content is protected
						$query->posts[ $post_index ]->post_content = $builder_post_content;
					} else {
						$more = null; // phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited

						// Overwrite default content, in case the content is protected
						$query->posts[ $post_index ]->post_content = et_is_builder_plugin_active() ? do_shortcode( get_the_content('') ) : apply_filters( 'the_content', get_the_content('') );
					}
				} else {
					if ( has_excerpt() && 'off' !== $args['use_manual_excerpt'] ) {
						$query->posts[ $post_index ]->post_content = et_is_builder_plugin_active() ? do_shortcode( et_strip_shortcodes( get_the_excerpt(), true ) ) : apply_filters( 'the_content', et_strip_shortcodes( get_the_excerpt(), true ) );
					} else {
						$query->posts[ $post_index ]->post_content = strip_shortcodes( truncate_post( intval( $args['excerpt_length'] ), false, '', true ) );
					}
				}

				$et_fb_processing_shortcode_object = $global_processing_original_value;

				if ( $is_ajax_request ) {
					// retrieve the styles for the modules inside Blog content
					$internal_style = ET_Builder_Element::get_style( true );

					// reset all the attributes after we retrieved styles
					ET_Builder_Element::clean_internal_modules_styles( false );

					$query->posts[ $post_index ]->internal_styles = $internal_style;
				}

				$et_pb_rendering_column_content = false;

				$post_index++;
			} // end while
			wp_reset_query();
		} else if ( wp_doing_ajax() || et_core_is_fb_enabled() ) {
			// This is for the VB
			$query  = '<div class="et_pb_row et_pb_no_results">';
			$query .= self::get_no_results_template();
			$query .= '</div>';

			$query = array( 'posts' => $query );
		}

		wp_reset_postdata();

		// Reset $wp_query to its origin
		$wp_query = $wp_query_page; // phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited

		return $query;
	}

	function get_fields() {
		$fields = array(
			'posts_number' => array(
				'label'             => esc_html__( 'Post Count', 'et_builder' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Choose how many posts you would like to display in the slider.', 'et_builder' ),
				'computed_affects'   => array(
					'__posts',
				),
				'toggle_slug'       => 'main_content',
			),
			'include_categories' => array(
				'label'            => esc_html__( 'Included Categories', 'et_builder' ),
				'type'             => 'categories',
				'option_category'  => 'basic_option',
				'renderer_options' => array(
					'use_terms' => false,
				),
				'description'      => esc_html__( 'Choose which categories you would like to include in the slider.', 'et_builder' ),
				'toggle_slug'      => 'main_content',
				'computed_affects' => array(
					'__posts',
				),
			),
			'orderby' => array(
				'label'             => esc_html__( 'Order', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'configuration',
				'options'           => array(
					'date_desc'  => esc_html__( 'Date: new to old', 'et_builder' ),
					'date_asc'   => esc_html__( 'Date: old to new', 'et_builder' ),
					'title_asc'  => esc_html__( 'Title: a-z', 'et_builder' ),
					'title_desc' => esc_html__( 'Title: z-a', 'et_builder' ),
					'rand'       => esc_html__( 'Random', 'et_builder' ),
				),
				'default'           => 'date_desc',
				'description'       => esc_html__( 'Here you can adjust the order in which posts are displayed.', 'et_builder' ),
				'computed_affects'   => array(
					'__posts',
				),
				'toggle_slug'    => 'main_content',
			),
			'show_arrows'         => array(
				'label'           => esc_html__( 'Show Arrows', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'default_on_front' => 'on',
				'toggle_slug'     => 'elements',
				'description'     => esc_html__( 'This setting will turn on and off the navigation arrows.', 'et_builder' ),
			),
			'show_pagination' => array(
				'label'             => esc_html__( 'Show Controls', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'default_on_front'  => 'on',
				'toggle_slug'       => 'elements',
				'description'       => esc_html__( 'This setting will turn on and off the circle buttons at the bottom of the slider.', 'et_builder' ),
			),
			'show_more_button' => array(
				'label'             => esc_html__( 'Show Read More Button', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'default_on_front'  => 'on',
				'affects' => array(
					'more_text',
				),
				'toggle_slug'       => 'elements',
				'description'       => esc_html__( 'This setting will turn on and off the read more button.', 'et_builder' ),
			),
			'more_text' => array(
				'label'             => esc_html__( 'Button', 'et_builder' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'default_on_front'  => esc_html__( 'Read More', 'et_builder' ),
				'depends_show_if'   => 'on',
				'toggle_slug'       => 'main_content',
				'dynamic_content'   => 'text',
				'description'       => esc_html__( 'Define the text which will be displayed on "Read More" button. Leave blank for default ( Read More )', 'et_builder' ),
			),
			'content_source' => array(
				'label'             => esc_html__( 'Content Display', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'configuration',
				'options'           => array(
					'off' => esc_html__( 'Show Excerpt', 'et_builder' ),
					'on'  => esc_html__( 'Show Content', 'et_builder' ),
				),
				'default'           => 'off',
				'affects' => array(
					'use_manual_excerpt',
					'excerpt_length',
				),
				'description'       => esc_html__( 'Showing the full content will not truncate your posts in the slider. Showing the excerpt will only display excerpt text.', 'et_builder' ),
				'toggle_slug'       => 'main_content',
				'computed_affects'  => array(
					'__posts',
				),
			),
			'use_manual_excerpt' => array(
				'label'             => esc_html__( 'Use Post Excerpts', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'default'           => 'on',
				'depends_show_if'   => 'off',
				'description'       => esc_html__( 'Disable this option if you want to ignore manually defined excerpts and always generate it automatically.', 'et_builder' ),
				'toggle_slug'       => 'main_content',
				'computed_affects'  => array(
					'__posts',
				),
			),
			'excerpt_length' => array(
				'label'             => esc_html__( 'Excerpt Length', 'et_builder' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'default_on_front'           => '270',
				'depends_show_if'   => 'off',
				'description'       => esc_html__( 'Define the length of automatically generated excerpts. Leave blank for default ( 270 ) ', 'et_builder' ),
				'toggle_slug'       => 'main_content',
				'computed_affects'  => array(
					'__posts',
				),
			),
			'show_meta' => array(
				'label'           => esc_html__( 'Show Post Meta', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'default_on_fron' => 'on',
				'toggle_slug'     => 'elements',
				'description'     => esc_html__( 'This setting will turn on and off the meta section.', 'et_builder' ),
				'default_on_front'=> 'on',
			),
			'show_image' => array(
				'label'             => esc_html__( 'Show Featured Image', 'et_builder' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'on'  => esc_html__( 'yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'default_on_front'  => 'on',
				'affects' => array(
					'image_placement',
				),
				'toggle_slug'       => 'featured_image',
				'description'       => esc_html__( 'This setting will turn on and off the featured image in the slider.', 'et_builder' ),
			),
			'image_placement' => array(
				'label'             => esc_html__( 'Featured Image Placement', 'et_builder' ),
				'type'              => 'select',
				'option_category'   => 'configuration',
				'options'           => array(
					'background' => esc_html__( 'Background', 'et_builder' ),
					'left'       => esc_html__( 'Left', 'et_builder' ),
					'right'      => esc_html__( 'Right', 'et_builder' ),
					'top'        => esc_html__( 'Top', 'et_builder' ),
					'bottom'     => esc_html__( 'Bottom', 'et_builder' ),
				),
				'default_on_front'  => 'background',
				'depends_show_if'   => 'on',
				'toggle_slug'       => 'featured_image',
				'description'       => esc_html__( 'Select how you would like to display the featured image in slides', 'et_builder' ),
			),
			'use_bg_overlay'      => array(
				'label'           => esc_html__( 'Use Background Overlay', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'default_on_front' => 'on',
				'affects'         => array(
					'bg_overlay_color',
				),
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'overlay',
				'description'     => esc_html__( 'When enabled, a custom overlay color will be added above your background image and behind your slider content.', 'et_builder' ),
			),
			'bg_overlay_color' => array(
				'label'             => esc_html__( 'Background Overlay Color', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'depends_show_if'   => 'on',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'overlay',
				'description'       => esc_html__( 'Use the color picker to choose a color for the background overlay.', 'et_builder' ),
				'mobile_options'    => true,
			),
			'use_text_overlay'      => array(
				'label'           => esc_html__( 'Use Text Overlay', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'yes', 'et_builder' ),
				),
				'affects'         => array(
					'text_overlay_color',
					'text_border_radius',
				),
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'overlay',
				'description'     => esc_html__( 'When enabled, a background color is added behind the slider text to make it more readable atop background images.', 'et_builder' ),
			),
			'text_overlay_color' => array(
				'label'             => esc_html__( 'Text Overlay Color', 'et_builder' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'depends_show_if'   => 'on',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'overlay',
				'description'       => esc_html__( 'Use the color picker to choose a color for the text overlay.', 'et_builder' ),
				'mobile_options'    => true,
			),
			'show_content_on_mobile' => array(
				'label'           => esc_html__( 'Show Content On Mobile', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'layout',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'default_on_front' => 'on',
				'tab_slug'        => 'custom_css',
				'toggle_slug'     => 'visibility',
			),
			'show_cta_on_mobile' => array(
				'label'           => esc_html__( 'Show CTA On Mobile', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'layout',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'et_builder' ),
					'off' => esc_html__( 'No', 'et_builder' ),
				),
				'default_on_front' => 'on',
				'tab_slug'        => 'custom_css',
				'toggle_slug'     => 'visibility',
			),
			'show_image_video_mobile' => array(
				'label'           => esc_html__( 'Show Image On Mobile', 'et_builder' ),
				'type'            => 'yes_no_button',
				'option_category' => 'layout',
				'options'         => array(
					'off' => esc_html__( 'No', 'et_builder' ),
					'on'  => esc_html__( 'Yes', 'et_builder' ),
				),
				'default_on_front' => 'off',
				'tab_slug'        => 'custom_css',
				'toggle_slug'     => 'visibility',
			),
			'text_border_radius' => array(
				'label'           => esc_html__( 'Text Overlay Border Radius', 'et_builder' ),
				'description'     => esc_html__( 'Increasing the border radius will increase the roundness of the overlay corners. Setting this value to 0 will result in squared corners.', 'et_builder' ),
				'type'            => 'range',
				'option_category' => 'layout',
				'default'         => '3',
				'allowed_units'   => array( '%', 'em', 'rem', 'px', 'cm', 'mm', 'in', 'pt', 'pc', 'ex', 'vh', 'vw' ),
				'default_unit'    => 'px',
				'default_on_front' => '',
				'range_settings'  => array(
					'min'  => '0',
					'max'  => '100',
					'step' => '1',
				),
				'depends_show_if' => 'on',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'overlay',
				'mobile_options'  => true,
			),
			'arrows_custom_color' => array(
				'label'          => esc_html__( 'Arrow Color', 'et_builder' ),
				'description'    => esc_html__( 'Pick a color to use for the slider arrows that are used to navigate through each slide.', 'et_builder' ),
				'type'           => 'color-alpha',
				'custom_color'   => true,
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'navigation',
				'mobile_options' => true,
			),
			'dot_nav_custom_color' => array(
				'label'          => esc_html__( 'Dot Navigation Color', 'et_builder' ),
				'description'    => esc_html__( 'Pick a color to use for the dot navigation that appears at the bottom of the slider to designate which slide is active.', 'et_builder' ),
				'type'           => 'color-alpha',
				'custom_color'   => true,
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'navigation',
				'mobile_options' => true,
			),
			'__posts' => array(
				'type'                => 'computed',
				'computed_callback'   => array( 'ET_Builder_Module_Fullwidth_Post_Slider', 'get_blog_posts' ),
				'computed_depends_on' => array(
					'posts_number',
					'include_categories',
					'orderby',
					'content_source',
					'use_manual_excerpt',
					'excerpt_length',
					'offset_number',
				),
			),
			'offset_number' => array(
				'label'            => esc_html__( 'Post Offset Number', 'et_builder' ),
				'description'      => esc_html__( 'Choose how many posts you would like to offset by', 'et_builder' ),
				'type'             => 'text',
				'option_category'  => 'configuration',
				'toggle_slug'      => 'main_content',
				'computed_affects' => array(
					'__posts',
				),
				'default'          => 0,
			),
		);

		return $fields;
	}

	public function get_transition_fields_css_props() {
		$fields = parent::get_transition_fields_css_props();
		$fields['background_layout'] = array(
			'background-color' => '%%order_class%% .et_pb_slide_overlay_container, %%order_class%% .et_pb_text_overlay_wrapper',
			'color' => self::$_->array_get( $this->advanced_fields, 'text.css.main', '%%order_class%%' ),
		);

		return $fields;
	}

	function render( $attrs, $content = null, $render_slug ) {
		/**
		 * Cached $wp_filter so it can be restored at the end of the callback.
		 * This is needed because this callback uses the_content filter / calls a function
		 * which uses the_content filter. WordPress doesn't support nested filter
		 */
		global $wp_filter;
		$wp_filter_cache                 = $wp_filter;
		$show_arrows                     = $this->props['show_arrows'];
		$show_pagination                 = $this->props['show_pagination'];
		$parallax                        = $this->props['parallax'];
		$parallax_method                 = $this->props['parallax_method'];
		$auto                            = $this->props['auto'];
		$auto_speed                      = $this->props['auto_speed'];
		$auto_ignore_hover               = $this->props['auto_ignore_hover'];
		$body_font_size                  = $this->props['body_font_size'];
		$show_content_on_mobile          = $this->props['show_content_on_mobile'];
		$show_cta_on_mobile              = $this->props['show_cta_on_mobile'];
		$show_image_video_mobile         = $this->props['show_image_video_mobile'];
		$background_position             = $this->props['background_position'];
		$background_size                 = $this->props['background_size'];
		$posts_number                    = $this->props['posts_number'];
		$include_categories              = $this->props['include_categories'];
		$show_more_button                = $this->props['show_more_button'];
		$more_text                       = $this->props['more_text'];
		$content_source                  = $this->props['content_source'];
		$background_color                = $this->props['background_color'];
		$show_image                      = $this->props['show_image'];
		$image_placement                 = $this->props['image_placement'];
		$background_image                = $this->props['background_image'];
		$background_repeat               = $this->props['background_repeat'];
		$background_blend                = $this->props['background_blend'];
		$use_bg_overlay                  = $this->props['use_bg_overlay'];
		$use_text_overlay                = $this->props['use_text_overlay'];
		$orderby                         = $this->props['orderby'];
		$show_meta                       = $this->props['show_meta'];
		$button_custom                   = $this->props['custom_button'];
		$button_rel                      = $this->props['button_rel'];
		$use_manual_excerpt              = $this->props['use_manual_excerpt'];
		$excerpt_length                  = $this->props['excerpt_length'];
		$dot_nav_custom_color            = $this->props['dot_nav_custom_color'];
		$arrows_custom_color             = $this->props['arrows_custom_color'];
		$header_level                    = $this->props['header_level'];
		$offset_number                   = $this->props['offset_number'];
		$bg_overlay_color_values         = et_pb_responsive_options()->get_property_values( $this->props, 'bg_overlay_color' );
		$text_overlay_color_values       = et_pb_responsive_options()->get_property_values( $this->props, 'text_overlay_color' );
		$text_border_radius_values       = et_pb_responsive_options()->get_property_values( $this->props, 'text_border_radius' );

		$background_layout               = $this->props['background_layout'];
		$background_layout_hover         = et_pb_hover_options()->get_value( 'background_layout', $this->props, 'light' );
		$background_layout_hover_enabled = et_pb_hover_options()->is_enabled( 'background_layout', $this->props );
		$background_layout_values        = et_pb_responsive_options()->get_property_values( $this->props, 'background_layout' );
		$background_layout_tablet        = isset( $background_layout_values['tablet'] ) ? $background_layout_values['tablet'] : '';
		$background_layout_phone         = isset( $background_layout_values['phone'] ) ? $background_layout_values['phone'] : '';

		$arrows_custom_color             = $this->props['arrows_custom_color'];
		$arrows_custom_color_values      = et_pb_responsive_options()->get_property_values( $this->props, 'arrows_custom_color' );
		$arrows_custom_color_tablet      = isset( $arrows_custom_color_values['tablet'] ) ? $arrows_custom_color_values['tablet'] : '';
		$arrows_custom_color_phone       = isset( $arrows_custom_color_values['phone'] ) ? $arrows_custom_color_values['phone'] : '';

		$dot_nav_custom_color            = $this->props['dot_nav_custom_color'];
		$dot_nav_custom_color_values     = et_pb_responsive_options()->get_property_values( $this->props, 'dot_nav_custom_color' );
		$dot_nav_custom_color_tablet     = isset( $dot_nav_custom_color_values['tablet'] ) ? $dot_nav_custom_color_values['tablet'] : '';
		$dot_nav_custom_color_phone      = isset( $dot_nav_custom_color_values['phone'] ) ? $dot_nav_custom_color_values['phone'] : '';

		$custom_icon_values              = et_pb_responsive_options()->get_property_values( $this->props, 'button_icon' );
		$custom_icon                     = isset( $custom_icon_values['desktop'] ) ? $custom_icon_values['desktop'] : '';
		$custom_icon_tablet              = isset( $custom_icon_values['tablet'] ) ? $custom_icon_values['tablet'] : '';
		$custom_icon_phone               = isset( $custom_icon_values['phone'] ) ? $custom_icon_values['phone'] : '';

		$post_index = 0;

		$hide_on_mobile_class = self::HIDE_ON_MOBILE;

		$is_text_overlay_applied = 'on' === $use_text_overlay;

		// Applying backround-related style to slide item since advanced_option only targets module wrapper
		if ( 'on' === $this->props['show_image'] && 'background' === $this->props['image_placement'] && 'off' === $parallax ) {
			if ('' !== $background_color) {
				ET_Builder_Module::set_style( $render_slug, array(
					'selector'    => '%%order_class%% .et_pb_slide:not(.et_pb_slide_with_no_image)',
					'declaration' => sprintf(
						'background-color: %1$s;',
						esc_html( $background_color )
					),
				) );
			}

			if ( '' !== $background_size && 'default' !== $background_size ) {
				ET_Builder_Module::set_style( $render_slug, array(
					'selector'    => '%%order_class%% .et_pb_slide',
					'declaration' => sprintf(
						'-moz-background-size: %1$s;
						-webkit-background-size: %1$s;
						background-size: %1$s;',
						esc_html( $background_size )
					),
				) );

				if ( 'initial' === $background_size ) {
					ET_Builder_Module::set_style( $render_slug, array(
						'selector'    => 'body.ie %%order_class%% .et_pb_slide',
						'declaration' => '-moz-background-size: auto; -webkit-background-size: auto; background-size: auto;',
					) );
				}
			}

			if ( '' !== $background_position && 'default' !== $background_position ) {
				$processed_position = str_replace( '_', ' ', $background_position );

				ET_Builder_Module::set_style( $render_slug, array(
					'selector'    => '%%order_class%% .et_pb_slide',
					'declaration' => sprintf(
						'background-position: %1$s;',
						esc_html( $processed_position )
					),
				) );
			}

			if ( '' !== $background_repeat ) {
				ET_Builder_Module::set_style( $render_slug, array(
					'selector'    => '%%order_class%% .et_pb_slide',
					'declaration' => sprintf(
						'background-repeat: %1$s;',
						esc_html( $background_repeat )
					),
				) );
			}

			if ( '' !== $background_blend ) {
				ET_Builder_Module::set_style( $render_slug, array(
					'selector'    => '%%order_class%% .et_pb_slide',
					'declaration' => sprintf(
						'background-blend-mode: %1$s;',
						esc_html( $background_blend )
					),
				) );
			}
		}

		if ( 'on' === $use_bg_overlay ) {
			// Background Overlay color.
			et_pb_responsive_options()->generate_responsive_css( $bg_overlay_color_values, '%%order_class%% .et_pb_slide .et_pb_slide_overlay_container', 'background-color', $render_slug, '', 'color' );
		}

		if ( $is_text_overlay_applied ) {
			// Text Overlay color.
			et_pb_responsive_options()->generate_responsive_css( $text_overlay_color_values, '%%order_class%% .et_pb_slide .et_pb_text_overlay_wrapper', 'background-color', $render_slug, '', 'color' );
		}

		// Text Border Radius.
		et_pb_responsive_options()->generate_responsive_css( $text_border_radius_values, '%%order_class%%.et_pb_slider_with_text_overlay .et_pb_text_overlay_wrapper', 'border-radius', $render_slug );

		$fullwidth = 'et_pb_fullwidth_post_slider' === $render_slug ? 'on' : 'off';

		$video_background = $this->video_background();
		$parallax_image_background = $this->get_parallax_image_background();

		$data_dot_nav_custom_color = '' !== $dot_nav_custom_color
			? sprintf( ' data-dots_color="%1$s"', esc_attr( $dot_nav_custom_color ) )
			: '';

		$data_dot_nav_custom_color_tablet = '' !== $dot_nav_custom_color_tablet
			? sprintf( ' data-dots_color-tablet="%1$s"', esc_attr( $dot_nav_custom_color_tablet ) )
			: '';

		$data_dot_nav_custom_color_phone = '' !== $dot_nav_custom_color_phone
			? sprintf( ' data-dots_color-phone="%1$s"', esc_attr( $dot_nav_custom_color_phone ) )
			: '';

		$data_arrows_custom_color = '' !== $arrows_custom_color
			? sprintf( ' data-arrows_color="%1$s"', esc_attr( $arrows_custom_color ) )
			: '';

		$data_arrows_custom_color_tablet = '' !== $arrows_custom_color_tablet
			? sprintf( ' data-arrows_color-tablet="%1$s"', esc_attr( $arrows_custom_color_tablet ) )
			: '';

		$data_arrows_custom_color_phone = '' !== $arrows_custom_color_phone
			? sprintf( ' data-arrows_color-phone="%1$s"', esc_attr( $arrows_custom_color_phone ) )
			: '';

		ob_start();

		// Re-used self::get_blog_posts() for builder output
		$query = self::get_blog_posts(array(
			'posts_number'       => $posts_number,
			'include_categories' => $include_categories,
			'orderby'            => $orderby,
			'content_source'     => $content_source,
			'use_manual_excerpt' => $use_manual_excerpt,
			'excerpt_length'     => $excerpt_length,
			'offset_number'      => $offset_number,
		), array(), array(), false );

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();

				$slide_class = 'off' !== $show_image && in_array( $image_placement, array( 'left', 'right' ) ) && has_post_thumbnail() ? ' et_pb_slide_with_image' : '';
				$slide_class .= 'off' !== $show_image && ! has_post_thumbnail() ? ' et_pb_slide_with_no_image' : '';
				$slide_class .= " et_pb_bg_layout_{$background_layout}";

				if ( ! empty( $background_layout_tablet ) ) {
					$slide_class .= " et_pb_bg_layout_{$background_layout_tablet}_tablet";
				}

				if ( ! empty( $background_layout_phone ) ) {
					$slide_class .= " et_pb_bg_layout_{$background_layout_tablet}_phone";
				}
			?>
			<div class="et_pb_slide et_pb_media_alignment_center<?php echo esc_attr( $slide_class ); ?>" <?php if ( 'on' !== $parallax && 'off' !== $show_image && 'background' === $image_placement ) { printf( 'style="background-image:url(%1$s)"', esc_url( wp_get_attachment_url( get_post_thumbnail_id() ) ) );  } ?><?php echo et_core_esc_previously( $data_dot_nav_custom_color ); echo et_core_esc_previously( $data_arrows_custom_color ); ?><?php echo et_core_esc_previously( $data_dot_nav_custom_color_tablet ); echo et_core_esc_previously( $data_arrows_custom_color_tablet ); ?><?php echo et_core_esc_previously( $data_dot_nav_custom_color_phone ); echo et_core_esc_previously( $data_arrows_custom_color_phone ); ?>>
				<?php if ( 'on' === $parallax && 'off' !== $show_image && 'background' === $image_placement ) { ?>
					<div class="et_parallax_bg<?php if ( 'off' === $parallax_method ) { echo ' et_pb_parallax_css'; } ?>" style="background-image: url(<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id() ) ); ?>);"></div>
				<?php } ?>
				<?php if ( 'on' === $use_bg_overlay ) { ?>
					<div class="et_pb_slide_overlay_container"></div>
				<?php } ?>
				<div class="et_pb_container clearfix">
					<div class="et_pb_slider_container_inner">
						<?php if ( 'off' !== $show_image && has_post_thumbnail() && ! in_array( $image_placement, array( 'background', 'bottom' ) ) ) { ?>
							<div class="et_pb_slide_image">
								<?php the_post_thumbnail(); ?>
							</div>
						<?php } ?>
						<div class="et_pb_slide_description">
							<?php if ( $is_text_overlay_applied ) : ?><div class="et_pb_text_overlay_wrapper"><?php endif; ?>
								<<?php echo et_pb_process_header_level( $header_level, 'h2' ) ?> class="et_pb_slide_title"><a href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a></<?php echo et_pb_process_header_level( $header_level, 'h2' ) ?>>
								<div class="et_pb_slide_content <?php if ( 'on' !== $show_content_on_mobile ) { echo esc_attr( $hide_on_mobile_class ); } ?>">
									<?php
									if ( 'off' !== $show_meta ) {
										printf(
											'<p class="post-meta">%1$s | %2$s | %3$s | %4$s</p>',
											et_get_safe_localization( sprintf( __( 'by %s', 'et_builder' ), '<span class="author vcard">' .  et_pb_get_the_author_posts_link() . '</span>' ) ),
											et_get_safe_localization( sprintf( __( '%s', 'et_builder' ), '<span class="published">' . esc_html( get_the_date() ) . '</span>' ) ),
											get_the_category_list(', '),
											esc_html( sprintf( _nx( '%s Comment', '%s Comments', get_comments_number(), 'number of comments', 'et_builder' ), number_format_i18n( get_comments_number() ) ) )
										);
									}
									?>
									<?php
										echo et_core_intentionally_unescaped( $query->posts[ $post_index ]->post_content, 'html' );
									?>
								</div>
							<?php if ( $is_text_overlay_applied ) : ?></div><?php endif; ?>
							<?php
								// render button
								$button_classname = array( 'et_pb_more_button' );

								if ( 'on' !== $show_cta_on_mobile ) {
									$button_classname[] = $hide_on_mobile_class;
								}

								echo et_core_esc_previously( $this->render_button( array(
									'button_classname'   => $button_classname,
									'button_custom'      => $button_custom,
									'button_rel'         => $button_rel,
									'button_text'        => $more_text,
									'button_url'         => get_permalink(),
									'custom_icon'        => $custom_icon,
									'custom_icon_tablet' => $custom_icon_tablet,
									'custom_icon_phone'  => $custom_icon_phone,
									'display_button'     => ( 'off' !== $show_more_button && '' !== $more_text ),
								) ) );
							?>
						</div> <!-- .et_pb_slide_description -->
						<?php if ( 'off' !== $show_image && has_post_thumbnail() && 'bottom' === $image_placement ) { ?>
							<div class="et_pb_slide_image">
								<?php the_post_thumbnail(); ?>
							</div>
						<?php } ?>
					</div>
				</div> <!-- .et_pb_container -->
			</div> <!-- .et_pb_slide -->
		<?php
			$post_index++;

			} // end while
		} // end if

		wp_reset_query();

		if ( ! $content = ob_get_clean() ) {
			$content  = '<div class="et_pb_row et_pb_no_results">';
			$content .= self::get_no_results_template();
			$content .= '</div>';
		}

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
			'et_pb_slider',
			'et_pb_post_slider',
			"et_pb_post_slider_image_{$image_placement}",
		) );

		if ( 'off' === $fullwidth ) {
			$this->add_classname( 'et_pb_slider_fullwidth_off' );
		}

		if ( 'off' === $show_arrows ) {
			$this->add_classname( 'et_pb_slider_no_arrows' );
		}

		if ( 'off' === $show_pagination ) {
			$this->add_classname( 'et_pb_slider_no_pagination' );
		}

		if ( 'on' === $parallax ) {
			$this->add_classname( 'et_pb_slider_parallax' );
		}

		if ( 'on' === $auto ) {
			$this->add_classname( array(
				'et_slider_auto',
				"et_slider_speed_{$auto_speed}",
			) );
		}

		if ( 'on' === $auto_ignore_hover ) {
			$this->add_classname( 'et_slider_auto_ignore_hover' );
		}

		if ( 'on' === $show_image_video_mobile ) {
			$this->add_classname( 'et_pb_slider_show_image' );
		}

		if ( 'on' === $use_bg_overlay ) {
			$this->add_classname( 'et_pb_slider_with_overlay' );
		}

		if ( 'on' === $use_text_overlay ) {
			$this->add_classname( 'et_pb_slider_with_text_overlay' );
		}

		// Removed automatically added classnames
		$this->remove_classname( 'et_pb_fullwidth_post_slider' );

		$output = sprintf(
			'<div%3$s class="%1$s"%7$s%8$s>
				%5$s
				%4$s
				<div class="et_pb_slides">
					%2$s
				</div> <!-- .et_pb_slides -->
				%6$s
			</div> <!-- .et_pb_slider -->
			',
			$this->module_classname( $render_slug ),
			$content,
			$this->module_id(),
			$video_background,
			$parallax_image_background, // #5
			$this->inner_shadow_back_compatibility( $render_slug ),
			et_core_esc_previously( $data_background_layout ),
			et_core_esc_previously( $data_background_layout_hover )
		);

		// Restore $wp_filter
		$wp_filter = $wp_filter_cache; // phpcs:ignore WordPress.Variables.GlobalVariables.OverrideProhibited
		unset($wp_filter_cache);

		return $output;
	}

	private function inner_shadow_back_compatibility( $functions_name ) {
		$utils = ET_Core_Data_Utils::instance();
		$atts  = $this->props;
		$style = '';

		if (
			version_compare( $utils->array_get( $atts, '_builder_version', '3.0.93' ), '3.0.99', 'lt' )
		) {
			$class = self::get_module_order_class( $functions_name );
			$style = sprintf(
				'<style>%1$s</style>',
				sprintf(
					'.%1$s.et_pb_slider .et_pb_slide {'
					. '-webkit-box-shadow: none; '
					. '-moz-box-shadow: none; '
					. 'box-shadow: none; '
					.'}',
					esc_attr( $class )
				)
			);

			if ( 'off' !== $utils->array_get( $atts, 'show_inner_shadow' ) ) {
				$style .= sprintf(
					'<style>%1$s</style>',
					sprintf(
						'.%1$s > .box-shadow-overlay { '
						. '-webkit-box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1); '
						. '-moz-box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1); '
						. 'box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1); '
						. '}',
						esc_attr( $class )
					)
				);
			}
		}

		return $style;
	}
}

new ET_Builder_Module_Fullwidth_Post_Slider;
