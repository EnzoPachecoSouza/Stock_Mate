<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Status', 'Quantidade'],
          ['Máxima',     11],
          ['Média',      2],
          ['Mínimo',  2],
          ['Desativado', 2]
        ]);

        var options = {
          title: 'Quantidade de Produtos',
          pieHole: 0.4,
          colors: ['#5cb85c', '#f0ad4e', '#d9534f', '#505050'] // Definindo as cores personalizadas
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="donutchart" style="width: 900px; height: 500px;"></div>
  </body>
</html>
