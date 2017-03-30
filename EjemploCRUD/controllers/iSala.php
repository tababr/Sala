<?php
	ini_set('display_errors', 'on');
	session_start();
	include_once("../models/class.sala.php");
	$obj = new sala();
	if (isset($_POST['codigo']) && isset($_POST['capacidad'] ) && isset($_POST['id_silla'] )){
		$obj->id_sala=$_POST['codigo'];
		$obj->capacidad=$_POST['capacidad'];
		$obj->id_silla=$_POST['id_silla'];
		echo $obj->insert();
	}
	else{
		echo "-1";
	}
?>
