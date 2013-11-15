<?php
/**
 * 公共调用文件
 */

include 'config/development.php';

include 'lib/Db.class.php';
include 'lib/Login.class.php';
include 'lib/Ip.class.php';
include 'lib/Message.class.php';


session_start();

$db = new Db($config['db']['host'], $config['db']['username'], 
		$config['db']['password'], $config['db']['dbname']);
