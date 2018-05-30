<?php
	namespace handler\db;
	use \PDO;
	
	class db {
		// Store a single instance of this class:
		static private $_instance = NULL;

		// Store settings:
		private $_settings = array();
		public $con;
		// Private methods cannot be called:
		private function __construct() {}
		private function __clone() {}

		// Method for returning the instance:
		static function getInstance() {
			if (self::$_instance == NULL) {
				self::$_instance = new db();
				self::$_instance->connect();
			}
			return self::$_instance;
		}

		public function connect() {
			$dsn = 'mysql:dbname='.DBNAME.';host='.HOST.';charset=UTF8';
			try{
				
				$this->con = new \PDO($dsn, PATIENTS_USERNAME, PATIENTS_PASSWORD);
				$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch (PDOException $e) {
				return false;
			}
		}
		
		function disconnect() {
			$this->con = false;
		}
		
		
	}
	// Method for retrieving a setting:
