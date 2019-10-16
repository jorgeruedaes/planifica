<?php
session_start();
include('../../../php/consultas.php');
include('../../../php/cargador.php');

if(isset($_SESSION['id_usuarios']))
{

	$resultado = '{"salida":true,';

	$carpeta = $_GET['carpeta'];
	$bandera= $_POST['bandera'];

	$archivo = $_FILES['file'];

	$temp = $archivo['tmp_name'];
	$name = $archivo['name'];
	//$torneo =$archivo['torneo'];

	if(!$temp)
	{
		$resultado.='"mensaje":false';
	}
	else
	{
		if($bandera=="subirequipos")
		{
			if(move_uploaded_file($temp,'../../../../Archivos/'.$carpeta.'/'.$name))
			{
				list($boolean,$resultados) = Cargar_Equipos('../../../../Archivos/'.$carpeta.'/'.$name);
				if($boolean)
				{
					$resultado.='"mensaje":true,';
					$resultado.='"datos":'.json_encode($resultados).'';
				}
				else
				{
					$resultado.='"mensaje":false,';
					$resultado.='"datos":'.json_encode($resultados).'';
				}
			}
			else
			{
				$resultado.='"mensaje":false';	
			}
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