<?php

class dcsbcm_Divi_Breadcrumbs_Module extends ET_Builder_Module {

	public $slug       = 'et_pb_dcsbcm_divi_breadcrumbs_module';
	public $vb_support = 'on';
	public $main_css_element = '%%order_class%%';
	//public $main_css_element = '%%order_class%%.dcsbcm_divi_breadcrumbs_wrapper';

	protected $module_credits = array(
		'module_uri' => 'https://divibreadcrumbs.com/',
		'author'     => 'CODECRATER',
		'author_uri' => 'https://divicake.com/author/codecrater/',
	);

	public function init() {

		$this->name = esc_html__( 'Divi Breadcrumbs', 'dcsbcm_Divi_Breadcrumbs_Module' );
		$this->options_toggles = array(
			'general'  => array(
				'toggles' => array(
					'breadcrumbnav_settings' => esc_html__( 'Breadcrumb Navigation Settings', 'et_builder' ),
				),
			),
		);
		$this->custom_css_fields = array(
			'breadcrumbcss_breadcrumbs' => array(
				'label'    => esc_html__( 'Breadcrumbs', 'et_builder' ),
				'selector' => 'span.dcsbcm_divi_breadcrumb',
			),
			'breadcrumbcss_activebreadcrumb' => array(
				'label'    => esc_html__( 'Active Breadcrumb', 'et_builder' ),
				'selector' => 'span.dcsbcm_divi_breadcrumb-active',
			),
			'breadcrumbcss_breadcrumblinks' => array(
				'label'    => esc_html__( 'Breadcrumb Links', 'et_builder' ),
				'selector' => 'span.dcsbcm_divi_breadcrumb a',
			),
			'breadcrumbcss_breadcrumblinkhover' => array(
				'label'    => esc_html__( 'Breadcrumb Link Hover', 'et_builder' ),
				'selector' => 'span.dcsbcm_divi_breadcrumb a:hover',
			),
			'breadcrumbcss_seperators' => array(
				'label'    => esc_html__( 'Separators', 'et_builder' ),
				'selector' => 'span.dcsbcm_separator',
			),
		);
	}

	public function get_fields() {

		// Init separator choices
		$dcsbcm_separatorlist = array();
		$dcsbcm_separatorlist['sep-raquo'] 		= '»';
		$dcsbcm_separatorlist['sep-arrow'] 		= '→';
		$dcsbcm_separatorlist['sep-tri'] 		= '▶';
		$dcsbcm_separatorlist['sep-dash'] 		= '-';
		$dcsbcm_separatorlist['sep-ndash'] 		= '–';
		$dcsbcm_separatorlist['sep-mdash'] 		= '—';
		$dcsbcm_separatorlist['sep-tinydot']	= '·';
		$dcsbcm_separatorlist['sep-bull'] 		= '•';
		$dcsbcm_separatorlist['sep-tinystar'] 	= '*';
		$dcsbcm_separatorlist['sep-star'] 		= '⋆';
		$dcsbcm_separatorlist['sep-tilde']		= '~';
		$dcsbcm_separatorlist['sep-pipe']		= '|';


		$module_fields = [];

		$module_fields['hide_homebreadcrumb'] = [
			'label'             => esc_html__( 'Hide Home Breadcrumb', 'et_builder' ),
			'type'              => 'yes_no_button',
			'option_category'   => 'basic_option',
			'default'			=> 'off',
			'options'           => array(
				'off' => esc_html__( "No", 'et_builder' ),
				'on'  => esc_html__( 'Yes', 'et_builder' ),
			),
			'affects'           => array(
				'homebreadcrumbtext'
			),
			'toggle_slug'       => 'breadcrumbnav_settings',
			'description'       => esc_html__( 'Choose whether or not to display "Home" link.', 'et_builder' ),
			'computed_affects' => array(
				'computed_field_html_payload',
			),
		];
		$module_fields['homebreadcrumbtext'] = [
			'label'           => esc_html__( 'Home Breadcrumb Text', 'et_builder' ),
			'type'            => 'text',
			'option_category' => 'basic_option',
			'depends_show_if' => 'off',
			'description'     => esc_html__( 'If you would like override the "Home" breadcrumb text, input your own text here. The word "Home" will be shown if this field is left blank.', 'et_builder' ),
			'toggle_slug'     => 'breadcrumbnav_settings',
			'computed_affects' => array(
				'computed_field_html_payload',
			),
		];
		$module_fields['separator'] = [
			'label'           => esc_html__( 'Separator', 'et_builder' ),
			'type'            => 'select',
			'option_category' => 'basic_option',
			'default'		  => 'sep-raquo',
			'options'         => $dcsbcm_separatorlist,
			'toggle_slug'     => 'breadcrumbnav_settings',
			'description'     => esc_html__( 'Choose a symbol to use as your breadcrumb separator. The appearance of separators can be customized in the Design Tab.', 'et_builder' ),
			'computed_affects' => array(
				'computed_field_html_payload',
			),
		];
		$module_fields['hide_currentbreadcrumb'] = [
			'label'             => esc_html__( 'Hide Current Page', 'et_builder' ),
			'type'              => 'yes_no_button',
			'option_category'   => 'basic_option',
			'options'           => array(
				'off' => esc_html__( "No", 'et_builder' ),
				'on'  => esc_html__( 'Yes', 'et_builder' ),
			),
			'toggle_slug'       => 'breadcrumbnav_settings',
			'description'       => esc_html__( 'Choose whether or not to display the show current Post or Page title in the breadcrumbs.', 'et_builder' ),
			'computed_affects' => array(
				'computed_field_html_payload',
			),
		];


		$module_fields['computed_field_html_payload'] = [
			'type'					=> 'computed',
			'computed_callback' 	=> array( 'dcsbcm_Divi_Breadcrumbs_Module', 'ccfcm_build_output' ),
			'computed_depends_on' 	=> array(
				'hide_homebreadcrumb',
				'homebreadcrumbtext',
				'separator',
				'hide_currentbreadcrumb',
			),
			'computed_minimum' 		=> array(
				'hide_homebreadcrumb',
				'homebreadcrumbtext',
				'separator',
				'hide_currentbreadcrumb',
			),
		];

		return $module_fields;
	}


	static function ccfcm_build_output( $args = array(), $conditional_tags = array(), $current_page = array() ) {

		$args = wp_parse_args( $args );

		ob_start();

		// Retrieve of all the stored data into variables to be used in the method.
		$separator         			= $args['separator'];
		$hide_homebreadcrumb    	= $args['hide_homebreadcrumb'];
		$homebreadcrumbtext			= $args['homebreadcrumbtext'];
		$hide_currentbreadcrumb		= $args['hide_currentbreadcrumb'];
		$current_page_ID			= $current_page['id'];
		$current_page_slug			= get_post_field( 'post_name', $current_page_ID );
		$post 						= get_post( $current_page_ID );
		
		// Configure Home breadcrumb text
		$breadcrumbFullText['home'] = $homebreadcrumbtext;
		if ( $homebreadcrumbtext == '' ) { $breadcrumbFullText['home'] = 'Home'; } // If value is blank, set to "Home".

		// Show or don't show Home breadcrumb
		if ( $hide_homebreadcrumb == 'on' ) {
			$hide_homebreadcrumb = 1; // 0 - don't hide home title in breadcrumbs, 1 - hide
		} else {
			$hide_homebreadcrumb = 0; // 0 - don't hide home title in breadcrumbs, 1 - hide
		}
		
		// Show or don't show Current page breadcrumb
		if ( $hide_currentbreadcrumb == 'on' ) {
			$hide_currentbreadcrumb = 1; // 0 - don't hide current post/page title in breadcrumbs, 1 - hide
		} else {
			$hide_currentbreadcrumb = 0; // 0 - don't hide current post/page title in breadcrumbs, 1 - hide
		}
		
		// Separator Options
		switch ( $separator ) {
			case 'sep-raquo':
				$separator = '&raquo;';
				break;
			case 'sep-arrow':
				$separator = '&rarr;';
				break;
			case 'sep-tri':
				$separator = '&#9654;';
				break;
			case 'sep-dash':
				$separator = '-';
				break;
			case 'sep-ndash':
				$separator = '&ndash;';
				break;
			case 'sep-mdash':
				$separator = '&mdash;';
				break;
			case 'sep-tinydot':
				$separator = '·';
				break;
			case 'sep-bull':
				$separator = '&bull;';
				break;
			case 'sep-tinystar':
				$separator = '*';
				break;
			case 'sep-star':
				$separator = '&#9733;';
				break;
			case 'sep-tilde':
				$separator = '~';
				break;
			case 'sep-pipe':
				$separator = '|';
				break;
		}
		$separator = '<span class="dcsbcm_separator">&nbsp;'.$separator.'&nbsp;</span>';
		
		$breadcrumbActiveBefore      		= '<span class="dcsbcm_divi_breadcrumb dcsbcm_divi_breadcrumb-active">'; // tag before the active crumb
		$breadcrumbActiveAfter       		= '</span>'; // tag after the active crumb
		
		$breadcrumbFullText['category'] = 'Category: "%s"'; // text for a category page
		$breadcrumbFullText['tax'] 	  	= 'Archive for "%s"'; // text for a taxonomy page
		$breadcrumbFullText['search']   = 'Search Results for "%s"'; // text for a search results page
		$breadcrumbFullText['tag']      = 'Posts Tagged "%s"'; // text for a tag page
		$breadcrumbFullText['author']   = 'Posts by %s'; // text for an author page
		$breadcrumbFullText['404']      = 'Error 404'; // text for the 404 page

		$dcsbcm_Output_BreadcrumbsHTML = '';
		$homeLink = get_bloginfo('url') . '/';
		$linkBefore = '<span class="dcsbcm_divi_breadcrumb" typeof="v:Breadcrumb">';
		$linkAfter = '</span>';
		$linkAttr = ' rel="v:url" property="v:title"';
		$link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;

		
		if ( is_home() || is_front_page() ) {

			if ( $hide_homebreadcrumb == 0 ) { $dcsbcm_Output_BreadcrumbsHTML = '<div class="dcsbcm_divi_breadcrumbs"><span class="dcsbcm_divi_breadcrumb dcsbcm_divi_breadcrumb-active">TESTINGABC<a href="' . $homeLink . '">' . $breadcrumbFullText['home'] . '</a></span></div>'; }

		} else {
	
			$dcsbcm_Output_BreadcrumbsHTML = '<div class="dcsbcm_divi_breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">';
			
			if ( $hide_homebreadcrumb == 0 ) { $dcsbcm_Output_BreadcrumbsHTML = sprintf( $link, $homeLink, $breadcrumbFullText['home'] ) . $separator; }
			
			if ( is_category() ) {
				$thisCat = get_category(get_query_var('cat'), false);
				if ($thisCat->parent != 0) {
					$cats = get_category_parents($thisCat->parent, TRUE, $separator);
					$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
					$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
					$dcsbcm_Output_BreadcrumbsHTML .= $cats;
				}
				$dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . sprintf($breadcrumbFullText['category'], single_cat_title('', false)) . $breadcrumbActiveAfter;

			} elseif( is_tax() ){
				$thisCat = get_category(get_query_var('cat'), false);
				if ($thisCat->parent != 0) {
					$cats = get_category_parents($thisCat->parent, TRUE, $separator);
					$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
					$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
					$dcsbcm_Output_BreadcrumbsHTML .= $cats;
				}
				$dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . sprintf($breadcrumbFullText['tax'], single_cat_title('', false)) . $breadcrumbActiveAfter;
			
			}elseif ( is_search() ) {
				$dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . sprintf($breadcrumbFullText['search'], get_search_query()) . $breadcrumbActiveAfter;

			} elseif ( is_day() ) {
				$dcsbcm_Output_BreadcrumbsHTML .= sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $separator;
				$dcsbcm_Output_BreadcrumbsHTML .= sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $separator;
				$dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . get_the_time('d') . $breadcrumbActiveAfter;

			} elseif ( is_month() ) {
				$dcsbcm_Output_BreadcrumbsHTML .= sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $separator;
				$dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . get_the_time('F') . $breadcrumbActiveAfter;

			} elseif ( is_year() ) {
				$dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . get_the_time('Y') . $breadcrumbActiveAfter;

			} elseif ( is_single( $current_page_ID ) && !is_attachment() ) {
				if ( get_post_type( $current_page_ID ) != 'post' ) {
					$post_type = get_post_type_object(get_post_type( $current_page_ID ));
					$slug = $post_type->rewrite;
					printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
					if ($hide_currentbreadcrumb == 0) $dcsbcm_Output_BreadcrumbsHTML .= $separator . $breadcrumbActiveBefore . get_the_title( $current_page_ID ) . $breadcrumbActiveAfter;
				} else {
					$cat = get_the_category(); $cat = $cat[0];
					$cats = get_category_parents($cat, TRUE, $separator);
					if ($hide_currentbreadcrumb == 1) $cats = preg_replace("#^(.+)$separator$#", "$1", $cats);
					$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
					$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
					$dcsbcm_Output_BreadcrumbsHTML .= $cats;
					if ($hide_currentbreadcrumb == 0) $dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . get_the_title( $current_page_ID ) . $breadcrumbActiveAfter;
				}
			} elseif ( !is_single( $current_page_ID ) && get_post_type( $current_page_ID ) !== 'page' && get_post_type( $current_page_ID ) != 'post' && !is_404() ) {
				$post_type = get_post_type_object(get_post_type( $current_page_ID ));
				$dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . $post_type->labels->singular_name . $breadcrumbActiveAfter;
			} elseif ( is_attachment() ) {
				$parent = get_post($post->post_parent);
				$cat = get_the_category($parent->ID); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $separator);
				$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				$dcsbcm_Output_BreadcrumbsHTML .= $cats;
				printf($link, get_permalink($parent), $parent->post_title);
				if ($hide_currentbreadcrumb == 0) $dcsbcm_Output_BreadcrumbsHTML .= $separator . $breadcrumbActiveBefore . get_the_title( $current_page_ID ) . $breadcrumbActiveAfter;

			} elseif ( get_post_type( $current_page_ID ) == 'page' && !$post->post_parent ) {
				if ($hide_currentbreadcrumb == 0) $dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . get_the_title( $current_page_ID ) . $breadcrumbActiveAfter;

			} elseif ( get_post_type( $current_page_ID ) == 'page' && $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_post($parent_id);
					$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					$dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbs[$i];
					if ($i != count($breadcrumbs)-1) $dcsbcm_Output_BreadcrumbsHTML .= $separator;
				}
				if ($hide_currentbreadcrumb == 0) $dcsbcm_Output_BreadcrumbsHTML .= $separator . $breadcrumbActiveBefore . get_the_title( $current_page_ID ) . $breadcrumbActiveAfter;

			} elseif ( is_tag() ) {
				$dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . sprintf($breadcrumbFullText['tag'], single_tag_title('', false)) . $breadcrumbActiveAfter;

			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata($author);
				$dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . sprintf($breadcrumbFullText['author'], $userdata->display_name) . $breadcrumbActiveAfter;

			} elseif ( is_404() ) {
				$dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . $breadcrumbFullText['404'] . $breadcrumbActiveAfter;
				
			}

			if ( get_query_var('paged') ) {
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $dcsbcm_Output_BreadcrumbsHTML .= ' (';
				$dcsbcm_Output_BreadcrumbsHTML .= __('Page') . ' ' . get_query_var('paged');
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $dcsbcm_Output_BreadcrumbsHTML .= ')';
			}

			$dcsbcm_Output_BreadcrumbsHTML .= '</div>';
	
		}
		
		
		if ( is_home() || is_front_page() ) {
			if ( $hide_homebreadcrumb == 0 ) { echo $dcsbcm_Output_BreadcrumbsHTML; } // If on the homepage, only return html if we're supposed to.
		} else {
			echo $dcsbcm_Output_BreadcrumbsHTML;
		}

		return ob_get_clean();

	}

	

	public function get_advanced_fields_config() {
		
		$advanced_fields = [];

		// This disables Divi's default "Module Link" option.
		$advanced_fields['link_options'] = false;

		// This disables Divi's default "Text" option.
		$advanced_fields['text'] = false;

		// Breadcrumbs Fonts Styling options
		$advanced_fields['fonts'] = [
			'fontsbreadcrumbs' => [
				'label'    => esc_html__( 'Breadcrumbs', 'et_builder' ),
				'css'      => array(
					'main' => "{$this->main_css_element}",
				),
			],
			'fontsseperator'   => [
				'label'    => esc_html__( 'Seperator', 'et_builder' ),
				'css'      => array(
					'main' => "{$this->main_css_element} span.dcsbcm_separator",
				),
			],
			'fontsbreadcrumblinks'   => [
				'label'    => esc_html__( 'Breadcrumb Links', 'et_builder' ),
				'css'      => array(
					'main' => "{$this->main_css_element} .dcsbcm_divi_breadcrumb a",
				),
			],
		];

		$advanced_fields['custom_margin_padding'] = [
			'css' => array(
				'important' => 'all',
			),
		];
		return $advanced_fields;
	
	}


	public function render( $attrs, $content = null, $render_slug ) {

		// Retrieve of all the stored data into variables to be used in the method.
		$separator         			= $this->props['separator'];
		$hide_homebreadcrumb    	= $this->props['hide_homebreadcrumb'];
		$homebreadcrumbtext			= $this->props['homebreadcrumbtext'];
		$hide_currentbreadcrumb		= $this->props['hide_currentbreadcrumb'];
		$current_page_ID			= get_the_ID();
		$current_page_slug			= get_post_field( 'post_name', $current_page_ID );
		$post 						= get_post( $current_page_ID );
		
		// Configure Home breadcrumb text
		$breadcrumbFullText['home'] = $homebreadcrumbtext;
		if ( $homebreadcrumbtext == '' ) { $breadcrumbFullText['home'] = 'Home'; } // If value is blank, set to "Home".

		// Show or don't show Home breadcrumb
		if ( $hide_homebreadcrumb == 'on' ) {
			$hide_homebreadcrumb = 1; // 0 - don't hide home title in breadcrumbs, 1 - hide
		} else {
			$hide_homebreadcrumb = 0; // 0 - don't hide home title in breadcrumbs, 1 - hide
		}
		
		// Show or don't show Current page breadcrumb
		if ( $hide_currentbreadcrumb == 'on' ) {
			$hide_currentbreadcrumb = 1; // 0 - don't hide current post/page title in breadcrumbs, 1 - hide
		} else {
			$hide_currentbreadcrumb = 0; // 0 - don't hide current post/page title in breadcrumbs, 1 - hide
		}
		
		// Separator Options
		switch ( $separator ) {
			case 'sep-raquo':
				$separator = '&raquo;';
				break;
			case 'sep-arrow':
				$separator = '&rarr;';
				break;
			case 'sep-tri':
				$separator = '&#9654;';
				break;
			case 'sep-dash':
				$separator = '-';
				break;
			case 'sep-ndash':
				$separator = '&ndash;';
				break;
			case 'sep-mdash':
				$separator = '&mdash;';
				break;
			case 'sep-tinydot':
				$separator = '·';
				break;
			case 'sep-bull':
				$separator = '&bull;';
				break;
			case 'sep-tinystar':
				$separator = '*';
				break;
			case 'sep-star':
				$separator = '&#9733;';
				break;
			case 'sep-tilde':
				$separator = '~';
				break;
			case 'sep-pipe':
				$separator = '|';
				break;
		}
		$separator = '<span class="dcsbcm_separator">&nbsp;'.$separator.'&nbsp;</span>';
		
		$breadcrumbActiveBefore      		= '<span class="dcsbcm_divi_breadcrumb dcsbcm_divi_breadcrumb-active">'; // tag before the active crumb
		$breadcrumbActiveAfter       		= '</span>'; // tag after the active crumb
		
		$breadcrumbFullText['category'] = 'Category: "%s"'; // text for a category page
		$breadcrumbFullText['tax'] 	  	= 'Archive for "%s"'; // text for a taxonomy page
		$breadcrumbFullText['search']   = 'Search Results for "%s"'; // text for a search results page
		$breadcrumbFullText['tag']      = 'Posts Tagged "%s"'; // text for a tag page
		$breadcrumbFullText['author']   = 'Posts by %s'; // text for an author page
		$breadcrumbFullText['404']      = 'Error 404'; // text for the 404 page

		$dcsbcm_Output_BreadcrumbsHTML = '';
		$homeLink = get_bloginfo('url') . '/';
		$linkBefore = '<span class="dcsbcm_divi_breadcrumb" typeof="v:Breadcrumb">';
		$linkAfter = '</span>';
		$linkAttr = ' rel="v:url" property="v:title"';
		$link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;

		
		if ( is_home() || is_front_page() ) {

			if ( $hide_homebreadcrumb == 0 ) { $dcsbcm_Output_BreadcrumbsHTML = '<div class="dcsbcm_divi_breadcrumbs"><span class="dcsbcm_divi_breadcrumb dcsbcm_divi_breadcrumb-active">TESTINGABC<a href="' . $homeLink . '">' . $breadcrumbFullText['home'] . '</a></span></div>'; }

		} else {
	
			$dcsbcm_Output_BreadcrumbsHTML = '<div class="dcsbcm_divi_breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">';
			
			if ( $hide_homebreadcrumb == 0 ) { $dcsbcm_Output_BreadcrumbsHTML = sprintf( $link, $homeLink, $breadcrumbFullText['home'] ) . $separator; }
			
			if ( is_category() ) {
				$thisCat = get_category(get_query_var('cat'), false);
				if ($thisCat->parent != 0) {
					$cats = get_category_parents($thisCat->parent, TRUE, $separator);
					$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
					$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
					$dcsbcm_Output_BreadcrumbsHTML .= $cats;
				}
				$dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . sprintf($breadcrumbFullText['category'], single_cat_title('', false)) . $breadcrumbActiveAfter;

			} elseif( is_tax() ){
				$thisCat = get_category(get_query_var('cat'), false);
				if ($thisCat->parent != 0) {
					$cats = get_category_parents($thisCat->parent, TRUE, $separator);
					$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
					$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
					$dcsbcm_Output_BreadcrumbsHTML .= $cats;
				}
				$dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . sprintf($breadcrumbFullText['tax'], single_cat_title('', false)) . $breadcrumbActiveAfter;
			
			}elseif ( is_search() ) {
				$dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . sprintf($breadcrumbFullText['search'], get_search_query()) . $breadcrumbActiveAfter;

			} elseif ( is_day() ) {
				$dcsbcm_Output_BreadcrumbsHTML .= sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $separator;
				$dcsbcm_Output_BreadcrumbsHTML .= sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $separator;
				$dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . get_the_time('d') . $breadcrumbActiveAfter;

			} elseif ( is_month() ) {
				$dcsbcm_Output_BreadcrumbsHTML .= sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $separator;
				$dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . get_the_time('F') . $breadcrumbActiveAfter;

			} elseif ( is_year() ) {
				$dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . get_the_time('Y') . $breadcrumbActiveAfter;

			} elseif ( is_single( $current_page_ID ) && !is_attachment() ) {
				if ( get_post_type( $current_page_ID ) != 'post' ) {
					$post_type = get_post_type_object(get_post_type( $current_page_ID ));
					$slug = $post_type->rewrite;
					printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
					if ($hide_currentbreadcrumb == 0) $dcsbcm_Output_BreadcrumbsHTML .= $separator . $breadcrumbActiveBefore . get_the_title( $current_page_ID ) . $breadcrumbActiveAfter;
				} else {
					$cat = get_the_category(); $cat = $cat[0];
					$cats = get_category_parents($cat, TRUE, $separator);
					if ($hide_currentbreadcrumb == 1) $cats = preg_replace("#^(.+)$separator$#", "$1", $cats);
					$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
					$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
					$dcsbcm_Output_BreadcrumbsHTML .= $cats;
					if ($hide_currentbreadcrumb == 0) $dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . get_the_title( $current_page_ID ) . $breadcrumbActiveAfter;
				}
			} elseif ( !is_single( $current_page_ID ) && get_post_type( $current_page_ID ) !== 'page' && get_post_type( $current_page_ID ) != 'post' && !is_404() ) {
				$post_type = get_post_type_object(get_post_type( $current_page_ID ));
				$dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . $post_type->labels->singular_name . $breadcrumbActiveAfter;
			} elseif ( is_attachment() ) {
				$parent = get_post($post->post_parent);
				$cat = get_the_category($parent->ID); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $separator);
				$cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
				$cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
				$dcsbcm_Output_BreadcrumbsHTML .= $cats;
				printf($link, get_permalink($parent), $parent->post_title);
				if ($hide_currentbreadcrumb == 0) $dcsbcm_Output_BreadcrumbsHTML .= $separator . $breadcrumbActiveBefore . get_the_title( $current_page_ID ) . $breadcrumbActiveAfter;

			} elseif ( get_post_type( $current_page_ID ) == 'page' && !$post->post_parent ) {
				if ($hide_currentbreadcrumb == 0) $dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . get_the_title( $current_page_ID ) . $breadcrumbActiveAfter;

			} elseif ( get_post_type( $current_page_ID ) == 'page' && $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_post($parent_id);
					$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					$dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbs[$i];
					if ($i != count($breadcrumbs)-1) $dcsbcm_Output_BreadcrumbsHTML .= $separator;
				}
				if ($hide_currentbreadcrumb == 0) $dcsbcm_Output_BreadcrumbsHTML .= $separator . $breadcrumbActiveBefore . get_the_title( $current_page_ID ) . $breadcrumbActiveAfter;

			} elseif ( is_tag() ) {
				$dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . sprintf($breadcrumbFullText['tag'], single_tag_title('', false)) . $breadcrumbActiveAfter;

			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata($author);
				$dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . sprintf($breadcrumbFullText['author'], $userdata->display_name) . $breadcrumbActiveAfter;

			} elseif ( is_404() ) {
				$dcsbcm_Output_BreadcrumbsHTML .= $breadcrumbActiveBefore . $breadcrumbFullText['404'] . $breadcrumbActiveAfter;
				
			}

			if ( get_query_var('paged') ) {
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $dcsbcm_Output_BreadcrumbsHTML .= ' (';
				$dcsbcm_Output_BreadcrumbsHTML .= __('Page') . ' ' . get_query_var('paged');
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $dcsbcm_Output_BreadcrumbsHTML .= ')';
			}

			$dcsbcm_Output_BreadcrumbsHTML .= '</div>';
	
		}
		
		
		if ( is_home() || is_front_page() ) {
			if ( $hide_homebreadcrumb == 0 ) { return $dcsbcm_Output_BreadcrumbsHTML; } // If on the homepage, only return html if we're supposed to.
		} else {
			return $dcsbcm_Output_BreadcrumbsHTML;
		}


	}
}

new dcsbcm_Divi_Breadcrumbs_Module;