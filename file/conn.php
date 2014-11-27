<?php
error_reporting(E_ALL ^ E_DEPRECATED);
$con = mysql_connect("localhost","u899150493_muzi","lzq1997201");
if (!$con)
  {
  die('连接错误: ' . mysql_error());
  }
mysql_select_db("u899150493_muzi", $con);
	//字符转换
	mysql_query("set character set 'utf8'");
	//写库
	mysql_query("set names 'utf8'");

?>