<?php
class Login {
	/**
	 * 用户首次登陆时进行初始化
	 * SESSION data:
	 * currentMessageId
	 * username
	 */
	static function loginInit($db) {

		$_SESSION['username'] = Ip::genName($_SERVER['REMOTE_ADDR']);
		$_SESSION['currentMessageId'] = $db->getCurrentMessageId();
	
	}
	
	/**
	 * 检查是否登录
	 * @return boolean 是否登录
	 */
	static function isLogin() {
		return isset($_SESSION['username']);
	
	}
}