<?php
require_once '../../conexion/conexion.php';
$no_reloj = $_POST['no_reloj'];
$cargoColab = $_POST['cargoColab'];

if ($_POST['perfil'] == 1) {
    $urlObjetivos = 'objetivosSup.php';
} else {
    $urlObjetivos = 'objetivos.php';
}
?>
<div class="row <?php if ($cargoColab != 1) {
                    echo 'justify-content-md-center';
                }?>">
    <div class="<?php if ($cargoColab == 1) {
                    echo 'col-md-4';
                } else {
                    echo 'col-md-4';
                } ?>">
        <div class="chart-container">
            <a href="<?= $urlObjetivos ?>">
                <canvas class="chartObjetivos" id="dougnutObjetivos"></canvas>
            </a>
        </div>
    </div>
    <div class="<?php if ($cargoColab == 1) {
                    echo 'col-md-4';
                } else {
                    echo 'col-md-4';
                } ?>">
        <div class="chart-container">
            <a href="#" class="btnModalCompetencias" data-id="<?= $no_reloj ?>">
                <canvas class="chartCompetencias" id="dougnutCompetencias"></canvas>
            </a>
        </div>
    </div>
    <?php
    if ($cargoColab == 1) {
    ?>
        <div class="col-md-4">
            <div class="chart-container">
                <a href="#" data-toggle="modal" data-target="#modalGPTW">
                    <canvas class="chartGPTW" id="dougnutGPTW"></canvas>
                </a>
            </div>
        </div>
    <?php
    }
    ?>
</div>
<div class="modal fade" id="modalCompetencias" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body-gptw p-3"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalGPTW" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body-gptw p-3"></div>
        </div>
    </div>
</div>
<?php
$anio = '2021';
$sql_objetivos = mysqli_query($conn, "SELECT AVG(logro) AS logro, obj_no_reloj FROM objetivos_gdp WHERE obj_no_reloj = '$no_reloj' AND anio_reg = '$anio' GROUP BY obj_no_reloj") or die(mysqli_error($conn));
$r = mysqli_fetch_assoc($sql_objetivos);
if ($r['logro'] != '') {
    $arrayLogroObjetivos[] =  number_format(floor(($r['logro']) * 100) / 100, 2);
    $faltanteDataObjetivos = 100 - number_format(floor(($r['logro']) * 100) / 100, 2);
} else {
    $arrayLogroObjetivos[] = 0;
    $faltanteDataObjetivos = 10 - 0;
}

$sql_evaluacion = mysqli_query($conn, "SELECT *  FROM t_evaluacion WHERE no_reloj = '$no_reloj'");
if (mysqli_num_rows($sql_evaluacion) > 0) {
    while ($row = mysqli_fetch_assoc($sql_evaluacion)) {
        $sum =  (($row['competencia1'] + $row['competencia2'] + $row['competencia3'] + $row['competencia4'] + $row['competencia5'] + $row['competencia6'] + $row['competencia7'] + $row['competencia8'] + $row['competencia9'] + $row['competencia10'] + $row['competencia11'] + $row['competencia12'] + $row['competencia13'] + $row['competencia14'] + $row['competencia15'] + $row['competencia16'] + $row['competencia17'] + $row['competencia18'] + $row['competencia19'] + $row['competencia20']) / 20);
        $avgEvaluacion =  ($sum * 70) / 100;
        $sql_matriz = mysqli_query($conn, "SELECT desempeno FROM t_matriz WHERE no_reloj ='$no_reloj'");
        if (mysqli_num_rows($sql_matriz) > 0) {
            $r = mysqli_fetch_assoc($sql_matriz);
            $desempeno = $r['desempeno'];
            if ($desempeno == 'Excepcional') {
                $calificacion = 12;
            } else if ($desempeno == 'Excede Expectativas') {
                $calificacion = 11;
            } else if ($desempeno == 'Cumple Expectativas') {
                $calificacion = 10;
            } else if ($desempeno == 'Cumple Parcialmente Expectativas') {
                $calificacion = 8;
            } else if ($desempeno == 'Insatisfactorio') {
                $calificacion = 5;
            }
        } else {
            $calificacion = 0;
        }
        $avgDesempeno = ($calificacion * 30) / 100;
        $avgTotal[] =  number_format(floor(($avgEvaluacion + $avgDesempeno) * 100) / 100, 2);
        $faltanteDataCompetencias = 10 - number_format(floor(($avgEvaluacion + $avgDesempeno) * 100) / 100, 2);
    }
} else {
    $sql_matriz = mysqli_query($conn, "SELECT desempeno FROM t_matriz WHERE no_reloj ='$no_reloj'");
    if (mysqli_num_rows($sql_matriz) > 0) {
        $r = mysqli_fetch_assoc($sql_matriz);
        $desempeno = $r['desempeno'];
        if ($desempeno == 'Excepcional') {
            $calificacion = 10;
        } else if ($desempeno == 'Excede Expectativas') {
            $calificacion = 9.9;
        } else if ($desempeno == 'Cumple Expectativas') {
            $calificacion = 9.5;
        } else if ($desempeno == 'Cumple Parcialmente Expectativas') {
            $calificacion = 8;
        } else if ($desempeno == 'Insatisfactorio') {
            $calificacion = 9.5;
        }
    } else {
        $calificacion = 0;
    }

    $avgDesempeno = ($calificacion * 30) / 100;
    $avgTotal[] =  number_format(floor((0 + $avgDesempeno) * 100) / 100, 2);
    $faltanteDataCompetencias = 10 - number_format(floor((0 + $avgDesempeno) * 100) / 100, 2);
}
mysqli_free_result($sql_evaluacion);

$sql_gptw = mysqli_query($conn, "SELECT r_liderazgo FROM t_calificaciones_gptw WHERE no_reloj = '$no_reloj' AND anio_reg = '2021' LIMIT 1");
if (mysqli_num_rows($sql_gptw) > 0) {
    while ($data = mysqli_fetch_assoc($sql_gptw)) {
        $liderazgo = $data['r_liderazgo'];
    }
    mysqli_free_result($sql_gptw);
} else {
    $liderazgo = 0;
}
?>
<script>
    $('.btnModalCompetencias').on('click', function(e) {
        e.preventDefault();
        var no_reloj = $(this).data('id');
        $.ajax({
            type: "POST",
            url: "../../ajax/supervisor/ajax_modalCompetencias.php",
            data: {
                no_reloj: no_reloj
            },
            cache: false,
            success: function(data) {
                $('#modalCompetencias').modal('show');
                $('#modalCompetencias').find('.modal-body-gptw').html(data);
            },
            error: function(err) {
                console.log(err);
            }
        });
    });

    $('#modalGPTW').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var modal = $(this);
        var no_reloj = '<?= $no_reloj ?>';
        $.ajax({
            type: "POST",
            url: "../../ajax/reddin/ajax_modalGPTW.php",
            data: {
                no_reloj: no_reloj
            },
            cache: false,
            success: function(data) {
                modal.find('.modal-body-gptw').html(data);
            },
            error: function(err) {
                console.log(err);
            }
        });
    });

    //---------------CHART OBJETIVOS-----------------------//
    const datapointsObjetivos = <?php echo json_encode($arrayLogroObjetivos) ?>;
    const chartObjetivos = document.getElementById('dougnutObjetivos');
    const dataObjetivos = {
        labels: ['Cumplido', ''],
        datasets: [{
            data: [datapointsObjetivos[0], <?= $faltanteDataObjetivos ?>],
            backgroundColor: ['#31b17e', '#B5EAD5'],
            borderColor: '#31b17e',
            borderWidth: 0.05,
            cutout: '70%'
        }],
    };
    const porcentajeObjetivos = {
        id: 'porcentajeObjetivos',
        beforeDraw(chart, args, options) {
            const {
                ctx,
                chartArea: {
                    top,
                    right,
                    bottom,
                    left,
                    width,
                    height
                }
            } = chart;
            ctx.save();
            ctx.font = options.fontSize + 'px ' + options.fontFamily;
            ctx.textAlign = 'center';
            ctx.fillStyle = options.fontColor;
            ctx.fillText(datapointsObjetivos[0], width / 2, top + (height / 2) + (options.fontSize * 0 / 34));
        }
    }
    const doughnutObjetivos = new Chart(chartObjetivos, {
        type: 'doughnut',
        data: dataObjetivos,
        options: {
            events: [],
            animation: {
                duration: 0
            },
            responsive: true,
            plugins: {
                legend: false,
                title: {
                    display: true,
                    text: 'Objetivos'
                },
                porcentajeObjetivos: {
                    fontColor: '#3db686',
                    fontSize: 13,
                    fontFamily: 'sans-serif',
                    fontStyle: "bold",
                }
            }
        },
        plugins: [porcentajeObjetivos]
    });

    //---------------CHART EVALUACION COMPETENCIAS-----------------------//
    const datapointsCompetencias = <?php echo json_encode($avgTotal) ?>;
    const chartCompetencias = document.getElementById('dougnutCompetencias');
    const dataCompetencias = {
        labels: ['Cumplido', ''],
        datasets: [{
            data: [datapointsCompetencias[0], <?= $faltanteDataCompetencias ?>],
            backgroundColor: ['#f37b2f', '#F6C2A2'],
            borderColor: '#f37b2f',
            borderWidth: 0.05,

            cutout: '70%'
        }],
    };
    const porcentajeCompetencias = {
        id: 'porcentajeCompetencias',
        beforeDraw(chart, args, options) {
            const {
                ctx,
                chartArea: {
                    top,
                    right,
                    bottom,
                    left,
                    width,
                    height
                }
            } = chart;
            ctx.save();
            ctx.font = options.fontSize + 'px ' + options.fontFamily;
            ctx.textAlign = 'center';
            ctx.fillStyle = options.fontColor;
            ctx.fillText(datapointsCompetencias[0], width / 2, top + (height / 2) + (options.fontSize * 0 / 34));
        }
    }
    const doughnutComperencias = new Chart(chartCompetencias, {
        type: 'doughnut',
        data: dataCompetencias,
        options: {
            events: [],
            animation: {
                duration: 0
            },
            responsive: true,
            plugins: {
                legend: false,
                title: {
                    display: true,
                    text: 'Competencias'
                },
                porcentajeCompetencias: {
                    fontColor: '#f37b2f',
                    fontSize: 13,
                    fontFamily: 'sans-serif',
                    fontWeight: "bold",
                }
            }
        },
        plugins: [porcentajeCompetencias]
    });


    //---------------CHART GPTW-----------------------//
    const chartGPTW = document.getElementById('dougnutGPTW');
    const dataGPTW = {
        labels: ['Cumplido', ''],
        datasets: [{
            label: 'Dataset 1',
            data: [90, 10],
            backgroundColor: ['#dc3545', '#EAB9BE'],
            borderWidth: 1,
            cutout: '70%'
        }],
    };
    const porcentajeGPTW = {
        id: 'porcentajeGPTW',
        beforeDraw(chart, args, options) {
            const {
                ctx,
                chartArea: {
                    top,
                    right,
                    bottom,
                    left,
                    width,
                    height
                }
            } = chart;
            ctx.save();
            ctx.font = options.fontSize + 'px ' + options.fontFamily;
            ctx.textAlign = 'center';
            ctx.fillStyle = options.fontColor;
            ctx.fillText(<?= $liderazgo ?>, width / 2, top + (height / 2) + (options.fontSize * 0 / 34));
        }
    }
    const doughnutGPTW = new Chart(chartGPTW, {
        type: 'doughnut',
        data: dataGPTW,
        options: {
            events: [],
            animation: {
                duration: 0
            },
            responsive: true,
            plugins: {
                legend: false,
                title: {
                    display: true,
                    text: 'GPTW'
                },
                porcentajeGPTW: {
                    fontColor: '#dc3545',
                    fontSize: 13,
                    fontFamily: 'sans-serif',
                    fontStyle: "bold",
                }
            }
        },
        plugins: [porcentajeGPTW]
    });
</script>