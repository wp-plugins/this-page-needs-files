<?php
/**
 * Plugin Name: This page needs file
 * Description: Allow to include urls to javascript and css files inside the HTML header on a page/post specifc basis.
 * Version: 1.0.4
 * Date: 16/03/2015
 * Author: Jacquemin Serge
 * Author URI: http://www.mch.be
**/
// important: no namespace for ths file! PHP 5.0+ Compatible!
define('BE_MCH_TPNF', true);
define('BE_MCH_TPNF_FILE', __FILE__);

function tpnf_plugin_data() {
	return get_plugin_data(BE_MCH_TPNF_FILE);
}

include(dirname(BE_MCH_TPNF_FILE) . '/includes/requirements.php');
register_activation_hook(BE_MCH_TPNF_FILE, 'tpnf_check_requirements');

include(dirname(BE_MCH_TPNF_FILE) . '/includes/uninstall.php');
register_deactivation_hook(BE_MCH_TPNF_FILE, 'tpnf_uninstall');

$be_mch_tpnf_working = (int)get_option('be_mch_tpnf_working', -1);
if ($be_mch_tpnf_working === -1) {
	require_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
	// Either the plugin is inactive either its "working value" should be set
	if (!is_plugin_active(basename(dirname(BE_MCH_TPNF_FILE)) . '/' . basename(BE_MCH_TPNF_FILE))) {
		return;	
	}
	
	$be_mch_tpnf_working = 0;
}

if ($be_mch_tpnf_working === 0) {
	// maybe plugin could start "working" due to its activation or a change of environement
	$be_mch_tpnf_working = tpnf_check_requirements() ? 1 : 0;
}

if ($be_mch_tpnf_working === 1) {
	try {
		include(dirname(BE_MCH_TPNF_FILE) . '/includes/program.php');
	}
	catch (Exception $e) {
		require_once(dirname(BE_MCH_TPNF_FILE) . '/includes/error.php');
		
		$msg = new BE_MCH_TPNF_Error($e->getMessage());
		add_action('admin_notices', array($msg, 'display'));
		
		// maybe plugin isn't "working" anymore due to a change of environement
		tpnf_check_requirements();
	}
}
