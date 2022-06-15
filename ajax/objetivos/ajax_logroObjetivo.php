<?php
include("../../conexion/conexion.php"); 
$id_objetivo = $_POST['string'];
$txtlogro = $_POST['txtlogro'];

if (!empty($_FILES['file'])) {
	$nombreArchivo = $_FILES['file']['name'];
	$explode = explode('.', $nombreArchivo);
	$rutaAlmacenamiento = $_FILES['file']['tmp_name'];
	$carpeta = '../../archivosEvidencia/';
	$rutaFinal = $carpeta.$nombreArchivo;
	move_uploaded_file($rutaAlmacenamiento, $rutaFinal);


	$sql = "UPDATE objetives_gdp SET logro = '$txtlogro', archivoEvidencia = '$rutaFinal' WHERE id_num_objetives = '$id_objetivo'";
	if ($conn->query($sql) === TRUE) {
		echo "<p class='alert alert-success d-block'><i class='fas fa-check-circle' style='font-size: 11px; color: #9fa59c;'></i> Evaluado correctamente</p>";
	} else {
		echo "Error updating record: " . $conn->error;
	} 
}else{

	$sql = "UPDATE objetives_gdp SET logro = '$txtlogro' WHERE id_num_objetives = '$id_objetivo'";
	if ($conn->query($sql) === TRUE) {
		echo "<p class='alert alert-success d-block'><i class='fas fa-check-circle' style='font-size: 11px; color: #9fa59c;'></i> Evaluado correctamente</p>";
	} else {
		echo "Error updating record: " . $conn->error;
	} 
}
?>



