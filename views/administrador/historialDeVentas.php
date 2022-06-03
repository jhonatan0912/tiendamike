<?php
require_once __DIR__ . '/../../controllers/historialVentasAdapter.php';
require_once __DIR__ . '/../../controllers/ventaAdapter.php';
require_once __DIR__ . '/../../tools/httpTools.php';

$date = $_POST['date'];
$historiales = HistorialVentasAdapter::historialByDate($date);
$numberOfSales = VentaAdapter::salesChart($date);
$dataPoints = array(
  array("y" => $numberOfSales, "label" => "$date"),
);
if ($historiales == null) {
  HttpTools::redireccionar('/views/administrador/index.php');
}
$suma = 0;
?>
<html lang="ES-PE">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/assets/css/style--historial--ventas.css">
  <link rel="shortcut icon" href="/assets/imagenes/logochifa.png" type="image/x-icon">
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <title>Historial de ventas</title>
</head>

<body>
  <div class="container-logo-title">
    <div class="container-logo">
      <a href="/views/administrador/index.php">
        <img class="img-logo" src="/assets/imagenes/logochifa.png">
      </a>
    </div>
    <div class="container-title">
      <div>HISTORIAL DE VENTAS</div>
    </div>
  </div>
  <div class="chart">
    <div id="chartContainer" style="height: 300px; width: 100%;max-width:380px;">
    </div>
  </div>
  <table>
    <tr>
      <th class="shadow">N° Venta</th>
      <th>Cliente</th>
      <th class="shadow">Correo</th>
      <th>N° Celular</th>
      <th class="shadow">Indicaciones</th>
      <th>Direccion</th>
      <th class="shadow">Fecha - Hora</th>
      <th>Tipo de comprobante</th>
      <th class="shadow">N° Documento</th>
      <th>Variedad</th>
      <th class="shadow">NombrePlato</th>
      <th>PrecioPlato</th>
    </tr>
    <!-- FILA CON DATOS -->
    <?php foreach ($historiales as $historial) : ?>
      <tr>
        <td>
          <?php echo $historial->idVenta ?>
        </td>
        <td>
          <?php echo ucwords($historial->nombres)
            . "&nbsp;&nbsp;" .
            ucwords($historial->apellidos);
          ?>
        </td>
        <td>
          <?php echo $historial->correo ?>
        </td>
        <td>
          <?php echo $historial->celular ?>
        </td>
        <td>
          <?php echo $historial->indicaciones ?>
        </td>
        <td>
          <?php echo $historial->direccion ?>
        </td>
        <td>
          <?php echo $historial->fechaHora ?>
        </td>
        <td>
          <?php echo $historial->tipoComprobante ?>
        </td>
        <td>
          <?php echo $historial->numeroDocumento ?>
        </td>
        <td>
          <?php echo $historial->nombreVariedad ?>
        </td>
        <td>
          <?php echo $historial->nombrePlato ?>
        </td>
        <td>
          <?php echo $historial->precioPlato ?>
        </td>
      </tr>
    <?php endforeach; ?>
    <!-- END FILA CON DATOS -->
  </table>

  <script>
    window.onload = function() {
      var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        exportEnabled: true,
        theme: "dark1", // "light1", "light2", "dark1", "dark2"
        title: {
          text: "Historial de ventas por día"
        },
        axisY: {
          includeZero: true
        },
        data: [{
          type: "bar", //change type to bar, line, area, pie, etc
          //indexLabel: "{y}", //Shows y value on all Data Points
          indexLabelFontColor: "#5A5757",
          indexLabelPlacement: "outside",
          dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
      });
      chart.render();
    }
  </script>
</body>

</html>