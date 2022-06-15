<?php
include("../../conexion/conexion.php");
$token = $_POST["token"];
$no_reloj = $_POST["no_reloj"];
$nombres = $_POST["nombres"];
$apellidos = $_POST["apellidos"];
$pass = $_POST["pass"];
$pass = hash('sha512', $pass);
$repass = $_POST["repass"];
$image = $_POST['file'];

list($type, $image) = explode(';', $image);
list(, $image) = explode(',', $image);
$image = base64_decode($image);
$image_name = $no_reloj . '.png';

$destino = "../images/" . $image_name; //RUTA DE LA IMAGEN
file_put_contents('../../images/' . $image_name, $image);
$correo = $_POST["correo"];
$puesto = $_POST["puesto"];
$depto = $_POST["depto"];
$supervisor = $_POST["supervisor"];
$esSupervisor = $_POST["radioSupervisor"];
$radioRegion = $_POST["radioRegion"];


$existe = $conn->query("SELECT * FROM registrogdp WHERE no_reloj = '$no_reloj'");
if (mysqli_num_rows($existe) > 0){   
  echo "<p class='alert alert-warning'><i class='fas fa-exclamation-circle' style='font-size: 11px;'></i> Usuario/No. Reloj ya registrado.</p>";
} 
else{
  $sql = $conn->query("INSERT INTO registrogdp (no_reloj, nombres, apellidos, img, correo, puesto, depto, no_reloj_supervisor,cargoColab, region, token) VALUES ('$no_reloj', '$nombres', '$apellidos','$destino', '$correo','$puesto', '$depto',  '$supervisor','$esSupervisor', '$radioRegion','$token')");
  if ($sql) { 
    $regLog = $conn->query("INSERT INTO login_gdp (no_reloj, pass, repass, cargoColab, token) VALUES ('$no_reloj', '$pass','$repass', '$esSupervisor', '$token')");
  }
  if ($sql && $regLog){            
    echo '<div class="alert alert-success alert-dismissible fade show ml-5" style="font-weight:600;" role="alert"><i class="fas fa-check-circle mr-3"></i>
    <strong>'.$_POST["nombres"].'</strong> te has registrado correctamente, puedes <strong><a href="../vista/login-vista.php" style="cursor: pointer; text-decoration: none; color: #155724;" >Iniciar Sesión</a></strong>.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
  }
  else
  {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  mysqli_close($conn);
}
