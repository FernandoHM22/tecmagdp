<?php
include("../../conexion/conexion.php");
$estatus  = $_POST['estatus'];
$relojColaborador  = $_POST['relojC'];
$relojLider  = $_POST['relojL'];
$comentarioLider  = $_POST['comentarioLider'];
$añoObjetivos  = $_POST['año'];

if ($comentarioLider == '') {
	$totalObjetivos = count($_POST['arrayIDsObjetivos']);
	$n = $totalObjetivos;
	foreach ( $_POST['arrayIDsObjetivos'] as $id) {
		$estatus  = $_POST['estatus'];
		$query = "UPDATE objetives_gdp SET estatus_objetivos = '$estatus' WHERE id_num_objetives = '$id'";
		$q = mysqli_query($conn, $query)or die (mysqli_error($conn));
		$n--;
	}
	if ($n == 0) {
		echo 1;
	} else {
		echo 0;
	}
}else{
	$totalObjetivos = count($_POST['arrayIDsObjetivos']);
	$n = $totalObjetivos;
	foreach ( $_POST['arrayIDsObjetivos'] as $id) {
		$estatus  = $_POST['estatus'];
		$query = "UPDATE objetives_gdp SET estatus_objetivos = '$estatus' WHERE id_num_objetives = '$id'";
		$q = mysqli_query($conn, $query)or die (mysqli_error($conn));
		$n--;
	}
	
	if ($n == 0) {
		$query = "INSERT INTO t_comentariosObjetivos(comentario, no_relojC, reloj_lider, añoObjetivos) VALUES('$comentarioLider','$relojColaborador','$relojLider','$añoObjetivos')";
		$q = mysqli_query($conn, $query)or die (mysqli_error($conn));
		if ($q == true) {
			echo 1;
		}else{
			echo 0;
		}
	} else {
		echo 0;
	}

}
$conn->close();

?>