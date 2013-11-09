$(getMessage);


$(function(){
	$("#input_msg").focus();
	$("#send_button").click(sendMessage);
	$("#input_msg").bind('keypress', function(e) {
		if(e.keyCode==13){
			sendMessage();
		}
	});
});


/*
 * 获取消息
 */
function getMessage(){
	$.getJSON("get.php", function(data,status){
		if (data.length > 0) {
			$.each(data,function(key,value){
				displayMessage(value.username, 
						new Date(value.time * 1000), 
						value.msg);
				});
			}
			
		getMessage();
		  });

	}


/*
 * 发送消息
 */
function sendMessage() {
	message = $("#input_msg").val();
	
	if (!message) return;
	$("#input_msg").val("");
	$("#input_msg").focus();
	
		
	myName = "<span class=\"spName\">我</span>";
	
	displayMessage(myName, new Date(), message);
	
	$.post("add.php",
			{msg: message},
			function(data,status){
	  });
}


/*
 * 显示消息
 */
function displayMessage(username, time, message) {
	time = dateFormat(time);
	message = msgFormat(message);
	
	$("#msgs").append("<span class='username'>" 
			+ username
			+ "<span style='display: inline-block; width: 35px'></span>"
			+ time
			+ "</span><br />"
			);
	$("#msgs").append("&nbsp;&nbsp;" + message + "<br /><br />");
	$("#msgs").scrollTop(9999999);
}


/*
 * 格式化时间
 */
function dateFormat(d) {
	hour = d.getHours();
	minute = d.getMinutes();
	second = d.getSeconds();
	if (hour >= 12) {
		if (hour != 12) hour -= 12;
		ap = "PM";
	} else {
		if (hour == 0) hour = 12;
		ap = "AM";
	}
	
	if (hour < 10) hour = "0" + hour;
	if (minute < 10) minute = "0" + minute;
	if (second < 10) second = "0" + second;
	
	return hour + ":" + minute + ":" + second + " " + ap;
}

/*
 * 格式化消息
 */
function msgFormat(message) {
	return escapeHtml(message).replace(/{:(\d):}/g, "<img src=\"face/$1.gif\" />");
}


/*
 * 过滤html字符
 */
function escapeHtml(text) {
	  return text
	      .replace(/&/g, "&amp;")
	      .replace(/</g, "&lt;")
	      .replace(/>/g, "&gt;")
	      .replace(/"/g, "&quot;")
	      .replace(/'/g, "&#039;");
}

/*
 * 添加表情
 */
function makeEm(e){
	$("#input_msg").val($("#input_msg").val() + "{:" + e + ":}");
	$("#input_msg").focus();
}


