<?php

function SubirArchivos($archivos,$carpeta)
{
	$_FILES['file']=$archivos;
	$reporte = '';
	$bandera=true;

	for($x=0; $x<count($_FILES["file"]["name"]); $x++)
	{
		$file = $_FILES["file"];
		$nombre = $file["name"][$x];
		$tipo = $file["type"][$x];
		$ruta_provisional = $file["tmp_name"][$x];
		$size = $file["size"][$x];

		if ( $tipo !='application/pdf' && $tipo != 'image/jpeg' && 
			$tipo != 'image/jpg' && $tipo != 'image/png' && $tipo != 'image/gif')
		{
			$reporte .= "Error $nombre, el archivo no es del formato esperado.";
			$bandera=false;
		}
		else if($size > 1024*1024)
		{
			$reporte .= "Error $nombre, el tamaño máximo permitido es 1mb";
			$bandera=false;
		}
    // else if($width > 500 || $height > 500)
    // {
    //     $reporte .= "<p style='color: red'>Error $nombre, la anchura y la altura máxima permitida es de 500px</p>";
    // }
    // else if($width < 60 || $height < 60)
    // {
    //     $reporte .= "<p style='color: red'>Error $nombre, la anchura y la altura mínima permitida es de 60px</p>";
    // }
		else
		{
			$src = $carpeta.$nombre;
			move_uploaded_file($ruta_provisional, $src);
			$bandera=true;
		}
	}
	return array($bandera,$reporte);
}
?>


