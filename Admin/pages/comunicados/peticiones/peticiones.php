<?php
session_start();
include('../../../php/consultas.php');
include('../../../php/comunicados.php');

if(isset($_SESSION['id_usuarios']))
{
	$resultado = '{"salida":true,';
	$bandera = $_POST['bandera'];

// Agrega un nuevo modulo al sitio.
	if ($bandera === "nuevo") {
		$titulo = $_POST['titulo'];
		$tipo = $_POST['tipo'];
		$fecha = $_POST['fecha'];
		$comunicado =$_POST['comunicado'];

		if (boolean_new_Comunicado($tipo,$comunicado,$fecha,$titulo)) {
			$resultado.='"mensaje":true';
		} else {
			$resultado.='"mensaje":false';
		}
	}
	// Permite modificar un modulo.
	else if($bandera === "modificar") {
		$titulo = $_POST['titulo'];
		$tipo = $_POST['tipo'];
		$fecha = $_POST['fecha'];
		$comunicado = $_POST['comunicado'];
		$codigo = $_POST['codigo'];
		if (boolean_set_Comunicado($tipo,$fecha,$titulo,$codigo,$comunicado)) {
			$resultado.='"mensaje":true';
		} else {
			$resultado.='"mensaje":false';
		}
	}else if($bandera === "eliminar") {
		$comunicado = $_POST['comunicado'];

		if (boolean_delete_Comunicado($comunicado)) {
			$resultado.='"mensaje":true';
		} else {
			$resultado.='"mensaje":false';
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