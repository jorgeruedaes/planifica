<?php

header("Content-Type: text/html;charset=utf-8");
/**
 * [Read_Folders_Folder description]
 * @param [type] $directorio [description]
 */
function Read_Folders_Folder($directorio)
{
	$vector = array();
	$ruta = opendir($directorio);
	$cantidad =0;

	while (($archivo = readdir($ruta)) != false) {
		if (!is_dir($archivo) and $archivo !="." and $archivo !=".."){

			$informacion= array(
				'archivo' => "$archivo"
				);
			array_push($vector,$informacion);
		}
	}
	return $vector;
}
/**
 * [new_Folder description]
 * @param  [type] $carpeta [description]
 * @return [type]          [description]
 */
function new_Folder($carpeta)
{
	$carpeta = $_SERVER['DOCUMENT_ROOT'].'/Archivos/'.$carpeta;
	if (!file_exists($carpeta)) {
		return mkdir($carpeta, 0777, true);
	}
}

/**
 * [Read_Files_Folder description]
 * @param [type] $directorio [description]
 * @param [type] $carpeta    [description]
 */
function Read_Files_Folder($directorio,$carpeta)
{
	$vector = array();
	$ruta = opendir($directorio);
	$cantidad =0;

	while ($archivo = readdir($ruta)) {
		if (!is_dir($archivo)){
			$cantidad = $cantidad +1;

			$url = base_url_usuarios().'Archivos/'.$carpeta.'/'.$archivo;
			$ex = explode(".",$archivo);
			$extension = $ex[1];
			$nombre = $ex[0];
			$archivo = $_SERVER['DOCUMENT_ROOT'].'/Archivos/'.$carpeta.'/'.$archivo;

			$informacion= array(
				'FileName' => "$nombre",
				'Extension' => "$extension",
				'Url' => "$url",
				'Archivo' => "$archivo",
				);

			array_push($vector,$informacion);
		}
	}
	return $vector;
}
/**
 * [Get_Icon description]
 * @param [type] $tipo [description]
 */
function Get_Icon($tipo)
{
	if($tipo=="png" or $tipo=="jpg" or $tipo=="jpge" or $tipo=="bmp" or $tipo=="png" )
	{
		return array("image","green");
	}
	else if($tipo=="pdf" or $tipo=="PDF" )
	{
		return array("picture_as_pdf","red");
	}else
	{
		return	array("dvr","blue");
	}
}
/**
 * [boolean_delete_file description]
 * @param  [type] $FileName [description]
 * @return [type]           [description]
 */
function boolean_delete_file($FileName)
{
	return unlink($FileName);

}

/**
 * [Cargar_Partidos description]
 * @param [type] $FileName [description]
 * @param [type] $torneo   [description]
 */
function Cargar_Partidos($FileName,$torneo)
{
	$boolean = false;
	$resultado ='';

	list($boolean,$resultado) =Validate_All_Partidos($FileName,$torneo);
	if($boolean)
	{
		list($boolean,$resultado) =  Load_Partidos($FileName,$torneo);
	}
	else
	{

	}

	return array($boolean,$resultado);

}

function Cargar_Resultados($FileName,$torneo)
{
	$boolean = false;
	$resultado ='';

	list($boolean,$resultado) =Validate_All_Partidos_Resultados($FileName,$torneo);
	if($boolean)
	{
		list($boolean,$resultado) =  Set_Partidos($FileName,$torneo);
	}
	else
	{

	}

	return array($boolean,$resultado);

}
/**
 * [Insertar_Partido description]
 * @param [type] $NombreEquipo1 [description]
 * @param [type] $Fecha         [description]
 * @param [type] $NombreEquipo2 [description]
 * @param [type] $Lugar         [description]
 * @param [type] $Numero_Fecha  [description]
 * @param [type] $Hora          [description]
 * @param [type] $torneo        [description]
 */
function Insertar_Partido($NombreEquipo1,$Fecha,$NombreEquipo2,$Lugar,$Numero_Fecha,$Hora,$torneo)
{
	global $conexion;

	$equipo1 = Codigo_Equipo($NombreEquipo1,$torneo)[1];
	$equipo2 = Codigo_Equipo($NombreEquipo2,$torneo)[1];
	$lugar = Codigo_Lugar($Lugar)[1];
	$Fecha = date('Y-m-d', strtotime($Fecha));
	$Hora = date('H:i', strtotime($Hora));



	return insertar("INSERT INTO `tb_partidos`(`id_partido`, `equipo1`, `equipo2`, `resultado1`, `resultado2`, `fecha`, `hora`, `numero_fecha`, `Lugar`, `Estado`) VALUES (NULL,$equipo1,$equipo2,0,0,'$Fecha','$Hora',$Numero_Fecha,$lugar,1)");
}
/**
 * [Codigo_Equipo description]
 * @param [type] $NombreEquipo [description]
 * @param [type] $torneo       [description]
 */
function Codigo_Equipo($NombreEquipo,$torneo)
{
	$NombreEquipo =  utf8_encode($NombreEquipo);
	$NombreEquipo =  str_replace(' ','',$NombreEquipo); 
	$valor = mysqli_fetch_array(consultar("SELECT id_equipo FROM tb_equipos WHERE ( REPLACE(nombre_equipo,' ','')='$NombreEquipo' or REPLACE(nombre_equipo,' ','') like '%$NombreEquipo%') and torneo='$torneo' and estado='activo' "));

	return array(!empty($valor),$valor['id_equipo']);
}

function Codigo_Torneo($torneo)
{
	$torneo = utf8_encode($torneo);
	$valor = mysqli_fetch_array(consultar("SELECT id_torneo FROM `tb_torneo` WHERE (`nombre_torneo`='$torneo' or `nombre_torneo`like '%$torneo%') and estado='activo' "));

	return array(!empty($valor),$valor['id_torneo']);
}
function ValidarTorneo($torneo)
{
	$resultado ="";
	$valor =false;

	if(Codigo_Torneo($torneo)[0])
	{
		$resultado ="";
		$valor =true;
	}
	else
	{
		$resultado= "El torneo no es valido : ".$torneo." ".", Intenta nuevamente";
		$valor =false;

	}

	return array($valor,$resultado);
}

function Codigo_Club($club)
{
	$club = utf8_encode($club);
	$valor = mysqli_fetch_array(consultar("SELECT `id_colegio` FROM `tb_colegio` WHERE (`nombre`='$club' or `nombre` like '%$club%' ) and  `estado` ='activo' "));

	return array(!empty($valor),$valor['id_colegio']);
}
function ValidarClub($club)
{
	$resultado ="";
	$valor =false;

	if(Codigo_Club($club)[0])
	{
		$resultado ="";
		$valor =true;
	}
	else
	{
		$resultado= "El club no  valido : ".$club." ".", Intenta nuevamente";
		$valor =false;

	}

	return array($valor,$resultado);
}
/**
 * [Codigo_Lugar description]
 * @param [type] $NombreLugar [description]
 */
function Codigo_Lugar($NombreLugar)
{
	global $conexion;

	$valor = mysqli_fetch_array(consultar("SELECT id_lugar FROM tb_lugares WHERE nombre='$NombreLugar'  "));

	return array(empty($valor),$valor['id_lugar']);
}
/**
 * [ValidarEquipos description]
 * @param [type] $NombreEquipo [description]
 * @param [type] $torneo       [description]
 */
function ValidarEquipos($NombreEquipo,$torneo)
{
	$resultado ="";
	$valor =false;

	if(Codigo_Equipo($NombreEquipo,$torneo)[0])
	{
		$resultado ="";
		$valor =true;
	}
	else
	{
		$resultado= "Uno de los nombres  de equipo  no es valido : ".$NombreEquipo." ".", Intenta nuevamente";
		$valor =false;

	}

	return array($valor,$resultado);
}
/**
 * [Validar_Lugar description]
 * @param [type] $Lugar [description]
 */
function Validar_Lugar($Lugar)
{
	$resultado ="";
	$valor =false;

	if(!Codigo_Lugar($Lugar)[0])
	{
		$resultado ="";
		$valor =true;
	}
	else
	{
		$resultado= "El lugar no es valido : ".$Lugar." ".", Intenta nuevamente";
		$valor =false;

	}

	return array($valor,$resultado);
}
/**
 * [check_date description]
 * @param  [type] $str [description]
 * @return [type]      [description]
 */
function check_date($str){ 

	try {
		trim($str);
		$trozos = explode ("-", $str);
		$dia=$trozos[2];

		$mes=$trozos[1];

		$año=$trozos[0];


		if(checkdate ($mes,$dia,$año)){
			return true;
		}
		else{
			return false;
		}
		throw new Exception('La fecha no es valida.');

	} catch (Exception $e) {
		return false;
	}


}

/**
 * [Validar_Fecha description]
 * @param [type] $fecha [description]
 */
function Validar_Fecha($fecha)
{
	$resultado ="";
	$valor =false;


	if(check_date($fecha))
	{
		$resultado ="";
		$valor =true;
	}
	else
	{
		$resultado= "La fecha no es valida : ".$fecha." ".", Intenta nuevamente";
		$valor =false;

	}

	return array($valor,$resultado);
}
/**
 * [validateTime description]
 * @param  [type] $time [description]
 * @return [type]       [description]
 */
function validateTime($time)
{
	$pattern="/^([0-1][0-9]|[2][0-3])[\:]([0-5][0-9])$/";
	if(preg_match($pattern,$time))
		return true;
	return false;
}
/**
 * [Validar_Hora description]
 * @param [type] $Hora [description]
 */
function Validar_Hora($Hora)
{
	$resultado = "";
	$valor =false;

	if(validateTime($Hora))
	{
		$resultado = "";
		$valor =true;
	}
	else
	{
		$resultado= "La hora no es valida : ".$Hora." ".", Intenta nuevamente";
		$valor =false;

	}

	return array($valor,$resultado);
}
/**
 * [Validar_Numero_DatosFila Valida la cantidad de datos en las filas.]
 * @param [type] $datos    [description]
 * @param [type] $cantidad [description]
 */
function Validar_Numero_DatosFila($datos,$cantidad)
{
	$resultado = "";
	$valor =false;

	if(count($datos)==$cantidad)
	{
		$resultado = "";
		$valor =true;
	}
	else
	{
		$resultado= " Debe tener exactamente ".$cantidad." columnas , Intenta nuevamente";
		$valor =false;
	}

	return array($valor,$resultado);
}
/**
 * [Load_Partidos Carga los partidos al calendario]
 * @param [type] $FileName [description]
 * @param [type] $torneo   [description]
 */
function Load_Partidos($FileName,$torneo)
{
	$bandera = true;
	if (($gestor = fopen($FileName, "r")) !== FALSE) {
		while (($datos = fgetcsv($gestor,200, ",")) !== FALSE) {

			$Lugar= $datos[0];
			$Fecha= $datos[1];
			$Hora= $datos[2];
			$NombreEquipo1= $datos[3];
			$NombreEquipo2= $datos[5];
			$Numero_Fecha= $datos[6];

			if(Insertar_Partido($NombreEquipo1,$Fecha,$NombreEquipo2,$Lugar,$Numero_Fecha,$Hora,$torneo))
			{
				$mensaje = 'true';
			}
			else
			{
				$bandera=false;
				$mensaje = $NombreEquipo1.$Fecha.$NombreEquipo2.$Lugar.$Numero_Fecha.$Hora.$torneo;
			}
		}
		fclose($gestor);
	}
	return array($bandera,$mensaje);
}
/**
 * [Validate_All_Partidos Valida lque los datos a cargar del archivo.]
 * @param [type] $FileName [El archivo]
 * @param [type] $torneo   [Torneo]
 */
function Validate_All_Partidos($FileName,$torneo)
{
	$resultado = '';
	$boolean = true;
	$numero =1;
	if (($gestor = fopen($FileName, "r")) !== FALSE) {
		while (($datos = fgetcsv($gestor,200, ",")) !== FALSE) {

			list($valorbolean,$resultado2) = Validar_Numero_DatosFila($datos,'7');
			if($valorbolean)
			{
				$Lugar= $datos[0];
				$Fecha= $datos[1];
				$Hora= $datos[2];
				$NombreEquipo1= $datos[3];
				$NombreEquipo2= $datos[5];
				$Numero_Fecha= $datos[6];

				list($valor,$resultado1) = Validate_A_Partidos($NombreEquipo1,$Fecha,$NombreEquipo2,$Lugar,$Numero_Fecha,$Hora,$torneo);
				if($valor)
				{

				}
				else
				{
					$boolean = false;
					$resultado =$resultado.'<h3>En el partido '.$numero.'</h3> <br>'.$resultado1;
				}
			}
			else
			{
				$boolean = false;
				$resultado =$resultado.'<br><h3>En el partido '.$numero.'</h3> <br>'.$resultado2;
			}

			$numero=$numero+1;
		}
		fclose($gestor);
	}
	return array($boolean,$resultado);
}
/**
 * [Validar_Existencia Valida la existeencia de un partido para la respetiva fecha.]
 * @param [type] $NombreEquipo1 [description]
 * @param [type] $NombreEquipo2 [description]
 * @param [type] $Numero_Fecha  [description]
 */
function Validar_Existencia($NombreEquipo1,$NombreEquipo2,$Numero_Fecha)
{
	global $conexion;
	$query = "SELECT * FROM `tb_partidos` WHERE equipo1='$NombreEquipo1'
	and equipo2='$NombreEquipo2' and numero_fecha='$Numero_Fecha'  ";
	$valor = consultar($query);
	return mysqli_num_rows($valor)>0;
}
function Validar_Existencia_Equipo($nombre,$torneo,$club)
{
	$query = " SELECT * FROM tb_equipos where torneo='$torneo' and colegio='$club' and nombre_equipo='$nombre'  ";
	$valor = consultar($query);
	return mysqli_num_rows($valor)>0;
}

function Validar_Existencia_Terminado($NombreEquipo1,$NombreEquipo2,$Numero_Fecha)
{
	global $conexion;
	$query = "SELECT * FROM `tb_partidos` WHERE equipo1='$NombreEquipo1'
	and equipo2='$NombreEquipo2' and numero_fecha='$Numero_Fecha' and estado='2' ";
	$valor = consultar($query);
	return mysqli_num_rows($valor)>0;
}
/**
 * [Validate_A_Partidos Valida que un partido sea valido para la inserción.]
 * @param [type] $NombreEquipo1 [description]
 * @param [type] $Fecha         [description]
 * @param [type] $NombreEquipo2 [description]
 * @param [type] $Lugar         [description]
 * @param [type] $Numero_Fecha  [description]
 * @param [type] $Hora          [description]
 * @param [type] $torneo        [description]
 */
function Validate_A_Partidos($NombreEquipo1,$Fecha,$NombreEquipo2,$Lugar,$Numero_Fecha,$Hora,$torneo)
{
	$resultado="";
	$valor = true;
	if(is_numeric($Numero_Fecha))
	{

	}
	else
	{
		$resultado.='El numero de la fecha ( Ronda ) no es valido. <br>';
		$valor=false;
	}

	if($NombreEquipo1!=$NombreEquipo2)
	{

	}
	else
	{
		$resultado.='No se puede enfrentar un equipo consigo mismo. <br>';
		$valor=false;
	}

	if(ValidarEquipos($NombreEquipo1,$torneo)[0])
	{

	}
	else
	{
		$resultado.=ValidarEquipos($NombreEquipo1,$torneo)[1].'<br>';
		$valor=false;
	}
	if(ValidarEquipos($NombreEquipo2,$torneo)[0])
	{

	}
	else
	{
		$resultado.=ValidarEquipos($NombreEquipo2,$torneo)[1].'<br>';
		$valor=false;
	}
	if(Validar_Lugar($Lugar)[0])
	{

	}
	else
	{
		$resultado.=Validar_Lugar($Lugar)[1].'<br>';
		$valor=false;
	}
	if(Validar_Fecha($Fecha)[0])
	{
		
	}
	else
	{
		$resultado.=Validar_Fecha($Fecha)[1].'<br>';
		$valor=false;
	}
	if(Validar_Hora($Hora)[0])
	{
		
	}
	else
	{
		$resultado.=Validar_Hora($Hora)[1].'<br>';
		$valor=false;
	}

	if(Validar_Existencia(Codigo_Equipo($NombreEquipo1,$torneo)[1],Codigo_Equipo($NombreEquipo2,$torneo)[1],$Numero_Fecha))
	{
		$resultado.='Ya Existe!. <br>';
		$valor=false;
	}
	
	else
	{
	}


	return array($valor,$resultado);

}


function Validate_A_Partidos_Resultados($NombreEquipo1,$NombreEquipo2,$torneo,$marcador1,$marcador2,$Numero_Fecha)
{
	$resultado="";
	$valor = true;
	if($marcador2>=0)
	{

	}
	else
	{
		$resultado.='El marcador numero 2 no es valido. <br>';
		$valor=false;

	}
	if($marcador1>=0)
	{

	}
	else
	{
		$resultado.='El marcador numero 1 no es valido. <br>';
		$valor=false;

	}

	if($NombreEquipo1!=$NombreEquipo2)
	{

	}
	else
	{
		$resultado.='No se puede enfrentar un equipo consigo mismo. <br>';
		$valor=false;
	}

	if(ValidarEquipos($NombreEquipo1,$torneo)[0])
	{

	}
	else
	{
		$resultado.=ValidarEquipos($NombreEquipo1,$torneo)[1].'<br>';
		$valor=false;
	}
	if(ValidarEquipos($NombreEquipo2,$torneo)[0])
	{

	}
	else
	{
		$resultado.=ValidarEquipos($NombreEquipo2,$torneo)[1].'<br>';
		$valor=false;
	}


	if(Validar_Existencia(Codigo_Equipo($NombreEquipo1,$torneo)[1],Codigo_Equipo($NombreEquipo2,$torneo)[1],$Numero_Fecha))
	{


	}
	
	else
	{
		$resultado.=' No Existe!. <br>';	
		$valor=false;
	}
	
	if(Validar_Existencia_Terminado(Codigo_Equipo($NombreEquipo1,$torneo)[1],Codigo_Equipo($NombreEquipo2,$torneo)[1],$Numero_Fecha))
	{
		$resultado.='Ya tiene resultados!. <br>';	
		$valor=false;

	}
	
	else
	{
		
	}


	return array($valor,$resultado);

}

function Validate_All_Partidos_Resultados($FileName,$torneo)
{
	$resultado = '';
	$boolean = true;
	$numero =1;
	if (($gestor = fopen($FileName, "r")) !== FALSE) {
		while (($datos = fgetcsv($gestor,200, ",")) !== FALSE) {

			list($valorbolean,$resultado2) = Validar_Numero_DatosFila($datos,'5');
			if($valorbolean)
			{

				$NombreEquipo1= $datos[0];
				$marcador1= $datos[1];
				$NombreEquipo2= $datos[2];
				$marcador2= $datos[3];
				$Numero_Fecha =$datos[4];

				list($valor,$resultado1) = Validate_A_Partidos_Resultados($NombreEquipo1,$NombreEquipo2,$torneo,$marcador1,$marcador2,$Numero_Fecha);
				if($valor)
				{

				}
				else
				{
					$boolean = false;
					$resultado =$resultado.'<h3>En el partido '.$numero.'</h3> <br>'.$resultado1;
				}
			}
			else
			{
				$boolean = false;
				$resultado =$resultado.'<br><h3>En el partido '.$numero.'</h3> <br>'.$resultado2;
			}

			$numero=$numero+1;
		}
		fclose($gestor);
	}
	return array($boolean,$resultado);
}


function Set_Partidos($FileName,$torneo)
{
	$bandera = true;
	if (($gestor = fopen($FileName, "r")) !== FALSE) {
		while (($datos = fgetcsv($gestor,200, ",")) !== FALSE) {

			$NombreEquipo1= $datos[0];
			$marcador1= $datos[1];
			$NombreEquipo2= $datos[2];
			$marcador2= $datos[3];
			$Numero_Fecha =$datos[4];

			if(Set_Partido($NombreEquipo1,$NombreEquipo2,$marcador1,$marcador2,$Numero_Fecha,$torneo))
			{
				$mensaje = 'true';
			}
			else
			{
				$bandera=false;
				$mensaje = $NombreEquipo1;
			}
		}
		fclose($gestor);
	}
	return array($bandera,$mensaje);
}

function Set_Partido($NombreEquipo1,$NombreEquipo2,$marcador1,$marcador2,$Numero_Fecha,$torneo)
{

	$partido = Int_Get_Id_Partido($NombreEquipo1,$NombreEquipo2,$Numero_Fecha,$torneo);


	$valor  = modificar(sprintf("UPDATE `tb_partidos` SET `resultado1`='%d',`resultado2`='%d',`estado`='2'
		WHERE `id_partido`='%d' ",escape($marcador1),escape($marcador2),escape($partido)));
	return $valor;

}

function Int_Get_Id_Partido($NombreEquipo1,$NombreEquipo2,$Numero_Fecha,$torneo)
{
	$equipo1 = Codigo_Equipo($NombreEquipo1,$torneo)[1];
	$equipo2 = Codigo_Equipo($NombreEquipo2,$torneo)[1];


	$query = "SELECT id_partido as id FROM `tb_partidos` WHERE equipo1='$equipo1'
	and equipo2='$equipo2' and numero_fecha='$Numero_Fecha'  and estado='1' ";
	$valor =  mysqli_fetch_array(consultar($query));
	return $valor['id'];
}

function Cargar_Jugadores($FileName,$torneo)
{
	$boolean = false;
	$resultado ='';

	list($boolean,$resultado) =Validate_All_Jugadores($FileName,$torneo);
	if($boolean)
	{
		list($boolean,$resultado) =  Load_Jugadores($FileName,$torneo);
	}
	else
	{

	}

	return array($boolean,$resultado);

}
function Validate_All_Jugadores($FileName,$torneo)
{
	$resultado = '';
	$boolean = true;
	$numero =1;
	if (($gestor = fopen($FileName, "r")) !== FALSE) {
		while (($datos = fgetcsv($gestor,300, ",")) !== FALSE) {

			list($valorbolean,$resultado2) = Validar_Numero_DatosFila($datos,'7');
			if($valorbolean)
			{

				$Documento= $datos[0];
				$Fecha_nacimiento= $datos[1];
				$Nombre1= $datos[2];
				$Nombre2= $datos[3];
				$Apellido1 =$datos[4];
				$Apellido2 =$datos[5];
				$Equipo =$datos[6];
				list($valor,$resultado1) = Validate_A_Jugadores($Documento,$Fecha_nacimiento,$Nombre1,$Nombre2,$Apellido1,$Apellido2,$Equipo,$torneo);
				if($valor)
				{

				}
				else
				{
					$boolean = false;
					$resultado =$resultado.'<h3>En el Jugador '.$numero.'</h3> <br>'.$resultado1;
				}
			}
			else
			{
				$boolean = false;
				$resultado =$resultado.'<br><h3>En el Jugador '.$numero.'</h3> <br>'.$resultado2;
			}

			$numero=$numero+1;
		}
		fclose($gestor);
	}
	return array($boolean,$resultado);
}

function Validar_Existencia_Jugador($Documento,$Fecha,$Nombre1,$Nombre2,$Apellido1,$Apellido2,$equipo,$torneo)
{

	$Nombre1= utf8_encode($Nombre1);
	$Nombre2= utf8_encode($Nombre2);
	$Apellido1= utf8_encode($Apellido1);
	$Apellido2= utf8_encode($Apellido2);

	$query = "SELECT * FROM `tb_jugadores` WHERE `documento`='$Documento' and `nombre1`='$Nombre1' and `nombre2`='$Nombre2' and `apellido1`='$Apellido1' and `apellido2`='$Apellido2' and `fecha_nacimiento`='$Fecha' and equipo='$equipo'  ";
	$valor = consultar($query);
	return mysqli_num_rows($valor)>0;
}
function Validate_A_Jugadores($Documento,$Fecha,$Nombre1,$Nombre2,$Apellido1,$Apellido2,$NombreEquipo1,$torneo)
{
	$resultado="";
	$valor = true;

	if($Nombre1!="")
	{

	}
	else
	{
		$resultado.='El primer nombre esta vacio. <br>';
		$valor=false;	
	}
	if($Apellido1!="")
	{

	}
	else
	{
		$resultado.='El primer apellido esta vacio. <br>';
		$valor=false;	
	}

	if(ValidarEquipos($NombreEquipo1,$torneo)[0])
	{

	}
	else
	{
		$resultado.=ValidarEquipos($NombreEquipo1,$torneo)[1].'<br>';
		$valor=false;
	}
	if(Validar_Fecha($Fecha)[0])
	{
		
	}
	else
	{
		$resultado.=Validar_Fecha($Fecha)[1].'<br>';
		$valor=false;
	}
	if(Validar_Existencia_Jugador($Documento,$Fecha,$Nombre1,$Nombre2,$Apellido1,$Apellido2,
		Codigo_Equipo($NombreEquipo1,$torneo)[1],$torneo))
	{
		$resultado.='Ya Existe!. <br>';
		$valor=false;
	}
	
	else
	{
	}


	return array($valor,$resultado);

}


function Load_Jugadores($FileName,$torneo)
{
	$bandera = true;
	if (($gestor = fopen($FileName, "r")) !== FALSE) {
		while (($datos = fgetcsv($gestor,300, ",")) !== FALSE) {

			$Documento= $datos[0];
			$Fecha_nacimiento= $datos[1];
			$Nombre1= $datos[2];
			$Nombre2= $datos[3];
			$Apellido1 =$datos[4];
			$Apellido2 =$datos[5];
			$Equipo =$datos[6];


			if(boolean_new_jugador($Documento,$Equipo,$Nombre1,$Nombre2,$Apellido1,$Apellido2,$Fecha_nacimiento,'1',$torneo))
			{
				$mensaje = 'true';
			}
			else
			{
				$bandera=false;
				$mensaje = $Documento;
			}
		}
		fclose($gestor);
	}
	return array($bandera,$mensaje);
}
/**
 * [boolean_new_jugador description]
 * @param  [type] $documento [description]
 * @param  [type] $equipo    [description]
 * @param  [type] $nombre1   [description]
 * @param  [type] $nombre2   [description]
 * @param  [type] $apellido1 [description]
 * @param  [type] $apellido2 [description]
 * @param  [type] $fecha     [description]
 * @param  [type] $estado    [description]
 * @return [type]            [description]
 */
function boolean_new_jugador($documento,$NombreEquipo1,$nombre1,$nombre2,$apellido1,$apellido2,$fecha,$estado,$torneo)
{

	$equipo = Codigo_Equipo($NombreEquipo1,$torneo)[1];

	$partido = insertar(sprintf("INSERT INTO `tb_jugadores`(`id_jugadores`, `documento`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, 
		`fecha_nacimiento`, `email`, `equipo`, `foto_jugador`, `fecha_ingreso`, `estado_jugador`, `telefono`, `profesion`, `tipo_jugador`)
		VALUES (NULL,'%d','%s','%s','%s','%s','%s','','%d','',NOW(),'%d','','','')"
		,escape($documento),escape(strtoupper($nombre1)),escape(strtoupper($nombre2)),escape(strtoupper($apellido1)),escape(strtoupper($apellido2)),escape($fecha),escape($equipo),escape($estado)));
	return $partido;    
}

function Cargar_Equipos($FileName)
{
	$boolean = false;
	$resultado ='';

	list($boolean,$resultado) =Validate_All_Equipos($FileName);
	if($boolean)
	{
		list($boolean,$resultado) =  Load_Equipos($FileName);
	}
	else
	{

	}

	return array($boolean,$resultado);

}

function Load_Equipos($FileName)
{
	$bandera = true;
	if (($gestor = fopen($FileName, "r")) !== FALSE) {
		while (($datos = fgetcsv($gestor,200, ",")) !== FALSE) {

			$nombre = $datos[1];
			$tecnico ='';
			$grupo = $datos[3];
			$torneo = Codigo_Torneo($datos[2])[1];
			$club = Codigo_Club($datos[0])[1];
			$estado ='activo';


			if(boolean_new_equipo($nombre,$tecnico,$grupo,$torneo,$club,$estado))
			{
				$mensaje = 'true';
			}
			else
			{
				$bandera=false;
				$mensaje = $Documento;
			}
		}
		fclose($gestor);
	}
	return array($bandera,$mensaje);
}

function boolean_new_equipo($nombre,$tecnico,$grupo,$torneo,$club,$estado)
{
	$campeonatos = insertar(sprintf("INSERT INTO `tb_equipos`(`id_equipo`, `nombre_equipo`, `tecnico1`, `torneo`, `grupo`, `colegio`, `estado`)
		VALUES (NULL,'%s','%s','%d','%s','%d','%s')",
		escape($nombre),escape($tecnico),escape($torneo),escape($grupo),escape($club),
		escape($estado)));
	return $campeonatos;  

}

function Validate_All_Equipos($FileName)
{
	$resultado = '';
	$boolean = true;
	$numero =1;
	if (($gestor = fopen($FileName, "r")) !== FALSE) {
		while (($datos = fgetcsv($gestor,200, ",")) !== FALSE) {

			list($valorbolean,$resultado2) = Validar_Numero_DatosFila($datos,'4');
			if($valorbolean)
			{

				$nombre = $datos[1];
				$grupo = $datos[3];
				$torneo = $datos[2];
				$club = $datos[0];

				list($valor,$resultado1) = Validate_A_Equipos($nombre,$grupo,$torneo,$club);
				if($valor)
				{

				}
				else
				{
					$boolean = false;
					$resultado =$resultado.'<h3>En el Equipo '.$numero.'</h3> <br>'.$resultado1;
				}
			}
			else
			{
				$boolean = false;
				$resultado =$resultado.'<br><h3>En el Equipo '.$numero.'</h3> <br>'.$resultado2;
			}

			$numero=$numero+1;
		}
		fclose($gestor);
	}
	return array($boolean,$resultado);
}

function Validate_A_Equipos($nombre,$grupo,$torneo,$club)
{
	$resultado="";
	$valor = true;

	if($nombre!="")
	{

	}
	else
	{
		$resultado.='El  nombre esta vacio. <br>';
		$valor=false;	
	}
	if($grupo!="")
	{

	}
	else
	{
		$resultado.='El grupo esta vacio. <br>';
		$valor=false;	
	}
	if($torneo!="")
	{

	}
	else
	{
		$resultado.='La categoria o torneo  esta vacio. <br>';
		$valor=false;	
	}
	if($club!="")
	{

	}
	else
	{
		$resultado.='La club  esta vacio. <br>';
		$valor=false;	
	}

	if(ValidarTorneo($torneo)[0])
	{

	}
	else
	{
		$resultado.=ValidarTorneo($torneo)[1].'<br>';
		$valor=false;

	}
	if(ValidarClub($club)[0])
	{

	}
	else
	{
		$resultado.=ValidarClub($club)[1].'<br>';
		$valor=false;

	}

	if(ValidarClub($club)[0])
	{
		if(ValidarTorneo($club)[0])
		{

			if(Validar_Existencia_Equipo($nombre,Codigo_Torneo($torneo),Codigo_Club($club)))
			{
				$resultado.='Ya Existe!. <br>';
				$valor=false;
			}

			else
			{

			}

		}
		else
		{

		}
	}
	else
	{

	}


	return array($valor,$resultado);

}
