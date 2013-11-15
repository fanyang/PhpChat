<?php
class Ip {

	
	/**
	 * 根据ip地址产生用户名
	 * @param  string $ip ip地址
	 * @return string 产生的用户名，如：中国广东省广州市网友218.192.*.*
	 */
	static function genName($ip) {
		$ipInfo = self::getIpInfo($ip);
	
		$ipArray = explode('.', $ip);
		$ipArray[2] = '*';
		$ipArray[3] = '*';
		$ip = implode('.', $ipArray);
	
		$name = $ipInfo . "网友" .$ip;
		return $name;
	}
	
	/**
	 * 获取ip归属地，接口用法：http://ip.taobao.com/instructions.php
	 * @param string $ip ip地址
	 * @return string ip归属地信息，如：中国广东省广州市
	 */
	static function getIpInfo($ip) {
		$ipJson = file_get_contents("http://ip.taobao.com/service/getIpInfo.php?ip=" . $ip);
		$ipJson = json_decode($ipJson, true);
	
		if ($ipJson['code'] == 1) {
			return "未知地址";
		} else {
			return ($ipJson['data']['country'] . $ipJson['data']['region'] . $ipJson['data']['city']);
		}
	
	}
}