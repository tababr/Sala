<?php
ini_set('display_errors', 'off');
include_once("resources/class.database.php");

class registro_silla{
	var $fecha;
  	var $id_silla;

function registro_silla(){
}

function insert(){
	$sql = "INSERT INTO adm.tbl_registro_silla( fecha, id_silla) VALUES ( '$this->fecha', '$this->id_silla')";
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

	$sql="SELECT * FROM adm.tbl_registro_silla";
	try {
		echo "<SELECT id_silla='id_r'>";
		$result = pg::query($sql);
		while ($row= pg_fetch_array($result)){
			echo "<OPTION value='".$row['id_silla']."' </OPTION>";
		}
		echo "</SELECT>";
	}
	catch (DependencyException $e) {
		pg::query("rollback");
	}
}

/*function getAutocomplete(){
	$res="";
	$sql="SELECT * FROM adm.tbl_registro_silla";
	try {
		$result = pg::query($sql);
		while ($row= pg_fetch_array($result)){
			$res .= '"' . $row['id_silla'] . '"';
			$res .= ',';
		}
		$res = substr ($res, 0, -2);
		$res = substr ($res, 1);
	}
	catch (DependencyException $e) {
	}
	return $res;
}*/
}
?>
