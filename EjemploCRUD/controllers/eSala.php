<?php
	ini_set('display_errors', 'on');
	session_start();
	include_once("../models/class.sala.php");
	$obj = new sala();
	if (isset($_POST['id_sala'])){
		echo $obj->delete($_POST['id_sala']);
	}
	else{
		echo "-2";
	}
?>
