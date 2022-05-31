<?php
require_once __DIR__ . '/../../models/cliente.php';
require_once __DIR__ . '/../../controllers/platoAdapter.php';
require_once __DIR__ . '/../../tools/carritoTools.php';
require_once __DIR__ . '/../../tools/httpTools.php';
require_once __DIR__ . '/../../controllers/direccionAdapter.php';
HttpTools::iniciarSesion();
$logeado = HttpTools::validarClienteLogeado();
$nd = 1;
if (!$logeado) {
  HttpTools::redireccionar('/views/seguridad/p-login-clientes.php?redireccionar=/views/shopping/checkout.php');
}
$cliente = HttpTools::getCliente();
// FIN VALIDACION INICIO DE SESION
// CARRITO DE COMPRAS
$carrito = CarritoTools::obtener();
/**
 * Resumen/precio pedido
 */
$subtotal = 0;
foreach ($carrito as $item) {
  $precio = $item['producto']->precioPlato;
  $cantidad = $item['cantidad'];
  $costo = $precio * $cantidad;
  $subtotal = $subtotal + $costo;
}
// Traemos las direcciones del cliente
$direcciones = DireccionAdapter::listar($cliente->idCliente);
// valores de variables tipoComprobante
$boleta = 1;
$factura = 2;
?>
<html lang="ES">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/assets/css/style--checkout.css">
  <link rel="shortcut icon" href="/assets/imagenes/logochifa.png" type="image/x-icon">
  <script src="https://kit.fontawesome.com/a413ea44fb.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="/fonts.googleapis.com/css?family=Nova+Flat" />
  <title>Checkout</title>
</head>

<body>
  <div class="nav--high">
    <div class="logo">
      <a href="/views/carta/p-menu-variedades.php">
        <img class="logoImg" src="/assets/imagenes/logochifa.png">
      </a>
    </div>
    <div class="container-title-page">
      <h1 class="title-shopping-cart">DETALLES DE COMPRA</h1>
    </div>
    <div class="datos-cliente">
      Bienvenido:<br>
      <a class="redirect-page-client" href="/views/seguridad/p-perfil-cliente.php?perfil=<?php echo $cliente->idCliente; ?>">
        <?php if ($logeado) : ?>
          <?php
          echo ucwords($cliente->nombres);
          echo "&nbsp" . ucwords($cliente->apellidos);
          ?>
        <?php endif; ?>
      </a>
      <br>
      <div class="salir">
        <a class="redireccion-salir" href="/views/seguridad/cerrarSesion.php">
          <img class="salirsvg" src="/assets/imagenes/salir.svg">&nbsp CERRAR SESIÓN
        </a>
      </div>
    </div>
  </div>
  <div class="container">
    <!-- CONTAINER FORMULARIO AGREGAR DIRECCIONES -->
    <section class="formulario oculto">
      <div class="header-modal">
        <p class="title-modal">
          Agregar nueva dirección
        </p>
        <button class="btn-close-modal" onclick="ocultarFormularioDireccion(event)">
          X
        </button>
      </div>
      <form class="form-add-direction" name="form1" action="nuevaDireccion.php" method="POST">
        <div>
          <input type="hidden" name="idCliente" value="<?php echo $cliente->idCliente ?>">
        </div>
        <div>
          <input class="inp-direccion" type="text" name="direccion" required placeholder="Inserte direccion aqui">
        </div>
        <div>
          <input class="agregar-direccion" type="submit" value="Agregar">
        </div>
      </form>
    </section>
    <!-- listado de productos del carrito de compras -->
    <div class="products-container">
      <div class="orders-container">
        <table>
          <?php foreach ($carrito as $item) : ?>
            <tr>
              <!-- imagen -->
              <td class="imagen-producto">
                <img class="imagen-producto" src="<?php echo $item['producto']->imagenPlato; ?>" height="100px">
              </td>
              <!-- nombreproducto -->
              <td><strong>
                  <?php echo ucwords($item['producto']->nombrePlato); ?>
                </strong>
              </td>
              <!-- descripcion producto -->
              <td>
                <?php echo ucwords($item['producto']->descripcionPlato); ?>
              </td>
              <!-- precio producto -->
              <td>
                S/<?php echo $item['producto']->precioPlato; ?>
              </td>
              <!-- cantidad de productos deseado -->
              <td>
                <input class="cantidad-prod" type="number" step="1" value="<?php echo  $item['cantidad']; ?>" min="1" readonly>
              </td>
              <!-- boton eliminar producto del carrito de compras  -->
              <td>
                <a href="/views/shopping/p-carrito-compras.php?eliminar=<?php echo $item['producto']->idPlato; ?>">
                  <img class="delete-img" src="/assets/imagenes/delete.png">
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>
      <!-- FORM para generar compra -->
      <div class="resumen-pedido-container">
        <form name="form2" action="procesarPedido.php" method="POST">
          <div class="container-direcciones">
            <div class="subtotal-list-direcciones">
              <div class="lista-st-drc">
                <strong>Subtotal:</strong>
                <span>S/<?php echo $subtotal; ?></span>
              </div>
            </div>
            <hr>
            <div class="datos-compra">
              <?php if (count($direcciones) == 0) : ?>
                <div class="direccion-entrega">
                  <div class="title-dir-ent">
                    Dirección de entrega:
                  </div>
                  <div class="lista-st-drc">
                    <button class="agregar-direccion" onclick="mostrarFormularioDireccion()">
                      Agregar direccion
                    </button>
                  </div>
                </div>
            </div>
          <?php else : ?>
            <div class="lista-st-drc">
              <p>
                <strong>
                  Seleccionar dirección:
                </strong>
              </p>
              <?php foreach ($direcciones as $direccion) : ?>
                <div>
                  <p class="lista-direcciones">
                    <input type="radio" name="direccion" value="<?php echo $direccion->idDireccion; ?>">
                    <?php echo $nd++ . ".- &nbsp" . ucwords($direccion->direccion); ?>
                  </p>
                </div>
              <?php endforeach; ?>
            </div>
            <div class="lista-st-drc">
              <button class="agregar-direccion" onclick="mostrarFormularioDireccion(event)">
                Agregar nueva direccion
              </button>
            </div>
          <?php endif; ?>
          <hr>
          <div class="form-datos-envio lista-st-drc">
            <p>
              <strong>
                RELLENAR DATOS PARA ENVIO:
              </strong>
            </p>
            <div>
              <label for="celular"><strong>N° Telefono:</strong></label>
              <input type="tel" name="celular" required placeholder="Ej: 943-234-143" maxlength="13">
            </div>
            <!-- <hr> -->
            <div class="tipo-comprobante">
              <p>
                <strong>
                  Tipo de comprobante:
                </strong>
              </p>
              <p class="list-tipo-comprobante">
                <input type="radio" name="idComprobante" value="<?php echo $boleta ?>">
                Boleta
              </p>
              <p class="list-tipo-comprobante">
                <input type="radio" name="idComprobante" value="<?php echo $factura ?>">
                Factura
              </p>
            </div>
            <hr>
            <div class="numero-documento">
              <label for="numeroDocumento"><strong>Numero de documento: (DNI/RUC)</strong></label>
              <input type="number" name="numeroDocumento" placeholder="999999999" required min="1">
            </div>
            <!-- <hr> -->
            <div>
              <label for="indicaciones"><strong>Indicaciones:</strong></label>
              <textarea name="indicaciones" overflow="none"></textarea>
            </div>
          </div>
          <hr>
          </div>
          <!-- boton finalizar compra -->
          <div class="lista-st-drc">
            <button class="btn-continuar">
              Finalizar Compra
            </button>
          </div>
      </div>
      </form>
    </div>
  </div>
  </div>
  <script>
    function mostrarFormularioDireccion() {
      event.preventDefault();
      let formulario = document.querySelector('.formulario.oculto');
      formulario.className = "formulario";
    }

    function ocultarFormularioDireccion() {
      event.preventDefault(); //no hace lo que normalmente haria, submit
      let formulario = document.querySelector('.formulario');
      formulario.className = "formulario oculto";
    }
  </script>
</body>

</html>