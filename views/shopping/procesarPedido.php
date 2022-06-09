<?php
require_once __DIR__ . '/../../tools/carritoTools.php';
require_once __DIR__ . '/../../tools/httpTools.php';
require_once __DIR__ . '/../../controllers/ventaAdapter.php';
require_once __DIR__ . '/../../models/cliente.php';
require_once __DIR__ . '/../../controllers/ventaDetalleAdapter.php';
require_once __DIR__ . '/../../models/zapatilla.php';
require_once __DIR__ . '/../../tools/mailTools.php';
require_once __DIR__ . '/../../controllers/direccionAdapter.php';
date_default_timezone_set('America/Lima');
$direccion = $_POST['direccion'];
$carrito = CarritoTools::obtener();
$cliente = HttpTools::getCliente();
$celular = $_POST['celular'];
$fechaHora = date('Y-m-d h:i:s', time());
//*  VARIABLES PARA FECHA Y HORA
$fecha = date('d-m-Y');
//? echo date_format($fecha,"d/m/Y ");  
$hora = date('h:i:s');
//?echo $hora;
//*
$venta = new Venta($cliente->idCliente, 0, $celular, '', $direccion, $fechaHora, 1, "12345678");
$idVenta = VentaAdapter::crear($venta);
$direccionListar = DireccionAdapter::listar($cliente->idCliente);
foreach ($carrito as $item) {
  $ventaDetalle = new VentaDetalle($idVenta, 0, $item['producto']->idZapatilla, $item['cantidad'], $item['producto']->precioZapatilla);
  $vdId = VentaDetalleAdapter::crear($ventaDetalle);
  CarritoTools::elmininarTodosProductos();
}
//? ENVIAR MAIL
?>
<!--START VOUCHER  -->
<?php
ob_start();
?>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="/assets/imagenes/logoTienda.png" type="image/x-icon">
  <title>Comprobante</title>
</head>

<body>

  <div style='margin:0;
            padding:0;
            font-weight:600;
            font-family: Courier New, Courier, monospace'>
    <div class=' background-page marginZero' style='padding:0;margin:0;'>
      <div class='background-comprobante' style='background-color: #ffffff;
                                              width: 500px;
                                              margin: 20px auto;
                                             box-shadow: 0 0 5px #6e6e6e;
                                             border:1px solid #000;
                                              border-radius: 10px;
                                              padding: 30px;
                                              min-height: calc(100vh - 100px);
                                              padding:6px'>
        <div class='content-comprobante' style='margin: 10px auto;width: 90%;'>
          <div class='name-empresa' style='padding:6px;text-align:center;font-size:24px;color:#000;'>
            Calzados Mike
          </div>
          <hr style='border: 1px solid #000;'>
          <div class='ruc-empresa align fz2' style='padding:6px;
                                                  font-size:18px;
                                                  text-align:center;
                                                  color:#000;'>
            RUC: 10453676183
          </div>
          <hr style='border: 1px solid #000;'>
          <div style='padding:6px; font-size:18px; text-align:center;'>
            Boleta Electrónica
            <div class='numero-comprobante' style='padding:6px'>
              N° <?php echo $idVenta; ?>
            </div>
          </div>
          <hr style='border: 1px solid #000;'>
          <div class='marginTop10px' style='padding:6px;color:#000;'>
            Fecha de emisión:
            <div class='fecha-emision-comprobante inline' style='padding:6px;
                                                         display:inline-block;
                                                         color:#000;'>
              <?php echo $fecha; ?>
            </div>
          </div>
          <div class='hora marginTop10px' style='padding:6px'>
            Hora:
            <div class='hora-emision-comprobante' style='padding:6px;display:inline-block;'>
              <?php echo $hora; ?>
            </div>
          </div>
          <div class='usuario marginTop10px' style='padding:6px;color:#000;'>
            Señor(a):
            <div class='nombre-usuario inline' style='padding:6px;display:inline-block;color:#000;'>
              <?php echo ucwords($cliente->nombres) . 'ㅤ' . ucwords($cliente->apellidos); ?>
            </div>
          </div>
          <div class='direction marginTop10px' style='padding:6px;color:#000;'>
            Dirección:
            <div class='direction-client inline' style='padding:6px;display:inline-block;color:#000;'>
              <?php echo $direccion ?>
            </div>
          </div>
          <hr style='border: 1px solid #000;'>
          <div style='display: flex;
                      padding:6px;
                      justify-content:space-around'>

            <div class='inline' style='width:100px;text-align:center'>Cant.</div>
            <div class='inline' style='width:150px'>Descripción</div>
            <div class='inline' style='width:100px;text-align:center'>Precio</div>
            <div class='inline' style='width:100px;text-align:center'>Total</d>
            </div>
          </div>
          <hr style='border: 1px solid #000;'>
          <!-- DIV CONTENIDO CANTIDAD DESCRIPCION PRECIO PLATO -->
          <div class='compra-content'>
            <table>
              <?php foreach ($carrito as $item) : ?>
                <tr>
                  <td style='width:100px;text-align:center'>
                    <?php echo $item['cantidad']; ?>
                  </td>
                  <td style='width:150px'>
                    <?php echo $item['producto']->precioZapatilla ?>
                  </td>
                  <td style='width:100px;text-align:center'>
                    S/ <?php echo$item['producto']->precioZapatilla; ?>
                  </td>
                  <td style='width:100px;text-align:center'>
                    S/ <?php echo$item['producto']->precioZapatilla * $item['cantidad']; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </table>
          </div>
          <!-- FIN CONTENIDO CANTIDAD DESCRIPCION PRECIO PLATO -->
          <hr style='border: 1px solid #000;'>
          <div style='padding:6px; display:flex; justify-content:space-between;'>
            <div style='width:80%'>COSTO DE TRANSPORTE</div>
            <div>
              <?php
              $subtotal = 0;
              foreach ($carrito as $item) {
                $precio =$item['producto']->precioZapatilla;
                $cantidad = $item['cantidad'];
                $costo = $precio * $cantidad;
                $subtotal = $subtotal + $costo;
                $igv = $subtotal * 0.18;
              }
              echo "S/" . "20";
              ?>
            </div>
          </div>
          <div class='importe-venta marginTop10px' style='padding:6px; display:flex;justify-content:space-between;'>
            <div style='width:80%'>IMPORTE TOTAL DE VENTA
            </div>
            <div>
              <?php
              $subtotal = 0;
              $total = 0;
              foreach ($carrito as $item) {
                $precio =$item['producto']->precioZapatilla;
                $cantidad = $item['cantidad'];
                $costo = ($precio * $cantidad) + 20;
              }
              echo "S/" . $costo;
              ?>
            </div>
          </div>
        </div>
        <div style='padding:6px;text-align:center'>
          MUCHAS GRACIAS POR SU COMPRA
        </div>

      </div>
    </div>
  </div>
</body>

</html>
<?php
$comprobante = ob_get_clean();
?>
<?php
echo $comprobante;
$boletaEnviada = MailTools::enviar($cliente->correo, 'Compra realizada con exito!', $comprobante);
?>