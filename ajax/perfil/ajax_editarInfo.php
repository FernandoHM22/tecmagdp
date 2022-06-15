<?php 
include("../../conexion/conexion.php");
$nreloj = $_POST["no_reloj"];
$nombres = $_POST["nombres"];
$apellidos = $_POST["apellidos"];
$puesto = $_POST["puesto"];
$correo = $_POST["correo"];
$depto = $_POST["depto"];
$supervisor = $_POST["supervisor"];
$gerente = $_POST["gerente"];
$region = $_POST["region"];
$personalCargo = $_POST["personalCargo"];
$input = $_POST["file_input"];
$image = $_POST['file'];


if (!empty($input)){
list($type, $image) = explode(';',$image);
list(, $image) = explode(',',$image);
$image = base64_decode($image);
$image_name = time().'.png';
$destino = "../images/".$image_name; //RUTA DE LA IMAGEN
file_put_contents('../../images/'.$image_name, $image);

if ($gerente == "") {
  $sql  = "UPDATE registrogdp SET nombres = '$nombres', apellidos = '$apellidos',img ='$destino',  puesto = '$puesto', correo = '$correo', depto = '$depto', no_reloj_supervisor = '$supervisor', liderArea = '$gerente', region = '$region' WHERE no_reloj= '$nreloj'";

if ($conn->query($sql) === TRUE) {
    echo "<p class='alert alert-success d-block'><i class='fas fa-check-circle' style='font-size: 11px; color: #9fa59c;'></i> Información actualizada correctamente</p>";
        if($personalCargo != ''){
        $personalCargosql  = "UPDATE login_gdp SET cargoColab = '$personalCargo' WHERE no_reloj= '$nreloj'";
        $conn->query($personalCargosql);
        $personalCargo  = "UPDATE registrogdp SET cargoColab = '$personalCargo' WHERE no_reloj= '$nreloj'";
        $conn->query($personalCargo);
    }
  }else {
    echo "Error: " . $sql . "<br>" . $conn->error."";
  }

  $conn->close();
}else{
  $sql  = "UPDATE registrogdp SET nombres = '$nombres', apellidos = '$apellidos',img ='$destino',  puesto = '$puesto', correo = '$correo', depto = '$depto',  no_reloj_supervisor = '$supervisor', liderArea = '$gerente', region = '$region' WHERE no_reloj= '$nreloj'";

if ($conn->query($sql) === TRUE) {
    echo "<p class='alert alert-success d-block'><i class='fas fa-check-circle' style='font-size: 11px; color: #9fa59c;'></i> Información actualizada correctamente</p>";
      if($personalCargo != ''){
        $personalCargosql  = "UPDATE login_gdp SET cargoColab = '$personalCargo' WHERE no_reloj= '$nreloj'";
        $conn->query($personalCargosql);
        $personalCargo  = "UPDATE registrogdp SET cargoColab = '$personalCargo' WHERE no_reloj= '$nreloj'";
        $conn->query($personalCargo);
    }
  }else {
    echo "Error: " . $sql . "<br>" . $conn->error."";
  }

  $conn->close();
}

}else{
  if($gerente ==''){
      $actualizar  = "UPDATE registrogdp SET nombres = '$nombres', apellidos = '$apellidos', puesto = '$puesto', correo = '$correo', depto = '$depto',  no_reloj_supervisor = '$supervisor', liderArea = '$gerente', region = '$region'  WHERE no_reloj= '$nreloj'";

if ($conn->query($actualizar) === TRUE) {
    echo "<p class='alert alert-success d-block'><i class='fas fa-check-circle' style='font-size: 11px; color: #9fa59c;'></i> Información actualizada correctamente</p>";
        if($personalCargo != ''){
        $personalCargosql  = "UPDATE login_gdp SET cargoColab = '$personalCargo' WHERE no_reloj= '$nreloj'";
        $conn->query($personalCargosql);
        $personalCargo  = "UPDATE registrogdp SET cargoColab = '$personalCargo' WHERE no_reloj= '$nreloj'";
        $conn->query($personalCargo);
    }
  }else {
    echo "Error: " . $sql . "<br>" . $conn->error."";
  }
  $conn->close();
  }else{
      $actualizar  = "UPDATE registrogdp SET nombres = '$nombres', apellidos = '$apellidos', puesto = '$puesto', correo = '$correo', depto = '$depto', no_reloj_supervisor = '$supervisor', liderArea = '$gerente', region = '$region'   WHERE no_reloj= '$nreloj'";

if ($conn->query($actualizar) === TRUE) {
    echo "<p class='alert alert-success d-block'><i class='fas fa-check-circle' style='font-size: 11px; color: #9fa59c;'></i> Información actualizada correctamente</p>";
    if($personalCargo != ''){
        $personalCargosql  = "UPDATE login_gdp SET cargoColab = '$personalCargo' WHERE no_reloj= '$nreloj'";
        $conn->query($personalCargosql);
        $personalCargo  = "UPDATE registrogdp SET cargoColab = '$personalCargo' WHERE no_reloj= '$nreloj'";
        $conn->query($personalCargo);
    }

  }else {
    echo "Error: " . $sql . "<br>" . $conn->error."";
  }
  $conn->close();
  }
}


?>