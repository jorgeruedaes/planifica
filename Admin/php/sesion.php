<?php 
/**
 * [List_New_Sesion Inicia el registro en el Log]
 * @param [Int] $id_usuarios [description]
 */
function Int_New_Sesion($id_usuarios)
{
	global $conexion;
	$query = mysqli_query($conexion,sprintf("INSERT INTO `tb_sesion`
		(`id_sesion`, `id_usuario`, `fecha_inicio`, `fecha_final`) 
		VALUES (NULL,'%d',NOW(),'')",escape($id_usuarios)));
	return mysqli_insert_id($conexion);	
}
/**
 * [Set_Sesion Modifica la sesion]
 * @param [Int] $id_sesion [description]
 * @param [String] $query     [description]
 * @param [String] $tipo [tipo de movimiento]
 */
	function Set_Sesion($id_sesion,$tipo,$valorquery)
{
	global $conexion;
	$query = mysqli_query($conexion,sprintf("UPDATE `tb_sesion` SET `fecha_final`=NOW()
		WHERE id_sesion='%d' ",escape($id_sesion)));
	if($query)
	{
	$query = mysqli_query($conexion,sprintf("INSERT INTO `tr_sesionxmovimientos`
		(`id_sesionxmovimiento`, `id_sesion`, `tipo`, `movimiento`) 
		VALUES (NULL,'%d','%s','%s')",escape($id_sesion),escape($tipo),escape($valorquery)));
	}

	return $query;	
}

?>