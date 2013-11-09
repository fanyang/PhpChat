<?php
/**
 * 一些工具函数
 */


/**
 * 获取ip归属地，接口用法：http://ip.taobao.com/instructions.php
 * @param string $ip ip地址
 * @return string ip归属地信息，如：中国广东省广州市
 */
function getIpInfo($ip) {
	$ipJson = file_get_contents("http://ip.taobao.com/service/getIpInfo.php?ip=".$ip);
	$ipJson = json_decode($ipJson, true);
	
	if ($ipJson['code'] == 1) {
		return "未知地址";
	} else {
		return ($ipJson['data']['country'] . $ipJson['data']['region'] . $ipJson['data']['city']);
	}

}


/**
 * 根据ip地址产生用户名
 * @param  string $ip ip地址
 * @return string 产生的用户名，如：中国广东省广州市网友218.192.*.*
 */
function genName($ip) {
	$ipInfo = getIpInfo($ip);
	
	$ipArray = explode('.', $ip);
	$ipArray[2] = '*';
	$ipArray[3] = '*';
	$ip = implode('.', $ipArray);
	
	$name = $ipInfo . "网友" .$ip;
	return $name;
}


/**
 * 获取当前消息id
 * @return number 当前消息id
 */
function getCurrentMessageId() {
	$result = mysql_query("SELECT MAX(id) maxID FROM `message`");
	$row = mysql_fetch_assoc($result);
	return $row['maxID']?$row['maxID']:0;
}


/**
 * 用户首次登陆时进行初始化
 * SESSION data:
 * currentMessageId
 * username
 */
function loginInit() {
	
	$_SESSION['username'] = genName($_SERVER['REMOTE_ADDR']);
	$_SESSION['currentMessageId'] = getCurrentMessageId();
	
}

/**
 * 检查是否登录
 * @return boolean 是否登录
 */
function isLogin() {
	return isset($_SESSION['username']);

}



/**
 * 对返回的消息进行封装
 * @author think
 *
 */
class Message {
	private $username;
	private $time;
	private $msg;

	function __construct($username, $time, $msg) {
		$this->username = $username;
		$this->time = $time;
		$this->msg = $msg;
	}

	function toArray() {
		return array('username' => $this->username,
				'time' => $this->time,
				'msg' => $this->msg,
		);
	}
}















