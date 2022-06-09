<?php
require_once __DIR__ . '/../../tools/httpTools.php';
require_once __DIR__ . '/../../tools/fileTools.php';
require_once __DIR__ . '/../../controllers/listaIndexAdapter.php';
$imagenUrl = "";
if (
  isset($_FILES['imagen'])
  && isset($_POST['descripcion'])
  && isset($_POST['registrarImg'])
) {
  $descripcion = $_POST['descripcion'];
  $listaIndex = new listaIndex(0, $imagenUrl, $descripcion);
  $id = listaIndexAdapter::registrarImagen($listaIndex);
  if ($id) {
    if (isset($_FILES['imagen'])) {
      $path = FileTools::subirImagen($_FILES['imagen'], 'platos', $id);
      $listaIndex = listaIndexAdapter::obtenerUno($id);
      $listaIndex->imagenUrl = $path;
      listaIndexAdapter::actualizarImg($listaIndex);
    }
  }
}
$listaIndexs = listaIndexAdapter::listar();
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
    @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap');

    * {
      margin: 0;
      padding: 0;
      /* border: 1px solid; */
    }

    body {
      text-align: center;
      font-family: 'Nunito', sans-serif;
    }

    form {
      width: 30%;
      margin: 0 auto;
      border: 1px solid;
      display: flex;
      flex-direction: column;
      text-align: center;
      margin-top: 30px;
    }

    form>div {
      border: 1px solid;
      padding: 1.5em;
      font-size: 1.4em;
      font-weight: bolder;
    }

    .listar {
      margin: 70px auto;
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      row-gap: 20px;
    }

    .container-img {
      border: 1px solid;
    }

    input[type="submit"] {
      background-color: #000;
      color: #fff;
      width: 200px;
      height: 40px;
    }

    a {
      text-decoration: none;
      color: red;
      font-weight: bolder;
      font-size: 1.5em;
    }

    .eliminar {
      border-top: 1px solid;
    }

    .descripcion {
      font-weight: bolder;
      font-size: 1.4em;
    }

    .header {
      display: flex;
    }

    .fas {
      font-size: 1.4em;
      color: #000;
    }
  </style>
</head>

<body>
  <div class="header">
    <a href="/views/administrador/index.php"> <i class="fas fa-angle-double-left"></i></a>
  </div>
  <div class="container">
    <h1>PRODUCTOS NUEVOS</h1>
  </div>
  <form action="" method="POST" enctype="multipart/form-data">
    <div>
      <div for="imagen">Insertar Imagen</div>
      <input type="file" name="imagen" accept="image/png, image/jpeg" required>
    </div>
    <div>
      <div for="descripcion">Inserte descripcion de zapatilla</div>
      <input type="text" name="descripcion" required>
    </div>
    <div>
      <input type="submit" name="registrarImg" value="Registrar">
    </div>
  </form>
  </div>


  <div class="listar">

    <?php foreach ($listaIndexs as $ls) : ?>
      <div class="container-img">
        <img src="<?php echo $ls->imagenUrl ?>" width="295px" height="295px">
        <br>
        <p class="descripcion">
          <?php echo ucwords($ls->descripcion) ?>
        </p>
        <div class="eliminar">
          <a href="/views/administrador/deleteFromIndex.php?id=<?php echo $ls->idImagen ?>">Eliminar</a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</body>

</html>