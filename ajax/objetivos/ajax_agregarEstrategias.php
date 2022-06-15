	<?php

	include("../../conexion/conexion.php");
	$id_objetivo = $_POST['id_objetivo'];
	$estrategia_input = $_POST['estrategia_input'];
	$descripcion_input = $_POST['descripcion_input'];
	$medida_input = $_POST['medida_input'];
	$ponderacion_input = $_POST['ponderacion_input'];
	$responsable_input = $_POST['responsable_input'];
	$responsable = implode("','", $responsable_input);

	$no_reloj_input = $_POST['no_reloj_input'];
	$fecha_registro_input = $_POST['fecha_registro_input'];
	$anio_input = $_POST['anio_input'];
	$estatus_objetivo_input = $_POST['estatus_objetivo_input'];
	$borrador_input = $_POST['borrador_input'];


	$sql_agregar_estrategia = 'INSERT INTO objetivos_gdp (id_rel_estrategia, estrategia, metricos_kpi ,medida_estrategia, ponderacion_num, responsable, obj_no_reloj, fecha_reg, año_reg, estatus_objetivos, borrador_estatus) VALUES ("' . $id_objetivo . '","' . $estrategia_input  . '","' . $descripcion_input . '","' . $medida_input . '", "' . $ponderacion_input . '","' . $responsable . '","' . $no_reloj_input . '", "' . $fecha_registro_input . '","' . $anio_input . '","' . $estatus_objetivo_input . '","' . $borrador_input . '")';

	if ($conn->query($sql_agregar_estrategia) === TRUE) {
		echo 1;
	} else {
		echo 0;
	}
	$conn->close();

	?>