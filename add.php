<?php
/**
 * 插入一条消息到数据库
 */

include 'common.php';


if (!Login::isLogin()) exit;

$db->insertMessage($_POST['msg']);