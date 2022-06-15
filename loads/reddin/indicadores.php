<?php
require_once '../../conexion/conexion.php';
$no_reloj = $_POST['no_reloj'];
?>
<div class="card card-reddin">
    <div class="card-header">
        Indicadores
    </div>
    <div class="card-body">
        <div class="col-md-12">
            <div class="chart-container">
                <a href="#">
                    <canvas id="dougnutObjetivos"></canvas>
                </a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="chart-container">
                <a href="#">
                    <canvas id="dougnutPlanes"></canvas>
                </a>
            </div>
        </div>
        <div class="col-md-12">
            <div class="chart-container">
                <a href="#" data-toggle="modal" data-target="#modalGPTW">
                    <canvas id="dougnutGPTW"></canvas>
                </a>
            </div>
        </div>
        <div class="col-md-12 text-center pt-2 divEfectividadGerencial">
            <span data-toggle="modal" data-target="#modalEfectividadGerencial" >Efectividad Gerencial</span><br>
            <!-- <?php
            $sql_efectividad = mysqli_fetch_assoc(mysqli_query($conn, "SELECT efectividad FROM t_efectividad_gerencial WHERE no_reloj = '$no_reloj' ORDER BY  anio_reg DESC LIMIT 1"));
            $efectividad = $sql_efectividad['efectividad'];
            if($efectividad != ''){
                echo '<a href="#" data-toggle="modal" data-target="#modalEfectividadGerencial">' . $efectividad . '</a>'; 
            }else{
                $efectividad  = 0;
                echo '<a href="#" data-toggle="modal" data-target="#modalEfectividadGerencial">' . $efectividad . '</a>';
            }
            ?> -->
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
<div class="modal fade" id="modalEfectividadGerencial" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Efectividad Gerencial</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
            </div>
            <div class="modal-body-efectividad p-3"></div>
        </div>
    </div>
</div>
<?php
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
    $('#modalEfectividadGerencial').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var modal = $(this);
        var no_reloj = '<?= $no_reloj ?>';
        $.ajax({
            type: "POST",
            url: "../../ajax/reddin/ajax_modalEfectividadGerencial.php",
            data: {
                no_reloj: no_reloj
            },
            cache: false,
            success: function(data) {
                modal.find('.modal-body-efectividad').html(data);
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
    const ctx = document.getElementById('dougnutObjetivos');
    const doughnutPlanes = document.getElementById('dougnutPlanes');
    const dougnutGPTW = document.getElementById('dougnutGPTW');
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
            ctx.fillText(<?= $liderazgo ?>, width / 2, top + (height / 2) + (options.fontSize * 0 / 34));
        }
    }

    const myChart = new Chart(ctx, {
        type: 'doughnut',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: false,
                title: {
                    display: true,
                    text: 'Objetivos'
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
    const myChart2 = new Chart(doughnutPlanes, {
        type: 'doughnut',
        data: data2,
        options: {
            responsive: true,
            plugins: {
                legend: false,
                title: {
                    display: true,
                    text: 'Reddin'
                }
            }
        },
    });
    const myChart3 = new Chart(dougnutGPTW, {
        type: 'doughnut',
        data: data3,
        options: {
            responsive: true,
            plugins: {
                legend: false,
                title: {
                    display: true,
                    text: 'GPTW'
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