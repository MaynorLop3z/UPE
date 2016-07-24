function ParticipantesCantidadShow() {
    $("#QuantityAlumCat").modal('toggle');
//    console.log("Entro");
}
;

$('#QuantityAlumCat').on('show.bs.modal', function (event) {
    var posting = $.post("ReportesController/getCategoriasCantidad/", {Codigo: 1});
    posting.done(function (data) {
        if (data !== null) {
            var obj = jQuery.parseJSON(data);
            google.charts.load('current', {'packages': ['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Categoria');
                data.addColumn('number', 'Cantidad');
                for (var x in obj) {
//                    console.log(typeof( +obj[x].CantidadParticipantes ) );
                    data.addRow([obj[x].NombreCategoriaParticipante, +obj[x].CantidadParticipantes]);
                }
                //var data = google.visualization.arrayToDataTable(datos);
                var options = {
                    title: 'Cantidad de Alumnos por Categoria',
                    is3D: true,
                    width: 700,
                    height: 400
                };

                var chart = new google.visualization.PieChart(document.getElementById('AlumByCat'));

                chart.draw(data, options);
            }
        }
    });
    posting.fail(function (xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });
});


function GeneroXDiplomadoShow() {
    $("#QuantityGenderCat").modal('toggle');
}
;


$('#QuantityGenderCat').on('show.bs.modal', function (event) {
    var posting = $.post("ReportesController/getDiplomadosGenero/", {Codigo: 2});
    posting.done(function (data) {
        if (data !== null) {
            var obj = jQuery.parseJSON(data);
            google.charts.load('current', {'packages': ['bar']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Diplomado');
                data.addColumn('number', 'Hombres');
                data.addColumn('number', 'Mujeres');
                for (var x in obj) {
                    data.addRow([obj[x].NombreDiplomado, +obj[x].Hombres, +obj[x].Mujeres]);
                }
                var options = {
                    chart: {
                        title: 'Cantidad de Alumnos por Diplomados',
                        subtitle: 'Cantidad por genero',
                    },
                    bars: 'horizontal',
                    hAxis: {format: 'decimal'},
                    height: 400,
                    colors: ['#1b9e77', '#d95f02']
                };
                var chart = new google.charts.Bar(document.getElementById('GenderByCat'));

                chart.draw(data, google.charts.Bar.convertOptions(options));
            }
        }
    });
    posting.fail(function (xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });
});


function showGraphCatAlum(){  
    var posting = $.post("ReportesController/getCategoriasCantidad/", {Codigo: 1});
    var fecha = new Date();
    posting.done(function (data) {
        if (data !== null) {
            var obj = jQuery.parseJSON(data);
            var datos = new Array();
                for (var x in obj) {
                    datos[x] = {
                name: obj[x].NombreCategoriaParticipante,
                y: +obj[x].CantidadParticipantes
                };
            }
           $('#showGraphCatAlum').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Cantidad de Alumnos por Categoria al '+fecha.getDate()+'/'+fecha.getMonth()+'/'+fecha.getFullYear()
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: datos
        }]
    }); 
        }
    });
    posting.fail(function (xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });        
};


function showGraphCatQuen(){
     $('#showGraphCatQuen').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Historic World Population by Region'
        },
        subtitle: {
            text: 'Source: <a href="https://en.wikipedia.org/wiki/World_population">Wikipedia.org</a>'
        },
        xAxis: {
            categories: ['Africa', 'America', 'Asia', 'Europe', 'Oceania'],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Population (millions)',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' millions'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 80,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Year 1800',
            data: [107, 31, 635, 203, 2]
        }, {
            name: 'Year 1900',
            data: [133, 156, 947, 408, 6]
        }, {
            name: 'Year 2012',
            data: [1052, 954, 4250, 740, 38]
        }]
    });
};