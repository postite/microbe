<?php

class microbe_tools_Debug {
	public function __construct(){}
	static $debug = false;
	static function Alerte($str, $pos = null) {
	}
	function __toString() { return 'microbe.tools.Debug'; }
}
