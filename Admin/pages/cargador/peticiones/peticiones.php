<?php
session_start();
include('../../../php/consultas.php');
include('../../../php/cargador.php');

if(isset($_SESSION['id_usuarios']))
{
	$resultado = '{"salida":true,';
	$bandera = $_POST['bandera'];

// Modifica un club.
	if ($bandera === "subir-archivos") {
	}
    // Guarda los datos de un nuevo cancha.
	else if($bandera === "eliminar") {

		$archivo = $_POST['archivo'];
		if (boolean_delete_file($archivo)) {
			$resultado.='"mensaje":true';
		} else {
			$resultado.='"mensaje":false';
		}
	} else if($bandera === "nuevo") {

		$carpeta = $_POST['carpeta'];
		if (new_Folder($carpeta)) {
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