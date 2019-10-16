<?php
require('conexion.php');
require('sesion.php');
/**
 * [escape Permite escapar paramtros dentro de una función]
 * @param  [type] $parametro [Parametro a escapar]
 * @return [type]            [description]
 */
function escape($parametro)
{
	global $conexion;
	return	mysqli_real_escape_string($conexion,$parametro);
}
/**
 * [consultar esta funcion permite realizar consultas en la BD]
 * @param  [String] $query [Consulta SQL]
 * @return [Result]        [Resultado de la consulta]
 */
function consultar($query)
{
	global $conexion;
	Set_Sesion($_SESSION['Id'],'Select',$query);
	return mysqli_query($conexion,$query);

	
}
/**
 * [modificar Modifica informacion de la base de datos]
 * @param  [type] $query [Consulta SQL]
 * @return [type]        [description]
 */
function modificar($query)
{
	global $conexion;
	Set_Sesion($_SESSION['Id'],'Update',$query);
	return mysqli_query($conexion,$query);

	
}
/**
 * [eliminar Elimina algun valor de la base de datos]
 * @param  [type] $query [Consulta SQL]
 * @return [type]        [description]
 */
function eliminar($query)
	{
	global $conexion;
	Set_Sesion($_SESSION['Id'],'Delete',$query);
	return mysqli_query($conexion,$query);

}

/**
 * [insertar Permite registrar en la base de datos]
 * @param  [type] $query [Consulta SQL]
 * @return [type]        [description]
 */
function insertar($query)
	{
	global $conexion;
	Set_Sesion($_SESSION['Id'],'Insert',$query);
	return mysqli_query($conexion,$query);

	
}
/**
 * [Boolean_consultaVacia Ayuda establecer si una consulta tiene resultados]
 * @param [type] $consulta [Consulta SQL]
 */
function Int_consultaVacia($consulta)
{
	return mysqli_num_rows($consulta);
}
/**
 * [Start_Transaction Permite iniciar una transacción]
 */
function start()
{
	global $conexion;
	return mysqli_begin_transaction($conexion,MYSQLI_TRANS_START_READ_WRITE);
}
 /**
  * [commit Confirma una transacción]
  * @return [type] [Boolean]
  */
 function commit()
 {
 	global $conexion;
 	return mysqli_commit($conexion);
 }
/**
 * [rollback Devuelve una transacción]
 * @return [type] [Boolean]
 */
function rollback()
{
	global $conexion;
	return mysqli_rollback($conexion);
}

?>