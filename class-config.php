<?php
class Config {
 
	private static $instance = NULL;
	private static $dsn      = "pgsql:host=localhost;dbname=pendataan;port=5432;";
	private static $db_user  = 'postgres';
	private static $db_pass  = 'd4p0d1kd452013!';
 
	private function __construct() {
	}

	private function __clone() {
	}
	
	public static function getInstance() {
		if (!self::$instance) {
			self::$instance = new PDO(self::$dsn, self::$db_user, self::$db_pass);
			self::$instance-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		return self::$instance;
	}
}
