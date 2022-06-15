<?php
include("../../conexion/conexion.php");
$btn = $_POST["btn"];

if ($btn == "guardarFicha") {
	$reloj = $_POST["no_reloj"];
	$edad = $_POST["edadForm"];
	$estadoCivil = $_POST["estadoCivilForm"];
	$hijos = $_POST["hijosForm"];
	$lugarResidencia = $_POST["residenciaForm"];
	$nivelEducativo = $_POST["educacionForm"];
	$carrera = $_POST["carreraForm"];
	$postgrados = $_POST["postgradosForm"];
	$nivelIngles = $_POST["inglesForm"];
	$antiguedadPuesto = $_POST["antiguedadPuestoForm"];
	$antiguedadEmpresa = $_POST["antiguedadEmpresaForm"];
	$viajar = $_POST["viajar"];
	$cambioResidencia = $_POST["residencia"];
	$experienciaUno = $_POST["areaExperienciaUno"];
	$experienciaDos = $_POST["areaExperienciaDos"];
	$experienciaTres = $_POST["areaExperienciaTres"];
	$interesUno = $_POST["areaInteresUno"];
	$interesDos = $_POST["areaInteresDos"];
	$interesTres = $_POST["areaInteresTres"];
	$trayectoriaLaboralUno = $_POST["trayectoriaLaboralUno"];
	$trayectoriaLaboralDos = $_POST["trayectoriaLaboralDos"];
	$trayectoriaLaboralTres = $_POST["trayectoriaLaboralTres"];
	$supervisor = $_POST['reloj_supervisor'];

	$agregarFicha  = "INSERT INTO t_fichatalento(edad, estadoCivil, hijos, lugarResidencia, antiguedadEmpresa, antiguedadPuesto, nivelEducativo, postgrados, carreraProfesional, nivelIngles, viaje, residencia, areaExperienciaUno, areaExperienciaDos, areaExperienciaTres, areaInteresUno, areaInteresDos, areaInteresTres, trayectoriaLaboralUno, trayectoriaLaboralDos, trayectoriaLaboralTres, reloj_colaborador, reloj_supervisor) VALUES('$edad','$estadoCivil', '$hijos', '$lugarResidencia', '$antiguedadEmpresa', '$antiguedadPuesto','$nivelEducativo', '$postgrados', '$carrera', '$nivelIngles', '$viajar',  '$cambioResidencia', '$experienciaUno', '$experienciaDos', '$experienciaTres', '$interesUno', '$interesDos', '$interesTres', '$trayectoriaLaboralUno', '$trayectoriaLaboralDos', '$trayectoriaLaboralTres', '$reloj', '$supervisor')";

	if ($conn->query($agregarFicha) === TRUE) {
		echo 1;
	} else {
		echo "Error updating record: " . $conn->error;
	}
} else {
	$reloj = $_POST["no_reloj"];
	$edad = $_POST["edadForm"];
	$estadoCivil = $_POST["estadoCivilForm"];
	$hijos = $_POST["hijosForm"];
	$lugarResidencia = $_POST["residenciaForm"];
	$nivelEducativo = $_POST["educacionForm"];
	$carrera = $_POST["carreraForm"];
	$postgrados = $_POST["postgradosForm"];
	$nivelIngles = $_POST["inglesForm"];
	$antiguedadPuesto = $_POST["antiguedadPuestoForm"];
	$antiguedadEmpresa = $_POST["antiguedadEmpresaForm"];
	$viajar = $_POST["viajar"];
	$cambioResidencia = $_POST["residencia"];
	$experienciaUno = $_POST["areaExperienciaUno"];
	$experienciaDos = $_POST["areaExperienciaDos"];
	$experienciaTres = $_POST["areaExperienciaTres"];
	$interesUno = $_POST["areaInteresUno"];
	$interesDos = $_POST["areaInteresDos"];
	$interesTres = $_POST["areaInteresTres"];
	$trayectoriaLaboralUno = $_POST["trayectoriaLaboralUno"];
	$trayectoriaLaboralDos = $_POST["trayectoriaLaboralDos"];
	$trayectoriaLaboralTres = $_POST["trayectoriaLaboralTres"];
	$supervisor = $_POST['reloj_supervisor'];

	$actualizarFicha  = "UPDATE t_fichatalento SET edad = '$edad',
	estadoCivil = '$estadoCivil',
	hijos = '$hijos',
	lugarResidencia = '$lugarResidencia',
	antiguedadEmpresa = '$antiguedadEmpresa',
	antiguedadPuesto = '$antiguedadPuesto',
	nivelEducativo = '$nivelEducativo',
	postgrados = '$postgrados',
	carreraProfesional = '$carrera',
	nivelIngles = '$nivelIngles',
	viaje = '$viajar',
	residencia = '$cambioResidencia',
	areaExperienciaUno = '$experienciaUno',
	areaExperienciaDos = '$experienciaDos',
	areaExperienciaTres = '$experienciaTres',
	areaInteresUno = '$interesUno',
	areaInteresDos = '$interesDos',
	areaInteresTres = '$interesTres',
	trayectoriaLaboralUno = '$trayectoriaLaboralUno',
	trayectoriaLaboralDos = '$trayectoriaLaboralDos',
	trayectoriaLaboralTres = '$trayectoriaLaboralTres'
	WHERE reloj_colaborador= '$reloj'";

	if ($conn->query($actualizarFicha) === TRUE) {
		echo 1;
	} else {
		echo "Error updating record: " . $conn->error;
	}
}
