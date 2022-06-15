<div class="card card-reddin">
    <div class="card-header">
        Indicadores
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="chart-container">
                    <a href="#">
                        <canvas id="dougnutCentral"></canvas>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="chart-container">
                    <a href="#">
                        <canvas id="dougnutWest"></canvas>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="chart-container">
                    <a href="#">
                        <canvas id="dougnutEast"></canvas>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
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
    const dougnutCentral = document.getElementById('dougnutCentral');
    const dougnutWest = document.getElementById('dougnutWest');
    const dougnutEast = document.getElementById('dougnutEast');
    const datapointsDougnut1 = [70, 30];
    const data = {
        labels: ['Cumplido', 'Faltante'],
        datasets: [{
            label: 'Dataset 1',
            data: datapointsDougnut1,
            backgroundColor: ['#67bd5b', '#ff404f'],
            borderWidth: 1,
            cutout: '70%'
        }],
    };
    const data2 = {
        labels: ['Cumplido', 'Faltante'],
        datasets: [{
            label: 'Dataset 1',
            data: [40, 60],
            backgroundColor: ['#67bd5b', '#ff404f'],
            borderWidth: 1,
            cutout: '70%'
        }],
    };
    const data3 = {
        labels: ['Cumplido', 'Faltante'],
        datasets: [{
            label: 'Dataset 1',
            data: [90, 10],
            backgroundColor: ['#67bd5b', '#ff404f'],
            borderWidth: 1,
            cutout: '70%'
        }],
    };

    const doughnutTextMiddleIndicadores = {
        id: 'doughnutTextMiddleIndicadores',
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
            ctx.fillText(datapointsDougnut1[0] + '%', width / 2, top + (height / 2) + (options.fontSize * 0 / 34));
        }
    }
    const doughnutTextMiddleIndicadores2 = {
        id: 'doughnutTextMiddleIndicadores2',
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
            ctx.fillText(datapointsDougnut1[0] + '%', width / 2, top + (height / 2) + (options.fontSize * 0 / 34));
        }
    }
    const doughnutTextMiddleIndicadores3 = {
        id: 'doughnutTextMiddleIndicadores3',
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
            ctx.fillText(datapointsDougnut1[0] + '%', width / 2, top + (height / 2) + (options.fontSize * 0 / 34));
        }
    }

    const myChart = new Chart(dougnutCentral, {
        type: 'doughnut',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: false,
                title: {
                    display: true,
                    text: 'Central'
                },
                doughnutTextMiddleIndicadores: {
                    fontColor: '#67bd5b',
                    fontSize: 13,
                    fontFamily: 'sans-serif',
                    fontStyle: "bold",
                }
            }
        },
        plugins: [doughnutTextMiddleIndicadores]
    });
    const myChart2 = new Chart(dougnutWest, {
        type: 'doughnut',
        data: data2,
        options: {
            responsive: true,
            plugins: {
                legend: false,
                title: {
                    display: true,
                    text: 'West'
                }
            }
        },
        plugins: [doughnutTextMiddleIndicadores2]
    });
    const myChart3 = new Chart(dougnutEast, {
        type: 'doughnut',
        data: data3,
        options: {
            responsive: true,
            plugins: {
                legend: false,
                title: {
                    display: true,
                    text: 'East'
                },
                doughnutTextMiddleIndicadores3: {
                    fontColor: '#67bd5b',
                    fontSize: 13,
                    fontFamily: 'sans-serif',
                    fontStyle: "bold",
                }
            }
        },
        plugins: [doughnutTextMiddleIndicadores3]
    });
</script>