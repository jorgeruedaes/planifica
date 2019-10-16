<?php
function Array_Get_Noticias()
{
  $query = consultar("SELECT * FROM `tb_noticias` order by fecha desc");
  $vector    = array();
  while ($valor = mysqli_fetch_array($query)) {

    $id_noticias = $valor['id_noticias'];
    $titulo = $valor['titulo'];
    $emcabezado =$valor['emcabezado'];
    $texto =$valor['texto'];
    $fecha = $valor['fecha'];
    $imagen =$valor['imagen'];
    $torneo =$valor['torneo'];

    $arreglo = array(
      'id_noticias'=>"$id_noticias",
      'titulo'=>"$titulo",
      'emcabezado'=>"$emcabezado",
      'fecha'=>"$fecha",
      'texto'=>"$texto",
      'imagen'=>"$imagen",
      'torneo'=>"$torneo"
      );
    array_push($vector, $arreglo);
  }

  return $vector;
}
/**
 * [boolean_new_noticia description]
 * @param  [type] $titulo     [description]
 * @param  [type] $emcabezado [description]
 * @param  [type] $texto      [description]
 * @param  [type] $fecha      [description]
 * @param  [type] $torneo     [description]
 * @return [type]             [description]
 */
function boolean_new_noticia($titulo,$emcabezado,$texto,$fecha,$torneo,$url)
{
  $noticia = insertar(sprintf("INSERT INTO `tb_noticias`(`id_noticias`, `titulo`, `emcabezado`, `texto`, `imagen`, `torneo`, `fecha`)
   VALUES (NULL,'%s','%s','%s','%s','%s','%s')"
   ,escape($titulo),escape($emcabezado),escape($texto),escape($url),escape($torneo),escape($fecha)));
  return $noticia;    
}
/**
 * [boolean_set_noticia description]
 * @param  [type] $titulo     [description]
 * @param  [type] $emcabezado [description]
 * @param  [type] $texto      [description]
 * @param  [type] $fecha      [description]
 * @param  [type] $torneo     [description]
 * @return [type]             [description]
 */
function boolean_set_noticia($titulo,$emcabezado,$texto,$fecha,$torneo,$noticia,$url)
{
  $noticia = insertar(sprintf("UPDATE `tb_noticias` SET `imagen`= '%s',`titulo`='%s',`emcabezado`='%s',`texto`='%s',`torneo`='%d',`fecha`='%s' 
    WHERE id_noticias='%d' "
    ,escape($url),escape($titulo),escape($emcabezado),escape($texto),escape($torneo),escape($fecha),escape($noticia)));
  return $noticia;    
}
/**
 * [boolean_delete_noticia description]
 * @param  [type] $noticia [description]
 * @return [type]          [description]
 */
function boolean_delete_noticia($noticia)
{
  $noticia = eliminar("DELETE FROM `tb_noticias` WHERE id_noticias='$noticia' ");
  return $noticia;    
}