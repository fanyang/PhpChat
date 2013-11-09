<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Web聊天室</title>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="room.js?0178"></script>
<link href="room.css?0166" rel="stylesheet" type="text/css" charset="utf-8" />
</head>
<body>
<div id="msgs"></div>
<div>
	<input type="text" maxlength="500" id="input_msg" />
	<input type="button" value="发送" id="send_button" />
</div>
<div id="emo">
	<?php for ($i = 0; $i <=9; $i++):?>
		<a href="javascript:makeEm(<?php echo $i;?>);">
		<img src="face/<?php echo $i;?>.gif" />
		</a>
	<?php endfor;?>
</div>

</body>
</html>