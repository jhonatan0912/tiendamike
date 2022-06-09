<?php
require_once __DIR__ . '/../../controllers/platoAdapter.php';
require_once __DIR__ . '/../../tools/httpTools.php';
require_once __DIR__ . '/../../controllers/variedadesAdapter.php';
require_once __DIR__ . '/../../tools/fileTools.php';
$variedades = VariedadAdapter::listar();
$idPlato = $_GET['idPlato'];
$plato;
$guardado = FALSE;
$errores = [];
if (isset($idPlato)) {
  $plato = PlatoAdapter::obtenerUno($idPlato);
  if ($plato != null) {
    if (
      isset($_POST['idVariedad']) &&
      isset($_POST['nombrePlato']) &&
      isset($_POST['descripcionPlato']) &&
      isset($_POST['precioPlato'])
    ) {
      $plato->idVariedad = $_POST['idVariedad'];
      $plato->nombrePlato = $_POST['nombrePlato'];
      $plato->descripcionPlato = $_POST['descripcionPlato'];
      $plato->precioPlato = $_POST['precioPlato'];
      if (
        isset($_FILES['imagenPlato']) &&
        $_FILES['imagenPlato']['name']
      ) {
        $path = FileTools::subirImagen($_FILES['imagenPlato'], 'platos', $idPlato);
        $plato->imagenPlato = $path;
      }
      $res = PlatoAdapter::actualizarPlato($plato);

      if ($res === FALSE) {
        $errores[] = "no se pudo actualizar el plato";
      } else {
        $guardado = TRUE;
        HttpTools::redireccionar('/views/administrador/p-listar-platos.php');
      }
    }
  }
} else {
  HttpTools::redireccionar('/errores/p404.php');
}
?>

<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../../assets/css/style-actualizar-plato.css">
  <script src="https://kit.fontawesome.com/a413ea44fb.js" crossorigin="anonymous"></script>
  <link rel="shortcut icon" href="/assets/imagenes/logochifa.png" type="image/x-icon">
  <title>ACTUALIZAR ZAPATILLAS</title>
</head>

<body>
  <a style="color: #000;font-size:1.9em" href="/views/administrador/index.php"> <i class="fas fa-angle-double-left"></i></a>
  <div class="high-container">
    <div class="title-page">
      <h1>ACTUALIZAR ZAPATILLAS</h1>
    </div>
  </div>

  <form class="form-register-plato" method="POST" action="" enctype="multipart/form-data">
    <br>
    <div class="imagen-plato">
      <img class="imagen--plato" src="<?php echo $plato->imagenPlato; ?>">
      <div class="update-image-plato">
        <input type="file" name="imagenPlato" accept="image/png, image/jpeg">
        <p class="text-upload-image">
          Actualizar Imagen Aqui.
        </p>
      </div>
    </div>

    <div>
      <label for="idV</td>ariedad">Marcas</label>
      <select class="borderMustard sizeInput marginInputs" name="idVariedad">
        <?php foreach ($variedades as $variedad) : ?>
          <option <?php echo $plato->idVariedad == $variedad->idVariedad ? "selected" : ""; ?> value="<?php echo $variedad->idVariedad; ?>">
            <?php echo ucwords($variedad->nombreVariedad); ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div>
      <label for="nombrePlato">Nombre zapatila</label>
      <input class="borderMustard sizeInput marginInputs" type="text" name="nombrePlato" value="<?php echo $plato->nombrePlato; ?>">
    </div>

    <div>
      <!-- <label for="descripcionPlato">Categoria</label> -->
      <input class="borderMustard sizeInput marginInputs" type="hidden" name="descripcionPlato" value="<?php echo $plato->descripcionPlato ?>">
    </div>

    <div>
      <label for="precioPlato">Precio venta</label>
      <input class="borderMustard sizeInput marginInputs" type="text" name="precioPlato" value="<?php echo $plato->precioPlato; ?>">
    </div>

    <div>
      <?php foreach ($errores as $error) : ?>
        <p class="mensaje-error">
          <?php echo $error; ?>
        </p>
      <?php endforeach; ?>
    </div>

    <div>
      <input type="submit" value="ACTUALIZAR">
    </div>
  </form>
</body>

</html>