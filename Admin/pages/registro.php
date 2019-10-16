
<?php
require('../php/principal.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Registro Administración |<?php echo String_Get_Valores('titulo') ?></title>
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
                    <div class="msg">Recuerda que para poder ingresar el usuario debe ser autorizado por un administrador.</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" id="name" class="form-control" name="name" placeholder="Nombre" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Apellido" required autofocus>
                        </div>
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" id="username"  name="username" placeholder="Nombre de usuario" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        </div>
                        
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">touch_app</i>
                        </span>
                        <select name="pregunta" class="form-control show-tick select-pregunta" required>
                            <option value="">-- Selecciona una pregunta --</option>
                            <?php 
                            $vector = Array_Get_Preguntas();
                            foreach ($vector as  $value)
                            {
                             ?>
                             <option value="<?php echo $value['id_preguntas']; ?>"><?php echo $value['pregunta']; ?></option>
                             <?php
                         } 
                         ?>                           
                     </select>
                 </div>
                 <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">question_answer</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" name="respuesta" id="respuesta" placeholder="Respuesta" required>
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                     <input type="password" class="form-control" id="password" name="password" minlength="8" placeholder="Contraseña" required>
                 </div>
             </div>
             <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">lock</i>
                </span>
                <div class="form-line">
                 <input type="password" class="form-control" name="confirm" minlength="8" placeholder="Confirmar contraseña" required>
             </div>
         </div>
         <div class="form-group">
            <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
            <label for="terms">Ya he leido, acepto los <a href="javascript:void(0);">terminos de uso</a>.</label>
        </div>
        <div class="row">
            <div class="col-xs-8 p-t-5">
            </div>
            <div class="col-xs-12">
                <input type="hidden" value="guardar" name="bandera" />
                <button class="btn btn-block bg-pink waves-effect registro" type="submit">Registrarse</button>
            </div>
        </div>
    </form>
    <div class="m-t-25 m-b--5 align-center">
    <a href="inicio.php">¿ Ya estas registrado ?</a>
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

