<?php
require_once __DIR__ . '/../../tools/httpTools.php';
require_once __DIR__ . '/../../models/cliente.php';
require_once __DIR__ . '/../../controllers/clienteAdapter.php';
$logeado = HttpTools::soloCliente();
$idCliente = $_GET['perfil'];
$perfil = ClienteAdapter::perfilCliente($idCliente);

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style-perfil-cliente.css">
    <link rel="shortcut icon" href="/assets/imagenes/logochifa.png" type="image/x-icon">
    <title>PERFIL DE CLIENTE</title>
</head>

<body>
    <div class="container-high">
        <div class="logo-container">
            <a href="<?= $_SERVER["HTTP_REFERER"] ?>">
                <img class="logo" src="/assets/imagenes/logochifa.png">
            </a>
        </div>
        <div class="container-titulo">
            <p class="titulo-pagina">
                PERFIL
            </p>
        </div>
    </div>
    <div class="container-mid">
        <form action="" method="POST">
            <div class="nombre-container ">
                <label for="">NOMBRES</label>
                <input type="text" name="" value="<?php echo $perfil->nombres ?>">
            </div>
            <div class="apellidos-container ">
                <label for="">APELLIDOS</label>
                <input type="text" name="" value="<?php echo $perfil->apellidos ?>">
            </div>
            <div class="correo-container ">
                <label for="">CORREO</label>
                <input type="text" name="" value="<?php echo $perfil->correo ?>">
            </div>
        </form>
    </div>
</body>

</html>