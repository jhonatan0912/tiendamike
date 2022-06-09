<?php
require_once __DIR__ . '/../../models/cliente.php';
require_once __DIR__ . '/../../controllers/zapatillaAdapter.php';
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
  $precio = $item['producto']->precioZapatilla;
  $cantidad = $item['cantidad'];
  $costo = $precio * $cantidad;
  $subtotal = ($subtotal + $costo) + 20;;
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
  <link rel="shortcut icon" href="/assets/imagenes/logoTienda.png" type="image/x-icon">
  <script src="https://kit.fontawesome.com/a413ea44fb.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="/fonts.googleapis.com/css?family=Nova+Flat" />
  <title>Checkout</title>
</head>

<body>
  <div class="nav--high">
    <div class="logo">
      <a class="hyperlink__logo" href="/views/carta/marcas.php">
        Calzados Mike
      </a>
    </div>
    <div class="container-title-page">
      <h1 class="title-shopping-cart">DETALLES DE COMPRA</h1>
    </div>
    <div class="datos-cliente">
      Logeado como:<br>
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
          <img class="salirsvg" src="/assets/imagenes/salir.svg">&nbsp SALIR
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
        <table required>
          <?php foreach ($carrito as $item) : ?>
            <tr>
              <!-- imagen -->
              <td class="imagen-producto">
                <img class="imagen-producto" src="<?php echo $item['producto']->imagenZapatilla; ?>" height="100px">
              </td>
              <!-- nombreproducto -->
              <td><strong>
                  <?php echo ucwords($item['producto']->nombreZapatilla); ?>
                </strong>
              </td>
              <!-- descripcion producto -->
              <td>
                <?php echo ucwords($item['producto']->descripcionZapatilla); ?>
              </td>
              <!-- precio producto -->
              <td>
                S/<?php echo $item['producto']->precioZapatilla; ?>
              </td>
              <!-- cantidad de productos deseado -->
              <td>
                <input class="cantidad-prod" type="number" step="1" value="<?php echo  $item['cantidad']; ?>" min="1" readonly>
              </td>
              <td>
                <form action="/views/shopping/procesarPedido.php" method="POST">
                  Talla:
                  <select name="talla">

                    <option value="">21</option>
                    <option value="">22</option>
                    <option value="">23</option>
                    <option value="">24</option>
                    <option value="">25</option>
                    <option value="">26</option>
                    <option value="">27</option>
                    <option value="">28</option>
                    <option value="">29</option>
                    <option value="">30</option>
                    <option value="">31</option>
                    <option value="">36</option>
                    <option value="">37</option>
                    <option value="">38</option>
                    <option value="">39</option>
                    <option value="">40</option>
                    <option value="">41</option>
                    <option value="">42</option>
                  </select>
                </form>
              </td>

              <!-- boton eliminar producto del carrito de compras  -->
              <td>
                <a href="/views/shopping/p-carrito-compras.php?eliminar=<?php echo $item['producto']->idZapatilla; ?>">
                  <i class="fas fa-times-circle"></i>
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
                <strong>Costo de envio: <span> S/ 20.00</span></strong>
                <br>
                <strong>Total:</strong>
                <span>S/<?php echo $subtotal; ?></span>
              </div>
            </div>
            <hr>
            <div>
              <label for="direccion">Direccion</label>
              <br>
              <input type="text" name="direccion" required>
            </div>
            <div class="form-datos-envio lista-st-drc">
              <p>
                <strong>
                  RELLENAR DATOS PARA ENVIO:
                </strong>
              </p>
              <br>
              <div>
                <label for="celular"><strong>N° Telefono:</strong></label>
                <input type="tel" name="celular" required placeholder="Ej: 943-234-143" maxlength="13">
              </div>
              <div>
                <label for="celular"><strong>Tipo de pago</strong></label>
                <select name="" class="select-pago">
                  <option value="">Contra entrega</option>
                  <option value="">Tarjeta</option>
                </select>
              </div>
              <!-- <hr> -->
              <!-- <hr> -->
            </div>
            <hr>
            <div class="pasarela-pago">
              <div class="pasarela-header">
                <div class="tarjeta-credito-p">
                  Tarjeta de crédito
                </div>
                <div class="pasarela-header__img">
                  <img src="/assets/imagenes/visa.png" width="25px">
                  <img src="/assets/imagenes/mastercard.png" width="25px">
                  <img src="/assets/imagenes/americanExpress.png" width="25px">
                </div>
              </div>
              <div class="pasarela-mid">
                <div class="numero-tarjeta">
                  <div>
                    <input style="border:none;width:100%" type="number" placeholder="Numero de tarjeta">
                  </div>
                  <div class="candado">
                    <i class="fas fa-lock"></i>
                  </div>
                </div>
                <div class="nombre-titular">
                  <input class="nombre-titular-input" type="text" placeholder="Nombre del titular">
                </div>
                <div class=" fechaVencimiento-codigoSeguridad">
                  <div class="fecha-vencimiento">
                    <input style="width:100%;border:none" type="number" placeholder="Fecha de vencimiento (MM/AA)">
                  </div>
                  <div class="codigo-seguridad">
                    <input style="width:90%;border:none;" type="password" placeholder="Código de seguridad" maxlength="4">
                    <i class="fas fa-question-circle" style="display: flex;justify-content:center;align-items:center;"></i>
                  </div>
                </div>
              </div>
              <div class="pasarela-footer">
                <div class="paypal">
                  <img style="object-fit:contain;" src="/assets/imagenes/paypal.png" width="60px" height="24px">
                </div>
                <div>
                  <img style="object-fit:contain;" src="/assets/imagenes/visa.png" width="30px" height="24px">
                  <img style="object-fit:contain;" src="/assets/imagenes/masterCard.png" width="30px" height="24px">
                  <img style="object-fit:contain;" src="/assets/imagenes/americanExpress.png" width="30px" height="24px">
                  <img style="object-fit:contain;" src="/assets/imagenes/interbank.png" width="30px" height="24px">
                </div>
              </div>
            </div>
          </div>
          <!-- boton finalizar compra -->
          <div class="lista-st-drc">
            <button class="btn-continuar">
              Finalizar Compra
            </button>
          </div>
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