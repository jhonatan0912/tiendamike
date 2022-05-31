<?php
require_once __DIR__ . '/../../tools/carritoTools.php';
require_once __DIR__ . '/../../tools/httpTools.php';
$carrito = CarritoTools::obtener();
$clienteLogeado = HttpTools::validarClienteLogeado();
?>
<?php if ($clienteLogeado) : ?>
  <div class="carrito-container">
    <a href="/views/shopping/checkout.php">
      <img class="carrito" src="/assets/imagenes/carrito.png">
      <span class="cantidad-productos"><?php echo count($carrito); ?></span>
    </a>
  </div>
<?php else : ?>
  <div class="carrito-container">
    <a href="/views/shopping/p-carrito-compras.php">
      <img class="carrito" src="/assets/imagenes/carrito.png">
      <span class="cantidad-productos"><?php echo count($carrito); ?></span>
    </a>
  </div>
<?php endif; ?>