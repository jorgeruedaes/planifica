<?php

include('consultas.php');
/**
 * [Array_Get_MenuPrincipal Permite obtener los menus y submenus de la entrada principa
 * de administración y de cada uno de sus modulos]
 * @param [String] $tipo [Este tipo se define en menu o submenu]
 * @param [Integer] $padre [Codigo del Padre]
 */

function Array_Get_MenuPrincipal($padre,$tipo,$perfil)
{
	if ($tipo =='principal')
	{
		$consulta = consultar("SELECT * FROM tb_modulos WHERE 
			(id_modulos IN (SELECT padre FROM `tb_modulos` tb,tr_modulosxperfiles tr WHERE tb.id_modulos=tr.id_modulos AND id_perfiles=$perfil )) 
			OR id_modulos IN (SELECT id_modulos FROM tr_modulosxperfiles tr WHERE id_modulos AND id_perfiles=$perfil) and padre=$padre ORDER BY orden");
		$datos = array();
		while ($informacion = mysqli_fetch_array($consulta)) {
			$id_modulos  = $informacion['id_modulos'];
			$padre = $informacion['padre'];
			$nombre  = $informacion['nombre'];
			$ruta  = $informacion['ruta'];
			$submenu = $informacion['submenu'];
			$icono =  $informacion['icono'];
			$vector = array(
				'id_modulos' => "$id_modulos",
				'padre' => "$padre",
				'nombre' => "$nombre",
				'ruta' =>"$ruta",
				'submenu' => "$submenu",
				'icono' => "$icono"
				);
			array_push($datos, $vector);
		}
		return $datos;

	}
	else
	{
		$consulta = consultar("SELECT * FROM tb_modulos WHERE (id_modulos IN (SELECT id_modulos FROM tr_modulosxperfiles tr WHERE id_modulos AND id_perfiles=$perfil and padre=$padre)) ORDER BY orden ");
		$datos = array();
		while ($informacion = mysqli_fetch_array($consulta)) {
			$id_modulos  = $informacion['id_modulos'];
			$padre = $informacion['padre'];
			$nombre  = $informacion['nombre'];
			$ruta  = $informacion['ruta'];
			$submenu = $informacion['submenu'];
			$icono =  $informacion['icono'];
			$vector = array(
				'id_modulos' => "$id_modulos",
				'padre' => "$padre",
				'nombre' => "$nombre",
				'ruta' =>"$ruta",
				'submenu' => "$submenu",
				'icono' => "$icono"
				);
			array_push($datos, $vector);
		}
		return $datos;
	}

}
/**
 * [Boolean_Get_Modulo_Permiso Manejador de la seguridad en todas las paginas]
 * @param [Integer] $id_modulos [Entero con el valor del modulo en el cual se ha ingresado]
 * @param [Integer] $perfil     [Entero con el valor del perfil]
 */
function Boolean_Get_Modulo_Permiso($id_modulos,$perfil)
{
	$consulta = consultar("SELECT * FROM tr_modulosxperfiles WHERE id_modulos=$id_modulos and id_perfiles=$perfil");

	return (mysqli_num_rows($consulta)>0) ? True:False;
}

/**
 * [Array_Get_PadreHijo Obtiene la información del modulo con la de su respectivo padre]
 * @param [type] $hijo [Identificador del sub modulo]
 */
function Array_Get_PadreHijo($hijo)
{
	$consulta = consultar("(SELECT * from tb_modulos WHERE id_modulos=$hijo) union (SELECT * FROM tb_modulos WHERE id_modulos IN (SELECT padre from tb_modulos WHERE id_modulos=$hijo)) ORDER BY padre");
	$datos = array();
	while ($informacion = mysqli_fetch_array($consulta)) {
		$id_modulos  = $informacion['id_modulos'];
		$padre = $informacion['padre'];
		$nombre  = $informacion['nombre'];
		$ruta  = $informacion['ruta'];
		$icono =  $informacion['icono'];
		$vector = array(
			'id_modulos' => "$id_modulos",
			'padre' => "$padre",
			'nombre' => "$nombre",
			'ruta' =>"$ruta",
			'icono' => "$icono"
			);
		array_push($datos, $vector);
	}
	return $datos;

}
/**
 * [Array_Get_Preguntas Retorna las preguntas para el formulario de resgitro]
 */
function Array_Get_Preguntas()
{
	$consulta = consultar("SELECT * FROM tb_preguntas ");
	$datos = array();
	while ($informacion = mysqli_fetch_array($consulta)) {
		$id_preguntas  = $informacion['id_preguntas'];
		$pregunta = $informacion['pregunta'];
		$vector = array(
			'id_preguntas' => "$id_preguntas",
			'pregunta' => "$pregunta"
			);
		array_push($datos, $vector);
	}
	return $datos;
}
	/**
 * [String_Pregunta Retorna el texto de la pregunta]
 * @param [type] $pregunta [Identificador de la pregunta]
 */
function String_Pregunta($pregunta)
	{
	$consulta =  consultar("SELECT pregunta FROM tb_preguntas WHERE id_preguntas=$pregunta ");
	$informacion = mysqli_fetch_array($consulta);
	return $informacion['pregunta'];	
}
/**
 * [Array_Get_Modulos Obtiene los modulos y submodulos]
 * @param boolean $boolean [saber si es padre o hijo]
 * @param [type]  $padre   [El padre de ese submodulo]
 */
function Array_Get_Modulos($boolean,$padre)
{
	if($boolean=='true')
	{
		$consulta = consultar("SELECT * FROM `tb_modulos` WHERE padre='0' and tipo='admin' and submenu=1 Order by orden");
		
	}
	else
	{
		$consulta = consultar("SELECT * FROM `tb_modulos` WHERE padre=$padre and tipo='admin'  Order by orden");	
	}
	
	$datos = array();
	while ($informacion = mysqli_fetch_array($consulta)) {
		$id_modulos  = $informacion['id_modulos'];
		$padre = $informacion['padre'];
		$nombre  = $informacion['nombre'];
		$ruta  = $informacion['ruta'];
		$icono =  $informacion['icono'];
		$vector = array(
			'id_modulos' => "$id_modulos",
			'padre' => "$padre",
			'nombre' => "$nombre",
			'ruta' =>"$ruta",
			'icono' => "$icono"
			);
		array_push($datos, $vector);
	}
	return $datos;

}
/**
 * [Array_Get_Modulos Obtiene los modulos y submodulos]
 * @param boolean $boolean [saber si es padre o hijo]
 * @param [type]  $padre   [El padre de ese submodulo]
 */
function Array_Get_Modulos_All()
{
$consulta = consultar("SELECT * FROM `tb_modulos`   Order by orden");	
	
	
	$datos = array();
	while ($informacion = mysqli_fetch_array($consulta)) {
		$id_modulos  = $informacion['id_modulos'];
		$padre = $informacion['padre'];
		$nombre  = $informacion['nombre'];
		$ruta  = $informacion['ruta'];
		$submenu = $informacion['submenu'];
		$icono =  $informacion['icono'];
		$vector = array(
			'id_modulos' => "$id_modulos",
			'padre' => "$padre",
			'nombre' => "$nombre",
			'ruta' =>"$ruta",
			'submenu' =>"$submenu",
			'icono' => "$icono"
			);
		array_push($datos, $vector);
	}
	return $datos;

}
/**
 * [String_Get_NombreModulo description]
 * @param [type] $id_modulos [del modulo para cargar el nombre]
 */
	function String_Get_NombreModulo($id_modulos)
 {
 	$consulta = consultar("SELECT nombre FROM `tb_modulos` WHERE id_modulos=$id_modulos");	
 	$informacion = mysqli_fetch_array($consulta);

 	return $informacion['nombre'];
 }
 	function Int_RutaModulo($uri)
 {
 	$modulo='0';

 	$consulta = consultar("SELECT ruta,id_modulos FROM `tb_modulos` 
 		WHERE submenu='0' and tipo='admin' and estado='activo' ");	
 	while ($informacion = mysqli_fetch_array($consulta))
 	{
 	 if($uri==url().$informacion['ruta'])
 	 {
 	 	$modulo =$informacion['id_modulos']; 
 	 }
 	}
 	

 	return $modulo;
 }
  	function Int_RutaModulo_Anterior($uri)
 {
 	$modulo='0';

 	$consulta = consultar("SELECT ruta,id_modulos FROM `tb_modulos` 
 		WHERE submenu='0' and tipo='admin' and estado='activo' ");	
 	while ($informacion = mysqli_fetch_array($consulta))
 	{
 	 if($uri==url().$informacion['ruta'])
 	 {
 	 	$modulo =$informacion['id_modulos']; 
 	 }
 	}
 	

 	return $modulo;
 }

?>