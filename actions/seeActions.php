<?php
require('../conexion/conexion.php');
$id = $_GET["id_plan"];


$consultaedit  = mysqli_query($conn, "SELECT * FROM planeacion_gdp WHERE id_plan_rel = $id");

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
    <form id="form-info" action="../actions/addActions.php" method="POST">
        <div class="modal-body">
            <div class="form-row">
                <input type="text" hidden name="id" value="<?php echo $datos['id_plan'];?>" readonly="true"/>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <?php 
                    if (mysqli_num_rows($consultaedit) > 0) {
                        while ($datos = mysqli_fetch_array($consultaedit))  {
                            ?>
                            <label><?php echo $datos['date_reg_action'];?> - <?php echo $datos['more_actions'];?></label>
                            <hr>
                            <?php 
                        } 
                        mysqli_free_result($consultaedit); 
                    } else{
                        echo "No hay más acciones registradas";
                    }
                    ?>  
                </div>
            </div>                  
        </div>
    </form>

</body>
</html>