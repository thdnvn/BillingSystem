<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/database.php");
	$con=new database("item");
	$code=$_GET['code'];
	$con->autofill($code);
?>
