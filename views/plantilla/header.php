<?php
require_once __DIR__ . '/../../tools/httpTools.php';
$clienteLogeado = HttpTools::validarClienteLogeado();
?>

<head>
  <link rel="stylesheet" href="/assets/css/style--index.css">
</head>
<div class="main-high">
  <div class="main-high__logo-title">
    <div class="main-high__title">
      <a style="color:#000;text-decoration:none" href="/">Calzados Mike
      </a>
    </div>
  </div>
  <div class="varietys">
    <div class="main-high__firstOption">
      <a href="/views/carta/catalogo.php" class="main-high__hyperlink">
        Catalogo
      </a>
    </div>
    <div class="main-high__thirdOption">
      <a href="/views/contactanos.php" class="main-high__hyperlink">
        Contactanos
      </a>
    </div>
    <div class="main-high__thirdOption">
      <a href="/views/carta/marcas.php" class="main-high__hyperlink">
        Marcas
      </a>
    </div>
  </div>
  <div class="main-high__options">
    <?php if ($clienteLogeado) : ?>
      <div class="main-high__fourthOption">
        <a href="/views/shopping/checkout.php" class="main-high__hyperlink">
          <img class="img-login" src="/assets/imagenes/user-login.png">
        </a>
      </div>
    <?php else : ?>
      <div class="main-high__fourthOption">
        <a href="/views/seguridad/p-login-clientes.php" class="main-high__hyperlink">
          <img class="img-login" src="/assets/imagenes/user-login.png">
        </a>
      </div>
    <?php endif; ?>
    <div class="main-high__thirdOption">
      <?php include_once __DIR__ . '/shoppingCart.php'; ?>
    </div>
  </div>
</div>