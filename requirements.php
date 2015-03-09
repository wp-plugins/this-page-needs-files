<?php
defined('BE_MCH_TPNF')||die();

/*
function tpnf_err_spl_types() {
	$data = tpnf_plugin_data();
    ?>
    <div class="error">
    	<h1><?php echo($data['Name']); ?></h1>
        <p>SPL Types library (<a href="http://php.net/manual/en/install.pecl.downloads.php" target="_new">PECL</a>) required</p>
    </div>
    <?php
}

if (!extension_loaded('spl_types')) {
	add_action( 'admin_notices', 'tpnf_err_spl_types' );
	
	return false;
}
*/

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

return true;