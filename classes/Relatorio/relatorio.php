<?php
// require "../Produto/produto.service.php";
require ('../../classes/conexao.php');

$con = new Conexao();

$con2 = $con->conectar();

function relatorioQuantidade($con2){
  $query = '
  SELECT 
SUM(CASE 
      WHEN PRO_QUANTIDADE <= PRO_MINIMO AND PRO_STATUS = 1 THEN 1 
      ELSE 0 
  END) AS quantidade_produto_minimo_ativo,
SUM(CASE 
      WHEN PRO_QUANTIDADE > PRO_MINIMO AND PRO_QUANTIDADE <= PRO_MINIMO * 2 AND PRO_STATUS = 1 THEN 1 
      ELSE 0 
  END) AS quantidade_produto_entre_minimo_maximo_ativo,
SUM(CASE 
      WHEN PRO_QUANTIDADE > PRO_MINIMO * 2 AND PRO_STATUS = 1 THEN 1 
      ELSE 0 
  END) AS quantidade_produto_mais_que_maximo_ativo,
SUM(CASE 
      WHEN PRO_STATUS = 0 THEN 1 
      ELSE 0 
  END) AS quantidade_produto_desativado
FROM 
PRODUTOS;
  ';

  $stmt = $con2->prepare($query);

  $stmt->execute();

  return $stmt->fetch(PDO::FETCH_ASSOC);
}

$teste = relatorioQuantidade($con2);


// var_dump($teste);
?> 


<html>
  <head>
    <body>
      <input hidden value="<?= $teste['quantidade_produto_minimo_ativo'] ?>" id="qntMin">
      <input hidden value="<?= $teste['quantidade_produto_entre_minimo_maximo_ativo'] ?>" id="qntEntreMinMax">
      <input hidden value="<?= $teste['quantidade_produto_mais_que_maximo_ativo'] ?>" id="qntMaisQMax">
      <input hidden value="<?= $teste['quantidade_produto_desativado'] ?>" id="qntDesativado">
    </body>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      let qntMin = parseInt(document.querySelector('#qntMin').value);
      let qntEntreMinMax = parseInt(document.querySelector('#qntEntreMinMax').value);
      let qntMaisQMax = parseInt(document.querySelector('#qntMaisQMax').value);
      let qntDesativado = parseInt(document.querySelector('#qntDesativado').value);

      let teste = [];

      teste.push(qntMin);
      teste.push(qntEntreMinMax);
      teste.push(qntMaisQMax);
      teste.push(qntDesativado);

  

    console.log(typeof teste[0]);

      console.log(teste);

      google.charts.load("current", {'packages':["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Status', 'Quantidade'],
          ['Mínimo', teste[0]],
          ['Médio', teste[1]],
          ['Máxima', teste[2]],
          ['Desativado', teste[3]]
        ]);

        var options = {
          title: 'Quantidade de Produtos',
          pieHole: 0.4,
          colors: ['#dc3545', '#ffc107', '#28a745', '#505050'] // Definindo as cores personalizadas
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="donutchart" style="width: 900px; height: 450px;"></div>
  </body>
</html>