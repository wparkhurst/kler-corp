<?php

define( 'DFA_AUTHOR', 'Alex Brinkman' );
define( 'DFA_STORE_URL', 'https://elegantmarketplace.com' ); 
define( 'DFA_PRODUCT_NAME', 'Divi Font Awesome' ); 
define( 'DFA_PRODUCT_ID', '382976');

if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {
	// load our custom updater
	include( dirname( DFA_PLUGIN_FILE ) . '/update/EDD_SL_Plugin_Updater.php' );
}

function dfa_prod_updater() {

	// retrieve our license key from the DB
	$dfa_license = trim( get_option('dfa_license_key') );
	
	// setup the updater
	$edd_updater = new EDD_SL_Plugin_Updater( DFA_STORE_URL, DFA_PLUGIN_FILE, array(
			'version' 	=> DFA_VERSION, 		// current version number
			'license' 	=> $dfa_license, 		// license key (used get_option above to retrieve from DB)
			'item_name' => DFA_PRODUCT_NAME, 	// name of this plugin
			'item_id'	=> DFA_PRODUCT_ID,		// ID of your EMP product as shown in EMP dashboard
			'author' 	=> DFA_AUTHOR,  		// author of this plugin
			'beta'		=> false,
		)
	);

}
add_action( 'admin_init', 'dfa_prod_updater');

function dfa_activate_license() {

	// listen for our activate button to be clicked
	if( isset( $_POST['dfa_activate'] ) ) {

		// run a quick security check
	 	if( ! check_admin_referer( 'dfa_nonce', 'dfa_nonce' ) )
			return; // get out if we didn't click the Activate button

		register_setting( DFA_SETTINGS, 'dfa_license_status' );

		// retrieve the license.
		$license = ( isset( $_POST['dfa_license_key'] ) && $_POST['dfa_license_key'] ) ? trim( $_POST['dfa_license_key'] ) : trim( get_option( 'dfa_license_key' ) );

		// data to send in our API request
		$api_params = array(
			'edd_action' => 'activate_license',
			'license'    => $license,
			'item_name'  => urlencode( DFA_PRODUCT_NAME ), // the name of our product in EDD
			'url'        => home_url()
		);

		// Call the custom API.
		$response = wp_remote_post( DFA_STORE_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {

			if ( is_wp_error( $response ) ) {
				$message = $response->get_error_message();
			} else {
				$message = __( 'An error occurred, please try again.' );
			}

		} else {

			$license_data = json_decode( wp_remote_retrieve_body( $response ) );

			if ( false === $license_data->success ) {

				switch( $license_data->error ) {

					case 'expired' :

						$message = sprintf(
							__( 'Your license key expired on %s.' ),
							date_i18n( get_option( 'date_format' ), strtotime( $license_data->expires, current_time( 'timestamp' ) ) )
						);
						break;

					case 'revoked' :

						$message = __( 'Your license key has been disabled.' );
						break;

					case 'missing' :

						$message = __( 'Invalid license.' );
						break;

					case 'invalid' :
					case 'site_inactive' :

						$message = __( 'Your license is not active for this URL.' );
						break;

					case 'item_name_mismatch' :

						$message = sprintf( __( 'This appears to be an invalid license key for %s.' ), DFA_PRODUCT_NAME );
						break;

					case 'no_activations_left':

						$message = __( 'Your license key has reached its activation limit.' );
						break;

					default :

						$message = __( 'An error occurred, please try again.' );
						break;
				}

			}

		}

		// Check if anything passed on a message constituting a failure
		if ( ! empty( $message ) ) {
			$base_url = admin_url( 'options-general.php?page=' . DFA_SETTINGS );
			$redirect = add_query_arg( array( 'sl_activation' => 'false', 'message' => urlencode( $message ) ), $base_url );

			wp_redirect( $redirect );
			exit();
		}

		// $license_data->license will be either "valid" or "invalid"
		update_option( 'dfa_license_status', $license_data->license );
		update_option( 'dfa_license_key', $license );

		wp_redirect( admin_url( 'options-general.php?page=' . DFA_SETTINGS ) );
		exit();
	}
}
add_action('admin_init', 'dfa_activate_license');

function dfa_deactivate_license() {

	// listen for our activate button to be clicked
	if( isset( $_POST['dfa_deactivate'] ) ) {

		// run a quick security check
	 	if( ! check_admin_referer( 'dfa_nonce', 'dfa_nonce' ) )
			return; // get out if we didn't click the Activate button

		// retrieve the license from the database
		$license = trim( get_option( 'dfa_license_key' ) );

		// data to send in our API request
		$api_params = array(
			'edd_action' => 'deactivate_license',
			'license'    => $license,
			'item_name'  => urlencode( DFA_PRODUCT_NAME ), // the name of our product in EDD
			'url'        => home_url()
		);

		// Call the custom API.
		$response = wp_remote_post( DFA_STORE_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {

			if ( is_wp_error( $response ) ) {
				$message = $response->get_error_message();
			} else {
				$message = __( 'An error occurred, please try again.' );
			}

			$base_url = admin_url( 'options-general.php?page=' . DFA_SETTINGS );
			$redirect = add_query_arg( array( 'sl_activation' => 'false', 'message' => urlencode( $message ) ), $base_url );

			wp_redirect( $redirect );
			exit();
		}

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "deactivated" or "failed"
		if( $license_data->license == 'deactivated' || $license_data->license == 'failed' ) {
			delete_option( 'dfa_license_status' );
		}

		wp_redirect( admin_url( 'options-general.php?page=' . DFA_SETTINGS ) );
		exit();

	}
}
add_action('admin_init', 'dfa_deactivate_license');

/**
 * This is a means of catching errors from the activation method above and displaying it to the customer
 */
function dfa_admin_notices() {
	if ( isset( $_GET['sl_activation'] ) && ! empty( $_GET['message'] ) ) {

		switch( $_GET['sl_activation'] ) {

			case 'false':
				$message = urldecode( $_GET['message'] );
				?>
				<div class="error">
					<p><?php echo $message; ?></p>
				</div>
				<?php
				break;

			case 'true':
			default:
				// Developers can put a custom success message here for when activation is successful if they way.
				break;

		}
	}
}
add_action( 'admin_notices', 'dfa_admin_notices' );