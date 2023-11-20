
<?php
	class Database {
		//viejadatabase
		//private static $dbName = 'id21496293_esp32_mc_db'; // Example: private static $dbName = 'myDB';
		//private static $dbHost = 'localhost'; // Example: private static $dbHost = 'localhost';
		//private static $dbUsername = 'id21496293_root'; // Example: private static $dbUsername = 'myUserName';
		//private static $dbUserPassword = 'Nodotecnologico*123'; // // Example: private static $dbUserPassword = 'myPassword';
		//nuevadatabase
		private static $dbName = 'id21496293_dasbhoard_error2'; // Example: private static $dbName = 'myDB';
		private static $dbHost = 'localhost'; // Example: private static $dbHost = 'localhost';
		private static $dbUsername = 'id21496293_psiconervio'; // Example: private static $dbUsername = 'myUserName';
		private static $dbUserPassword = 'Psiconervio*1'; // // Example: private static $dbUserPassword = 'myPassword';
		 
		private static $cont  = null;
		 
		public function __construct() {
			die('Init function is not allowed');
		}
		 
		public static function connect() {
      // One connection through whole application
      if ( null == self::$cont ) {     
        try {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword); 
        } catch(PDOException $e) {
          die($e->getMessage()); 
        }
      }
      return self::$cont;
		}
		 
		public static function disconnect() {
			self::$cont = null;
		}
	}
?>