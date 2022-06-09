<?php
require_once __DIR__ . '/../../controllers/zapatillaAdapter.php';
require_once __DIR__ . '/../../controllers/personalAdapter.php';
require_once __DIR__ . '/../../tools/httpTools.php';

session_start();
$logeado = FALSE;
$perfilPersonal;
if (isset($_SESSION['personal'])) {
    $perfilPersonal = $_SESSION['personal'];
    $logeado = TRUE;
    $platos = ZapatillaAdapter::listar();
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
    <link rel="shortcut icon" href="/assets/imagenes/logoTienda.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/a413ea44fb.js" crossorigin="anonymous"></script>
    <title>ADMINISTRAR PRODUCTOS</title>
</head>

<body>
    <a style="color: #000;font-size:1.9em" href="/views/administrador/index.php"> <i class="fas fa-angle-double-left"></i></a>
    <div class="high-container">
        <div class="title-page">
            <h1>ADMINISTRAR PRODUCTOS</h1>
        </div>
    </div>
    <div class="platos-container">
        <?php foreach ($platos as $plato) : ?>

            <div class="platos--content">
                <img class="imagen--plato" src="<?php echo $plato->imagenZapatilla; ?>" alt="NO HAY IMAGEN">

                <div class="nombre--plato">
                    <p class="name--content">
                        <?php echo ucwords($plato->nombreZapatilla); ?>
                    </p>
                </div>

                <!-- <div class="descripcion-plato">
                    <span class="descripcion--plato">
                        <?php //echo ucwords($plato->descripcionPlato) 
                        ?>
                    </span>
                </div> -->

                <div class="precio--container">
                    <p class="precio--mount">
                        <?php echo "S/" . ucwords($plato->precioZapatilla); ?>
                    </p>
                </div>
                <div class="editar">
                    <a href="/views/administrador/p-actualizar-zapatilla.php?idPlato=<?php echo $plato->idZapatilla; ?>">
                        EDITAR
                    </a>
                </div>
                <div class="eliminar">
                    <a href="/views/administrador/p-eliminar-zapatilla.php?idPlato=<?php echo $plato->idZapatilla; ?>">
                        ELIMINAR
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>