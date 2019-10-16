<?php

/**
 * [Array_Get_Equipos description]
 */
function Array_Get_Equipos()
{
    $query = consultar("SELECT  `id_equipo`, `nombre_equipo`, `tecnico1`, `torneo`, `grupo`, `colegio`, `estado`
     FROM tb_equipos ORDER BY torneo asc,colegio desc,nombre_equipo desc ");
    $vector    = array();
    while ($valor = mysqli_fetch_array($query)) {

    $id_equipo = $valor['id_equipo'];
    $nombre_equipo = $valor['nombre_equipo'];
    $tecnico1 = $valor['tecnico1'];
    $torneo = $valor['torneo'];
    $grupo = $valor['grupo'];
    $colegio = $valor['colegio'];
    $estado = $valor['estado'];


    $arreglo = array(
      'id_equipo'=>"$id_equipo",
      'nombre_equipo'=>"$nombre_equipo",
      'tecnico1'=>"$tecnico1",
      'torneo'=>"$torneo",
      'grupo'=>"$grupo",
      'colegio'=>"$colegio",
      'estado'=>"$estado"
      );
        array_push($vector, $arreglo);
    }
    
    return $vector;
}
/**
 * [Get_Equipo Obtengo un equipo]
 * @param [Int] $identificador [Codigo del equipo]
 */
function Get_Equipo($identificador)
{
    $valor  = mysqli_fetch_array(consultar("SELECT * 
      FROM tb_equipos WHERE id_equipo=$identificador ORDER BY nombre_equipo desc"));
    $id_equipo = $valor['id_equipo'];
    $nombre_equipo = $valor['nombre_equipo'];
    $puntos        = $valor['puntos'];
    $tecnico1      = $valor['tecnico1'];
    $tecnico2      = $valor['tecnico2'];
    $imagen_equipo = $valor['imagen_escudo'];
    
    return array(
      "id_equipo" => "$id_equipo",
      "nombre_equipo" => "$nombre_equipo",
      "puntos" => "$puntos",
      "tecnico1" => "$tecnico1",
      "tecnico2" => "$tecnico2",
      "imagen_equipo" => "$imagen_equipo",
      "id_equipo" => "$identificador"
      );
}
/**
 * [Get_NombreEquipo Obtiene el nombre de un equipo]
 * @param [type] $identificador [Codigo del equipo]
 */
function Get_NombreEquipo($identificador)
{
    $valor = mysqli_fetch_array(consultar("SELECT nombre_equipo 
      FROM tb_equipos WHERE id_equipo=$identificador"));
    $valor = $valor['nombre_equipo'];
    
    return $valor;
}

/**
 * [boolean_new_equipo description]
 * @param  [type] $nombre  [description]
 * @param  [type] $tecnico [description]
 * @param  [type] $grupo   [description]
 * @param  [type] $torneo  [description]
 * @param  [type] $club    [description]
 * @param  [type] $estado  [description]
 * @return [boolean]          [description]
 */
function boolean_new_equipo($nombre,$tecnico,$grupo,$torneo,$club,$estado)
{
  $campeonatos = insertar(sprintf("INSERT INTO `tb_equipos`(`id_equipo`, `nombre_equipo`, `tecnico1`, `torneo`, `grupo`, `colegio`, `estado`)
   VALUES (NULL,'%s','%s','%d','%s','%d','%s')",
    escape($nombre),escape($tecnico),escape($torneo),escape($grupo),escape($club),
    escape($estado)));
  return $campeonatos;  

}

/**
 * [boolean_Set_equipo description]
 * @param  [type] $nombre  [description]
 * @param  [type] $tecnico [description]
 * @param  [type] $grupo   [description]
 * @param  [type] $torneo  [description]
 * @param  [type] $club    [description]
 * @param  [type] $estado  [description]
 * @param  [type] $equipo  [description]
 * @return [boolean]          [description]
 */
function boolean_Set_equipo($nombre,$tecnico,$grupo,$torneo,$club,$estado,$equipo)
{

  $campeonatos = modificar(sprintf("UPDATE `tb_equipos` SET `nombre_equipo`='%s',`tecnico1`='%s',`torneo`='%s',`grupo`='%s',`colegio`='%s',`estado`='%s' WHERE id_equipo='%d' ",
    escape($nombre),escape($tecnico),escape($torneo),escape($grupo),escape($club),
    escape($estado),escape($equipo)));
  return $campeonatos;  
}
/**
 * [Array_Get_Equipos_Torneo description]
 * @param [type] $torneo [description]
 */
function Array_Get_Equipos_Torneo($torneo)
{
    $query = consultar("SELECT  `id_equipo`, `nombre_equipo`, `tecnico1`, `torneo`, `grupo`, `colegio`, `estado`
     FROM tb_equipos WHERE torneo=$torneo ORDER BY nombre_equipo asc ");
    $vector    = array();
    while ($valor = mysqli_fetch_array($query)) {

    $id_equipo = $valor['id_equipo'];
    $nombre_equipo = $valor['nombre_equipo'];
    $tecnico1 = $valor['tecnico1'];
    $torneo = $valor['torneo'];
    $grupo = $valor['grupo'];
    $colegio = $valor['colegio'];
    $estado = $valor['estado'];


    $arreglo = array(
      'id_equipo'=>"$id_equipo",
      'nombre_equipo'=>"$nombre_equipo",
      'tecnico1'=>"$tecnico1",
      'torneo'=>"$torneo",
      'grupo'=>"$grupo",
      'colegio'=>"$colegio",
      'estado'=>"$estado"
      );
        array_push($vector, $arreglo);
    }
    return $vector;
  }
/**
 * [Array_Get_Equipos_Club description]
 * @param [type] $club [description]
 */
  function Array_Get_Equipos_Club($club)
{
    $query = consultar("SELECT  `id_equipo`, `nombre_equipo`, `tecnico1`, `torneo`, `grupo`, `colegio`, `estado`
     FROM tb_equipos WHERE colegio='$club' ORDER BY torneo asc,colegio desc,nombre_equipo desc ");
    $vector    = array();
    while ($valor = mysqli_fetch_array($query)) {

    $id_equipo = $valor['id_equipo'];
    $nombre_equipo = $valor['nombre_equipo'];
    $tecnico1 = $valor['tecnico1'];
    $torneo = $valor['torneo'];
    $grupo = $valor['grupo'];
    $colegio = $valor['colegio'];
    $estado = $valor['estado'];


    $arreglo = array(
      'id_equipo'=>"$id_equipo",
      'nombre_equipo'=>"$nombre_equipo",
      'tecnico1'=>"$tecnico1",
      'torneo'=>"$torneo",
      'grupo'=>"$grupo",
      'colegio'=>"$colegio",
      'estado'=>"$estado"
      );
        array_push($vector, $arreglo);
    }
    
    return $vector;
}
?>