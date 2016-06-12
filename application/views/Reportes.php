<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->helper('url'); ?>
        <meta charset="UTF-8">
        <title>Reportes</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap -->          
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" href="../bootstrap/minerva.jpg" type="image/x-icon" />
        <script src="../bootstrap/js/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <h1>REPORTES</h1>
                    <div id="piechartTEST" style="width: 900px; height: 500px;"></div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
        <script language="javascript">
            google.charts.load('current', {'packages': ['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['Categoria', 'Cantidad']
                    <?php
                    foreach ($categorias as $cat) {
                        echo ",['".$cat->NombreCategoriaParticipante."',".$cat->CantidadParticipantes."]";
                    }
?>
                ]);

                var options = {
                    title: 'Cantidad de Alumnos por Categoria',
                    is3D: true,
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechartTEST'));

                chart.draw(data, options);
            }
        </script>
    </body>
</html>
