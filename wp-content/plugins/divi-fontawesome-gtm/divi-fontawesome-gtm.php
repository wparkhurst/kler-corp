<?php

/**
 * @link              https://greentreemediallc.com
 * @since             1.1.0
 * @wordpress-plugin
 * Plugin Name:       Divi Font Awesome
 * Description:       Easily load the iconic Font Awesome directly into the Divi Builder. Seriously.
 * Plugin URI:	      http://alexbrinkman.org/divi-font-awesome/
 * Version:           1.4.3
 * Author:            Alex Brinkman
 * Author URI:        https://greentreemediallc.com
 * Text Domain:       divi-fontawesome-gtm
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) :
	die;
endif;

define( 'DFA_VERSION', '1.4.3' );
define( 'DFA_OPTIONS_NAME', 'divi_fontawesome_gtm_settings' );
define( 'DFA_PLUGIN_SLUG', 'divi-fontawesome-gtm' );
define( 'DFA_SETTINGS', 'divi_fontawesome_gtm_settings' );
define( 'DFA_PLUGIN_FILE', __FILE__ ); 
define( 'DFA_MARKETPLACE', 'emp' );

// Elegant Marketplace EDD Auto Updater.
if( DFA_MARKETPLACE === 'emp') :
	add_action( 'admin_init', 'dfa_marketplace_plugin_updater', 0 );
endif;

add_filter( 'body_class', 'gtm_dfa_public_custom_class' );
add_filter( 'admin_body_class', 'gtm_dfa_admin_custom_class' );

add_action( 'init', 'load_the_icons_dfa' );
add_filter( 'filter_front_icon_dfa', 'front_icon_filter_dfa' );

add_action( 'admin_init', 'gtm_dfa_setup_sections' );
add_action( 'admin_init', 'gtm_dfa_setup_fields' );
add_action( 'admin_menu', 'gtm_dfa_admin_menu' );

add_action( 'admin_enqueue_scripts', 'dfa_admin_style' );
add_action( 'wp_enqueue_scripts', 'gtm_dfa_public_script' );
add_action( 'admin_enqueue_scripts', 'gtm_dfa_public_script' );

add_action( 'wp_enqueue_scripts', 'gtm_dfa_fontawesome' );

add_action( 'admin_enqueue_scripts', 'gtm_dfa_fontawesome' );

add_filter( 'plugin_action_links', 'gtm_dfa_add_action_plugin', 10, 5 );

function gtm_dfa_public_custom_class( $classes ) {
	$classes[] = ' divi-font-awesome';
	return $classes;
}

function gtm_dfa_admin_custom_class( $classes ) {
	$classes .= ' divi-font-awesome';
	return $classes;
}

function dfa_marketplace_plugin_updater() {
	if ( is_admin() ) :
		require_once('update/emp_dfa_lic.php');
	endif;
}

function load_the_icons_dfa()
{
	add_filter( 'et_pb_font_icon_symbols', 'et_icons_dfa', 20 );
  add_filter( 'et_pb_font_icon_symbols', 'fa_icons_dfa', 30 );
}

/**
 * Filter plugin action links.
 *
 * @since    1.0.0
 */
function gtm_dfa_add_action_plugin( $actions, $plugin_file )
{
	static $plugin;

	if ( ! isset( $plugin ) )
		$plugin = plugin_basename(__FILE__);
	
	if ($plugin == $plugin_file) :

		$settings = array('settings' => '<a href="options-general.php?page=' . DFA_SETTINGS . '">' . __('Settings', 'General') . '</a>');
		$site_link = array('support' => '<a href="https://alexbrinkman.org/product-support/" target="_blank">Support</a>');
		
    $actions = array_merge($settings, $actions);
		$actions = array_merge($site_link, $actions);
			
	endif;
		
	return $actions;
}

/**
 * Register the admin stylesheet on our settings page.
 *
 * @since    1.3.0
 */
function dfa_admin_style( $hook ) {
	if( $hook != 'settings_page_' . DFA_SETTINGS )
			return;

	wp_enqueue_style( DFA_PLUGIN_SLUG . 'admin', plugin_dir_url( __FILE__ ) . 'assets/' . DFA_PLUGIN_SLUG . '-admin.css', array(), DFA_VERSION, 'all'  );
}

/**
 * Register the admin menu.
 *
 * @since    1.0.0
 */
function gtm_dfa_admin_menu()
{
	add_submenu_page(
		'options-general.php',		// parent slug
		'Divi Font Awesome',	// page title
		'Divi Font Awesome',	// menu title
		'manage_options',			//capability
		DFA_SETTINGS,			// slug
		'gtm_dfa_settings_page' 		// callback 
	);
}

function gtm_dfa_settings_page()
{
	$license 	= trim( get_option( 'dfa_license_key' ) );
	$status 	= trim( get_option( 'dfa_license_status' ) );

    settings_errors( 'settings_messages' ); ?>
	    
		<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

		<section id="post-body" class="metabox-holder columns-2 gtm_plugin_settings__section">
		
			<form method="post" action="options.php" class="gtm_plugin_settings__form">

				<?php if( DFA_MARKETPLACE && DFA_MARKETPLACE === 'emp' ) : ?>
				<div class="gtm_plugin_settings">
					<table class="form-table">
						<tbody>
							<tr valign="top">
								<th scope="row" valign="top">
									<?php _e('License Key'); ?>
								</th>
								<td>
									<input id="dfa_license_key" name="dfa_license_key" type="text" class="regular-text" value="<?php esc_attr_e( $license ); ?>" />
									<p class="description" for="dfa_license_key"><?php _e('Enter your license key'); ?></p>
								</td>
							</tr>
						<?php if( false !== $license ) { ?>
							<tr valign="top">
								<th scope="row" valign="top">
									<?php _e('Activate License'); ?>
								</th>
								<td>
									<?php if( $status && $status == 'valid' ) { ?>
										<span class="gtm_license_status gtm_license_status--active"><?php _e('License: Active'); ?></span>
										<?php wp_nonce_field( 'dfa_nonce', 'dfa_nonce' ); ?>
										<input type="submit" class="button-secondary" name="dfa_deactivate" value="<?php _e('Deactivate License'); ?>"/>
									<?php } else {
										wp_nonce_field( 'dfa_nonce', 'dfa_nonce' ); ?>
										<input type="submit" class="button-secondary" name="dfa_activate" value="<?php _e('Activate License'); ?>"/>
									<?php } ?>
								</td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
				<?php // If DFA_MARKETPLACE END.
				endif; ?>

				<div class="gtm_plugin_settings">
					<?php
            		settings_fields( DFA_SETTINGS );    
            		do_settings_sections( DFA_SETTINGS );
            		submit_button();
        			?>
				</div>
			</form>
		</section>
		<footer class="gtm_plugin_settings__footer">
			<p>Built with <span class="dashicons dashicons-heart"></span> by Alex Brinkman over at Green Tree Media. Have a great day!</p>
			<p>If this plugin made your life just a little easier, <a href="greentreemediallc.com/twitter" target="_blank">tweet at me</a> and let me know!</p>
		</footer>
	</div><!-- /.wrap -->
	<?php
}

function gtm_dfa_setup_sections() {
	add_settings_section( 'divi_fontawesome_settings', '', 'gtm_dfa_section_callback', DFA_SETTINGS );
}

function gtm_dfa_section_callback( $arguments ) {
	switch( $arguments['id'] ) :
		case 'divi_fontawesome_settings':
			echo '<p>You\'re almost ready to use Font Awesome 
			directly in your Divi Builder!</p>
			<p>You can either load Font Awesome 4.7 locally from your server 
			or use the official Font Awesome CDN, which will help your website load the iconic 
			Font Awesome quickly and reliably.</p>

			<p>If you wish to load Font Awesome locally from your server without making 
			external calls to the CDN, simply leave the <strong>CDN Embed Code ID field below empty</strong>.
			By default the plugin will load Font Awesome locally from your server.</p>
				
			<p>If you wish to use the official CDN, You can get a FREE 
			<a href="https://cdn.fontawesome.com/" target="_blank">Font Awesome 
			CDN account here</a> to get your embed code.</p>';
		break;
	endswitch;
}
    
function gtm_dfa_setup_fields() {
        
    // Our main setting we'll be saving our settings under.
	register_setting( DFA_SETTINGS, DFA_OPTIONS_NAME );
	register_setting( DFA_SETTINGS, 'dfa_license_key' );
        
    $settings = get_option( DFA_OPTIONS_NAME );
        
    // Set variables 
    $fa_embed_code_id 		= isset( $settings['fa_embed_code_id'] ) ? $settings['fa_embed_code_id'] : '';
    $fa_embed_code_format 	= isset( $settings['fa_embed_code_format'] ) ? $settings['fa_embed_code_format'] : '';
             
    $fields = array(
		array(
	    	'uid' => 'fa_embed_code_id',
		    'label' => '<span class="dashicons-before dashicons-cloud gtm_dfa_settings_label_icon">CDN Embed Code ID</span>',
		    'section' => 'divi_fontawesome_settings',
		    'type' => 'text',
		    'options' => false,
		    'placeholder' => 'CDN Embed Code ID',
		    'helper' => '',
		    'supplemental' => '',
		    'default' => $fa_embed_code_id
	    ),
	    array(
	    	'uid' => 'fa_embed_code_format',
		    'label' => '<span class="dashicons-before dashicons-editor-code gtm_dfa_settings_label_icon">Format</span>',
		    'section' => 'divi_fontawesome_settings',
		    'type' => 'select',
		    'options' => array(
		    	'js' => 'JavaScript',
		    	'css' => 'CSS'
		    ),
		    'placeholder' => '',
		    'helper' => '',
		    'supplemental' => 'We\'re happy to serve it up however you\'d prefer. Note: Loading Font Awesome via Javascript is only available using the CDN. 
			If you\'re loading Font Awesome locally from your server, it will 
			always be loaded via CSS, regardless of which format you choose here.',
		    'default' => $fa_embed_code_format
	    )
    );
	   
	foreach( $fields as $field ) :
	        
	    add_settings_field(
	        $field['uid'],
	        $field['label'],          
	        'gtm_dfa_field_callback',
	        DFA_SETTINGS,
	        $field['section'],
	        $field
	    );
	        
	endforeach;
    
}

function gtm_dfa_field_callback( $arguments ) {
	        
	$option_name = DFA_OPTIONS_NAME;
    $value = isset( $arguments['default'] ) ? $arguments['default'] : '';

	// Check which type of field we want
    switch( $arguments['type'] ) :
    	
    	case 'checkbox': // If it is a checkbox field
				if( isset( $arguments['is_toggle'] ) && $arguments['is_toggle'] ) :
					printf( '<input name="%4$s[%1$s]" id="%1$s" type="%2$s" class="tgl tgl-flat" %3$s /><label class="tgl-btn" for="%1$s"></label>', $arguments['uid'], $arguments['type'], ( ( $value == 'on' ) ? 'checked' : ''), $option_name  );
				else :
					printf( '<input name="%4$s[%1$s]" id="%1$s" type="%2$s" %3$s />', $arguments['uid'], $arguments['type'], ( ( $value == 'on' ) ? 'checked' : ''), $option_name );
				endif;
			break;
	        
	    case 'text': // If it is a text field
		    printf( '<input name="%5$s[%1$s]" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', $arguments['uid'], $arguments['type'], $arguments['placeholder'], $value, $option_name );
		break;
		    
		case 'number': // If it is a number field
		    printf( '<input name="%5$s[%1$s]" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', $arguments['uid'], $arguments['type'], $arguments['placeholder'], $value, $option_name );
		break;
	        
	    case 'textarea': // If it is a textarea
		    printf( '<textarea name="%4$s[%1$s]" id="%1$s" placeholder="%2$s" rows="5" cols="50">%3$s</textarea>', $arguments['uid'], $arguments['placeholder'], $value, $option_name );
		break;
	        
	    case 'select': // If it is a select dropdown
		        
		    if( ! empty ( $arguments['options'] ) && is_array( $arguments['options'] ) ) :
			        
			    $options_markup = '';
			        
			    foreach( $arguments['options'] as $key => $label ) :
				    $options_markup .= sprintf( '<option value="%s" %s>%s</option>', $key, selected( $value, $key, false ), $label );
			    endforeach;
			        
			    printf( '<select name="%3$s[%1$s]" id="%1$s">%2$s</select>', $arguments['uid'], $options_markup, $option_name );
		       
		    endif;
		        
		break;
		    
    endswitch;

	// If there is help text
    if( $helper = $arguments['helper'] ) :
        printf( '<span class="helper"> %s</span>', $helper );
	endif;
	
	// If there is a tooltip
	if( $tooltip = isset( $arguments['tooltip'] ) ? $arguments['tooltip'] : false ) :
		printf( '<a href="#" class="gtm-tooltip" data-tooltip="%s"><span class="dashicons dashicons-editor-help"></span></a>', $tooltip );
	endif;

	// If there is supplemental text
    if( $supplimental = $arguments['supplemental'] ) :
        printf( '<p class="description">%s</p>', $supplimental );
    endif;
    
}

function gtm_dfa_fontawesome() {
	$settings = get_option( DFA_OPTIONS_NAME );
	$fa_embed_code_id 		= isset( $settings['fa_embed_code_id'] ) ? $settings['fa_embed_code_id'] : '';
	$fa_embed_code_format 	= isset( $settings['fa_embed_code_format'] ) ? $settings['fa_embed_code_format'] : 'JS';
	
	$fa_url = plugin_dir_url( __FILE__ ) . 'vendor/font-awesome-4.7.0/css/font-awesome.min';

	if( $fa_embed_code_id ) :
		$fa_url = 'https://use.fontawesome.com/' . $fa_embed_code_id;
	endif;
	
	// Load the correct format from the CDN
	if( $fa_embed_code_format === 'js' && $fa_embed_code_id ) :
		wp_enqueue_script( DFA_PLUGIN_SLUG, $fa_url . '.js', array(), DFA_VERSION, false );
	else :
		wp_enqueue_style( DFA_PLUGIN_SLUG, $fa_url . '.css', array(), DFA_VERSION, 'all' );
	endif;
	
	// Load our custom stylesheet
	wp_enqueue_style( DFA_PLUGIN_SLUG . '-custom',  plugin_dir_url( __FILE__ ) . 'assets/' . DFA_PLUGIN_SLUG . '.css', array(), DFA_VERSION, 'all' );
}

function gtm_dfa_public_script() {
	wp_enqueue_script( DFA_PLUGIN_SLUG . '-custom',  plugin_dir_url( __FILE__ ) . 'assets/' . DFA_PLUGIN_SLUG . '.js', array('jquery'), DFA_VERSION, true );
}
		
/**
 * Add Font Awesome icons to Divi.
 *
 * @since    1.0.0
 */
function fa_icons_dfa( $icons ) {
	
	include( plugin_dir_path( __FILE__ ) . 'assets/fontawesome.php' );
		
	foreach( $fontawesome_icons as $icon ) :
		$icons[] = sprintf('%1$s~|%2$s~|%3$s~|%4$s',
		  $icon['unicode'],
		  $icon['name'],
		  $icon['family'],
		  $icon['style']
	  );
	endforeach;
	
  return $icons;
}

/**
 * Add structured ET icons to Divi.
 *
 * @since    1.4.1
 */
function et_icons_dfa( $icons )
{			
	// Ditch the original icons. Deuces.
	$icons = array();
	
	include( plugin_dir_path( __FILE__ ) . 'assets/elegantthemes.php' );
	
	foreach( $elegantthemes_icons as $icon ) :

		$icons[] = sprintf('%1$s~|%2$s~|%3$s~|%4$s',
			$icon['unicode'],
			$icon['name'],
			$icon['family'],
			$icon['style']
		);

	endforeach;

	return $icons;
}

/**
 * Copy of Divi's et_pb_get_font_icon_list_items() function 
 * with the addition of the filter for the output so that we 
 * (and others) can apply their own filters if they wish.
 *
 * @since    1.0.0
 * @since	 1.1.0 Added filter and seperated custom logic from original function
 */
if ( ! function_exists( 'et_pb_get_font_icon_list_items' ) ) :
	
	function et_pb_get_font_icon_list_items()
	{
		$output = '';
			
		$symbols = et_pb_get_font_icon_symbols();

		$filter_triggers = array();
				 																	
		foreach ( $symbols as $symbol ) :

			$icon_data = explode( '~|', $symbol );
	
			if( count($icon_data) > 1 ) :
				
				// Only ET icons in the customizer.
				if ( is_customize_preview() ) :
					if( $icon_data[2] !== 'elegant-themes') :
						continue;
					endif;
				endif;
	
				if(! in_array(esc_attr($icon_data[2]), $filter_triggers) )
					$filter_triggers[] = $icon_data[2];

				$output .= sprintf(
					'<li data-name=\'%1$s\' title=\'%1$s\' data-icon=\'%2$s\' data-family=\'%3$s\' class="divi_font_awesome_icon divi_font_awesome_icon--%3$s"></li>',
					$icon_data[1],
					$icon_data[0],
					$icon_data[2]
				);			

			else :
				$output .= sprintf( '<li data-icon=\'%1$s\' data-family=\'elegant-themes\' class=\'divi_font_awesome_icon divi_font_awesome_icon--elegant-themes\'></li>', esc_attr( $symbol ) );	
			endif;

		endforeach;

		return $output;
	}
endif;

if ( ! function_exists( 'et_pb_process_font_icon' ) ) :
	function et_pb_process_font_icon( $font_icon, $symbols_function = 'default' )
	{
		// the exact font icon value is saved
		if ( 1 !== preg_match( "/^%%/", trim( $font_icon ) ) ) :
			return $font_icon;
		endif;
	
		// the font icon value is saved in the following format: %%index_number%%
		$icon_index   = (int) str_replace( '%', '', $font_icon );
		$icon_symbols = 'default' === $symbols_function ? et_pb_get_font_icon_symbols() : call_user_func( $symbols_function );
		$font_icon    = isset( $icon_symbols[ $icon_index ] ) ? $icon_symbols[ $icon_index ] : '';
		
		// This is the only alteration to this function.
		$font_icon = apply_filters( 'filter_front_icon_dfa', $font_icon );
	
		return $font_icon;
	}
endif;
	
function front_icon_filter_dfa( $font_icon )
{
	if( is_json_dfa( $font_icon ) ) :
		$icon = json_decode( $font_icon, true );
		$icon = $icon['family'] . '-' . $icon['unicode'];
	else :
		$icon = $font_icon;	
	endif;
			
	return $icon;
}

/**
 * Checks if a string is valid json
 *
 * @since    1.4.1
 */
function is_json_dfa( $string )
{
   return is_string( $string ) && is_array( json_decode( $string, true ) ) && ( json_last_error() == JSON_ERROR_NONE ) ? true : false;
}

// /**
//  * Filter to adjust how the icons are output in the Divi Builder.
//  *
//  * @since    1.1.0
//  */
// function gtm_dfa_filter_icon_list( $data ) {
	
// 	$output = '';
		
// 	$symbols = trim( str_replace( "<li data-icon='","", $data ) );
// 	$symbols = explode( "'></li>", $symbols );
// 	$symbols = array_filter( $symbols );
	
// 	foreach ( $symbols as $symbol ) {
		
// 		$fa_check = substr( $symbol, 0, 3 );
						
// 		if( $fa_check === 'fa-' ) :
			
// 			$symbol_parts = explode( '-', $symbol );
// 			$output .= sprintf( '<li data-icon=\'%1$s\' class="fa fa-fw fa-divi-fontawesome-builder"></li>', esc_attr( $symbol_parts[1] ) );
// 		else :
// 			$output .= sprintf( '<li data-icon=\'%1$s\'></li>', esc_attr( $symbol ) );
// 		endif;
// 	}
	
// 	return $output;

// }
// add_filter('gtm_dfa_icon_list_items', 'gtm_dfa_filter_icon_list');