<?php
ini_set('display_errors', 'off');
include_once("resources/class.database.php");

class sala{
	var $id_sala;
  	var $capacidad;

function sala(){
}

function select($id_sala){
	$sql =  "SELECT * FROM adm.tbl_sala WHERE id_sala = '$id_sala'";
	try {
		$row = pg::query($sql);
		$row=pg_fetch_array($row);
		$this->id_sala = $row['id_sala'];
		$this->capacidad = $row['capacidad'];
		return true;
	}
	catch (DependencyException $e) {
	}
}

function delete($id_sala){
	$sql = "DELETE FROM adm.tbl_sala WHERE id_sala = '$id_sala'";
	try {
		pg::query("begin");
		$row = pg::query($sql);
		pg::query("commit");
		return "1";
	}
	catch (DependencyException $e) {
		pg::query("rollback");
		return "-1";
	}
}

function insert(){
//echo "me llamo";
	if ($this->validaP($this->id_sala) == false){
		$sql = "INSERT INTO adm.tbl_sala ( id_sala, capacidad, fk_id_silla) VALUES ( '$this->id_sala', '$this->capacidad', '$this->id_silla')";
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
	else{
		$sql="UPDATE adm.tbl_sala set capacidad='" . $this->capacidad . "' WHERE id_sala='" . $this->id_sala . "'";
		pg::query("begin");
		$row = pg::query($sql);
		pg::query("commit");		
		echo "2";
	}
}

function getCombo(){ 
    $sql="SELECT * FROM adm.tbl_silla "; 
    echo"<select id='id_silla'>"; 
    try{ 
        $result = pg::query($sql); 
        while ($row= pg_fetch_array($result)){ 
            echo"<option value=".$row['id_silla'].">".$row['id_silla']."</option>\n"; 
        } 
        echo"</select>";             
    } 
    catch (DependencyException $e) { 
        echo "Error al cargar el combobox"; 
    } 
     
}

function validaP ($id_sala){
      $sql =  "SELECT * FROM adm.tbl_sala WHERE id_sala = '$id_sala'";
      try {
		$row = pg::query($sql);
		if(pg_num_rows($row) == 0){
		        return false;
	        }
		else{
			return true;
		 }
		}
		catch (DependencyException $e) {
			//pg::query("rollback");
			return false;
		}
}

function getTabla(){
	
	$sql="SELECT * FROM adm.tbl_sala";
	try {
		echo "<div class='container' style='margin-top: 10px'>";
		echo "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id_sala='example'>";
		echo "<thead>";
		echo "<tr>";
		echo "	<th>Codigo</th>";
		echo "	<th>Capacidad</th>";
		echo "	<th>Silla</th>";
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		$result = pg::query($sql);
		while ($row= pg_fetch_array($result)){
			echo "<tr class='gradeA'>";
			echo "	<th>" . $row['id_sala'] . "</th>";
			echo "	<th>" . $row['capacidad'] . "</th>";
			echo "	<th>" . $row['fk_id_silla'] . "</th>";
			echo "	<th><a href='#' class='btn btn-danger' onclick='elimina(\"" . $row['id_sala'] . "\")'>X<i class='icon-white icon-trash'></i></a>.<a href='#' class='btn btn-primary' onclick='edit(\"" . $row['id_sala'] . "\", \"" . $row['capacidad'] . "\", \"" . $row['fk_id_silla'] . "\")'>E<i class='icon-white icon-refresh'></i></a></th>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
	}
	catch (DependencyException $e) {
		echo "Procedimiento sql invalido en el servidor";
	}
}

function getTablaInicianPorA(){
	
	$sql="select * from adm.tbl_sala where capacidad like 'A%'";
	try {
		echo "<div class='container' style='margin-top: 10px'>";
		echo "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-bordered' id_sala='example'>";
		echo "<thead>";
		echo "<tr>";
		echo "	<th>Codigo</th>";
		echo "	<th>Capacidad</th>";

		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		$result = pg::query($sql);
		while ($row= pg_fetch_array($result)){
			echo "<tr class='gradeA'>";
			echo "	<th>" . $row['id_sala'] . "</th>";
			echo "	<th>" . $row['capacidad'] . "</th>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
	}
	catch (DependencyException $e) {
		echo "Procedimiento sql invalido en el servidor";
	}
}

function getTablaPDF(){
	
	$sql="select * from adm.tbl_sala";	
	$tabla="";
	try {
		$tabla="<table>";
		$tabla=$tabla . "<tr>";
		$tabla=$tabla . "	<td>Codigo</td>";
		$tabla=$tabla . "	<td>Capacidad</td>";

		$tabla=$tabla . "</tr>";

		$result = pg::query($sql);
		while ($row= pg_fetch_array($result)){
			$tabla=$tabla . "<tr>";
			$tabla=$tabla . "	<td>" . $row['id_sala'] . "</td>";
			$tabla=$tabla . "	<td>" . $row['capacidad'] . "</td>";
			$tabla=$tabla . "</tr>";
		}
		$tabla=$tabla . "</table>";
	}
	catch (DependencyException $e) {
		echo "Procedimiento sql invalido en el servidor";
	}
	return $tabla;
}

function getLista(){
	
	$sql="SELECT * FROM adm.tbl_sala";
	try {
		echo "<SELECT id_sala='id_sala'>";
		$result = pg::query($sql);
		while ($row= pg_fetch_array($result)){
			echo "<OPTION value='".$row['id-sala']."'> ".$row['capacidad']." </OPTION>";
		}
		echo "</SELECT>";
	}
	catch (DependencyException $e) {
		pg::query("rollback");
	}
}

function getAutocomplete(){
	$res="";
	$sql="SELECT * FROM adm.tbl_sala";
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
