<?php
// important: no namespace for ths file! PHP 5.0+ Compatible!
if (!defined('BE_MCH_TPNF')) {
	return;
}

function tpnf_check_requirements()
{
	static $alreadyChecked = false;
	
	if ($alreadyChecked) {
		return;
	}
	$alreadyChecked = true;
	
	// Not "working" until proven otherwise
	update_option('be_mch_tpnf_working', 0);
	
	function tpnf_err_php() {
		$data = tpnf_plugin_data();
		?>
		<div class="error">
			<h1><?php echo($data['Name']); ?></h1>
			<p>PHP >= 5.3.0 required</p>
		</div>
		<?php
	}
	if (version_compare(PHP_VERSION, '5.3.0') < 0) {
		add_action( 'admin_notices', 'tpnf_err_php' );
		
		return false;
	}
	
	function tpnf_err_php_getConstants() {
		$data = tpnf_plugin_data();
		?>
		<div class="error">
			<h1><?php echo($data['Name']); ?></h1>
			<p>This version of PHP doesn't support <a href="php.net/manual/reflectionclass.getconstants.php" target="_blank">getConstants</a></p>
		</div>
		<?php
	}
	try {
		$ref = new ReflectionClass(Directory);
		$ref->getConstants();
	}
	catch (Exception $e) {
		add_action( 'admin_notices', 'tpnf_err_php_getConstants' );
		
		return false;	
	}

	// "Working"
	update_option('be_mch_tpnf_working', 1);	
	
	return true;
}