<?php
require('../conexion/conexion.php');
$id = $_GET["id_reddin"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>GDP | Agregar Acciones</title>
    <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
    <link rel="icon" href="../img/favicon.png" type="image/x-icon">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/estilo.css">
</head>
<body>
    <form id="form-info" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="modal-body"> 
            <div id="displaymessage" class="col-md-12"></div>
            <table id="tablaAccionesAdministradorReddin" class="table col-md-12" style="width:100%">
                <tbody>
                    <?php 
                    $consultaedit  = mysqli_query($conn, "SELECT * FROM t_reddin WHERE id_plan_rel = $id");
                    if (mysqli_num_rows($consultaedit) > 0){
                        while ($datos = mysqli_fetch_assoc($consultaedit)){ ?>
                            <tr>
                                <td width="20%"><?php echo $datos['date_reg_action'];?></td>
                                <td width="60%"><?php echo $datos['more_actions']; ?></td>
                                <td width="20%" class="text-center">
                                    <a class="agregarAccionReddin" title="Agregar" data-toggle="tooltip" id="<?php echo $datos['id_reddin']; ?>"><i class="fas fa-plus"></i></a> 
                                    <a class="editarAccionReddin" title="Editar" data-toggle="tooltip" id="<?php echo $datos['id_reddin']; ?>"><i class="fas fa-pencil-alt"></i></a> 
                                    <a class="borrarAccionReddin" title="Eliminar" data-toggle="tooltip" id="<?php echo $datos['id_reddin']; ?>"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php   
                        } 
                        mysqli_free_result($consultaedit); 
                    }else{
                        echo "<tr><td>No hay más acciones registradas</td></tr>";
                    }
                    ?>  
                </tbody>
            </table>                    
        </div>
    </form>

</body>
</html>