<?php
require_once __DIR__ . '/../../controllers/personalAdapter.php';
require_once __DIR__ . '/../../controllers/clienteAdapter.php';
require_once __DIR__ . '/../../controllers/platoAdapter.php';
require_once __DIR__ . '/../../controllers/ventaAdapter.php';
require_once __DIR__ . '/../../controllers/personalAdapter.php';
require_once __DIR__ . '/../../tools/httpTools.php';
session_start();
$logeado = FALSE;
$perfilPersonal;
if (isset($_SESSION['personal'])) {
  $perfilPersonal = $_SESSION['personal'];
  $logeado = TRUE;
} else {
  HttpTools::redireccionar('/errores/p403.php');
}

$numberOfClients = ClienteAdapter::getNumberOfClients();
$numberProducts = PlatoAdapter::getNumberOfProducts();
$numberSales = VentaAdapter::getNumberOfSales();
$numberOfStaff = PersonalAdapter::getNumberOfStaff();
?>
<html lang="ES">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="/assets/css/style--index--administrador.css">
  <link rel="shortcut icon" href="/assets/imagenes/logochifa.png" type="image/x-icon">
  <title>PANEL ADMINISTRADOR</title>
</head>

<body>
  <div class="container-logo-title">
    <div class="container-logo">
      <a href="/">
        <img class="img-logo" src="/assets/imagenes/logochifa.png">
      </a>
    </div>
    <div class="title-container">
      Panel Administrador
    </div>
  </div>

  <div class="container-page-mid">
    <!-- CONTAINER PANEL ADMINISTRADOR -->
    <div class="options-administrator">
      <div class="container-dni-administrator fontColorWhite fontSize">
        <?php if ($logeado) : ?>
          DNI: <?php echo $perfilPersonal->dni; ?>
          <div class="salir">
            <a class="redireccion-salir" href="/views/seguridad/cerrarSesion.php">
              <img class="salirsvg" src="/assets/imagenes/salir.svg">
              &nbsp CERRAR SESIÓN
            </a>
          </div>
        <?php else : ?>
          <div class="error-login">
            error
          </div>
        <?php endif; ?>
      </div>

      <div class="option-three marginOptions">
        <a href="/views/administrador/p-listar-platos.php" class="fontColorWhite shadowText fontSize">
          ADMINISTRAR PLATOS
        </a>
      </div>

      <div class="option-two marginOptions">
        <button onclick="mostrarFormularioHistorialDeVentas(event)" class="fontColorWhite shadowText fontSize formRegistroPersonal oculto">
          HISTORIAL DE VENTAS
        </button>
      </div>

      <div class=" option-one marginOptions">
        <a href="/views/administrador/p-registro-platos.php" class="fontColorWhite shadowText fontSize">
          REGISTRO DE PLATOS
        </a>
      </div>

      <div class="option-four marginOptions">
        <button onclick="mostrarFormularioRegistroPersonal(event)" class="fontColorWhite shadowText fontSize formRegistroPersonal oculto">
          REGISTRO DE PERSONAL
        </button>
      </div>
      <!-- FIN CONTAINER PANEL ADMINISTRADOR -->
    </div>
    <div class="statistics">

      <div class="statistics__card">
        <div class="image__card">
          <img class="statistics__img" src="/assets/imagenes/user.svg">
        </div>
        <div class="number-data">
          <strong>
            <?php echo $numberOfClients ?>
          </strong> Clientes <br> registrados
        </div>
      </div>

      <div class="statistics__card">
        <div class="image__card">
          <img class="statistics__img" src="/assets/imagenes/staff.png">
        </div>
        <div class="number-data">
          <strong>
            <?php echo $numberOfStaff ?>
          </strong> Personal(es) <br> registrados
        </div>
      </div>

      <div class="statistics__card">
        <div class="image__card">
          <img class="statistics__img" src="/assets/imagenes/product.png">
        </div>
        <div class="number-data">
          <strong>
            <?php echo $numberProducts ?>
          </strong> Platos <br> registrados
        </div>
      </div>

      <div class="statistics__card">
        <div class="image__card">
          <img class="statistics__img" src="/assets/imagenes/sales.png">
        </div>
        <div class="number-data">
          <strong>
            <?php echo $numberSales ?>
          </strong> Ventas
        </div>
      </div>

      <!-- MODAL FORM HISTORIAL DE VENTAS  -->
      <section class="formularioHistorySales oculto">
        <div class="header-form-history">
          <p>
            SELECCIONAR FECHA
          </p>
          <button class="btn-close-modal" onclick="ocultarFormularioHistorialDeVentas(event)">
            &times;
          </button>
        </div>
        <form action="historialDeVentas.php" method="POST">
          <input type="date" name="date">
          <input type="submit">
        </form>
      </section>

      <!-- END FORM HISTORIAL DE VENTAS -->
      <!-- FORM REGISTRO PERSONAL -->
      <section class="formulario oculto">
        <div class="header-modal">
          <p class="title-modal">
            Registrar nuevo personal
          </p>
          <button class="btn-close-modal" onclick="ocultarFormularioDireccion(event)">
            &times;
          </button>
        </div>
        <form class="form-add-direction" name="form1" action="p-registro-personal.php" method="POST">
          <div class="inputs-form">
            <label for="dni">DNI</label>
            <input type="number" name="dni" required min="1">
          </div>
          <div class="inputs-form">
            <label for="password">PASSWORD</label>
            <input type="password" name="password" required>
          </div>
          <div class="inputs-form">
            <input type="submit" name="registrarPersonal">
          </div>
        </form>
      </section>
      <!-- END FORM REGISTRO PERSONAL -->

      <script>
        function mostrarFormularioRegistroPersonal() {
          event.preventDefault();
          let formulario = document.querySelector('.formulario.oculto');
          formulario.className = "formulario";
        }

        function ocultarFormularioDireccion() {
          event.preventDefault(); //no hace lo que normalmente haria, submit
          let formulario = document.querySelector('.formulario');
          formulario.className = "formulario oculto";
        }

        function mostrarFormularioHistorialDeVentas() {
          event.preventDefault(); //no hace lo que normalmente haria, submit
          let formulario = document.querySelector('.formularioHistorySales.oculto');
          formulario.className = "formularioHistorySales";
        }

        function ocultarFormularioHistorialDeVentas() {
          event.preventDefault(); //no hace lo que normalmente haria, submit
          let formulario = document.querySelector('.formularioHistorySales');
          formulario.className = "formularioHistorySales oculto";
        }
      </script>
</body>

</html>