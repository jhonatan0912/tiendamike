<?php
require_once __DIR__ . '/../../controllers/platoAdapter.php';
$productos = PlatoAdapter::listar();
?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="/assets/imagenes/logoTienda.png" type="image/x-icon">
  <script src="https://kit.fontawesome.com/a413ea44fb.js" crossorigin="anonymous"></script>
  <title>Document</title>
  <style>
    .container-platos-lista {
      display: flex;
      flex-wrap: wrap;
      width: 85%;
      padding: 0 2%;
      row-gap: 40px;
    }

    .platos--content {
      width: 300px;
      /* height: 400px; */
      border: 1px solid #000;
      margin: 0 43px;
      border-radius: 5px;
      padding: 0 0 .10em 0;
    }

    .precio {
      color: #050505;
      font-size: 30px;
      padding: 0 80px;
    }

    .nombre-plato {
      color: #000;
      font-size: 1.5em;
      text-align: center;
      width: 90%;
      line-height: 70px;
      margin: auto;
      font-weight: 600;
    }

    .imagen-plato {
      width: 100%;
      height: 180px;
      text-align: center;
      object-fit: contain;
    }

    .ordenar--text {
      line-height: 50px;
      color: #fff;
      font-size: 24px;
      font-style: italic;
    }

    .boton--ordenar {
      background-color: #0e0e0e;
      display: flex;
      width: 200px;
      height: 50px;
      justify-content: space-evenly;
      margin-left: 15%;
      margin-top: 20px;
    }

    .shopping--cart--container:hover {
      background-color: #000;
    }

    .shopping--cart--style {
      width: 30px;
      margin: 9px 0;
      filter: invert(1);
    }

    .container-nombre-informacion {
      height: 60px;
      margin: 11px 0;
      display: flex;
    }

    .buscador {
      width: 100%;
      height: 100px;
      margin-top: 30px;
    }

    form {
      float: right;
      margin-right: 50px;
    }

    input[type="search"] {
      width: 250px;
      height: 30px;
      outline: none;
      border-bottom-left-radius: 5px;
      border-top-left-radius: 5px;
      border: 1px solid;
    }

    button {
      width: 30px;
      height: 30px;
      background-color: transparent;
      border: 1px solid;
      border-bottom-right-radius: 5px;
      border-top-right-radius: 5px;
    }

    ::placeholder {
      text-align: center;
    }

    .descripcion-plato {
      font-size: 1.4em;
      text-align: center;
      min-height: 31px;
    }
  </style>
</head>

<body>
  <div class="container">
    <?php include_once __DIR__ . '/../../views/plantilla/header.php'; ?>
    <div class="buscador">
      <form action="/others/buscarMarcas.php" method="GET">
        <input type="search" name="buscador-marcas" placeholder="Buscar marcas" required>
        <button type="submit">
          <i class="fas fa-search">
          </i></button>
      </form>
    </div>
    <div class="container-platos-lista">
      <?php foreach ($productos as $producto) : ?>
        <div class="platos--content">
          <div class="imagen">
            <img class="imagen-plato" src="<?php echo $producto->imagenPlato; ?>" alt="no imagen">
          </div>

          <div class="container-nombre-informacion">
            <p class="nombre-plato">
              <?php echo ucwords($producto->nombrePlato); ?>
            </p>
          </div>
          <div class="descripcion-plato">
            <span class="descripcion--plato">
              <?php echo ucwords($producto->descripcionPlato) ?>
            </span>
          </div>

          <div class="container-precio">
            <p class="precio">
              <?php echo "S/ " . $producto->precioPlato; ?>
            </p>
          </div>
          <div class="boton--ordenar">
            <p class="ordenar--text">COMPRAR</p>
            <div class="shopping--cart--container">
              <a href="/views/shopping/p-carrito-compras.php?agregar=<?php echo $producto->idPlato; ?>">
                <img class="shopping--cart--style" src="/assets/imagenes/carrito.png" id="addShoppingCart1">
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
</body>

</html>