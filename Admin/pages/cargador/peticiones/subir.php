<?php
session_start();
include('../../../php/consultas.php');
include('../../../php/cargador.php');

if(isset($_SESSION['id_usuarios']))
{
	$carpeta = $_GET['carpeta'];

	$archivo = $_FILES['file'];

	$temp = $archivo['tmp_name'];
	$name = $archivo['name'];

	if(!$temp)
	{
		echo "No se ha seleccionado ningun archivo.";
	}
	else
	{
		if(move_uploaded_file($temp,'../../../../Archivos/'.$carpeta.'/'.$name))
		{
			echo "Se ha guardado un archivo en el servidor";
		}
		else
		{
			echo "NO! se ha guardado un archivo en el servidor";
		}

		

	}


}




?>