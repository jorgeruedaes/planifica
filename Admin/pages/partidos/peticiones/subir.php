<?php
session_start();
include('../../../php/consultas.php');
include('../../../php/cargador.php');

if(isset($_SESSION['id_usuarios']))
{

	$resultado = '{"salida":true,';

	$carpeta = $_GET['carpeta'];
	$torneo = $_POST['torneo'];
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
		if($bandera=="subircalendario")
		{
			if(move_uploaded_file($temp,'../../../../Archivos/'.$carpeta.'/'.$name))
			{
				list($boolean,$resultados) = Cargar_Partidos('../../../../Archivos/'.$carpeta.'/'.$name,$torneo);
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
		else if($bandera=="subirresultados")
		{
				if(move_uploaded_file($temp,'../../../../Archivos/'.$carpeta.'/'.$name))
			{
				list($boolean,$resultados) = Cargar_Resultados('../../../../Archivos/'.$carpeta.'/'.$name,$torneo);
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