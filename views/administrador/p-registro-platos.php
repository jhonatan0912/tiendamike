<?php
require_once __DIR__ . '/../../models/plato.php';
require_once __DIR__ . '/../../controllers/platoAdapter.php';
require_once __DIR__ . '/../../controllers/variedadesAdapter.php';
require_once __DIR__ . '/../..//controllers/personalAdapter.php';
require_once __DIR__ . '/../../tools/fileTools.php';
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
$variedades = VariedadAdapter::listar();

// VALIDAR REGISTRO DE PLATO
$imagenPlato = '';
if (
	isset($_POST['idVariedad']) &&
	isset($_POST['nombrePlato']) &&
	isset($_POST['descripcionPlato']) &&
	isset($_POST['precioPlato'])
) {
	$idVariedad = $_POST['idVariedad'];
	$nombrePlato = $_POST['nombrePlato'];
	$descripcionPlato = $_POST['descripcionPlato'];
	$precioPlato = $_POST['precioPlato'];

	$plato = new Plato(
		$idVariedad,
		0,
		$imagenPlato,
		$nombrePlato,
		$descripcionPlato,
		$precioPlato
	);

	// echo ">>>" . ($plato->idPlato) . "<<<";
	$id = PlatoAdapter::crearPlato($plato);
	if ($id) {
		if (isset($_FILES['imagenPlato'])) {
			// foreach ($_FILES['imagenPlato'] as $llave => $valor) {
			// 	echo $llave . "->" . $valor . "<br>";
			// }
			$path = FileTools::subirImagen($_FILES['imagenPlato'], 'platos', $id);
			$plato = PlatoAdapter::obtenerUno($id);
			$plato->imagenPlato = $path;
			PlatoAdapter::actualizarPlato($plato);
		}
		echo "<h1 style='background-color:#000;color:#fff;text-align:center;'>REGISTRADO CORRECTAMENTE</h1>";
	} else {
		echo "<h1 style='background-color:#000;color:#fff;text-align:center;'>NO SE PUDO REGISTRAR LA ZAPATILLA</h1>";
	}
}

?>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="/assets/css/style--index--administrador.css">
	<link rel="shortcut icon" href="/assets/imagenes/logoTienda.png" type="image/x-icon">
	<script src="https://kit.fontawesome.com/a413ea44fb.js" crossorigin="anonymous"></script>
	<title>REGISTRO PLATOS</title>
</head>

<body>
	<!-- CONTAINER LOGO Y TITULO -->
	<a style="color: #000;font-size:1.9em" href="/views/administrador/index.php"> <i class="fas fa-angle-double-left"></i></a>
	<div class="container-logo-title">
		<div class="container-logo">

		</div>
		<div class="container-title">
			<h1 class="title-page">
				REGISTRO DE ZAPATILLAS
			</h1>
		</div>
	</div>
	<!-- FIN CONTAINER LOGO Y TITULO -->

	<div class="container-page-mid">
		<!-- CONTAINER PANEL ADMINISTRADOR -->
		<div class="options-administrator">
			<div class="container-dni-administrator fontColorWhite fontSize">
				<div class="option-three marginOptions">
					<a href="/views/administrador/p-listar-platos.php" class="fontColorWhite shadowText fontSize">
						GESTIÓN DE ZAPATILLAS
					</a>
				</div>
				<div class="option-one marginOptions">
					<a href="/views/administrador/p-registro-platos.php" class="fontColorWhite shadowText fontSize">
						REGISTRO DE ZAPATILLAS
					</a>
				</div>
				<div class="option-one marginOptions">
					<a href="/views/administrador/imagenesIndex.php" class="fontColorWhite shadowText fontSize">
						PRODUCTOS NUEVOS PAGINA PRINCIPAl
					</a>
				</div>
			</div>
			<div>
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
		</div>
		<!-- FIN CONTAINER PANEL ADMINISTRADOR -->
		<form class="form-register-plato" action="p-registro-platos.php" method="POST" enctype="multipart/form-data">


			<div class="upload-image-container">
				<input type="file" name="imagenPlato" accept="image/png, image/jpeg">
			</div>

			<br>

			<select class="borderMustard sizeInput marginInputs" name="idVariedad">
				<?php foreach ($variedades as $variedad) : ?>

					<option value="<?php echo $variedad->idVariedad; ?>">
						<?php echo strtoupper($variedad->nombreVariedad); ?>
					</option>

				<?php endforeach; ?>
			</select>

			<br>

			<input class="borderMustard sizeInput marginInputs" type="text" name="nombrePlato" placeholder="Inserte nombre">
			<br>
			<!-- <input class="borderMustard sizeInput marginInputs" type="text" name="descripcionPlato" placeholder="Inserte  categoria"> -->
			<select name="descripcionPlato" class=" borderMustard sizeInput marginInputs">
				<option value="hombre">Hombre</option>
				<option value="dama">Dama</option>
				<option value="niños">Niños</option>
			</select>
			<br>
			<input class="borderMustard sizeInput marginInputs" type="text" name="precioPlato" maxlength="9" placeholder="S/ ">

			<div class="boton-submit">
				<input type="submit" value="REGISTRAR" name="enviar">
			</div>
		</form>

	</div>
</body>

</html>