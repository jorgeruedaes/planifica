<?php
require('../php/consultas.php');
	session_start();
	$_SESSION['Id'] = Int_New_Sesion('99999');
if(isset($_SESSION['id_usuarios']))
{
	header("location:../pages/administracion.php");
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>Inicio de sesion Administración |<?php echo String_Get_Valores('titulo') ?></title>
	<!-- Favicon-->
	<link rel="icon" href="../../webs/images/<?php echo String_Get_Valores('favicon') ?>" type="image/x-icon">

	<!-- Google Fonts -->
    <link href="../css/google-fonts.css" rel="stylesheet" type="text/css">
	<!-- Bootstrap Core Css -->
	<link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

	<!-- Waves Effect Css -->
	<link href="../plugins/node-waves/waves.css" rel="stylesheet" />

	<!-- Animation Css -->
	<link href="../plugins/animate-css/animate.css" rel="stylesheet" />

	<!-- Custom Css -->
	<link href="../css/style.css" rel="stylesheet">
</head>

<body class="login-page">
	<div class="login-box">
		<div class="logo">
			<a href="javascript:void(0);">Admin<b>TEAM</b></a>
			<small><?php echo String_Get_Valores('titulo') ?>  - Material Design</small>
		</div>
		<div class="card">
			<div class="body">
				<form id="sign_in" action="../php/peticiones.php" method="POST">
					<div class="msg">Inicia sesion para entrar al sistema.</div>
					<div class="input-group">
						<span class="input-group-addon">
							<i class="material-icons">person</i>
						</span>
						<div class="form-line">
							<input type="text" class="form-control" name="username" placeholder="Email" required autofocus>
						</div>
					</div>
					<div class="input-group">
						<span class="input-group-addon">
							<i class="material-icons">lock</i>
						</span>
						<div class="form-line">
							<input type="password" class="form-control" name="password" placeholder="Contraseña" required>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-8 p-t-5">
						</div>
						<div class="col-xs-4">
							<input type="hidden" value="conectar" name="bandera" />
							<button class="btn btn-block bg-pink waves-effect" type="submit">Entrar</button>
						</div>
					</div>
					<div class="row m-t-15 m-b--20">
						<div class="col-xs-6">
							<a href="registro.php">Registrate </a> 
						</div>
						<div class="col-xs-6 align-right">
							<a href="olvidastecontrasena.php">¿ Olvidaste la contraseña ?</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!-- Jquery Core Js -->
	<script src="../plugins/jquery/jquery.min.js"></script>

	<!-- Bootstrap Core Js -->
	<script src="../plugins/bootstrap/js/bootstrap.js"></script>

	<!-- Waves Effect Plugin Js -->
	<script src="../plugins/node-waves/waves.js"></script>

	<!-- Validation Plugin Js -->
	<script src="../plugins/jquery-validation/jquery.validate.js"></script>

	<!-- Custom Js -->
	<script src="../js/admin.js"></script>
	<script src="../js/pages/examples/sign-in.js"></script>
</body>

</html>
