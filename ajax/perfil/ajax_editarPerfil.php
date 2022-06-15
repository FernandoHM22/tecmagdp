<?php
include '../../conexion/conexion.php';

$no_reloj = $_POST['no_reloj'];
$nombres = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$correo = $_POST['correo'];
$puesto = $_POST['puesto'];
$viajar = $_POST['viajar'];
$residencia = $_POST['residencia'];
$fechaNacimiento = $_POST['fechaNacimiento'];
$estadoCivil = $_POST['estadoCivil'];
$hijos = $_POST['hijos'];
$lugarResidencia = $_POST['lugarResidencia'];
$fechaIngreso = $_POST['fechaIngreso'];
$depto = $_POST['depto'];
$supervisor = $_POST['supervisor'];
$cargoColab = $_POST['cargoColab'];
$gradoEstudios = $_POST['gradoEstudios'];
$especialidad = $_POST['especialidad'];
$experienciaUno = $_POST['experienciaUno'];
$experienciaDos = $_POST['experienciaDos'];
$experienciaTres = $_POST['experienciaTres'];
$interesUno = $_POST['interesUno'];
$interesDos = $_POST['interesDos'];
$interesTres = $_POST['interesTres'];
$trayectoriaUno = $_POST['trayectoriaUno'];
$trayectoriaDos = $_POST['trayectoriaDos'];
$trayectoriaTres = $_POST['trayectoriaTres'];
$ingles = $_POST['ingles'];

if ($_POST['insertar'] == '1') {
    $sql_insertar_ficha  = "INSERT INTO t_fichatalento (edad, estadoCivil, hijos, lugarResidencia, antiguedadEmpresa, nivelEducativo, especialidad, areaExperienciaUno, areaExperienciaDos, areaExperienciaTres, areaInteresUno, areaInteresDos, areaInteresTres, trayectoriaLaboralUno, trayectoriaLaboralDos, trayectoriaLaboralTres, nivelIngles, viaje, residencia, reloj_colaborador) VALUES ('$fechaNacimiento','$estadoCivil','$hijos','$lugarResidencia', '$fechaIngreso','$gradoEstudios','$especialidad','$experienciaUno','$experienciaDos','$experienciaTres','$interesUno','$interesDos','$interesTres','$trayectoriaUno','$trayectoriaDos','$trayectoriaTres','$ingles','$viajar','$residencia','$no_reloj')";
    if (mysqli_query($conn, $sql_insertar_ficha) == TRUE) {
        $sql_perfil  = "UPDATE registrogdp SET nombres = '$nombres', apellidos = '$apellidos', correo = '$correo', puesto = '$puesto',  depto = '$depto', no_reloj_supervisor = '$supervisor' WHERE no_reloj= '$no_reloj'";
        if (mysqli_query($conn, $sql_perfil) == TRUE) {
            echo 1;
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    $sql_perfil  = "UPDATE registrogdp SET nombres = '$nombres', apellidos = '$apellidos', correo = '$correo', puesto = '$puesto',  depto = '$depto', no_reloj_supervisor = '$supervisor' WHERE no_reloj= '$no_reloj'";
    if (mysqli_query($conn, $sql_perfil) == TRUE) {
        $sql_ficha  = "UPDATE t_fichatalento SET edad = '$fechaNacimiento', estadoCivil = '$estadoCivil', hijos = '$hijos', lugarResidencia = '$lugarResidencia',  antiguedadEmpresa = '$fechaIngreso', nivelEducativo = '$gradoEstudios', especialidad = '$especialidad', areaExperienciaUno = '$experienciaUno', areaExperienciaDos = '$experienciaDos', areaExperienciaTres = '$experienciaTres', areaInteresUno = '$interesUno', areaInteresDos = '$interesDos', areaInteresTres = '$interesTres', trayectoriaLaboralUno = '$trayectoriaUno', trayectoriaLaboralDos = '$trayectoriaDos', trayectoriaLaboralTres = '$trayectoriaTres', nivelIngles = '$ingles', viaje = '$viajar', residencia = '$residencia' WHERE reloj_colaborador = '$no_reloj'";
        if (mysqli_query($conn, $sql_ficha) == TRUE) {
            if ($cargoColab != '') {
                $sql_login  = "UPDATE login_gdp SET cargoColab = '$cargoColab' WHERE no_reloj = '$no_reloj'";
                if (mysqli_query($conn, $sql_login) == TRUE) {
                    echo 1;
                } else {
                    echo "Error updating record: " . mysqli_error($conn);
                }
            } else {
                echo 1;
            }
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
