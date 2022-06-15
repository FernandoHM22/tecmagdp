function CargarDatosGraficaPlanes() {
    $.ajax({
        url: "../../control/reportes/graficas/planes/controlador_graficoPlanes.php",
        type: "POST"
    }).done(function(resp) {
        if (resp.length > 0) {
            var titulo = [];
            var cantidad = [];
            var colores = [];
            var data = JSON.parse(resp);
            for (var i = 0; i < data.length; i++) {
                titulo.push(data[i][0]);
                cantidad.push(data[i][1]);
                colores.push(random_rgba());
            }
            CrearGrafico(titulo, cantidad, 'bar', colores, 'graficoPlanes', 'Planes de Desarrollo');
        }
    });
};

function CargarDatosGraficaReddin() {
    $.ajax({
        url: "../../control/reportes/graficas/reddin/controlador_graficoReddin.php",
        type: "POST"
    }).done(function(resp) {
        if (resp.length > 0) {
            var titulo = [];
            var cantidad = [];
            var colores = [];
            var data = JSON.parse(resp);
            for (var i = 0; i < data.length; i++) {
                titulo.push(data[i][0]);
                cantidad.push(data[i][1]);
                colores.push(random_rgba());
            }
            CrearGrafico(titulo, cantidad, 'bar', colores, 'graficoReddin', 'Sesión de Talento');
        }
    });
};

function CrearGrafico(titulo, cantidad, tipo, colores, id, encabezado) {
    var ctx = document.getElementById(id);
    var myChart = new Chart(ctx, {
        type: tipo,
        data: {
            labels: titulo,
            datasets: [{
                label: '# of Votes',
                data: cantidad,
                backgroundColor: colores,
                borderColor: colores,
                borderWidth: 1
            }]
        },
        options: {
            legend: {
                display: false
            },
            responsive: true,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    },
                    scaleLabel: {
                        display: true,
                        labelString: "CANTIDAD DE PLANES REGISTRADOS",
                    }
                }],
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: "OPORTUNIDADES",
                    },
                }, ],
            },
            title: {
                display: true,
                text: encabezado + " (Total)",
                fontSize: 18,
                fontFamily: "Raleway"
            },
            tooltips: {
                enabled: true
            },
            hover: {
                animationDuration: 1
            },
            animation: {
                duration: 1,
                onComplete: function() {
                    var chartInstance = this.chart,
                        ctx = chartInstance.ctx;
                    ctx.textAlign = 'center';
                    ctx.font = "14px Raleway";
                    ctx.fillStyle = "rgba(0, 0, 0, 1)";
                    ctx.textBaseline = 'bottom';
                    // Loop through each data in the datasets
                    this.data.datasets.forEach(function(dataset, i) {
                        var meta = chartInstance.controller.getDatasetMeta(i);
                        meta.data.forEach(function(bar, index) {
                            var data = dataset.data[index];
                            ctx.fillText(data, bar._model.x, bar._model.y - 5);
                        });
                    });
                }
            }
        }
    });
}

function generarNumero(numero) {
    return (Math.random() * numero).toFixed(0);
}

function random_rgba() {
    var coolor = "(" + generarNumero(255) + "," + generarNumero(255) + "," + generarNumero(255) + ")";
    return "rgb" + coolor;
}


/*--------------------- GRAFICO CON PARAMETROS DE REGION*-----------------------------*/
/*--------------------- GRAFICO CON PARAMETROS DE REGION*-----------------------------*/
/*--------------------- GRAFICO CON PARAMETROS DE REGION*-----------------------------*/
/*
$('#AnioBusquedaGraficaPlanes').on('change', function() {
    CargarDatosGraficaPlanesParametros();
});
$('#AnioBusquedaGraficaReddin').on('change', function() {
    CargarDatosGraficaReddinParametros();
});

*/
$('#graficaPlanes').on('click', function() {
    CargarDatosGraficaPlanesParametros();
});

function CargarDatosGraficaPlanesParametros() {
    var region = $("#AnioBusquedaGraficaPlanes").val();
    $.ajax({
        url: "../../control/reportes/graficas/planes/controlador_graficoPlanesParametros.php",
        type: "POST",
        data: { region: region }
    }).done(function(resp) {
        if (resp.length > 0) {
            var titulo = [];
            var cantidad = [];
            var colores = [];
            var data = JSON.parse(resp);
            for (var i = 0; i < data.length; i++) {
                titulo.push(data[i][0]);
                cantidad.push(data[i][1]);
                colores.push(random_rgba());
            }
            if (region == 'all') {
                CrearGraficoParametros(titulo, cantidad, 'bar', colores, 'graficoPlanes', 'Planes de Desarrollo', region);
                $('#graficoPlanes').show();
                $('#central').hide();
                $('#west').hide();
                $('#east').hide();
            } else if (region == 'central') {
                CrearGraficoParametros(titulo, cantidad, 'bar', colores, 'central', 'Planes de Desarrollo', region);
                $('#graficoPlanes').hide();
                $('#central').show();
                $('#west').hide();
                $('#east').hide();
            } else if (region == 'west') {
                CrearGraficoParametros(titulo, cantidad, 'bar', colores, 'west', 'Planes de Desarrollo', region);
                $('#graficoPlanes').hide();
                $('#central').hide();
                $('#west').show();
                $('#east').hide();
            } else if (region == 'east') {
                CrearGraficoParametros(titulo, cantidad, 'bar', colores, 'east', 'Planes de Desarrollo', region);
                $('#graficoPlanes').hide();
                $('#central').hide();
                $('#west').hide();
                $('#east').show();
            }

        }
    });
};

$('#graficaReddin').on('click', function() {
    CargarDatosGraficaReddinParametros();
});

function CargarDatosGraficaReddinParametros() {
    var region = $("#AnioBusquedaGraficaReddin").val();
    $.ajax({
        url: "../../control/reportes/graficas/reddin/controlador_graficoReddinParametros.php",
        type: "POST",
        data: { region: region }
    }).done(function(resp) {
        if (resp.length > 0) {
            var titulo = [];
            var cantidad = [];
            var colores = [];
            var data = JSON.parse(resp);
            for (var i = 0; i < data.length; i++) {
                titulo.push(data[i][0]);
                cantidad.push(data[i][1]);
                colores.push(random_rgba());
            }
            if (region == 'all') {
                CrearGraficoParametros(titulo, cantidad, 'bar', colores, 'graficoReddin', 'Sesión de Talento', region);
                $('#graficoReddin').show();
                $('#centralReddin').hide();
                $('#westReddin').hide();
                $('#eastReddin').hide();
            } else if (region == 'central') {
                CrearGraficoParametros(titulo, cantidad, 'bar', colores, 'centralReddin', 'Sesión de Talento', region);
                $('#graficoReddin').hide();
                $('#centralReddin').show();
                $('#westReddin').hide();
                $('#eastReddin').hide();
            } else if (region == 'west') {
                CrearGraficoParametros(titulo, cantidad, 'bar', colores, 'westReddin', 'Sesión de Talento', region);
                $('#graficoReddin').hide();
                $('#centralReddin').hide();
                $('#westReddin').show();
                $('#eastReddin').hide();
            } else if (region == 'east') {
                CrearGraficoParametros(titulo, cantidad, 'bar', colores, 'eastReddin', 'Sesión de Talento', region);
                $('#graficoReddin').hide();
                $('#centralReddin').hide();
                $('#westReddin').hide();
                $('#eastReddin').show();
            }
        }
    });
};


function CrearGraficoParametros(titulo, cantidad, tipo, colores, id, encabezado, region) {
    var ctx = document.getElementById(id);
    var myChart = new Chart(ctx, {
        type: tipo,
        data: {
            labels: titulo,
            datasets: [{
                label: '# of Votes',
                data: cantidad,
                backgroundColor: colores,
                borderColor: colores,
                borderWidth: 1
            }]
        },
        options: {
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    },
                    scaleLabel: {
                        display: true,
                        labelString: "CANTIDAD DE PLANES REGISTRADOS",
                    }
                }],
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: "OPORTUNIDADES",
                    },
                }, ],
            },
            title: {
                display: true,
                text: encabezado + " (" + region + ")",
                fontSize: 18,
                fontFamily: "Raleway"
            },
            tooltips: {
                enabled: true
            },
            hover: {
                animationDuration: 1
            },
            animation: {
                duration: 1,
                onComplete: function() {
                    var chartInstance = this.chart,
                        ctx = chartInstance.ctx;
                    ctx.textAlign = 'center';
                    ctx.font = "14px Raleway";
                    ctx.fillStyle = "rgba(0, 0, 0, 1)";
                    ctx.textBaseline = 'bottom';
                    // Loop through each data in the datasets
                    this.data.datasets.forEach(function(dataset, i) {
                        var meta = chartInstance.controller.getDatasetMeta(i);
                        meta.data.forEach(function(bar, index) {
                            var data = dataset.data[index];
                            ctx.fillText(data, bar._model.x, bar._model.y - 5);
                        });
                    });
                }
            }
        }
    });
}