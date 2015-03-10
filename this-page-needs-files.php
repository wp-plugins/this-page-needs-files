<?php
/**
 * Plugin Name: This page needs file
 * Description: Allow to include urls to javascript and css files inside the HTML header on a page/post specifc basis.
 * Version: 1.0.1
 * Date: 09/03/2015
 * Author: Jacquemin Serge
 * Author URI: http://www.mch.be
**/
namespace be\mch\tpnf;

define('BE_MCH_TPNF', true);

function tpnf_plugin_data() {
	return get_plugin_data(__FILE__);
}

if (!include('requirements.php')) {
	// requirements not met
	return;
}

require_once(dirname(__FILE__) . '/model/urls.php');
require_once(dirname(__FILE__) . '/binder/main2urls.php');

if(is_admin()) {
	function tpnf_load_admin_scripts() {
		wp_enqueue_style('tpnf-main', plugins_url('css/main.css', __FILE__));
		wp_enqueue_script('tpnf-main', plugins_url('js/main.js', __FILE__));
	}
	add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\tpnf_load_admin_scripts' );
	
	function tpnf_add_meta_boxes() {
		add_meta_box( 
			'tpnf_meta_box'
			, 'This page needs files'
			, __NAMESPACE__ . '\tpnf_main'
			, null
			, 'advanced'
			, 'high'
		);
    }
	add_action('add_meta_boxes', __NAMESPACE__ . '\tpnf_add_meta_boxes');	
	
	function tpnf_save_meta_box($post_id) {
		$urls = tpnf_binder_main2urls();
		
//		die(json_encode($urls));
		
		if($urls != null) {
			if (count($urls->Urls) > 0) {
				update_post_meta($post_id, 'tpnf_urls', json_encode($urls));
			}
			else {
				delete_post_meta($post_id, 'tpnf_urls');
			}
		}
	}
	add_action('save_post', __NAMESPACE__ . '\tpnf_save_meta_box');
	
	
	function tpnf_deleted_meta_box($post_id) {
		delete_post_meta($post_id, 'tpnf_urls');
	}
	add_action('delete_post', __NAMESPACE__ . '\tpnf_deleted_meta_box');
	
	function tpnf_main() {
		global $post;
		
		$model = new TPNF_Model_Main();
		
		$model->Urls = tpnf_binder_main2urls();
		
		if ($model->Urls == null) {
			$meta = get_post_meta($post->ID, 'tpnf_urls', true);
			
			if (strlen($meta) > 0) {
				$std = json_decode($meta);
		
				$model->Urls = TPNF_Model_Urls::Cast($std);
			} else {			
				$model->Urls = new TPNF_Model_Urls();
			}
		}

		$model->Urls->Urls[] = new TPNF_Model_Url();
		
    	include __DIR__ . '/templates/main.php';
    }
}

// Site specific code.
if(!is_admin()) {
	function tpnf_load_main_script() {
		wp_enqueue_script('be_mch_tpnf-main',  plugins_url('js/frontend.js', __FILE__));
	}
	
	function tpnf_acknowledge_footer() {
		echo(
			'<script>Be_Mch_Tpnf.HasFooter = true;</script>'
		);
	}
	
	function tpnf_excecute_client_scripts($line) {
		static $lines = array();
		
		if (strlen($line) > 0) {
			$lines[] = $line;
			
			return;
		}
		
		echo(sprintf(
			'<script>Be_Mch_Tpnf.Excecute([%1$s]);</script>'
			, implode(',', $lines)
		));
	}
	
	function tpnf_load_client_scripts($post) {
		static $tmpID = 0, $hooked = false, $postsID = array();
		
		if(empty($post)) {
			return;
		}

		// Once per post		
		if (isset($postsID[$post->ID])) {
			return;
		}
		$postsID[$post->ID] = true;

		$meta = get_post_meta($post->ID, 'tpnf_urls', true);
		
		if (strlen($meta) < 1) {
			return;
		}
		
//		die(print_r($meta, true));
		
		$std = json_decode($meta);

		$model = new TPNF_Model_Main();
		$model->Urls = TPNF_Model_Urls::Cast($std);
		
//		die(print_r($model, true));
		
		foreach($model->Urls->Urls as $aUrl) {
			++$tmpID;
			
			$ref = sprintf('be_mch_tpnf-%d', $tmpID);
			$url = sprintf('%1$s%2$s', $model->Relatives[$aUrl->Relative]->Path, $aUrl->File);
			
			switch ($aUrl->Type) {
				case TPNF_Model_Url_EType::Css:
					wp_enqueue_style($ref, $url);
					$ext = 'css';
					break;
				case TPNF_Model_Url_EType::Js:
					// room for improvement
					wp_enqueue_script($ref, 'http://0.0.0.0/' . $ref . '/#' . $url);
					$ext = 'js';
					break;
				default:
					continue;
					break;
			}
			
			tpnf_excecute_client_scripts(sprintf(
				'{Ref:"%1$s",ID:"%2$s",Priority:"%3$s",Type:"%4$s"}'
				, $ref
				, $aUrl->ID
				, $aUrl->Priority
				, $ext
			));
		}
		
		if (!$hooked) {
			add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\tpnf_load_main_script' );
			add_action( 'wp_footer', __NAMESPACE__ . '\tpnf_acknowledge_footer' );
			add_action( 'wp_footer', __NAMESPACE__ . '\tpnf_excecute_client_scripts' );
			$hooked = true;
		}
	}
	add_action( 'the_post', __NAMESPACE__ . '\tpnf_load_client_scripts' );
}