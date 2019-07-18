<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Module Functions
*/

	/**
	 * Plugin Updater
	 * @since  1.0.3
	*/
    require_once('plugin_update_check.php');
    $KernlUpdater = new PluginUpdateChecker_2_0 (
        'https://kernl.us/api/v1/updates/5d0d47052ceb932b9673d488/',
        __FILE__,
        'et_pb_dcsbcm_divi_breadcrumbs_module',
        1
    );