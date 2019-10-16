<?php
require('../php/configuracion.php');
    session_start();
    if (!isset($_SESSION['recuperada'])) {
     header("location:../pages/error.php");
 }
     session_destroy();
     ?>
<!DOCTYPE html>
<html>

	<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>Inicio de sesion Administración |<?php echo String_Get_Valores('titulo') ?></title>
	<!-- Favicon-->
	<link rel="icon" href="../<?php echo String_Get_Valores('favicon') ?>" type="image/x-icon">

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
	
	
	<div class="container-fluid">
		<div class="block-header">
		
		 <div class="row clearfix">
		 	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		 		<div class="card">
                        <div class="header">
                            <h2>
                               INFORMACIÓN 
                               <small>Usted ha recuperado su contraseña.</small>
                            </h2>
                            
                        </div>
                        <div class="body">
                        	<div class="alert alert-info" role="alert">
                            	Usted ha recuerpado su contraseña para ingresar al sistema , haga click <strong><a href="inicio.php" class="alert-link">Aqui</a></strong> para volver a intentarlo.
                            </div>
      
                        </div>
                    </div>
                </div>
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