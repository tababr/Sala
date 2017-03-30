<?php
	ini_set('display_errors', 'on');
	session_start();
	include_once("../models/class.registro.silla.php");
	$obj = new registro_silla();
	if (isset($_POST['fec']) && isset($_POST['act'])){
		$obj->fecha=$_POST['fec'];
		$obj->id_silla=$_POST['act'];
		echo $obj->insert();
	}
	else{
		echo "-1";
	}
?>
