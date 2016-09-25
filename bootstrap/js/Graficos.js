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


function showGraphCatAlum() {
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
                    text: 'Cantidad de Alumnos por Categoria al ' + fecha.getDate() + '/' + fecha.getMonth() + '/' + fecha.getFullYear()
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
}
;


function showGraphCatQuen() {
    var posting = $.post("ReportesController/getDiplomadosGenero/", {Codigo: 1});
    posting.done(function (data) {
        if (data !== null) {
            var obj = jQuery.parseJSON(data);
            var categorias = new Array();
            var hombres = new Array();
            var mujeres = new Array();
            for (var x in obj) {
                categorias[x] = obj[x].NombreDiplomado;
                hombres[x] = parseInt(obj[x].Hombres, 10);
                mujeres[x] = parseInt(obj[x].Mujeres, 10);
//                console.log(obj);
            }
//            console.log(categorias);
//            console.log(hombres);
//            console.log(mujeres);
            $('#showGraphCatQuen').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'AFLUENCIA DE PERSONA A DIPLOMADOS'
                },
                subtitle: {
                    text: 'DETALLADO POR GENERO'
                },
                xAxis: {
                    labels: {
                        rotation: -45,
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }},
                    categories: categorias,
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Cantidad Personas'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                        name: 'Hombres',
                        data: hombres

                    }, {
                        name: 'Mujeres',
                        data: mujeres

                    }]
            });
        }
    });
    posting.fail(function (xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });
}
;