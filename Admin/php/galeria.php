<?php 

/**
 * [Array_Get_Galeria description]
 */
function Array_Get_Galeria()
{
    $query = consultar("SELECT `codigo`, `imagen`, `fecha`, `torneo` FROM `tb_galeria` order by fecha desc");
    $vector    = array();
    while ($valor = mysqli_fetch_array($query)) {

    $codigo = $valor['codigo'];
    $imagen = $valor['imagen'];
    $fecha =$valor['fecha'];
     $torneo =$valor['torneo'];

    $arreglo = array(
      'codigo'=>"$codigo",
      'imagen'=>"$imagen",
      'fecha'=>"$fecha",
       'torneo'=>"$torneo",

      );
        array_push($vector, $arreglo);
    }
    
    return $vector;
}
/**
 * [Array_Get_Albums description]
 */
function Array_Get_Albums()
{
    $query = consultar("SELECT * FROM `tb_album`  order by fecha_creacion desc");
    $vector    = array();
    while ($valor = mysqli_fetch_array($query)) {

    $id_album = $valor['id_album'];
    $nombre = $valor['nombre'];
    $fecha_creacion =$valor['fecha_creacion'];
     $estado =$valor['estado'];

    $arreglo = array(
      'id_album'=>"$id_album",
      'nombre'=>"$nombre",
      'fecha_creacion'=>"$fecha_creacion",
       'estado'=>"$estado",

      );
        array_push($vector, $arreglo);
    }
    
    return $vector;
}

/**
 * [boolean_new_album description]
 * @param  [type] $nombre [description]
 * @param  [type] $estado [description]
 * @return [type]         [description]
 */
function boolean_new_album($nombre,$estado)
{
  $galeria = insertar(sprintf("INSERT INTO `tb_album`(`id_album`, `nombre`, `fecha_creacion`, `estado`) 
    VALUES (NULL,'%s',NOW(),'%s')",
    escape($nombre),escape($estado)));
  return $galeria;  

}
/**
 * [boolean_set_album description]
 * @param  [type] $id_album [description]
 * @param  [type] $nombre   [description]
 * @param  [type] $estado   [description]
 * @return [type]           [description]
 */
function boolean_set_album($id_album,$nombre,$estado)
{
  $galeria = insertar(sprintf("UPDATE `tb_album` SET `nombre`='%s',`estado`='%s' WHERE id_album='%d' ",
    escape($nombre),escape($estado),escape($id_album)));
  return $galeria;  

}
/**
 * [boolean_delete_album description]
 * @param  [type] $id_album [description]
 * @return [type]           [description]
 */
function boolean_delete_album($id_album)
{
  $galeria = eliminar("DELETE FROM `tb_album` WHERE id_album='$id_album' and id_album!='100'  ");
  return $galeria;  

}
/**
 * [boolean_new_imagen description]
 * @param  [type] $url    [description]
 * @param  [type] $torneo [description]
 * @return [type]         [description]
 */
function boolean_new_imagen($url,$torneo)
{
  $galeria = insertar(sprintf("INSERT INTO `tb_galeria`(`codigo`, `imagen`, `fecha`, `torneo`) 
  	VALUES (NULL,'%s',NOW(),'%d')",
    escape($url),escape($torneo)));
  return $galeria;  

}

function boolean_set_imagen($url,$torneo,$codigo)
{
  $galeria = insertar(sprintf("UPDATE `tb_galeria` SET `imagen`='%s',`torneo`='%d' WHERE codigo='%d'  ",
    escape($url),escape($torneo),escape($codigo)));
  return $galeria;  

}
/**
 * [boolean_delete_imagen description]
 * @param  [type] $imagen [description]
 * @return [type]         [description]
 */
function boolean_delete_imagen($imagen)
{
  $galeria = eliminar("DELETE FROM `tb_galeria` WHERE codigo='$imagen' ");
  return $galeria;  

}

?>