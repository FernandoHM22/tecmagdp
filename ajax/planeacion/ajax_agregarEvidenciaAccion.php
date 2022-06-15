<?php
include("../../conexion/conexion.php");
$id_plan = $_POST["id_reddin"];
$targetDir = "../../evidencias/";
$fileName = basename($_FILES['evidenciaAccionInput']["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

if (!empty($_FILES["evidenciaAccionInput"]["name"])) {
	// Allow certain file formats
	$allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf', 'doc', 'docx', 'dot', 'xls', 'xlsx', 'xlsm', 'ppt', 'pptx', 'pps', 'pot');
	if (in_array($fileType, $allowTypes)) {
		// Upload file to server
		if (move_uploaded_file($_FILES["evidenciaAccionInput"]["tmp_name"], $targetFilePath)) {
			$insert = $conn->query("UPDATE t_reddin SET evidencias = '$targetFilePath' WHERE id_reddin = '$id_plan'");
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
