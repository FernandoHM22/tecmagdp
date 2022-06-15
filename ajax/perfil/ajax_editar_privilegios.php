<?php
include("../../conexion/conexion.php");
$no_reloj = $_POST['no_reloj'];
$privilegio = $_POST['privilegio'];

$sqlPrivilegiosUsuario = "UPDATE login_gdp SET isAdmin = '$privilegio' WHERE no_reloj = '$no_reloj'";
if (mysqli_query($conn, $sqlPrivilegiosUsuario) === TRUE) {
	echo 1;
} else {
	echo 0;
}

mysqli_close($conn);
