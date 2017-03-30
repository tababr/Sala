<?php
	ini_set('display_errors', 'on');
	session_start();
	include_once("../models/class.silla.php");
	$obj = new silla();
	if (isset($_POST['id_silla'])){
		echo $obj->delete($_POST['id_silla']);
	}
	else{
		echo "-2";
	}
?>
