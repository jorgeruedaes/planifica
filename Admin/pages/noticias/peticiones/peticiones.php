<?php
session_start();
include('../../../php/consultas.php');
include('../../../php/noticias.php');

if(isset($_SESSION['id_usuarios']))
{
	$resultado = '{"salida":true,';
	$bandera = $_POST['bandera'];

// Agrega un nuevo modulo al sitio.
	if ($bandera === "nuevo") {
		$titulo = $_POST['titulo'];
		$emcabezado = $_POST['emcabezado'];
		$torneo = $_POST['torneo'];
		$texto = $_POST['texto'];
		$fecha = $_POST['fecha'];
			$url = $_POST['url'];

		if (boolean_new_noticia($titulo,$emcabezado,$texto,$fecha,$torneo,$url)) {
			$resultado.='"mensaje":true';
		} else {
			$resultado.='"mensaje":false';
		}
	}
	// Permite modificar un modulo.
	else if($bandera === "modificar") {
		$titulo = $_POST['titulo'];
		$emcabezado = $_POST['emcabezado'];
		$torneo = $_POST['torneo'];
		$texto = $_POST['texto'];
		$fecha = $_POST['fecha'];
				$url = $_POST['url'];
		$noticia = $_POST['noticia'];

		
		if (boolean_set_noticia($titulo,$emcabezado,$texto,$fecha,$torneo,$noticia,$url)) {
			$resultado.='"mensaje":true';
		} else {
			$resultado.='"mensaje":false';
		}
	}else if($bandera === "eliminar") {
		$noticia = $_POST['noticia'];
		if (boolean_delete_noticia($noticia)) {
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