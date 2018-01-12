<?php
//input random stat put key
if ($_POST['key']==="qwerty123") {

	$mysqli = new mysqli("localhost", "root", "pass", "db");
	
	$mysqli->set_charset("utf8");
	
	$mysqli->query("INSERT INTO `stat` VALUES (NULL,'{$_POST['file']}',NOW())");
	
	}
?>