<?php
ini_set('display_errors', 'off');
include_once("resources/class.database.php");

class registro_sala{
	var $fecha;
  	var $id_sala;

function registro_sala(){
}

function insert(){
	$sql = "INSERT INTO adm.tbl_registro_sala( fecha, id_sala) VALUES ( '$this->fecha', '$this->id_sala')";
	try {
		pg::query("begin");
		$row = pg::query($sql);
		pg::query("commit");
		echo "1";
	}
	catch (DependencyException $e) {
		echo "Error: " . $e;
		pg::query("rollback");
		echo "-1";
	}
}

function getLista(){

	$sql="SELECT * FROM adm.tbl_registro_sala";
	try {
		echo "<SELECT id_sala='id_r'>";
		$result = pg::query($sql);
		while ($row= pg_fetch_array($result)){
			echo "<OPTION value='".$row['id_sala']."'> ".$row['capacidad']." </OPTION>";
		}
		echo "</SELECT>";
	}
	catch (DependencyException $e) {
		pg::query("rollback");
	}
}

function getAutocomplete(){
	$res="";
	$sql="SELECT * FROM adm.tbl_registro_sala";
	try {
		$result = pg::query($sql);
		while ($row= pg_fetch_array($result)){
			$res .= '"' . $row['id_sala'] . ', ' . $row['capacidad'] . '"';
			$res .= ',';
		}
		$res = substr ($res, 0, -2);
		$res = substr ($res, 1);
	}
	catch (DependencyException $e) {
	}
	return $res;
}
}
?>
