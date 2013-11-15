<?php
/**
 * 从数据库中获取消息并返回
 */

include 'common.php';
header("Content-Type: application/json; charset=utf-8");

//首次登陆，进行初始化，发送欢迎信息。
if (!Login::isLogin()) {
	Login::loginInit($db);
	
	$msg = new Message("<span class=\"spName\">系统消息</span>", time(), "欢迎你：" . $_SESSION['username']);
	$msgArray = array($msg->toArray());
	echo json_encode($msgArray);
	exit;
}


//非首次登陆


$count = 0;
$currentMessageId = $_SESSION['currentMessageId'];
$sessionId = session_id(); //用作用户唯一标识
session_write_close(); //关闭session文件，避免block
/*
 * 从数据库里找出比当前msgid大的全部信息
 * 如果有，把信息用json格式输出，并设置新的msg id
 * 如果没有继续循环
 */

while($count <= MAX_COUNT) {
	$result = $db->getCurrentMessage($currentMessageId, $sessionId);
	$numRows = count($result);

	if ($numRows > 0) {
		$msgs = array();
		for ($i = 0; $i < $numRows; $i++) {
			if ($result[$i]['id'] > $currentMessageId) $currentMessageId = $result[$i]['id'];

			$msg = new Message($result[$i]['uname'], $result[$i]['create_at'], $result[$i]['content']);
			$msgs[] = $msg->toArray();
		}
		
		session_start();//重新启动session设置msg id
		$_SESSION['currentMessageId'] = $currentMessageId;
		
		echo json_encode($msgs);
		
		exit;
	}
	
	usleep(USLEEP_TIME);
	$count++;
}

//没有新消息，返回一个空数组
echo json_encode(array());




