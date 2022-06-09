<?php
require_once __DIR__ . '/../../controllers/historialVentasAdapter.php';
require_once __DIR__ . '/../../controllers/ventaAdapter.php';
require_once __DIR__ . '/../../tools/httpTools.php';
error_reporting(0);
// $date = $_POST['date'];
$historiales = HistorialVentasAdapter::historialByDate($date);
// if ($historiales == null) {
// HttpTools::redireccionar('/views/administrador/index.php');
// }
// $suma = 0;
?>
<html lang="ES-PE">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/assets/css/style--historial--ventas.css">
  <link rel="shortcut icon" href="/assets/imagenes/logoTienda.png" type="image/x-icon">
  <script src="https://kit.fontawesome.com/a413ea44fb.js" crossorigin="anonymous"></script>
  <title>Historial de ventas</title>
</head>

<body>
  <div class="container-logo-title">
    <a href="/views/administrador/index.php"> <i class="fas fa-angle-double-left"></i></a>
    <div class="container-title">
      <div>HISTORIAL DE VENTAS</div>
    </div>
  </div>
  <table>
    <tr>
      <th class="shadow">N. Venta</th>
      <th>Cliente</th>
      <th class="shadow">Fecha de compra</th>
      <th>Nombre zapatilla</th>
      <th class="shadow">Precio Zapatilla</th>
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
          <?php echo $historial->fechaHora ?>
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

</body>

</html>