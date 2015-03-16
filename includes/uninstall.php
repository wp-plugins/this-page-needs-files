<?php
// important: no namespace for ths file! PHP 5.0+ Compatible!
if (!defined('BE_MCH_TPNF')) {
	return;
}

function tpnf_uninstall()
{
	delete_option('be_mch_tpnf_working');
}