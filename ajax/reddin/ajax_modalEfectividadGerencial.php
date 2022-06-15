<div class="chart-container-efectividad" style=" position: relative; height: 250px; width:460px;">
    <canvas id="chartEfectividad"></canvas>
</div>

<?php
require_once '../../conexion/conexion.php';
$no_reloj = $_POST['no_reloj'];
$años = array();
$calificaciones = array();
$sql_calificaciones_efectividad = mysqli_query($conn, "SELECT efectividad, anio_reg FROM t_efectividad_gerencial WHERE no_reloj = '$no_reloj' ORDER BY anio_reg ASC");

while ($r = mysqli_fetch_assoc($sql_calificaciones_efectividad)) {
    $años[] = "'" . $r['anio_reg'] . "'";
    $calificaciones[] = $r['efectividad'];
}
mysqli_free_result($sql_calificaciones_efectividad);
$años = implode(",", $años);
$calificaciones = implode(",", $calificaciones);
?>
<script>
    (() => {
        const chartEG = document.getElementById('chartEfectividad');
        const chartEfectividad = new Chart(chartEG, {
            data: {
                datasets: [{
                    type: 'bar',
                    data: [<?= $calificaciones ?>],
                    backgroundColor: 'rgba(37, 64, 143, 0.2)',
                    borderWidth: 1
                }, {
                    type: 'line',
                    data: [<?= $calificaciones ?>],
                    fill: false,
                    borderColor: '#25408f',
                    tension: 0.1
                }],
                labels: [<?= $años ?>]
            },
            plugins: [ChartDataLabels],
            options: {
                scales: {
                    y: {
                        max: 4,
                        min: 0,
                        ticks: {
                            stepSize: 1
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
    })();
</script>