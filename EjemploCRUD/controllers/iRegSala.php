<?php
	ini_set('display_errors', 'on');
	session_start();
	include_once("../models/class.registro.sala.php");
	$obj = new registro_sala();
	if (isset($_POST['fec']) && isset($_POST['act'])){
		$obj->fecha=$_POST['fec'];
		$obj->id_sala=$_POST['act'];
		echo $obj->insert();
	}
	else{
		echo "-1";
	}
?>
