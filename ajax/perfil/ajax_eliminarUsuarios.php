<?php
include("../../conexion/conexion.php"); 
$no_reloj = $_POST['string'];
$sqlUser = "DELETE FROM registrogdp WHERE no_reloj = '$no_reloj'";
if ($conn->query($sqlUser) === TRUE) {
	$sqlLogin = "DELETE FROM login_gdp WHERE no_reloj = '$no_reloj'";
	if ($conn->query($sqlLogin) === TRUE) {
		echo 1;
	} else {
		echo 0;
	} 
} else {
	echo 0;
}
