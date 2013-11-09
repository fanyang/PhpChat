<?php
/**
 * 公共调用文件
 */

//define('ENV', 'SERVER');
define('ENV', 'LOCAL');

switch (ENV) {
	case 'SERVER' :
		error_reporting(E_ALL & ~E_DEPRECATED);
		$db = array('host' => "liaotian.db.10829965.hostedresource.com",
				'username' => "liaotian",
				'password' => "Liaotian123!",
				'dbname' => "liaotian"
			
		);
		break;
	case 'LOCAL' :
		error_reporting(E_ALL | E_STRICT);
		$db = array('host' => "localhost",
				'username' => "root",
				'password' => "",
				'dbname' => "chat_room"
		
		);
		break;
}


include 'functions.php';

set_time_limit(180);
define("MAX_COUNT", 60);
define("USLEEP_TIME", 1000000);

session_start();


mysql_connect($db['host'], $db['username'], $db['password']);
mysql_select_db($db['dbname']);
mysql_set_charset("utf8");



