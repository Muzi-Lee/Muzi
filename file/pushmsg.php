<?php

date_default_timezone_set("Etc/GMT-8");

function input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

include './file/conn.php';

$nicknameErr=$qqErr=$mailErr=$messageErr="";
$face=$nickname=$qq=$mail=$message="";
$belong=null;
$flag=1;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$face=$_POST['face'];
	
  if (empty($_POST['nickname'])) {
    $nicknameErr = "昵称是必填的哟！";
	$flag=0;
  } else {
    $nickname=input($_POST['nickname']);
  }
  
  if (empty($_POST["qq"])) {
    $qq = "";
  } else {
    	$qq = input($_POST["qq"]);
		if(strlen($qq) < 5 || strlen($qq) > 10){
			$qqErr = "QQ号格式错误";
		}
  }

  if (empty($_POST["email"])) {
    $mail = "";
  } else {
		$email = input($_POST["email"]);
		if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
			$mailErr = "无效的 email 格式！";
		}
  }

  if (empty($_POST['message-content'])) {
	  $flag=0;
    $messageErr = "内容都不输你留什么言呢？";
  } else {
    $message = input($_POST['message-content']);
  }
   


$date=date('Y-n-j H:i:s');
$sql="INSERT INTO message (face, nickname, qq, mail, message, datetime, belong)VALUES ('".$face."','".$nickname."','".$qq."','".$mail."','".$message."','".$date."','".$belong."');";
if($flag){
	if (!mysql_query($sql,$con))
  	{
  	die('Error: ' . mysql_error());
  	}
	$flag=0;
	echo "<script>alert('亲爱的".$nickname."，您的留言我已收到！');</script>";
}
}
?>