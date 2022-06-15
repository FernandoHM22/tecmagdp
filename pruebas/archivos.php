<?php
require_once "conexion.php";
$c = new Conectar();
$conexion = $c->Conexion();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    </style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description">
    <meta name="author" content="Fernando H">
    <title>GDP - Escritorio</title>
    <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
    <link rel="icon" href="../img/favicon.png" type="image/x-icon">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/estilo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
    <style>
        body {
            background-color: #F0F0F0
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row pt-5">
            <div class="col-md-12">
                <?php
                $sql = "SELECT * FROM t_fileupload WHERE id_depto = 'SM' AND id_carpetaregion = '001_COR'";
                $result = mysqli_query($conexion, $sql);
                ?>
                <div class="table-responsive">
                    <table id="tablaCOR" class="table table-sm table-hover table-striped table-bordered" style="width:100%;">
                        <thead class="thead-dark">
                            <tr>
                                <th style="text-align: left;">Tipo Documento</th>
                                <th style="text-align: left;">Nombre Documento</th>
                                <th>Descargar</th>
                                <th>Visualizar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $extensionesValidas = array('pdf', 'png', 'jpg');
                            while ($mostrar = mysqli_fetch_assoc($result)) {
                                $rutaDescarga = "../archivosUpload/archivosGenerales/"
                                    . "/" . $mostrar['id_carpetaRaiz']
                                    . "/" . $mostrar['id_carpetaregion']
                                    . "/" . $mostrar['id_depto']
                                    . "/" . $mostrar['nombreArchivo'];
                                $nombreArchivo = $mostrar['nombreArchivo'];
                                $idArchivo = $mostrar['id_fileUpload'];
                                $tipoArchivo = $mostrar['tipoArchivo'];
                            ?>
                                <tr>
                                    <td style="text-align: left;"><?php echo $mostrar['id_carpetaRaiz']; ?></td>
                                    <td style="text-align: left;"><?php echo $mostrar['nombreArchivo']; ?></td>
                                    <td>
                                        <?php
                                        if ($tipoArchivo == 'pdf') {
                                        ?>
                                            <a href="#" data-ruta="<?php echo $rutaDescarga ?>" data-file="<?php echo $nombreArchivo ?>" class="btn btn-info btn-sm descargarConMarcaAgua">
                                                <span class="fa fa-file-download"></span>
                                            </a>
                                        <?php } else { ?>
                                            <a href="<?php echo $rutaDescarga ?>" download="<?php echo $nombreArchivo ?>" class="btn btn-info btn-sm">
                                                <span class="fa fa-file-download"></span>
                                            </a>

                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php
                                        for ($i = 0; $i < count($extensionesValidas); $i++) {
                                            if ($extensionesValidas[$i] == $mostrar['tipoArchivo']) {
                                        ?>
                                                <span class="btn btn-primary btn-sm" data-toggle="modal" data-target="#visualizarArchivo" onclick="obtenerArchivosPorIdGenerales('<?php echo $idArchivo ?>')">
                                                    <span class="far fa-eye"></span>
                                                </span>
                                        <?php
                                            }
                                        }
                                        ?>
                                        <?php
                                        ?>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/sb-admin.min.js"></script>
    <script>
        $('.descargarConMarcaAgua').on('click', function(e) {
            e.preventDefault();
            var ruta = $(this).data("ruta");
            var archivo = $(this).data('file');
            $.ajax({
                url: 'watermark_download.php',
                type: 'POST',
                data: {
                    ruta: ruta,
                    nombreArchivo: archivo
                },
                success: function(data) {
                    window.open("watermark_download.php");
                }

            });
        });
    </script>
</body>

</html>