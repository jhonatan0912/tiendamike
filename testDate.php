  <?php
  require_once __DIR__ . '/controllers/ventaAdapter.php';
  if ($_POST['date']) {
    $date = $_POST['date'];
    $dias = VentaAdapter::salesChart($date);
    $historial = VentaAdapter::getNumberOfSales();
  }
  ?>
  <html>

  <head>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  </head>

  <body>



    <form action="" method="POST">
      <input type="date" name="date">
      <input type="submit" name="submit">
      <br>
      <?php foreach ($dias as $dia) : ?>
        <input type="text" value="<?php echo $dia->fechaHora ?>">
        <?php $yaxis = ventaAdapter::yAxis($dia->fechaHora);
        echo $yaxis;
        echo "<br>";
        ?>
      <?php endforeach; ?>
    </form>


  </body>

  </html>