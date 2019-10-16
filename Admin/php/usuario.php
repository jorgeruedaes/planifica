<?php

/**
 * [Array_Get_Usuario Obtiene los datos no sencibles del usuario]
 * @param [Integer] $usuario [Identificador del Usuario]
 */
function Array_Get_Usuario($usuario)
{

	$usuarios = consultar("SELECT `id_usuario`,`nombre_usuario`, `apellido_usuario`, `perfil`, `email_usuario`, `estado`,pregunta_usuario,respuesta,color FROM `tb_usuarios` WHERE id_usuario=$usuario ");
	while ($valor = mysqli_fetch_array($usuarios)) {
		$id_usuarios = $valor['id_usuario'];
		$nombre       = $valor['nombre_usuario'];
		$apellido          = $valor['apellido_usuario'];
		$perfil          = $valor['perfil'];
		$email        = $valor['email_usuario'];
		$estado        = $valor['estado'];
		$pregunta   = $valor['pregunta_usuario'];
		$respuesta = $valor['respuesta'];
		$color = $valor['color'];
		$datos = array(
			'id_usuarios'=>"$id_usuarios",
			'nombre' => "$nombre",
			'apellido' => "$apellido",
			'perfil' => "$perfil",
			'email' => "$email",
			'estado' => "$estado",
			'pregunta' => "$pregunta",
			'respuesta' => "$respuesta",
			'color' => "$color"
			);
	}

	return $datos;	
}

/**
 * [String_Get_Nombre Obtiene el nombre completo del usuario]
 * @param Integer $usuario [Codigo identificador del usuario]
 */
function String_Get_Nombre($usuario)
{
	$usuario = consultar("SELECT `nombre_usuario`, `apellido_usuario` FROM `tb_usuarios` WHERE id_usuario=$usuario"); 
	while ($valor = mysqli_fetch_array($usuario)) {
		return $valor['nombre_usuario']." ".$valor['apellido_usuario'];
	}
}

/**
 * [Array_Get_Usuarios Retorna el grupo de usuarios editables o modificables]
 */
function Array_Get_Usuarios($perfil)
{
	if($perfil==3)
	{
		$usuario = consultar("SELECT `id_usuario`,`nombre_usuario`, `apellido_usuario`, `perfil`, `email_usuario`, `estado` FROM `tb_usuarios`");
	}

	else
	{
		$usuario = consultar("SELECT `id_usuario`,`nombre_usuario`, `apellido_usuario`, `perfil`, `email_usuario`, `estado` FROM `tb_usuarios` WHERE perfil!=3  ");	
	}	
	$datos = array();
	while ($valor = mysqli_fetch_array($usuario)) {
		$id_usuarios = $valor['id_usuario'];
		$nombre       = $valor['nombre_usuario'];
		$apellido          = $valor['apellido_usuario'];
		$perfil          = $valor['perfil'];
		$email        = $valor['email_usuario'];
		$estado        = $valor['estado'];
		$vector = array(
			'id_usuarios'=>"$id_usuarios",
			'nombre' => "$nombre",
			'apellido' => "$apellido",
			'perfil' => "$perfil",
			'email' => "$email",
			'estado' => "$estado"
			);
		array_push($datos, $vector);
	}

	return $datos;	
}
/**
 * [Array_Get_Perfiles Obtiene los nombres de los perfiles]
 * @param [type] $perfil [Codigo que identifica el perfil para saber cuales debo o no mostrar]
 */
function Array_Get_Perfiles($perfil)
{
	if($perfil=='3')
	{
		$perfiles = consultar("SELECT * FROM `tb_perfiles`");
	}
	else
	{
		$perfiles = consultar("SELECT * FROM `tb_perfiles` WHERE id_perfiles!=3");
	}
	$datos = array();
	while ($valor = mysqli_fetch_array($perfiles)) {
		$id_perfiles = $valor['id_perfiles'];
		$nombre       = $valor['nombre'];
		$descripcion          = $valor['descripcion'];
		$nivel          = $valor['nivel'];
		$vector = array(
			'id_perfiles'=>"$id_perfiles",
			'nombre' => "$nombre",
			'descripcion' => "$descripcion",
			'nivel' => "$nivel"
			);
		array_push($datos, $vector);
	}

	return $datos;	

}
/**
 * [String_Get_Nombre_Perfil Obtiene los nombres de los perfiles]
 * @param [type] $perfil [Codigo que identifica el perfil]
 */
function String_Get_Nombre_Perfil($perfil)
{
	$usuario = consultar("SELECT * FROM `tb_perfiles` WHERE id_perfiles=$perfil"); 
	while ($valor = mysqli_fetch_array($usuario)) {
		return $valor['nombre'];
	}	
}
/**
 * [Array_Get_Listado_Perfiles Obtengo el listado de los perfiles disponibles en la pagina]
 * @param [type] $perfil [Perfil con el cual se accedio con el fin de establer cuales perfiles mostrar]
 */
function Array_Get_Listado_Perfiles($perfil)
{
	if($perfil!=3)
	{
		$perfiles = consultar("SELECT * FROM `tb_perfiles` WHERE id_perfiles!=3 ORDER BY nivel");
	}
	else
	{
		$perfiles = consultar("SELECT * FROM `tb_perfiles` ORDER BY nivel");	
	}

	$datos = array();
	while ($valor = mysqli_fetch_array($perfiles)) {
		$id_perfiles = $valor['id_perfiles'];
		$nombre       = $valor['nombre'];
		$descripcion          = $valor['descripcion'];
		$nivel          = $valor['nivel'];
		$vector = array(
			'id_perfiles'=>"$id_perfiles",
			'nombre' => "$nombre",
			'descripcion' => "$descripcion",
			'nivel' => "$nivel"
			);
		array_push($datos, $vector);
	}

	return $datos;	
}
/**
 * [Int_Get_nuevosUsuarios Obtiene la cantidad de nuevos usuarios]
 */
function Int_Get_nuevosUsuarios()
{
	$usuario = consultar("SELECT * FROM `tb_usuarios` WHERE estado='procesando'  ");
	return mysqli_num_rows($usuario);
}

/**
 * [JSON_Get_ModulosxPerfil Permite obtener los modulos asignados a un perfil]
 * @param [type] $perfil [perfil de usuario para obtener permisos]
 */
function JSON_Get_ModulosxPerfil($perfil)
{
	$perfiles = consultar("SELECT * FROM tr_modulosxperfiles WHERE id_perfiles=$perfil ");
	$datos = array();
	while ($valor = mysqli_fetch_array($perfiles)) {
		$id_perfiles = $valor['id_perfiles'];
		$id_modulos       = $valor['id_modulos'];
		$vector = $id_modulos;
		array_push($datos, $vector);
	}

	return json_encode($datos,JSON_HEX_TAG);	
}

/**
 * [Boolean_Insertar_Usuario Insertar un nuevo usuario.]
 * @param [type] $nombre    [nombre del usuario]
 * @param [type] $apellido  [apellldo del usuario]
 * @param [type] $username  [User name]
 * @param [type] $password  [contraseña]
 * @param [Int] $pregunta  [Numero de la pregunta]
 * @param [type] $respuesta [Respuesta]
 * @param [type] $email     [email del nuevo usuario]
 */
function Boolean_Insertar_Usuario($nombre,$apellido,$username,$password,$pregunta,$respuesta,$email)
{
	list ($valid,$mensaje) = Boolean_Existencia_Usuario($username,$email);
	if($valid)
	{
		$query = insertar(sprintf("INSERT INTO `tb_usuarios`(`id_usuario`, `nombre_usuario`, `apellido_usuario`, `perfil`,
			`usuario`, `contrasena`, `pregunta_usuario`, `respuesta`,`email_usuario`, `estado`,`color`)
			VALUES (NULL,'%s','%s','2','%s','%s','%d','%s','%s',
			'procesando','green')",escape($nombre),escape($apellido),escape($username),escape($password),
			escape($pregunta),escape($respuesta),escape($email)));	

		if($query){
			return array($query,'El usuario se creó exitosamente.');
		}
		else{
			return array($query,'El usuario se no se puedo crear.');
		}	
	}	
	else
	{
		return array(False,$mensaje);

	}
}
/**
 * [Boolean_Existencia_Usuario Valida si existe el usuario.]
 * @param [type] $username [nombre de usuario]
 * @param [type] $email    [email del usuario]
 */
function Boolean_Existencia_Usuario($username,$email)
{
	$query = consultar(sprintf("SELECT email_usuario,usuario FROM tb_usuarios WHERE email_usuario='%s' or usuario='%s'",escape($username),escape($email)));
	if(Int_consultaVacia($query)>0)
	{
		return array(false,'El usuario o el email ya existen, intenta nuevamente.');
	}else
	{
		return array(true,'');	
	}

}
/**
 * [Boolean_Set_Perfil_Estado_Usuario Permite modificar el estado o el perfil de un usuario]
 * @param [type] $id_usuarios [description]
 * @param [type] $estado      [nuevo estado]
 * @param [type] $id_perfiles [nuevo perfil]
 */
function Boolean_Set_Perfil_Estado_Usuario($id_usuarios,$estado,$id_perfiles)
{
	$query = modificar(sprintf("UPDATE `tb_usuarios` SET `estado`='%s', `perfil` ='%d' WHERE id_usuario='%d' ",escape($estado),escape($id_perfiles),escape($id_usuarios)));
	return $query;
}
/**
 * [Boolean_Set_Password Modificar el password de un usuario]
 * @param [type] $password [nueva contraseña]
 * @param [type] $usuario  [id_usuario del usuario]
 */
function Boolean_Set_Password($password,$usuario)
{
	$password  = password_hash($password, PASSWORD_BCRYPT);
	$query =  modificar(sprintf("UPDATE `tb_usuarios` SET contrasena='%s' WHERE id_usuario='%d'",escape($password),escape($usuario)));
	return $query;
}
/**
 * [Boolean_Set_Usuario Modficar los datos de un usuario]
 * @param [type] $nombre    [description]
 * @param [type] $apellido  [description]
 * @param [type] $email     [description]
 * @param [type] $pregunta  [description]
 * @param [type] $respuesta [description]
 * @param [type] $usuario   [description]
 */
function Boolean_Set_Usuario($nombre,$apellido,$email,$pregunta,$respuesta,$usuario)
{
	$query =  modificar(sprintf("UPDATE `tb_usuarios` SET nombre_usuario='%s',apellido_usuario='%s',email_usuario='%s',pregunta_usuario='%d',respuesta='%s' WHERE id_usuario='%d'",escape($nombre),escape($apellido),escape($email),escape($pregunta),escape($respuesta),escape($usuario)));
	return $query;	
}
/**
 * [Boolean_Delete_Usuario Permite eliminar un usuario]
 * @param [type] $id_usuarios [id_del usuario que eliminara]
 */
function Boolean_Delete_Usuario($id_usuarios,$perfil)
{
	if($perfil==3)
	{
		$query =  eliminar(sprintf("DELETE FROM `tb_usuarios` WHERE id_usuario='%d' and perfil!=3 ",escape($id_usuarios)));
		return $query;	
	}
	else
	{
		$query =  eliminar(sprintf("DELETE  FROM`tb_usuarios` WHERE id_usuario='%d' and perfil='1' ",escape($id_usuarios)));
		return $query;	
	}
	
}

function generarCodigo($longitud) {
	$key = '';
	$pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
	$max = strlen($pattern)-1;
	for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
		return $key;
}

function new_verificacion($usuario,$codigo)
{
	$verifiacion = insertar(sprintf("INSERT INTO `tb_verificacion`(`id_verificacion`, `usuario`, `fecha`, `codigo`) 
		VALUES (NULL,'%d',curdate(),'%s')",
		escape($usuario),escape($codigo)));
	return $verifiacion; 

}
function Boolean_Existencia_verificacion($usuario,$codigo)
{
	$verifiacion = consultar(sprintf("SELECT * FROM `tb_verificacion` where codigo = '$codigo' and usuario ='$usuario' "));
	return $verifiacion; 

}
function delete_verificacion($usuario)
{
	$query =  eliminar(sprintf("DELETE  FROM`tb_verificacion` WHERE usuario='%d' and fecha=curdate() ",escape($usuario)));
	return $query;	

}

function enviar_correo($email,$codigo)
{
 $para  = $email;   //a quien le va a llegar el correo

 $de= $_POST['nombre'];
 $email = 'webmaster@ligasantandereanadefutbol.co';
 $asunto = 'Cambio de Contrasena';
 $mensaje = $codigo;

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
									<h3 style="color: #BC191A;text-align:center;font-size:20px">Recupera tu contrasena!</h3>
									<br>
									<br>
									<br>
									<table id="tableRequest">
										<tbody>
											<tr>
												<td class="req">Asunto:</td>
												<td class="req">'.$asunto.'</td>
											</tr>
											<tr>
												<td class="req">Codigo de seguridad:</td>
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
															Enviado desde el Sitio Web, Por favor no responder. <br>
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

	return true;
}else
{
	return false;
}

}




?>