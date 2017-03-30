<?php
	ini_set('display_errors', 'on');
	session_start();
	include_once("../models/class.silla.php");
	$obj = new silla();
	if (isset($_POST['codigo'])){
		$obj->id_silla=$_POST['codigo'];
		
		echo $obj->insert();
	}
	else{
		echo "-1";
	}
?>
