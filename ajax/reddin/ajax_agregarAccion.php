<?php
include("../../conexion/conexion.php");
$id_plan_rel = $_POST["id"];
$fecha_reg = $_POST["fecha"];
$accion = $_POST["accion"];
$mes = $_POST["mes_reg"];
$year = $_POST["year_reg"];
$no_reloj = $_POST["reloj"];
$estatus = $_POST["estatus"];
$targetDir = "../../evidencias/";
$fileName = basename($_FILES['file']["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

if ($_FILES['file']['size'] == 0) {
	$insert = "INSERT INTO t_reddin(id_plan_rel, more_actions, mes_reg, year_reg, date_reg_action, no_reloj, estatus) VALUES('$id_plan_rel','$accion', '$mes','$year','$fecha_reg','$no_reloj','$estatus')";
	if ($conn->query($insert) === TRUE) {
		echo 1;
	} else {
		echo 0;
	}
} else {
	$allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf', 'doc', 'docx', 'dot', 'xls', 'xlsx', 'xlsm', 'ppt', 'pptx', 'pps', 'pot');
	if (in_array($fileType, $allowTypes)) {
		// Upload file to server
		if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
			$insert = $conn->query("INSERT INTO t_reddin(id_plan_rel, more_actions, evidencias, mes_reg, year_reg, date_reg_action, no_reloj, estatus) VALUES('$id_plan_rel','$accion','$targetFilePath','$mes','$year','$fecha_reg','$no_reloj','$estatus')");
			if ($insert) {
				echo 1;
			} else {
				echo 0;
			}
		} else {
			echo 2;
		}
	} else {
		echo 3;
	}
}
