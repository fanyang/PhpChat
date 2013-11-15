<?php
class Db {

	private $conn;
	
	function __construct($host, $username, $password, $dbname) {
		$this->conn = new mysqli($host, $username, $password, $dbname);
		$this->conn->set_charset("utf8");
	}
	
	/**
	 * 获取当前消息id
	 * @return number 当前消息id
	 */
	function getCurrentMessageId() {
		$result = $this->conn->query("SELECT MAX(id) maxID FROM `message`");
		$row = $result->fetch_assoc();
		return $row['maxID'] ? $row['maxID'] : 0;
	}
	
	
	function getCurrentMessage($currentMessageId, $sessionId) {
		$resultSet = $this->conn->query("SELECT * FROM `message`
				WHERE (`id` > {$currentMessageId}) AND (`uid` <> '{$sessionId}')");
		
		$result = array();
		while ($row = $resultSet->fetch_assoc()) {
			$result[] = $row;
		}
		
		return $result;
		
	}
	
	
	function insertMessage($message) {
		$msg = addslashes($message);
		if (strlen($msg) < 1 || strlen($msg) > 1000) return false;
		
		$uname = $_SESSION['username'];
		
		$uid = session_id();
		
		$create_at = time();
		$sql = "INSERT INTO `message`(`id`, `uname`, `uid`, `create_at`, `content`)
		VALUES (NULL,'{$uname}','{$uid}','{$create_at}','{$msg}')";
		
		return $this->conn->query($sql);
	}
}