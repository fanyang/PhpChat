<?php
/**
 * 对返回的消息进行封装
 * @author Fan Yang
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