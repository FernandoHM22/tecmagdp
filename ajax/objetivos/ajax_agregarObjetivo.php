	<?php
	include("../../conexion/conexion.php");
	$txtcategoria = $_POST['txtcategoria'];
	$txtobjetivo = $_POST['txtobjetivo'];
	$txtdescripcion_meta = $_POST['txtdescripcion_meta'];
	$txtmeta = $_POST['txtmeta'];

	$array_estrategia = $_POST['array_estrategia'];
	$array_descripcion = $_POST['array_descripcion'];
	$array_medida = $_POST['array_medida'];
	$array_ponderacion = $_POST['array_ponderacion'];

	$txtreloj = $_POST['txtreloj'];
	$txtfechaReg  = $_POST['txtfechaReg'];
	$txtaño = $_POST['txtaño'];
	$txtestatus = $_POST['txtestatus'];
	$txtborrador = $_POST['txtborrador'];
	$selectedValues = $_POST['selectedValues'];

	foreach ($selectedValues as $key) {
		$array_responsable = [];
		foreach ($key as $key_value => $value) {
			$array_responsable[$key_value] = $value;
		}
		$array_implode = implode("','", $array_responsable);
		$array_responsables[] = $array_implode;

		$data = [];
		for ($i = 0; $i < count($array_estrategia); $i++) {
			$data[$i] = array(
				'estrategia' => $array_estrategia[$i],
				'descripcion' => $array_descripcion[$i],
				'medida' => $array_medida[$i],
				'ponderacion' => $array_ponderacion[$i],
				'responsables' => $array_responsables[$i],
				'reloj' => $txtreloj,
				'fechaReg' => $txtfechaReg,
				'año' => $txtaño,
				'estatus' => $txtestatus,
				'borrador' => $txtborrador,
			);
		}
	}

	$sql = "INSERT INTO objetivos_gdp (categoria, objetivo, descripcion_meta,meta_num, obj_no_reloj, fecha_reg, anio_reg, estatus_objetivos, borrador_estatus) VALUES ('$txtcategoria','$txtobjetivo','$txtdescripcion_meta','$txtmeta', '$txtreloj', '$txtfechaReg','$txtaño','$txtestatus','$txtborrador')";

	$query_evidencias = "INSERT INTO objetivos_gdp (id_rel_estrategia, estrategia, metricos_kpi, medida_estrategia, ponderacion_num, responsable, obj_no_reloj, fecha_reg, anio_reg, estatus_objetivos,borrador_estatus) VALUES";

	if (mysqli_query($conn, $sql) === TRUE) {
		$last_id_objetivo = $conn->insert_id;
		$all_values_dl = [];
		foreach ($data as $key) {
			$row_values = [];
			foreach ($key as $skey => $s_value) {
				$row_values[] = '"' . $s_value . '"';
			}
			$all_values_dl[] = '("' . $last_id_objetivo . '",' . implode(',', $row_values) . ')';
		}
		$query_evidencias .= implode(',', $all_values_dl);
		if (mysqli_query($conn, $query_evidencias) === TRUE) {
			echo 1;
		}else{
			echo 0;
		}
	} else {
		echo 0;
	}
	mysqli_close($conn);
	?>