<?php
namespace be\mch\tpnf;

// Help figuring when a method didn't run properly
class TPNF_Emergency {
	static $registered = array();
	static $invalidCount = 0;
	var $method = null;
	
	static function validate_all() {
		if (defined('BE_MCH_ACTUNV')) {
			new \BE_MCH_ACTUNV_messenger('validate_all ' . self::$invalidCount);
		}
		
		// Emergency is now 100% OK
		\BE_MCH_TPNF_VARS::$emergency = BE_MCH_TPNF_EMERGENCY_OK;
		
		// Valid?
		if (self::$invalidCount == 0) {
			// OK
			\BE_MCH_TPNF_VARS::$working = BE_MCH_TPNF_WORKING_OK;
			return;
		}
		
		// Unexpected error
		\BE_MCH_TPNF_VARS::$working = BE_MCH_TPNF_WORKING_ERROR;
		
		foreach(self::$registered as $k => $v) {
			if ($v > 0) {
				\BE_MCH_TPNF_VARS::add_error(sprintf(
					'%1$s didn\'t validate itself (%2$d time(s))'
					, $k
					, $v
				));
			}
		}
		
		if (defined('BE_MCH_ACTUNV')) {
			new \BE_MCH_ACTUNV_messenger('working? ' . \BE_MCH_TPNF_VARS::$working);
		}
		
		//sleep(7);
	}
	
	function __construct($method) {
		self::hook_validate_all();
		
		$this->method = $method;
		
		if (self::$invalidCount == 0) {
			// Emergency is now KO
			\BE_MCH_TPNF_VARS::$emergency = BE_MCH_TPNF_EMERGENCY_KO;
			\BE_MCH_TPNF_VARS::store_variable(BE_MCH_TPNF_EMERGENCY);
		}
		
		if (!isset(self::$registered[$this->method])) {
			self::$registered[$this->method] = 0;
			++self::$invalidCount;
		}
		++self::$registered[$this->method];
		
		if (defined('BE_MCH_ACTUNV')) {
			new \BE_MCH_ACTUNV_messenger('BE_MCH_TPNF_EMERGENCY: ' . \BE_MCH_TPNF_VARS::$emergency);
		}
	}
	
	function validate() {
		if (--self::$registered[$this->method] == 0) {
			unset(self::$registered[$this->method]);
			if (--self::$invalidCount == 0) {
				// Emergency is now (somewhat) OK
				\BE_MCH_TPNF_VARS::$emergency = BE_MCH_TPNF_EMERGENCY_OK;
				\BE_MCH_TPNF_VARS::store_variable(BE_MCH_TPNF_EMERGENCY);
			}
		};
		
		if (defined('BE_MCH_ACTUNV')) {
			new \BE_MCH_ACTUNV_messenger('validate: ' . \BE_MCH_TPNF_VARS::$emergency);
		}
	}
	
	static function has_properly_run() {
		if (defined('BE_MCH_ACTUNV')) {
			new \BE_MCH_ACTUNV_messenger('has_properly_run: ' . \BE_MCH_TPNF_VARS::$emergency);
		}
		
		if (\BE_MCH_TPNF_VARS::$emergency === BE_MCH_TPNF_EMERGENCY_KO) {
			// Potent fatal error
			\BE_MCH_TPNF_VARS::$working = BE_MCH_TPNF_WORKING_FATAL;
			if (defined('BE_MCH_ACTUNV')) {
				new \BE_MCH_ACTUNV_messenger('BE_MCH_TPNF_WORKING_FATAL !!!');
			}
		}
	}
	
	static function hook_validate_all() {
		static $hooked = false;
		
		if ($hooked) {
			return;
		}

		add_action('shutdown', array(__NAMESPACE__ . '\TPNF_Emergency', 'validate_all'));
		
		$hooked = true;
	}
}
TPNF_Emergency::has_properly_run();
?>