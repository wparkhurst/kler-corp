<?php

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

delete_option( 'divi_fontawesome_gtm_settings' );
delete_option( 'dfa_license_key' );
delete_option( 'dfa_license_status' );