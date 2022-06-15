<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>GDP | Iniciar Sesión</title>
    <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">
    <link rel="icon" href="../img/favicon.png" type="image/x-icon">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../css/sb-admin.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../css/estilo.css">
    <style>
        .error-msg {
            color: red;
            font-size: 13px;
            font-weight: 600;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                <p style="color:darkred; font-size:16px">(*) NOTA: Es importante realizar el llenado de esta informacion para que el curso sea contado como <strong>"Finalizado"</strong></p>
                <hr>
                <form>
                    <div class="form-group">
                        <label for="exampleInputPassword1"># de Empleado <strong>*</strong> </label>
                        <input type="number" class="form-control" id="numeroEmpleado">
                        <div id="divErrorReloj"></div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre Completo <strong>*</strong></label>
                        <input type="text" class="form-control" id="nombreCompleto">
                        <div id="divErrorNombre"></div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Cliente (Proyecto) <strong>*</strong></label>
                        <select name="" id="cliente" class="custom-select">
                            <option selected hidden>Seleccione su cliente(proyecto)</option>
                            <option value="ADM / JAWBONE">ADM / JAWBONE</option>
                            <option value="ALL-LINE">ALL-LINE</option>
                            <option value="AMAMEX">AMAMEX</option>
                            <option value="AMCOR">AMCOR</option>
                            <option value="BOYD">BOYD</option>
                            <option value="CAFETERIA">CAFETERIA</option>
                            <option value="CENTRIC">CENTRIC</option>
                            <option value="CIVCO">CIVCO</option>
                            <option value="CROPPER MEDICAL">CROPPER MEDICAL</option>
                            <option value="CURT">CURT</option>
                            <option value="DESIGN GROUP">DESIGN GROUP</option>
                            <option value="ECM">ECM</option>
                            <option value="ERGOMOTION">ERGOMOTION</option>
                            <option value="EXPRESSPOINT">EXPRESSPOINT</option>
                            <option value="EXPRESSPOINT (IMSSA)">EXPRESSPOINT (IMSSA)</option>
                            <option value="FIRSTRONICS DE JUAREZ">FIRSTRONICS DE JUAREZ</option>
                            <option value="FIRSTRONICS(IMS)">FIRSTRONICS(IMS)</option>
                            <option value="FLEXSTEEL">FLEXSTEEL</option>
                            <option value="GREEN TREE">GREEN TREE</option>
                            <option value="HOUSTON FOAM">HOUSTON FOAM</option>
                            <option value="IDEX">IDEX</option>
                            <option value="MADISON">MADISON</option>
                            <option value="MC ELECTRONICS">MC ELECTRONICS</option>
                            <option value="MILLER">MILLER</option>
                            <option value="NOABRANDS">NOABRANDS</option>
                            <option value="ORTRONICS">ORTRONICS</option>
                            <option value="PALCO">PALCO</option>
                            <option value="PEPI">PEPI</option>
                            <option value="PKTOOL">PKTOOL</option>
                            <option value="ROPER">ROPER</option>
                            <option value="SHAMROCK">SHAMROCK</option>
                            <option value="SHELTER">SHELTER</option>
                            <option value="SNAP N RACK">SNAP N RACK</option>
                            <option value="SUPERSACK">SUPERSACK</option>
                            <option value="TANIS">TANIS</option>
                            <option value="TEE SHIRT">TEE SHIRT</option>
                            <option value="TTS">TTS</option>
                            <option value="WESCON">WESCON</option>
                        </select>
                        <div id="divErrorCliente"></div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Región: <strong>*</strong></label>
                        <select name="" id="region" class="custom-select">
                            <option selected hidden>Seleccione su ciudad</option>
                            <option value="Juárez">Juárez</option>
                            <option value="Tijuana">Tijuana</option>
                            <option value="Silao">Silao</option>
                        </select>
                        <div id="divErrorRegion"></div>
                    </div>
                    <input type="button" value="Guardar" id="submit" class="btn btn-success btn-sm">
                </form>
                <div class="mt-1" id="msgsuccess"></div>  
            </div>
        </div>

    </div>
    </div>
    </div>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="http://sibeeshpassion.com/content/scripts/jquery-1.11.1.min.js"></script>
    <script src="https://tecmauniversitycom.h5p.com/js/h5p-resizer.js" charset="UTF-8"></script>
    <script>
        document.getElementById("nombreCompleto").addEventListener("input", forceLower);

        function forceLower(evt) {
            var words = evt.target.value.toLowerCase().split(/\s+/g);
            var newWords = words.map(function(element) {
                return element !== "" ? element[0].toUpperCase() + element.substr(1, element.length) : "";
            });
            evt.target.value = newWords.join(" ");
        }

        $("#submit").on("click", function() {
            var numeroEmpleado = $("#numeroEmpleado").val();
            var nombreCompleto = $("#nombreCompleto").val();
            var cliente = $("#cliente").val();
            var region = $("#region").val();
            if (numeroEmpleado == '') {
                $("#divErrorReloj").html("*Campo vacio, llene su número de empleado.").addClass("error-msg");
            }
            if (nombreCompleto == '') {
                $("#divErrorNombre").html("*Campo vacio, llene su nombre completo.").addClass("error-msg");
            }
            if (cliente == '' || cliente == "Seleccione su cliente(proyecto)") {
                $("#divErrorCliente").html("*Campo vacio").addClass("error-msg");
            }
            if (region == '' || region == "Seleccione su ciudad") {
                $("#divErrorRegion").html("*Campo vacio").addClass("error-msg");
            }else{
            $.ajax({
                url: 'guardardatos_curso_covid.php',
                method: 'POST',
                data: {
                    numeroEmpleado: numeroEmpleado,
                    nombreCompleto: nombreCompleto,
                    cliente: cliente,
                    region: region,
                },
                success: function(data) {
                    $("#submit").addClass( "disabled", "disabled" );
                    $("#msgsuccess").html(data);
                }
            });
        }
        });
    
    </script>
</body>

</html>