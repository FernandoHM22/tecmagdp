<?php
require_once '../../conexion/conexion.php';
$no_reloj = $_POST['no_reloj'];
?>
<div class="row justify-content-md-center">
    <div class="col-md-auto">
        <div class="chart-container" style=" position: relative; height: 85vh; width:80vw;">
            <canvas id="charHorizontalCompetencias"></canvas>
        </div>
    </div>
</div>
<?php
$sql_competencias = mysqli_query($conn, "SELECT * FROM t_evaluacion WHERE no_reloj = '$no_reloj' LIMIT 1") or die(mysqli_error($conn));
if (mysqli_num_rows($sql_competencias) > 0) {
    while ($row = mysqli_fetch_array($sql_competencias)) {
        $arrayResultadoCompetencias[] = $row['competencia1'] . ',' . $row['competencia2'] . ',' . $row['competencia3'] . ',' . $row['competencia4'] . ',' . $row['competencia5'] . ',' . $row['competencia6'] . ',' . $row['competencia7'] . ',' . $row['competencia8'] . ',' . $row['competencia9'] . ',' . $row['competencia10'] . ',' . $row['competencia11'] . ',' . $row['competencia12'] . ',' . $row['competencia13'] . ',' . $row['competencia14'] . ',' . $row['competencia15'] . ',' . $row['competencia16'] . ',' . $row['competencia17'] . ',' . $row['competencia18'] . ',' . $row['competencia19'] . ',' . $row['competencia20'];

        $avg =  (($row['competencia1'] + $row['competencia2'] + $row['competencia3'] + $row['competencia4'] + $row['competencia5'] + $row['competencia6'] + $row['competencia7'] + $row['competencia8'] + $row['competencia9'] + $row['competencia10'] + $row['competencia11'] + $row['competencia12'] + $row['competencia13'] + $row['competencia14'] + $row['competencia15'] + $row['competencia16'] + $row['competencia17'] + $row['competencia18'] + $row['competencia19'] + $row['competencia20']) / 20);
        // $avgEvaluacion =  ($avg * 70) / 100;
    }
    mysqli_free_result($sql_competencias);
} else {
    $arrayResultadoCompetencias[] = '';
    $avg = 0;
}

$arrayResultado = implode(",", $arrayResultadoCompetencias);
?>

<div class="row">
    <div class="col-md-6">
        <div class="jumbotron p-1">
            <p class="m-0 font-weight-bold">EVALUACIÓN DEL LÍDER: <span class="badge badge-info ml-1"><?= $avg ?></span></p>
        </div>
    </div>
    <div class="col-md-6">
        <?php
        $sql_evaluacion = mysqli_query($conn, "SELECT desempeno FROM t_matriz WHERE no_reloj = '$no_reloj'") or die(mysqli_error($conn));
        $data = mysqli_fetch_assoc($sql_evaluacion);
        $desempeno = $data['desempeno'];
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
        ?>
        <div class="jumbotron p-1">
            <p class="m-0 font-weight-bold">EVALUACIÓN EN CONCESO: <span class="badge badge-info ml-1"><?= $calificacion . '</span> '?></p>
            
        </div>
    </div>
</div>

<script>
    (() => {
        // setup 
        const data = {
            labels: ['Relación Con Superior', 'Relación Con Colegas', 'Relación Con Subordinados', 'Relación Con Asesores', 'Relación Con Grupos De Trabajo', 'Relación Con Clientes', 'Trato Con Publico En General', 'Creatividad', 'Fijación De Objetivos', 'Planeación', 'Manejo Del Cambio', 'Implementación', 'Controles', 'Evaluación', 'Productividad', 'Comunicación', 'Manejo De Conflictos', 'Manejo De Errores', 'Conducción De Juntas', 'Trabajo En Equipo'],
            datasets: [{
                data: [<?= $arrayResultado ?>],
                backgroundColor: [
                    'rgb(55, 179, 125)',
                    'rgb(247, 196, 7)',
                    'rgb(44, 129, 254)',
                    'rgb(34, 62, 109)'
                ],
                borderRadius: 5,
                borderSkipped: false,
                datalabels: {
                    color: '#000',
                    anchor: 'end',
                    align: 'end',
                    offset: 20,
                    font: {
                        weight: 'bold'
                    }

                }
            }]
        };

        // config 
        const config = {
            type: 'bar',
            data,
            plugins: [ChartDataLabels],
            options: {
                animation: {
                    duration: 0
                },
                indexAxis: 'y',
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: false
                        }

                    },
                    x: {
                        max: 10,
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        };

        // render init block
        const myChart = new Chart(
            document.getElementById('charHorizontalCompetencias'),
            config
        );
    })();
</script>