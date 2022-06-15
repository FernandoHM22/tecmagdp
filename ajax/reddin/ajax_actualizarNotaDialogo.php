
<?php
include("../../conexion/conexion.php");
$id_nota  = $_POST['id_nota'];
$input_nota = $_POST['input_nota'];

$sql = "UPDATE t_reddin SET notas = '$input_nota' WHERE id_nota = '$id_nota'";
if (mysqli_query($conn, $sql) === TRUE) {
  echo 1;
} else {
  echo 0;
}
mysqli_close($conn);
?>