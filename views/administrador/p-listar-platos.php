<?php
require_once __DIR__ . '/../../controllers/platoAdapter.php';
require_once __DIR__ . '/../../controllers/personalAdapter.php';
require_once __DIR__ . '/../../tools/httpTools.php';

session_start();
$logeado = FALSE;
$perfilPersonal;
if (isset($_SESSION['personal'])) {
    $perfilPersonal = $_SESSION['personal'];
    $logeado = TRUE;
    $platos = PlatoAdapter::listar();
} else {
    HttpTools::redireccionar('/errores/p403.php');
}


?>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style-listar-platos-administrador.css">
    <link rel="shortcut icon" href="/assets/imagenes/logochifa.png" type="image/x-icon">
    <title>ADMINISTRAR PLATOS</title>
</head>

<body>
    <div class="high-container">
        <div class="img-back-arrow">
            <a href="/views/administrador/index.php">
                <img class="back-arrow-img" src="/assets/imagenes/back-arrow.png">
            </a>
        </div>
        <div class="title-page">
            <h1>ADMINISTRAR PLATOS</h1>
        </div>
    </div>
    <div class="platos-container">
        <?php foreach ($platos as $plato) : ?>

            <div class="platos--content">
                <img class="imagen--plato" src="<?php echo $plato->imagenPlato; ?>" alt="NO HAY IMAGEN">

                <div class="nombre--plato">
                    <p class="name--content">
                        <?php echo ucwords($plato->nombrePlato); ?>
                    </p>
                </div>

                <div class="descripcion-plato">
                    <span class="descripcion--plato">
                        <?php echo ucwords($plato->descripcionPlato) ?>
                    </span>
                </div>

                <div class="precio--container">
                    <p class="precio--mount">
                        <?php echo "S/" . ucwords($plato->precioPlato); ?>
                    </p>
                </div>
                <div class="editar">
                    <a href="/views/administrador/p-actualizar-plato.php?idPlato=<?php echo $plato->idPlato; ?>">
                        EDITAR
                    </a>
                </div>
                <div class="eliminar">
                    <a href="/views/administrador/p-eliminar-plato.php?idPlato=<?php echo $plato->idPlato; ?>">
                        ELIMINAR
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>