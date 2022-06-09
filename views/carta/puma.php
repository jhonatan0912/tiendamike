<?php
require_once __DIR__ . '/../../controllers/zapatillaAdapter.php';

$platos = ZapatillaAdapter::listarPorIdVariedad(3);

?>
<html lang="es-pe">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" text="text/css" href="../../assets/css/style-platos.css">
  <link rel="shortcut icon" href="/assets/imagenes/logoTienda.png" type="image/x-icon">
  <title>PUMA</title>
</head>

<body>
  <div class="main-high">
    <div class="main-high__logo">
      <a href="<?= $_SERVER["HTTP_REFERER"] ?>">
        <img src="/assets/imagenes/logoTienda.png" class="main-high__img">
      </a>
    </div>
    <div class="main-high__title">
      PUMA
    </div>
    <?php include_once __DIR__ . '/../plantilla/shoppingCart.php'; ?>
  </div>
  <div class="container-asideList-platos">


    <div class="container-platos-lista">
      <?php foreach ($platos as $plato) : ?>
        <div class="platos--content">

          <div class="imagen">
            <<img class="imagen-plato" src="<?php echo $plato->imagenZapatilla; ?>" alt="no imagen">
          </div>

          <div class="container-nombre-informacion">
            <p class="nombre-plato">
              <?php echo ucwords($plato->nombreZapatilla); ?>
            </p>
          </div>

          <div class="container-precio">
            <p class="precio">
              <?php echo "S/ " . $plato->precioZapatilla; ?>
            </p>
          </div>

          <div class="boton--ordenar">
            <p class="ordenar--text">COMPRAR</p>
            <div class="shopping--cart--container">
              <a href="/views/shopping/p-carrito-compras.php?agregar=<?php echo $plato->idZapatilla; ?>">
                <img class="shopping--cart--style" src="/assets/imagenes/carrito.png" id="addShoppingCart1">
              </a>
            </div>
          </div>

        </div>
      <?php endforeach; ?>
    </div>
  </div>
</body>

</html>