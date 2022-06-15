<?php
include("../../conexion/conexion.php"); 
$id_plan = $_POST['string'];
$txtoportunidad = $_POST['txtoportunidad'];
$txtaccion = $_POST['txtaccion'];
$txtmejora = $_POST['txtmejora'];
$txtfecha = $_POST['txtfecha'];
$txtevidencias = $_POST['txtevidencias'];

if($_POST['txtestatus'] == ""){
	$txtestatus = "Actual";
}else {
	$txtestatus = $_POST['txtestatus'];
}




$sql = "UPDATE planeacion_gdp SET mejora = '$txtoportunidad', acciones = '$txtaccion', porque_mejora = '$txtmejora', fecha ='$txtfecha', evidencias ='$txtevidencias', estatus_plan = '$txtestatus' WHERE id_plan = $id_plan";
if ($conn->query($sql) === TRUE) {
	$sqlQuery = "SELECT * FROM planeacion_gdp" or die(mysqli_error($conn));
	$resultado = mysqli_query($conn, $sqlQuery);
	if (mysqli_num_rows($resultado) > 0) {
		$sqlEstatusAcciones = "UPDATE planeacion_gdp SET estatus_plan = '$txtestatus' WHERE id_plan_rel = '$id_plan'";
		if ($conn->query($sqlEstatusAcciones) === TRUE) {
			echo 1;
		}else{
			echo 0;
		}
	}else{
		echo 1;
	}
}else{
	echo 0;
} 
?>