<?php
/**
 * [Boolean_Create_Modulo Permite crear un modulo o submodulo dependiendo del caso.]
 * @param [type] $nombre  [description]
 * @param [type] $ruta    [description]
 * @param [type] $icono   [description]
 * @param [type] $tipo    [description]
 * @param [type] $submenu [description]
 * @param [type] $padre   [description]
 * @param [type] $orden   [description]
 */
function Boolean_Create_Modulo($nombre,$ruta,$icono,$tipo,$submenu,$padre,$orden)
{
	if($tipo=='Principal' and $padre=='0')
	{
		$query = ingresar(sprintf("INSERT INTO `tb_modulos`
			(`id_modulos`, `padre`, `nombre`, `ruta`, `submenu`, `icono`, `orden`) 
			VALUES (NULL,'%d','%s','%s','%d','%s','%d'))",escape($padre),escape($nombre),escape($ruta)
		,escape($submenu),escape($icono),escape($orden)));		

		return ($query==True)? array(True,'El modulo fue creado exitosamente.'):array(False,'El modulo no se ha creado.');

	}
	else if($tipo=='Submenu' and Boolean_Padre_Existe($padre) and $submenu=='0')
	{
		$query = ingresar(sprintf("INSERT INTO `tb_modulos`
			(`id_modulos`, `padre`, `nombre`, `ruta`, `submenu`, `icono`, `orden`) 
			VALUES (NULL,'%d','%s','%s','%d','%s','%d'))",escape($padre),escape($nombre),escape($ruta)
		,escape($submenu),escape($icono),escape($orden)));	

		return ($query==True)? array(True,'El modulo fue creado exitosamente.'):array(False,'El modulo no se ha creado.');
	}
	else
	{
		return array(False,'Hay un error en la creación del modulo.');	
	}

}
/**
 * [Boolean_Set_Modulo Modifica n moduló]
 * @param [type] $id_modulo [description]
 * @param [type] $nombre    [description]
 * @param [type] $ruta      [description]
 * @param [type] $icono     [description]
 * @param [type] $tipo      [description]
 * @param [type] $submenu   [description]
 * @param [type] $padre     [description]
 * @param [type] $orden     [description]
 */
function Boolean_Set_Modulo($id_modulo,$nombre,$ruta,$icono,$tipo,$submenu,$padre,$orden)
{
	if($tipo=='Principal' and $padre=='0')
	{
		$query = ingresar(sprintf("UPDATE `tb_modulos`
			SET `padre`='%d', `nombre`='%s', `ruta`='%s', `submenu`='%d', `icono`='%s', `orden`='%d' WHERE id_modulos='%d'
			",escape($padre),escape($nombre),escape($ruta)
			,escape($submenu),escape($icono),escape($orden),escape($id_modulo)));		

		return ($query==True)? array(True,'El modulo fue modificado exitosamente.'):array(False,'El modulo no se ha modificado.');

	}
	else if($tipo=='Submenu' and Boolean_Padre_Existe($padre) and $submenu=='0')
	{
		$query = ingresar(sprintf("UPDATE `tb_modulos`
			SET `padre`='%d', `nombre`='%s', `ruta`='%s', `submenu`='%d', `icono`='%s', `orden`='%d' WHERE id_modulos='%d'
			",escape($padre),escape($nombre),escape($ruta)
			,escape($submenu),escape($icono),escape($orden),escape($id_modulo)));	

		return ($query==True)? array(True,'El modulo fue modificado exitosamente.'):array(False,'El modulo no se ha modificado.');
	}
	else
	{
		return array(False,'Hay un error en la modificación del modulo.');	
	}
}


?>