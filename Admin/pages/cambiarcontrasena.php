<?php
require('../php/configuracion.php');
    session_start();
    if (!isset($_SESSION['valido'])) {
     header("location:../pages/error.php");
 }
    ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Ingresa el codigo de Verificación Administración |<?php echo String_Get_Valores('titulo') ?></title>
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

<section class="content">
	<div class="container-fluid">
		<div class="block-header">

         <div class="row clearfix">
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                <div class="card">
                    <div class="header">
                        <h2>
                            INGRESA EL CODIGO DE VERIFICACIÓN
                            <small>Revisa tu correo electronico.</small>
                        </h2>

                    </div>
                    <div class="body">
                        <div class="alert alert-info" role="alert">
                            Usted  <strong>DEBE</strong>  revisar el correo electronico con el cual se registro ahí encontrara el codigo de verificación.
                        </div>

                        <form action="../php/peticiones.php" id="forgot_password" method="POST">
                            <div class="msg">
                                Codigo de verificación.
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                <i class="material-icons">email</i>
                                </span>
                                <div class="form-line">
                                    <input type="codigo" class="form-control" name="codigo" placeholder="Codigo de verificación" required autofocus>
                                </div>
                            </div>
                            <input type="hidden" value="enviar-codigo" name="bandera" />
                            <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">Enviar</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
</section>



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

