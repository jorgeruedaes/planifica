<?php
session_start();
include('../../../php/consultas.php');
include('../../../php/modulo.php');

if($_SESSION['perfil']==3)
{
	$resultado = '{"salida":true,';
	$bandera = $_POST['bandera'];

// Agrega un nuevo modulo al sitio.
	if ($bandera === "nuevo") {
		$nombre = $_POST['nombre'];
		$ruta = $_POST['ruta'];
		$icono = $_POST['icono'];
		$tipo = $_POST['tipo'];
		$submenu = $_POST['submenu'];
		$padre = $_POST['padre'];
		$orden = $_POST['orden'];
		list($query,$mensaje) = Boolean_Create_Modulo($nombre,$ruta,$icono,$tipo,$submenu,$padre,$orden);
		if ($query) {
			$resultado.='"mensaje":true';
			$resultado.='"mensaje":'.$mensaje.'';
		} else {
			$resultado.='"mensaje":false';
			$resultado.='"mensaje":'.$mensaje.'';
		}
	}
	// Permite modificar un modulo.
	else if($bandera === "modificar") {
		$nombre = $_POST['nombre'];
		$id_modulo = $_POST['id_modulo'];
		$ruta = $_POST['ruta'];
		$icono = $_POST['icono'];
		$tipo = $_POST['tipo'];
		$submenu = $_POST['submenu'];
		$padre = $_POST['padre'];
		$orden = $_POST['orden'];
		list($query,$mensaje) = Boolean_Set_Modulo($id_modulo,$nombre,$ruta,$icono,$tipo,$submenu,$padre,$orden);
		if ($query) {
			$resultado.='"mensaje":true';
			$resultado.='"mensaje":'.$mensaje.'';
		} else {
			$resultado.='"mensaje":false';
			$resultado.='"mensaje":'.$mensaje.'';
		}
	}
	
}
else
{
	$resultado = '{"salida":false';
}
$resultado.='}';
echo ($resultado);
?>