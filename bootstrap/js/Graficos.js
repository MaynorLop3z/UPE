function ParticipantesCantidadShow() {
$("#QuantityAlumCat").modal('toggle');
console.log("Entro");
}
;

$('#QuantityAlumCat').on('show.bs.modal', function(event) {
//     google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
        ]);

        var options = {
          title: 'My Daily Activities',
          is3D: true
          ,width:700
          ,height:400
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechartTEST'));

        chart.draw(data, options);
      }
});

