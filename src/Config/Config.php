<?php

namespace Nameday\Config;

class Config {

	static $configArray = array();

	public static function setConfig($configArray) {
		self::$configArray = $configArray;
	}

	public static function getConfig($param = null, $default = null) {
		if (is_null($param)) {
			return self::$configArray;
		}

		return isset(self::$configArray[$param]) ? self::$configArray[$param] : $default;
	}
}