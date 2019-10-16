<?php
/**
 * [Boolean_Set_Perfil Modifica un perfil de usuario]
 * @param [String] $perfil      [nombre del perfil]
 * @param [Int] $nivel       [nivel de seguridad]
 * @param [Int] $id_perfiles [identificador del perfil]
 */
function Boolean_Set_Perfil($nombre,$nivel,$id_perfiles)
{
	$query = modificar(sprintf("UPDATE `tb_perfiles` SET 
		nombre='%s',`nivel`='%d' WHERE id_perfiles='%d' ",escape($nombre),escape($nivel),escape($id_perfiles)));
	return $query;

}
/**
 * [Boolean_New_Perfil Crea un nuevo perfil]
 * @param [String] $nombre      [nombre del nuevo perfil]
 * @param [Int] $nivel       [nivel de seguridad]
 * @param [String] $descripcion [descripción del perfil]
 */
function Boolean_New_Perfil($nombre,$nivel,$descripcion)
{
	$query = insertar(sprintf("INSERT INTO `tb_perfiles`
		(`id_perfiles`, `nombre`, `descripcion`, `nivel`) 
		VALUES (NULL,'%s','%s','%d')",escape($nombre),escape($descripcion),escape($nivel)));
	return $query;

}
/**
 * [Boolean_Delete_Perfil Elimina un perfil de usuario]
 * @param [Int] $id_perfiles [id del perfil a eliminar]
 */
function  Boolean_Delete_Perfil($id_perfiles)
{	
	if(Boolean_Pass_Delete_Perfil($id_perfiles))
	{
		if(Boolean_Delete_ModulosxPerfil($id_perfiles)){
			$query = eliminar(sprintf("DELETE FROM `tb_perfiles` WHERE id_perfiles='%s' ",escape($id_perfiles)));
		}
		return $query;
		
	}
	else
	{
		return False;	
	}
	

}
/**
 * [Boolean_Set_PerfilxModulos description]
 * @param JSON $json [Con todos los permisos de un perfil por modulo.]
 * @param INT $id_perfiles [Lista con los modulos permitidos.]
 */
function Boolean_Set_PerfilxModulos($json,$id_perfiles)
{
	$json = json_decode($json);
	$bandera ='';
	if(Boolean_Delete_ModulosxPerfil($id_perfiles)){
		for ($i=0; $i < count($json) ; $i++) {
			if(Boolean_New_ModulosxPerfil($id_perfiles,$json[$i]))
			{
				$bandera=true;
			}	
			else
			{
				$bandera=false;
			}
		}
	}
	else
	{
		$bandera=false;
	}
	return $bandera;
}
/**
 * [Boolean_Pass_Delete_Perfil Prueba si puede borrar un perfil]
 * @param [Int] $id_perfiles [id del perfil a probar]
 */
function Boolean_Pass_Delete_Perfil($id_perfiles)
{
	$query = consultar(sprintf("SELECT nombre FROM tb_usuarios WHERE perfil='%d'" ,escape($id_perfiles)));	
	return (Int_consultaVacia($query)>0)?False:True;
}
/**
 * [Boolean_Delete_ModulosxPerfil Elimina los modulos autorizados por un perfil]
 * @param [Int] $id_perfiles [id del perfil]
 */
function Boolean_Delete_ModulosxPerfil($id_perfiles)
{
	$query = eliminar(sprintf("DELETE FROM `tr_modulosxperfiles` WHERE id_perfiles='%s'",escape($id_perfiles)));
	return $query;
}
/**
 * [Boolean_New_ModulosxPerfil Crear un nuevo permiso por perfil]
 * @param [Int] $id_perfiles [description]
 * @param [Int] $id_modulos  [description]
 */
function Boolean_New_ModulosxPerfil($id_perfiles,$id_modulos)
{
	$query = insertar(sprintf("INSERT INTO `tr_modulosxperfiles`
		(`id_modulos`, `id_perfiles`) VALUES ('%d','%d')",escape($id_modulos),escape($id_perfiles)));
	return $query;
}

?>