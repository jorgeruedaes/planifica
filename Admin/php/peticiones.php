<?php
ob_start();

session_start();
include('consultas.php');
include('usuario.php');
$resultado = '{"salida":true,';
$bandera = $_POST['bandera'];


// Permite guardar el nuevo usuario en la BD.
if ($bandera === "guardar") {

	$nombre = $_POST['name'];
	$apellido = $_POST['lastname'];
	$username = $_POST['username'];
	$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
	$pregunta = $_POST['pregunta'];
	$respuesta = $_POST['respuesta'];
	$email = $_POST['email'];

	list ($query,$mensaje) = Boolean_Insertar_Usuario($nombre,$apellido,$username,$password,$pregunta,$respuesta,$email);	

	if ($query)
   {
      $resultado.='"mensaje":true';
      $resultado.=',"comentario":'.$mensaje.'';
      header("location:../pages/usuariocreado.php");
  } else {
      $resultado.='"mensaje":false';
      $resultado.=',"comentario":'.$mensaje.'';
      header("location:../pages/registro.php");
  }
}
// Permite saber si se puede o no registrar el nuevo usuario con ese nombre y email.
else if($bandera === "validar-usuario") {
	$email = $_POST['email'];
	$username = $_POST['username'];
	list($query,$mensaje) = Boolean_Existencia_Usuario($username,$email); 
	if ($query) {
		$resultado.='"mensaje":false';
		$resultado.=',"comentario":'.$mensaje.'';
	} else {
		$resultado.='"mensaje":true';
	}
	// Permite recuperar la contraseña
}else if($bandera === "recuperar") {
	$email = $_POST['email'];
	$query = consultar(sprintf("SELECT  id_usuario,pregunta_usuario,email_usuario FROM `tb_usuarios` WHERE email_usuario='%s'",escape($email)));
	$values = mysqli_fetch_array($query);
	if (Int_consultaVacia($query)>0) {
       session_start();   

       $_SESSION['usuario']=$values['id_usuario'];
        $_SESSION['email']=$values['email_usuario'];
       $_SESSION['pregunta']=$values['pregunta_usuario'];
       header("location:../pages/preguntas.php");
   } else {
      session_destroy();
      header("location:../pages/error.php");
  }
	// Valida la respuesta del usuario.
}else if($bandera === "validar-respuesta") {
	$respuesta = $_POST['respuesta'];
	$query = consultar(sprintf("SELECT id_usuario FROM `tb_usuarios` WHERE id_usuario='%d' and respuesta= '%s' ",
        escape($_SESSION['usuario']),escape($respuesta)));
	if (Int_consultaVacia($query)>0) {
		$_SESSION['valido']=$_SESSION['usuario'];
        $email = $_SESSION['email'];
       $codigo = generarCodigo(10);
       if(new_verificacion($_SESSION['usuario'],$codigo))
       {
        if(enviar_correo($email,$codigo))
        {

        header("location:../pages/cambiarcontrasena.php");
        }
        else
        {
        session_destroy();
        header("location:../pages/error.php");
       }

       }
	} else {
		session_destroy();
		header("location:../pages/error.php");
	}
}
// Permite verificar codigo para crear nueva contraseña.
else if($bandera === "enviar-codigo") {
    $codigo = $_POST['codigo'];
    $query = Boolean_Existencia_verificacion($_SESSION['valido'],$codigo);
    if ($query) {

        $_SESSION['verificado'] = 'Si';
        header("location:../pages/nuevacontrasena.php");
    } else {
        session_destroy();
        header("location:../pages/error.php");
    }
}
// Permite crear una nueva contraseña.
else if($bandera === "nueva") {
	$password = $_POST['password'];
	$query = Boolean_Set_Password($password,$_SESSION['valido']);
	if ($query) {
		$_SESSION['recuperada']='Si';
        delete_verificacion($_SESSION['valido']);
		header("location:../pages/recuperada.php");
	} else {
		session_destroy();
		header("location:../pages/error.php");
	}
}
// Permite el inicio de sesión.
else if($bandera === "conectar") {
	$contrasena= $_POST['password'];
	$email = $_POST['username'];
	$usuario_resgistrado=consultar(sprintf("SELECT id_usuario,perfil,contrasena FROM tb_usuarios WHERE (usuario='%s' or email_usuario='%s') and estado='activo' ",escape($email),escape($email)));
	if(Int_consultaVacia($usuario_resgistrado)>0){
		$values=mysqli_fetch_array($usuario_resgistrado);
		if (password_verify($contrasena,$values['contrasena']))
		{
			session_start();   
			$_SESSION['id_usuarios']=$values['id_usuario'];
			$_SESSION['perfil']=$values['perfil'];
			$_SESSION['Id']=Int_New_Sesion($values['id_usuario']);
			header("location: ".base_url()."pages/administracion.php");
		}else{
            session_destroy();
            header("location:../pages/error.php");
        }
    }else{
      header("location:../pages/inicio.php");
  }
}
else if($bandera === "EnviarCorreo") {

$para  = 'mlizarazo@ligasantandereanadefutbol.co';   //a quien le va a llegar el correo

$de= $_POST['nombre'];
$email = $_POST['email'];
$asunto = $_POST['asunto'];
$mensaje = $_POST['mensaje'];

$contenido = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>[SUBJECT]</title>
    <style type="text/css">
        body {
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
            margin:0 !important;
            width: 100% !important;
            -webkit-text-size-adjust: 100% !important;
            -ms-text-size-adjust: 100% !important;
            -webkit-font-smoothing: antialiased !important;
        }
        .tableContent img {
            border: 0 !important;
            display: block !important;
            outline: none !important;
        }
        a{
            color:#382F2E;
        }

        p, h1,h2,ul,ol,li,div{
            margin:0;
            padding:0;
        }

        h1,h2{
            font-weight: normal;
            background:transparent !important;
            border:none !important;
        }

        @media only screen and (max-width:480px)

        {

            table[class="MainContainer"], td[class="cell"] 
            {
                width: 100% !important;
                height:auto !important; 
            }
            td[class="specbundle"] 
            {
                width: 100% !important;
                float:left !important;
                font-size:13px !important;
                line-height:17px !important;
                display:block !important;
                padding-bottom:15px !important;
            }	
            td[class="specbundle2"] 
            {
                width:80% !important;
                float:left !important;
                font-size:13px !important;
                line-height:17px !important;
                display:block !important;
                padding-bottom:10px !important;
                padding-left:10% !important;
                padding-right:10% !important;
            }

            td[class="spechide"] 
            {
                display:none !important;
            }
            img[class="banner"] 
            {
                width: 100% !important;
                height: auto !important;
            }
            td[class="left_pad"] 
            {
                padding-left:15px !important;
                padding-right:15px !important;
            }

        }

        @media only screen and (max-width:540px) 

        {

            table[class="MainContainer"], td[class="cell"] 
            {
                width: 100% !important;
                height:auto !important; 
            }
            td[class="specbundle"] 
            {
                width: 100% !important;
                float:left !important;
                font-size:13px !important;
                line-height:17px !important;
                display:block !important;
                padding-bottom:15px !important;
            }	
            td[class="specbundle2"] 
            {
                width:80% !important;
                float:left !important;
                font-size:13px !important;
                line-height:17px !important;
                display:block !important;
                padding-bottom:10px !important;
                padding-left:10% !important;
                padding-right:10% !important;
            }

            td[class="spechide"] 
            {
                display:none !important;
            }
            img[class="banner"] 
            {
                width: 100% !important;
                height: auto !important;
            }
            td[class="left_pad"] 
            {
                padding-left:15px !important;
                padding-right:15px !important;
            }

        }

        .contentEditable h2.big,.contentEditable h1.big{
            font-size: 26px !important;
        }

        .contentEditable h2.bigger,.contentEditable h1.bigger{
            font-size: 37px !important;
        }

        td,table{
            vertical-align: top;
        }
        td.middle{
            vertical-align: middle;
        }

        a.link1{
            font-size:13px;
            color:#27A1E5;
            line-height: 24px;
            text-decoration:none;
        }
        a{
            text-decoration: none;
        }

        .link2{
            color:#ffffff;
            border-top:10px solid #27A1E5;
            border-bottom:10px solid #27A1E5;
            border-left:18px solid #27A1E5;
            border-right:18px solid #27A1E5;
            border-radius:3px;
            -moz-border-radius:3px;
            -webkit-border-radius:3px;
            background:#27A1E5;
        }

        .link3{
            color:#555555;
            border:1px solid #cccccc;
            padding:10px 18px;
            border-radius:3px;
            -moz-border-radius:3px;
            -webkit-border-radius:3px;
            background:#ffffff;
        }

        .link4{
            color:#27A1E5;
            line-height: 24px;
        }

        h2,h1{
            line-height: 20px;
        }
        p{
            font-size: 14px;
            line-height: 21px;
            color:#AAAAAA;
        }

        .contentEditable li{

        }

        .appart p{

        }
        .bgItem{
            background: #ffffff;
        }
        .bgBody{
            background: #ffffff;
        }

        img { 
            outline:none; 
            text-decoration:none; 
            -ms-interpolation-mode: bicubic;
            width: auto;
            max-width: 100%; 
            clear: both; 
            display: block;
            float: none;
        }

        p{
            color:#6C7A89;
        }
#tableRequest {
        border-collapse: collapse;
        width: 100%;
    }
    .req {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

</style>
<script type="colorScheme" class="swatch active">
    {
        "name":"Default",
        "bgBody":"ffffff",
        "link":"27A1E5",
        "color":"AAAAAA",
        "bgItem":"ffffff",
        "title":"444444"
    }
</script>
</head>
<body style="background-color: #ECF0F1;">
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tbody>
<tr>
<td>
<table style="font-family:helvetica, sans-serif; margin: 30px auto; border-radius: 5px; -webkit-border-radius: 5px;" class="MainContainer" align="center" width="500" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff">
<tbody>
<tr>
<td>
<table style="border-color: #dddddd;border-width: 1px;border-style: solid;" width="100%" cellspacing="0" cellpadding="0" border="0">
<tbody>
<tr>
<td width="20" valign="top">&nbsp;</td>
<td>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tbody>
<tr>
<td class="movableContentContainer">
<div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tbody>
<tr>
<td height="15"></td>
</tr>
<tr style="text-align: center;align-content: center;">
<td style="align-content: center;">
<table width="100%" cellspacing="0" cellpadding="0" border="0">
    <tbody>
        <tr>
            <td style="/*! background-color: black; */background-color: #019875;padding: 15px;/*! text-align: center; */" valign="top">
                <div style="/*! text-align: center; */"><img src="http://ligasantandereanadefutbol.co/images/logo.png" alt="Logo" title="Logo" data-max-width="100" style="/*! text-align: center; */width: 50%;height: 30%;" height="60" width="60"></div>
            </td>
        </tr>
    </tbody>
</table>
</td>
</tr>
<tr>
<td height="15"> </td>
</tr>
<tr>
<td><hr style="height:1px;background:#DDDDDD;border:none;"></td>
</tr>
</tbody>
</table>
</div>
<div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
</div>
<div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tbody>
<tr>
<td height="20"></td>
</tr>
<tr>
<td style="border: 1px solid #EEEEEE; border-radius:6px;-moz-border-radius:6px;-webkit-border-radius:6px"><table width="100%" cellspacing="0" cellpadding="0" border="0">
<tbody>
    <tr>
        <td width="40" valign="top">&nbsp;</td>
        <td><table align="center" width="100%" cellspacing="0" cellpadding="0" border="0">
            <tbody>
                <tr>
                    <td>
                        <div class="contentEditableContainer contentTextEditable">
                            <div class="contentEditable">
                                <h3 style="color: #BC191A;text-align:center;font-size:20px">Tienes un nuevo mensaje!</h3>
                                <br>
                                <br>
                                <br>
                                <table id="tableRequest">
                                  <tbody>
                                      <tr>
                                        <td class="req">De:</td>
                                        <td class="req">'.$de.'</td>
                                    </tr>
                                    <tr>
                                        <td class="req">Email:</td>
                                        <td class="req">'.$email.'</td>
                                    </tr>
                                    <tr>
                                        <td class="req">Asunto:</td>
                                                <td class="req">'.$asunto.'</td>
                                            </tr>
                                            <tr>
                                                <td class="req">Mensaje:</td>
                                                <td class="req">'.$mensaje.'</td>
                                            </tr>
                                        </tbody></table>
                                        <br>
                                        <br>
                                        <br>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody></table></td>
                        <td width="40" valign="top">&nbsp;</td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
</tbody>
</table>
</div>
<div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tbody>
    <tr>
        <td height="40"></td>
    </tr>
</tbody>
</table>
</div>
<div class="movableContent" style="border: 0px; padding: 10px 0; position: relative; background: #019875; color:#FFFFFF; /*! border-radius: 5px; */ /*! -webkit-border-radius: 5px; */">
                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td><table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td class="spechide" width="90" valign="top">&nbsp;</td>
                                                                                                <td><table align="center" width="100%" cellspacing="0" cellpadding="0">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td>
                                                                                                                <div class="contentEditableContainer contentTextEditable">
                                                                                                                    <div class="contentEditable" style="text-align: center;">
                                                                                                                        <p style="color: #FFFFFF;">
                                                                                                                            Enviado desde el Sitio Web <br>
                                                                                                                        </p>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody></table></td>
                                                                                                    <td class="spechide" width="90" valign="top">&nbsp;</td>
                                                                                                </tr>                                                                                        
                                                                                            </tbody>                                                                                     
                                                                                        </table>                                                                                     
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>                                                                                     
                                                                    </div>                                                                                       
                                                                    <br>                                                                                         
                                                                    <div class="movableContent" style="border: 0px; padding-top: 0px; position: relative;">
                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>
                                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td class="spechide" width="130" valign="top">&nbsp;</td>
                                                                                                    <td class="specbundle2"><table align="center" width="100%" cellspacing="0" cellpadding="0"><tbody><tr>
                                                                                                    </tr>
                                                                                                </tbody></table></td>
                                                                                                <td class="spechide" width="130" valign="top">&nbsp;</td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td width="20" valign="top">&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
</body>
</html>
';


$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$cabeceras .= 'From: <'.$email.'>' . "\r\n";

// Enviarlo
if(mail($para, $asunto, $contenido, $cabeceras)){

  $resultado.='"mensaje":true';
}else
{
  $resultado.='"mensaje":false';
}

}

$resultado.='}';
echo ($resultado);
ob_end_flush();
?>
