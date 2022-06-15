<?php
require_once '../../conexion/conexion.php';
$no_reloj = $_POST['no_reloj'];
?>
<div class="card cardResultadosGPTW">
    <div class="card-header">
        <div class="row">
            <div class="col">Resultados GPTW</div>
            <div class="col text-right">
                <?php
                $sql_num_colaboradores = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(no_reloj) as colaboradoresTotales FROM registrogdp WHERE no_reloj_supervisor = '$no_reloj'"));
                $totalColaboradores = $sql_num_colaboradores['colaboradoresTotales'];
                if ($totalColaboradores != '') {
                    echo 'Colaboradores: <span class="badge badge-info">'.$totalColaboradores.'</span>';
                }else{
                    $totalColaboradores = 0;
                    echo 'Colaboradores: <span class="badge badge-info">'.$totalColaboradores.'</span>';
                }
                ?>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-2 colTitulo">
                <span>LIDERARZGO</span>
            </div>
            <div class="col-md-2">
                <div class="chart-container-efectividad" style="position: relative; height: 7vh; width: 4vw;">
                    <canvas id="chartPieLiderazgo"></canvas>
                </div>
            </div>
            <div class="col-md-2 colTitulo">
                <span>EMPRESA</span>
            </div>
            <div class="col-md-2">
                <div class="chart-container-efectividad" style="position: relative; height: 7vh; width: 4vw;">
                    <canvas id="chartPieEmpresa"></canvas>
                </div>
            </div>
            <div class="col-md-2 colTitulo">
                <span>COMPAÑERISMO</span>
            </div>
            <div class="col-md-2">
                <div class="chart-container-efectividad" style="position: relative; height: 7vh; width: 4vw;">
                    <canvas id="chartPieCompanerismo"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-md-center">
    <div class="col-md-auto">
        <div class="chart-container" style=" position: relative; height: 42vh; width:41vw;">
            <canvas id="chartLiderazgo"></canvas>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="chart-container" style=" position: relative; height: 45vh; width:42vw;">
            <canvas id="chartEmpresa"></canvas>
        </div>
    </div>
    <div class="col-md-6">
        <div class="chart-container" style=" position: relative; height: 45vh; width:37vw;">
            <canvas id="chartCompanerismo"></canvas>
        </div>
    </div>
</div>

<?php
//SQL RESULTADO DE LIDERAZGO
// $anioActual = Date('Y');
$dataLiderazgo = array();
$dataEmpresa = array();
$dataCompanerismo = array();
$sql_calificaciones_gptw = mysqli_query($conn, "SELECT * FROM t_calificaciones_gptw WHERE no_reloj = '$no_reloj' AND anio_reg = '2021' LIMIT 1") or die(mysqli_error($conn));
if (mysqli_num_rows($sql_calificaciones_gptw) > 0) {
    while ($row = mysqli_fetch_array($sql_calificaciones_gptw)) {
        $dataLiderazgo[] = '"' . $row['4'] . '",' . '"' . $row['5'] . '",' . '"' . $row['6'] . '",' . '"' . $row['7'] . '",' . '"' . $row['8'] . '",' . '"' . $row['9'] . '",' . '"' . $row['10'] . '",' . '"' . $row['11'] . '",' . '"' . $row['12'] . '",' . '"' . $row['13'] . '"';

        $dataEmpresa[] = '"' . $row['14'] . '",' . '"' . $row['15'] . '",' . '"' . $row['16'] . '",' . '"' . $row['17'] . '",' . '"' . $row['18'] . '",' . '"' . $row['19'] . '",' . '"' . $row['20'] . '"';

        $dataCompanerismo[] = '"' . $row['21'] . '",' . '"' . $row['22'] . '",' . '"' . $row['23'] . '"';

        $resultadoLiderazgo = $row[24];
        $resultadoEmpresa = $row[25];
        $resultadoCompanerismo =  $row[26];
    }
    mysqli_free_result($sql_calificaciones_gptw);
} else {
    $resultadoLiderazgo = 0;
    $resultadoEmpresa = 0;
    $resultadoCompanerismo = 0;
}

$dataLiderazgo = implode(",", $dataLiderazgo);
$dataEmpresa = implode(',', $dataEmpresa);
$dataCompanerismo = implode(',', $dataCompanerismo);
$resultadoFaltantesLiderazgo = 10.00 - (float)$resultadoLiderazgo;
$resultadoFaltantesEmpresa = 10.00 - (float)$resultadoEmpresa;
$resultadoFaltantesCompanerismo = 10.00 - (float)$resultadoCompanerismo;
?>
<script>
    (() => {
        const chartResultadosLiderazgo = document.getElementById('chartLiderazgo');
        const chartResultadosEmpresa = document.getElementById('chartEmpresa');
        const chartResultadosCompanerismo = document.getElementById('chartCompanerismo');
        const chartLiderazgo = new Chart(chartResultadosLiderazgo, {
            data: {
                labels: ['Respeto', 'Confianza', 'Credibilidad', 'Cuidando', 'Escuchando(ideas)', 'Escuchando (acuerdos)', 'Comunicando', 'Agradeciendo', 'Imparcialidad (empleados)', 'Imparcialidad (asensos)'],
                datasets: [{
                    type: 'bar',
                    data: [<?= $dataLiderazgo ?>],
                    backgroundColor: 'rgba(224, 106, 37, 0.6)',
                    borderWidth: 1
                }]
            },
            plugins: [ChartDataLabels],
            options: {
                responsive: true,
                scales: {
                    y: {
                        max: 11,
                        min: 0,
                        ticks: {
                            stepSize: 1.2
                        }
                    }
                },
                animation: {
                    duration: 0
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Liderazgo'
                    },
                    datalabels: {
                        color: '#000',
                        anchor: 'center',
                        align: 'center',
                        font: {
                            size: '12px',
                            weight: 'bold'
                        }
                    }
                }
            },
        });

        const chartEmpresa = new Chart(chartResultadosEmpresa, {
            data: {
                labels: ['Orgullo', 'Beneficios', 'Clima Laboral', 'Salario', 'Capacitaciones', 'Trato', 'Crecimiento Personal'],
                datasets: [{
                    type: 'bar',
                    data: [<?= $dataEmpresa ?>],
                    backgroundColor: 'rgba(48, 131, 137, 0.6)',
                    borderWidth: 1
                }]
            },
            plugins: [ChartDataLabels],
            options: {
                responsive: true,
                scales: {
                    y: {
                        max: 11,
                        min: 0,
                        ticks: {
                            stepSize: 1.2
                        }
                    }
                },
                animation: {
                    duration: 0
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Empresa'
                    },
                    datalabels: {
                        color: '#000',
                        anchor: 'center',
                        align: 'center',
                        font: {
                            size: '12px',
                            weight: 'bold'
                        }
                    }
                }
            },
        });
        const chartCompanerismo = new Chart(chartResultadosCompanerismo, {
            data: {
                labels: ['Confianza', 'Respeto', 'Trabajo en Equipo'],
                datasets: [{
                    type: 'bar',
                    data: [<?= $dataCompanerismo ?>],
                    backgroundColor: 'rgba(37, 64, 143, 0.6)',
                    borderWidth: 1
                }]
            },
            plugins: [ChartDataLabels],
            options: {
                responsive: true,
                scales: {
                    y: {
                        max: 11,
                        min: 0,
                        ticks: {
                            stepSize: 1.2
                        }
                    }
                },
                animation: {
                    duration: 0
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Compañerismo'
                    },
                    datalabels: {
                        color: '#000',
                        anchor: 'center',
                        align: 'center',
                        font: {
                            size: '12px',
                            weight: 'bold'
                        }
                    }
                }
            },
        });
        const pieLiderazgo = document.getElementById('chartPieLiderazgo');
        const pieEmpresa = document.getElementById('chartPieEmpresa');
        const pieCompanerismo = document.getElementById('chartPieCompanerismo');
        const chartDataPie = {
            labels: ['Cumplido', 'Faltante'],
            datasets: [{
                label: 'Dataset 1',
                data: [<?= $resultadoLiderazgo ?>, <?= $resultadoFaltantesLiderazgo ?>],
                backgroundColor: ['#67bd5b', '#ff404f'],
                borderWidth: 1,
                cutout: '70%'
            }],
        };
        const chartDataPie2 = {
            labels: ['Cumplido', 'Faltante'],
            datasets: [{
                label: 'Dataset 1',
                data: [<?= $resultadoEmpresa ?>, <?= $resultadoFaltantesEmpresa ?>],
                backgroundColor: ['#67bd5b', '#ff404f'],
                borderWidth: 1,
                cutout: '70%'
            }],
        };
        const chartDataPie3 = {
            labels: ['Cumplido', 'Faltante'],
            datasets: [{
                label: 'Dataset 1',
                data: [<?= $resultadoCompanerismo ?>, <?= $resultadoFaltantesCompanerismo ?>],
                backgroundColor: ['#67bd5b', '#ff404f'],
                borderWidth: 1,
                cutout: '70%'
            }],
        };

        const doughnutTextMiddleGPTW = {
            id: 'doughnutTextMiddleGPTW',
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
                ctx.fillText(<?= $resultadoLiderazgo ?>, width / 2, top + (height / 2) + (options.fontSize * 0 / 34));
            }
        }
        const doughnutTextMiddleGPTW2 = {
            id: 'doughnutTextMiddleGPTW2',
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
                ctx.fillText(<?= $resultadoEmpresa ?>, width / 2, top + (height / 2) + (options.fontSize * 0 / 34));
            }
        }
        const doughnutTextMiddleGPTW3 = {
            id: 'doughnutTextMiddleGPTW3',
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
                ctx.fillText(<?= $resultadoCompanerismo ?>, width / 2, top + (height / 2) + (options.fontSize * 0 / 34));
            }
        }

        const ChartGPTW = new Chart(pieLiderazgo, {
            type: 'doughnut',
            data: chartDataPie,
            options: {
                responsive: true,
                animation: {
                    duration: 0
                },
                plugins: {
                    legend: false,
                    doughnutTextMiddleGPTW: {
                        fontColor: '#000',
                        fontSize: 13,
                        fontFamily: 'Raleway',
                        fontStyle: "bold",
                    },
                    tooltip: {
                        enabled: false
                    }
                }
            },
            plugins: [doughnutTextMiddleGPTW]
        });
        const ChartGPTW2 = new Chart(pieEmpresa, {
            type: 'doughnut',
            data: chartDataPie2,
            options: {
                responsive: true,
                animation: {
                    duration: 0
                },
                plugins: {
                    legend: false,
                    doughnutTextMiddleGPTW2: {
                        fontColor: '#000',
                        fontSize: 13,
                        fontFamily: 'Raleway',
                        fontStyle: "bold",
                    },
                    tooltip: {
                        enabled: false
                    }
                }
            },
            plugins: [doughnutTextMiddleGPTW2]
        });
        const ChartGPTW3 = new Chart(pieCompanerismo, {
            type: 'doughnut',
            data: chartDataPie3,
            options: {
                responsive: true,
                animation: {
                    duration: 0
                },
                plugins: {
                    legend: false,
                    doughnutTextMiddleGPTW3: {
                        fontColor: '#000',
                        fontSize: 13,
                        fontFamily: 'Raleway',
                        fontStyle: "bold",
                    },
                    tooltip: {
                        enabled: false
                    }
                }
            },
            plugins: [doughnutTextMiddleGPTW3]
        });
    })();
</script>