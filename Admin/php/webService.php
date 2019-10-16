<?php
include('consultas.php');
include('planifica.php');
include('usuario.php');

$myObj->salida = "true";

$modulo = String_Get_modulo_hash($_POST['modulo']);
$accion = $_POST['accion'];

$myObj->modulo = $modulo;

if ($modulo === "generales") {
	if ($accion === "iniciar")
	{

		$contrasena= $_POST['password'];
		$email = $_POST['username'];
		$usuario_resgistrado=consultar(sprintf("SELECT id_usuario,perfil,contrasena FROM tb_usuarios WHERE email_usuario='%s' and estado='activo' ",escape($email)));
		if(Int_consultaVacia($usuario_resgistrado)>0)
		{
			$values=mysqli_fetch_array($usuario_resgistrado);
			if (password_verify($contrasena,$values['contrasena']))
			{
				$query = true;
			}else{
				$query = false;
			}
		}else
		{
			$query = false;
		}

		if ($query)
		{

	$myObj->mensaje = "true";
		} else 
		{
	$myObj->mensaje = "false";
		}
	}
	else if ($accion === "descargar_estados")
	{
$estado = '111';
		$vector = Get_estados ($estado);
		
		if (!empty($vector)) {
			$myObj->mensaje = "true";
			$myObj->datos = ''.$vector.'';
			
			
		} else {
			$myObj->mensaje = "false";
		}
	} 
}
else if ($modulo === "actividades")
{
    if ($accion === "subir_ruta")
	{

		$id_ruta= $_POST['id_ruta'];
		$lat = $_POST['lat'];
		$lon = $_POST['lon'];
		$fecha_generacion = $_POST['fecha_generacion'];
		$orden = $_POST['orden'];
		
		$ruta = insertar(sprintf("INSERT INTO `tb_ruta_usuario`(`id_ruta`, `lat`, `lon`, `fecha_generacion`, `orden`)
   VALUES ('%d','%s','%s','%s','%d')",
    escape($id_ruta),escape($lat),escape($lon),escape($fecha_generacion),escape($orden)));
    
		if ($ruta)
		{

	$myObj->mensaje = "true";
		} else 
		{
	$myObj->mensaje = "false";
		}
	}

}
else if ($modulo === "eventos")
{
    if ($accion === "descargar_eventos")
	{

		$usuario= $_POST['usuario_creacion'];
		$vector = Get_eventos_usuario($usuario);
		
		if (!empty($vector)) {
			$myObj->mensaje = "true";
			$myObj->datos = ''.$vector.'';
			
			
		} else {
			$myObj->mensaje = "false";
		}
	} 
	else if ($accion === "subir_evento")
	{

		$id_evento= $_POST['id_evento'];
		$nombre_evento= $_POST['nombre_evento'];
		$tipo_evento= $_POST['tipo_evento'];
		$fecha_inicio= $_POST['fecha_inicio'];
		$fecha_fin= $_POST['fecha_fin'];
		$estado= $_POST['estado'];
		$lugar= $_POST['lugar'];
		$descripcion= $_POST['descripcion'];
		$usuario_creacion= $_POST['usuario_creacion'];
		
										
	$insert = new_evento($id_evento, $nombre_evento, $tipo_evento,
      $fecha_inicio, $fecha_fin, $estado, $lugar, $descripcion,
      $usuario_creacion);
		
		if ($insert) {
			$myObj->mensaje = "true";
	
		} else {
			$myObj->mensaje = "false";
		}
	} else if ($accion === "descargar_tipo_eventos")
	{
         $estado='5001';
        	
		$vector = Get_tipo_eventos($estado);
		
		if (!empty($vector)) {
			$myObj->mensaje = "true";
			$myObj->datos = ''.$vector.'';
			
			
		} else {
			$myObj->mensaje = "false";
		}
	} 
	

}
else
{
	$myObj->mensaje = "false";


}

$principal->result = array(json_encode($myObj));

$myJSON = json_encode($principal);


echo $myJSON;
?>