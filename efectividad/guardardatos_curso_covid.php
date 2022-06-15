<?php
include("../conexion/conexion.php");
$numeroEmpleado  = $_POST['numeroEmpleado'];
$nombreCompleto = $_POST['nombreCompleto'];
$cliente = $_POST['cliente'];
$region = $_POST['region'];

$sql = "INSERT INTO tu_curso_covid (reloj, nombreCompleto, cliente, region) VALUES ('" . $numeroEmpleado . "','" . $nombreCompleto . "','" . $cliente . "', '" . $region . "')";

if ($conn->query($sql) === TRUE) {
    echo "<p class='alert alert-success d-block mt-2'><i class='fas fa-check-circle' style='font-size: 11px; color: #9fa59c;'></i> Guardado correctamente, puede dar clic en el botón 'Continuar con video'</p>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error . "";
}
$conn->close();
