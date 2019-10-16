<?php
/**
 * [Array_Get_Clubs Retorna el grupo de torneos]
 */
function Array_Get_Clubs()
{

	$clubs = consultar("SELECT `id_colegio`, `nombre`, `direccion`, `telefono`, `correo`, `presidente`, `cancha_entrenamiento`, `horario`, `logo`, `estado` FROM `tb_colegio`  order by nombre asc  ");	


	$datos = array();
	while ($valor = mysqli_fetch_array($clubs)) {
		$id_colegio = $valor['id_colegio'];
		$nombre = $valor['nombre'];
		$direccion = $valor['direccion'];
		$telefono = $valor['telefono'];
		$correo = $valor['correo'];
		$presidente = $valor['presidente'];
		$cancha_entrenamiento = $valor['cancha_entrenamiento'];
		$horario = $valor['horario'];
		$logo = $valor['logo'];
		$estado = $valor['estado'];


		$vector = array(
			'id_colegio'=>"$id_colegio",
			'nombre'=>"$nombre",
			'direccion'=>"$direccion",
			'telefono'=>"$telefono",
			'correo'=>"$correo",
			'presidente'=>"$presidente",
			'cancha_entrenamiento'=>"$cancha_entrenamiento",
			'horario'=>"$horario",
			'logo'=>"$logo",
			'estado'=>"$estado"

			);
		array_push($datos, $vector);
	}

	return $datos;	
}
/**
 * [Set_Clubs description]
 * @param [type] $nombre    [description]
 * @param [type] $categoria [description]
 * @param [type] $estado    [description]
 * @param [type] $torneo    [description]
 */
function Set_Clubs($nombre,$telefono,$direccion,$presidente,$horario,$cancha,$correo,$estado,$club)
{

	$campeonatos = modificar(sprintf("UPDATE `tb_colegio` SET `nombre`='%s',`direccion`='%s',`telefono`='%s',`correo`='%s',`presidente`='%s',`cancha_entrenamiento`='%s',`horario`='%s',`estado`='%s' WHERE id_colegio='%d' ",
		escape($nombre),escape($direccion),escape($telefono),escape($correo),escape($presidente),
		escape($cancha),escape($horario),escape($estado),escape($club)));
	return $campeonatos;	
}

/**
 * [boolean_set_imagene_clubs description]
 * @param  [type] $reglamento [description]
 * @param  [type] $torneo     [description]
 * @return [type]             [description]
 */
function boolean_set_imagen_clubs($imagen,$club)
{

	$campeonatos = modificar(sprintf("UPDATE `tb_colegio` SET `logo`='%s' WHERE  `id_colegio`='%d' ",
		escape($imagen),escape($club)));
	return $campeonatos;	
}
/**
 * [boolean_new_Club description]
 * @param  [type] $nombre    [description]
 * @param  [type] $categoria [description]
 * @return [type]            [description]
 */
function boolean_new_Club($nombre,$telefono,$direccion,$presidente,$horario,$cancha,$correo,$estado,$url)
{
	$campeonatos = insertar(sprintf("INSERT INTO `tb_colegio`(`id_colegio`, `nombre`, `direccion`, `telefono`, `correo`, `presidente`, `cancha_entrenamiento`, `horario`, `logo`, `estado`) 
		VALUES (NULL,'%s','%s','%s','%s','%s','%s','%s','%s','%s')",
		escape($nombre),escape($direccion),escape($telefono),escape($correo),escape($presidente),
		escape($cancha),escape($horario),escape($url),escape($estado)));
	return $campeonatos;	

}
/**
 * [Get_nombre_club description]
 * @param [type] $identificador [id]
 */
function Get_nombre_club($identificador)
{
    $valor = mysqli_fetch_array(consultar("SELECT nombre 
      FROM tb_colegio WHERE id_colegio=$identificador"));
    $valor = $valor['nombre'];
    
    return $valor;
}