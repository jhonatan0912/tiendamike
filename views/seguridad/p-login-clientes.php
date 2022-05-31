<?php
require_once __DIR__ . '/../../controllers/clienteAdapter.php';
require_once __DIR__ . '/../../tools/httpTools.php';
session_start();
$falloLogueo = false;

if (isset($_POST['correo']) && isset($_POST['password'])) {
	$correo = $_POST['correo'];
	$password = $_POST['password'];
	//validar
	$id = ClienteAdapter::validarDatos($correo, $password);
	// echo $id;
	if ($id != 0) {
		$perfil = ClienteAdapter::perfilCliente($id);
		$_SESSION['perfil'] = $perfil;
		if (isset($_GET['redireccionar'])) {
			HttpTools::redireccionar($_GET['redireccionar']);
		}
	} else {
		$falloLogueo = true;
		session_destroy();
	}
}
?>
<!DOCTYPE html>
<html lang="ES">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>LOGIN</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/style--login--clientes.css">
	<link rel="icon" href="/assets/imagenes/logochifa.png">
</head>

<body>
	<div class="boxform">
		<div class="logo">
			<img src="/assets/imagenes/logochifa.png" width="162px" height="162px">
		</div>
	</div>
	<div class="container">
		<form class="box" action="" method="POST">
			<h1 style="color:#fff;text-shadow:2px 2px #000;">Login</h1>

			<input type="email" name="correo" placeholder="Email">

			<input type="password" name="password" placeholder="Password">

			<input type="submit" name="login" value="Login">
			<div class="error-logueo">
				<?php if ($falloLogueo) : ?>
					<p style="color:#fff;margin:8px 0;">
						Correo o contraseña invalidos
						<br>
						intentelo nuevamente
					</p>
					<p>
						<a class="btn-recoveryPassword" href="#">
							Recuperar Contraseña
						</a>
					</p>
				<?php endif; ?>
			</div>
			<div class="registrarse">
				<a style="color:#fff; text-decoration:none;font-weight:700;" href="/views/seguridad/p-registro-clientes.php">
					Registrarse
				</a>
			</div>
		</form>

		<div class="buttons-login">
			<button id="facebookButton" class="buttons__facebook">
				<img class="buttons__image" src="/assets/imagenes/login-facebook.png">
			</button>

			<button id="googleButton" class="buttons__google">
				<img class="buttons__image" src="/assets/imagenes/login-google.png">
			</button>
		</div>
	</div>

	<script type="module">
		//* Import the functions you need from the SDKs you need
		import {
			initializeApp
		} from "https://www.gstatic.com/firebasejs/9.8.1/firebase-app.js";
		// import {
		// 	getAnalytics
		// } from "https://www.gstatic.com/firebasejs/9.8.1/firebase-analytics.js";
		import {
			getAuth,
			signInWithPopup,
			GoogleAuthProvider,
			FacebookAuthProvider
		} from "https://www.gstatic.com/firebasejs/9.8.1/firebase-auth.js";
		const firebaseConfig = {
			apiKey: "AIzaSyBpym5b2NDUhIfOWjXzsb7WJNhIbPjWyeM",
			authDomain: "loginchifa.firebaseapp.com",
			projectId: "loginchifa",
			storageBucket: "loginchifa.appspot.com",
			messagingSenderId: "478656414964",
			appId: "1:478656414964:web:34512f400fffb4003ccaa1",
			measurementId: "G-C4VVKYZNXQ"
		};
		//* Initialize Firebase
		const app = initializeApp(firebaseConfig);
		//const analytics = getAnalytics(app);
		const googleProvider = new GoogleAuthProvider();
		const facebookProvider = new FacebookAuthProvider();

		const auth = getAuth();

		document.getElementById('facebookButton').onclick = ingresarConFacebook;
		document.getElementById('googleButton').onclick = ingresarConGoogle;

		function ingresarConFacebook() {
			ingresar(facebookProvider, 'facebook');
		}

		function ingresarConGoogle() {
			ingresar(googleProvider, 'google');
		}

		function ingresar(provider, proveedor) {
			signInWithPopup(auth, provider)
				.then((result) => {
					// This gives you a Google Access Token. You can use it to access the Google API.
					const credential = GoogleAuthProvider.credentialFromResult(result);
					//const token = credential.accessToken;
					// The signed-in user info.
					const user = result.user;
					console.log(result, credential);
					let token = "";
					if (proveedor == 'google') {
						token = credential.idToken;
					} else if (proveedor == 'facebook') {
						token = credential.accessToken;
					}
					enviarDatosDeUsuario(user.displayName, user.email, token, proveedor);
				}).catch((error) => {
					const errorCode = error.code;
					const errorMessage = error.message;
					const email = error.email;
					const credential = GoogleAuthProvider.credentialFromError(error);
				});
		}

		function enviarDatosDeUsuario(nombres, email, token, proveedor) {
			let form = document.createElement('form');
			form.action = "/views/seguridad/oauth.php";
			form.method = "POST";
			form.style.visibility = "hidden";
			let inputNombres = document.createElement('input');
			inputNombres.type = "text";
			inputNombres.name = "nombres";
			inputNombres.value = nombres;
			let inputEmail = document.createElement('input');
			inputEmail.type = "text";
			inputEmail.name = "email";
			inputEmail.value = email;
			let inputToken = document.createElement('input');
			inputToken.type = "text";
			inputToken.name = "token";
			inputToken.value = token;
			let inputProveedor = document.createElement('input');
			inputProveedor.type = "text";
			inputProveedor.name = "proveedor";
			inputProveedor.value = proveedor;
			form.appendChild(inputNombres);
			form.appendChild(inputEmail);
			form.appendChild(inputToken);
			form.appendChild(inputProveedor);
			document.body.appendChild(form);
			form.submit();
		}
	</script>
</body>

</html>