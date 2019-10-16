<?php
function Array_Get_Comunicados()
{
  $query = consultar("SELECT * FROM `tb_comunicados` order by fecha desc");
  $vector    = array();
  while ($valor = mysqli_fetch_array($query)) {

    $id_comunicados = $valor['id_comunicados'];
    $tipo = $valor['tipo'];
    $comunicado =$valor['comunicado'];
    $fecha =$valor['fecha'];
    $titulo = $valor['titulo'];

    $arreglo = array(
      'id_comunicados'=>"$id_comunicados",
      'tipo'=>"$tipo",
      'comunicado'=>"$comunicado",
      'fecha'=>"$fecha",
      'titulo'=>"$titulo"
      );
    array_push($vector, $arreglo);
  }

  return $vector;
}
/**
 * [boolean_new_Comunicado description]
 * @param  [type] $tipo       [description]
 * @param  [type] $comunicado [description]
 * @param  [type] $fecha      [description]
 * @param  [type] $titulo     [description]
 * @return [type]             [description]
 */
function boolean_new_Comunicado($tipo,$comunicado,$fecha,$titulo)
{
  $noticia = insertar(sprintf("INSERT INTO `tb_comunicados`(`id_comunicados`, `tipo`, `comunicado`, `fecha`, `titulo`) VALUES (NULL,'%s','%s','%s','%s')"
   ,escape($tipo),escape($comunicado),escape($fecha),escape($titulo)));
  return $noticia;    
}
/**
 * [boolean_set_Comunicado description]
 * @param  [type] $tipo          [description]
 * @param  [type] $fecha         [description]
 * @param  [type] $titulo        [description]
 * @param  [type] $identificador [description]
 * @return [type]                [description]
 */
function boolean_set_Comunicado($tipo,$fecha,$titulo,$identificador,$comunicado)
{
  $noticia = insertar(sprintf("UPDATE `tb_comunicados` SET `tipo`='%s',`comunicado`='%s',`fecha`='%s',`titulo`='%s'  WHERE  id_comunicados='%d' "
    ,escape($tipo),escape($comunicado),escape($fecha),escape($titulo),escape($identificador)));
  return $noticia;    
}
/**
 * [boolean_delete_Comunicado description]
 * @param  [type] $comunicado [description]
 * @return [type]             [description]
 */
function boolean_delete_Comunicado($comunicado)
{
  $noticia = eliminar("DELETE FROM `tb_comunicados` WHERE id_comunicados='$comunicado' ");
  return $noticia;    
}