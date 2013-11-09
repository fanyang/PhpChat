<?php
/**
 * 插入一条消息到数据库
 */

include 'common.php';


if (!isLogin()) {
	exit;
}


$msg = addslashes($_POST['msg']);
if (strlen($msg) < 1 || strlen($msg) > 1000) exit;

$uname = $_SESSION['username'];

$uid = session_id();

$create_at = time();


$sql = "INSERT INTO `message`(`id`, `uname`, `uid`, `create_at`, `content`) 
		VALUES (NULL,'{$uname}','{$uid}','{$create_at}','{$msg}')";

mysql_query($sql);