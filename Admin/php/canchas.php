<?php
/**
 * [Array_Get_Canchas description]
 */
function Array_Get_Canchas()
{
    $query = consultar("SELECT * FROM `tb_lugares` order by id_lugar desc");
    $vector    = array();
    while ($valor = mysqli_fetch_array($query)) {

    $id_lugar = $valor['id_lugar'];
    $nombre = $valor['nombre'];
    $estado =$valor['estado'];

    $arreglo = array(
      'id_lugar'=>"$id_lugar",
      'nombre'=>"$nombre",
      'estado'=>"$estado"
      );
        array_push($vector, $arreglo);
    }
    
    return $vector;
}
/**
 * [boolean_new_cancha description]
 * @param  [type] $nombre [description]
 * @param  [type] $estado [description]
 * @return [type]         [description]
 */
function boolean_new_cancha($nombre,$estado)
{
  $campeonatos = insertar(sprintf("INSERT INTO `tb_lugares`(`id_lugar`, `nombre`, `estado`)
   VALUES (NULL,'%s','%s')",
    escape($nombre),escape($estado)));
  return $campeonatos;  

}

/**
 * [boolean_Set_cancha description]
 * @param  [type] $nombre [description]
 * @param  [type] $estado [description]
 * @param  [type] $cancha [description]
 * @return [type]         [description]
 */
function boolean_Set_cancha($nombre,$estado,$cancha)
{

  $campeonatos = modificar(sprintf("UPDATE `tb_lugares` 
  	SET `nombre`='%s',`estado`='%s'
  	 WHERE id_lugar='%d' ",
     escape($nombre),escape($estado),escape($cancha)));
  return $campeonatos;  
}