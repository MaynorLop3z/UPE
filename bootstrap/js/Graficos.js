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