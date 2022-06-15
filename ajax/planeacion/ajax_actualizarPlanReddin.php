<?php
include("../../conexion/conexion.php");

$id_reddin = $_POST['id_reddin'];
$input_accion = $_POST['input_accion'];
$input_fechaCompromiso = $_POST['input_fechaCompromiso'];

if ($_POST['txtestatus'] == "") {
	$txtestatus = "Actual";
} else {
	$txtestatus = $_POST['txtestatus'];
}


$sql_reddin = mysqli_query($conn, "SELECT * FROM t_reddin WHERE id_reddin = '$id_reddin'");
if (mysqli_num_rows($sql_reddin) > 0) {
	while ($r = mysqli_fetch_assoc($sql_reddin)) {

		if ($input_accion == '') {
			$input_accion = $r['acciones'];
		}


		if ($input_fechaCompromiso == '') {
			$input_fechaCompromiso = $r['fecha'];
		}
	}
	mysqli_free_result($sql_reddin);
}

$sql = "UPDATE t_reddin SET acciones ='$input_accion', fecha ='$input_fechaCompromiso',  estatus = '$txtestatus' WHERE id_reddin= '$id_reddin'";
if ($conn->query($sql) === TRUE) {
	$sqlQuery = "SELECT * FROM t_reddin" or die(mysqli_error($conn));
	$resultado = mysqli_query($conn, $sqlQuery);
	if (mysqli_num_rows($resultado) > 0) {
		$sqlEstatusAcciones = "UPDATE t_reddin SET estatus = '$txtestatus' WHERE id_plan_rel = '$id_reddin'";
		if ($conn->query($sqlEstatusAcciones) === TRUE) {
			echo 1;
		} else {
			echo 0;
		}
	} else {
		echo 1;
	}
} else {
	echo 0;
	echo "Error updating record: " . $conn->error;
}
