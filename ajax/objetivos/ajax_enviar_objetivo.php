	<?php
	include("../../conexion/conexion.php");
	$id_objetivos = $_POST['id_objetivos'];
	$reloj = $_POST['reloj'];
	$totalObjetivos = count($id_objetivos);
	foreach ($id_objetivos as $key => $value) {
		$txtborrador = 1;
		$sql_validad_objetivos = "UPDATE objetivos_gdp SET borrador_estatus = '$txtborrador' WHERE id_num_objetives = '$value'";
		if (mysqli_query($conn, $sql_validad_objetivos) === TRUE) {
			$query_evidencias = "UPDATE objetivos_gdp SET borrador_estatus = '$txtborrador' WHERE id_rel_estrategia = '$value' AND obj_no_reloj = '$reloj'";
			if (mysqli_query($conn, $query_evidencias) === TRUE) {
				$totalObjetivos--;
			}
		}
	}
	if ($totalObjetivos == 0) {
		echo 1;
	}
	mysqli_close($conn);
	?>