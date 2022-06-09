  <?php
  require_once __DIR__ . '/../../tools/carritoTools.php';
  require_once __DIR__ . '/../../tools/carritoTools.php';
  require_once __DIR__ . '/../../tools/httpTools.php';
  require_once __DIR__ . '/../../controllers/ventaAdapter.php';
  require_once __DIR__ . '/../../models/cliente.php';
  require_once __DIR__ . '/../../controllers/ventaDetalleAdapter.php';
  require_once __DIR__ . '/../../models/zapatilla.php';
  require_once __DIR__ . '/../../tools/mailTools.php';
  $fecha = date('d-m-Y');
  $hora = date('h:i:s');
  ?>
  <div style="margin:0;
            padding:0;
            font-weight:600;
            font-family:'Courier New', Courier, monospace
            ">
    <div class="background-page marginZero" style="padding:0;margin:0;">
      <div class="background-comprobante" style="background-color: #ffffff;
                                              width: 500px;
                                              margin: 20px auto;
                                             box-shadow: 0 0 5px #6e6e6e;
                                             border:1px solid #000;
                                              border-radius: 10px;
                                              padding: 30px;
                                              min-height: calc(100vh - 100px);
                                              padding:6px">
        <div class="content-comprobante" style="margin: 10px auto;width: 90%;">
          <div class="name-empresa" style="padding:6px;text-align:center;font-size:24px;">
            Palacio Chino Premium
          </div>
          <div class="location align fz1" style="padding:6px;
                                              text-align:center;
                                              font-size:18px;">
            Uruguay 908, Huancayo
          </div>
          <hr style="border: 1px dashed #000;">
          <div class="ruc-empresa align fz2" style="padding:6px;
                                                  font-size:18px;
                                                  text-align:center;">
            RUC: 10424068786
          </div>
          <hr style="border: 1px dashed #000;">
          <div class="number-boleta align fz2" style="padding:6px;
        font-size:18px;
        text-align:center;">
            Boleta De Venta Electronica
            <div class="numero-comprobante" style="padding:6px">
              N° <?php echo $idVenta; ?>
            </div>
          </div>
          <hr style="border: 1px dashed #000;">
          <div class="marginTop10px" style="padding:6px">
            Fecha de emisión:
            <div class="fecha-emision-comprobante inline" style="padding:6px;
                                                         display:inline-block;">
              <?php echo $fecha; ?>
            </div>
          </div>
          <div class="hora marginTop10px" style="padding:6px">
            Hora:
            <div class="hora-emision-comprobante" style="padding:6px;display:inline-block;">
              <?php echo $hora; ?>
            </div>
          </div>
          <div class="usuario marginTop10px" style="padding:6px">
            Señor(a):
            <div class="nombre-usuario inline" style="padding:6px;display:inline-block;">
              <?php echo ucwords($cliente->nombres) . "&nbsp" . ucwords($cliente->apellidos); ?>
            </div>
          </div>
          <div class="documento marginTop10px" style="padding:6px">
            DNI:
            <div class="dni inline" style="padding:6px;display:inline-block;">
              <?php echo $numeroDocumento; ?>
            </div>
          </div>
          <div class="direction marginTop10px" style="padding:6px">
            Dirección:
            <div class="direction-client inline" style="padding:6px;display:inline-block;">
              <?php foreach ($direccionListar as $direccion) : ?>
                <?php echo $direccion->direccion; ?>
              <?php endforeach; ?>
            </div>
          </div>
          <hr style="border: 1px dashed #000;">
          <div class="cant-desc-pre-tot-container" style="display: flex;
                                                        justify-content: space-around;
                                                        padding:6px">
            <div class="inline" style="padding:6px">Cant</div>
            <div class="inline" style="padding:6px">Descripción</div>
            <div class="inline" style="padding:6px">Precio</div>
            <div class="inline" style="padding:6px">Total</d>
            </div>
          </div>
          <hr style="border: 1px dashed #000;">
          <!-- DIV CONTENIDO CANTIDAD DESCRIPCION PRECIO PLATO -->
          <div class="compra-content">
            <table>
              <?php foreach ($carrito as $item) : ?>
                <tr>
                  <td style="width:110px;word-wrap: break-word;word-break:break-all;">
                    <?php echo $item['cantidad']; ?>
                  </td>
                  <td style="width:110px;word-wrap: break-word;word-break:break-all;">
                    <?php echo $item['producto']->nombreZapatilla; ?>
                  </td>
                  <td style="width:110px;word-wrap: break-word;word-break:break-all;text-align:end;padding:0 .3em 0 0;">
                    S/ <?php echo $item['producto']->precioZapatilla; ?>
                  </td>
                  <td style="width:110px;word-wrap: break-word;word-break:break-all;text-align:end;padding:0 .3em 0 0;">
                    S/ <?php echo $item['producto']->precioZapatilla * $item['cantidad']; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </table>
          </div>
          <!-- FIN CONTENIDO CANTIDAD DESCRIPCION PRECIO PLATO -->
          <hr style="border: 1px dashed #000;">
          <div class="igv marginTop10px" style="padding:6px; display:flex;justify-content:space-between;">
            <div>TOTAL IGV</div>
            <div>
              <?php foreach ($carrito as $item) : ?>
                <?php
                $a = [[$item['producto']->precioZapatilla, $item['cantidad']]];
                for ($i = 0; $i < count($a); $i++) {
                  $b[] = array_product($a[$i]);
                }
                $b = array_sum($b);
                $igv = $b * 0.18;
                echo $igv;
                ?>

              <?php endforeach; ?>
            </div>
          </div>
          <div class="importe-venta marginTop10px" style="padding:6px; display:flex;justify-content:space-between;">
            <div>
              IMPORTE TOTAL DE VENTA
            </div>
            <div>
              <?php foreach ($carrito as $item) : ?>
                <?php $igv = [(($item['producto']->precioZapatilla * $item['cantidad']) + (($item['cantidad'] * $item['producto']->precioZapatilla) * 0.18))];
                echo array_sum($igv); ?>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
        <div style="padding:6px">
          <p class="agradecimiento" style="position: absolute;
                                        bottom:auto;
                                        width:25% ;
                                        text-align: center;">
            MUCHAS GRACIAS POR SU COMPRA
          </p>
        </div>

      </div>
    </div>
  </div>