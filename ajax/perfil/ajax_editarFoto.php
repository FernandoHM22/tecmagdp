<?php
include("../../conexion/conexion.php");
$image = $_POST['imagenPerfil'];
$no_reloj = $_POST['no_reloj'];
list($type, $image) = explode(';', $image);
list(, $image) = explode(',', $image);
$image = base64_decode($image);
$image_name = $no_reloj . '.png';

$destino = "../images/" . $image_name; 
file_put_contents('../../images/' . $image_name, $image);

$sql_upload_imagen_perfil = "UPDATE registrogdp SET img = '$destino' WHERE no_reloj ='$no_reloj'";

if ($conn->query($sql_upload_imagen_perfil)) {
    echo 1;
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
