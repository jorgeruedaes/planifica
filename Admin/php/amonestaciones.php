<?php
/**
 * [Add_detalle_amonestacion description]
 * @param [type] $partido      [description]
 * @param [type] $jugador      [description]
 * @param [type] $amonestacion [description]
 * @param [type] $comentario   [description]
 * @param [type] $jornada      [description]
 */
function Add_detalle_amonestacion($partido,$jugador,$amonestacion,$comentario,$jornada)
{
    $valor  = insertar(sprintf("INSERT INTO `tr_amonestacionesxjugador`(`partido`, `jugador`, `amonestacion`, `estado_amonestacion`, `duracion`, `comentario`, `jornada_amonestacion`)
        VALUES ('%d','%d','%d','1','','%s','%d') ",
        escape($partido),escape($jugador),escape($amonestacion),escape($comentario),escape($jornada)));
    return $valor;
}
/**
 * [Add_detalles_amonestaciones_partido description]
 * @param [type] $partido [description]
 * @param [type] $vector  [description]
 * @param [type] $fecha   [description]
 */
function Add_detalles_amonestaciones_partido($partido,$vector,$fecha)
{
    $json = json_decode($vector);
    $bandera ='';
    for ($i=0; $i < count($json) ; $i++) {
        if($json[$i][3]!='5'){
            if(Add_detalle_amonestacion($partido,$json[$i][0],$json[$i][3],$json[$i][2],$fecha))
            {
                $bandera=true;
            }   
            else
            {
                $bandera=false;
            }
        }
        else
        {
         $bandera=true;   
     }

 }
 return $bandera;
}
/**
 * [Boolean_Jugadorxpartido_amonestaciones description]
 * @param [type] $jugador [description]
 * @param [type] $partido [description]
 */
function Boolean_Jugadorxpartido_amonestaciones($jugador,$partido)
{
    $query = consultar("SELECT * FROM  `tr_jugadoresxpartido` WHERE `jugador`='$jugador' and `partido`='$partido' ");

    return (Int_consultaVacia($query)>0) ? true : false ;
}
/**
 * [Set_detalle_jugador_amonestado description]
 * @param [type] $jugador      [description]
 * @param [type] $partido      [description]
 * @param [type] $amonestacion [description]
 */
function Set_detalle_jugador_amonestado($jugador,$partido,$amonestacion)
{
    $valor  = modificar(sprintf("UPDATE `tr_jugadoresxpartido` SET amonestacion='%d' WHERE jugador='%d'
     and partido='%d' ",escape($amonestacion),escape($jugador),escape($partido)));
    return $valor;
}
/**
 * [Set_Detalle_Amonestacion description]
 * @param [type] $jugador      [description]
 * @param [type] $partido      [description]
 * @param [type] $amonestacion [description]
 */
function Set_Detalle_Amonestacion($jugador,$partido,$amonestacion)
{
 $valor  = modificar(sprintf("UPDATE `tr_amonestacionesxjugador` 
     SET `estado_amonestacion`='%d' 
     WHERE `partido`='%d' and `jugador`='%d' ",escape($amonestacion),escape($partido),escape($jugador)));
 return $valor;  

}
/**
 * [Delete_detalles_amonestaciones description]
 * @param [type] $partido [description]
 */
function Delete_detalles_amonestaciones_partidos($partido)
{
  $valor  = eliminar("DELETE FROM `tr_amonestacionesxjugador` WHERE partido=$partido");
  return $valor;
}

function Delete_partido_detalles_amonestaciones($partido)
{
  $valor  = eliminar("DELETE FROM `tr_jugadoresxpartido` WHERE partido=$partido and goles='0' and autogoles='0' ");
  return $valor;
}
/**
 * [Reinicia_Detalles_Partido_amonestaciones description]
 * @param [type] $partido [description]
 */
function Reinicia_Detalles_Partido_amonestaciones($partido)
{
    $valor  = modificar("UPDATE `tr_jugadoresxpartido` SET `amonestacion`='5' WHERE  partido='$partido'");
    return $valor;
}

/**
 * [Add_detalle_jugador_amonestado description]
 * @param [type] $jugador      [description]
 * @param [type] $partido      [description]
 * @param [type] $amonestacion [description]
 * @param [type] $gol          [description]
 * @param [type] $autogol      [description]
 */
function Add_detalle_jugador_amonestado($jugador,$partido,$amonestacion,$gol,$autogol)
{
    $valor  = insertar(sprintf("INSERT INTO `tr_jugadoresxpartido`(`jugador`, `partido`, `amonestacion`, `goles`, `autogoles`)
     VALUES ('%d','%d','%d','%d','%d') ",escape($jugador),escape($partido),escape($amonestacion),escape($gol),escape($autogol)));
    return $valor;
}

/**
 * [Set_Detalles_Amonestacion description]
 * @param [type] $vector [description]
 */
function Set_Detalles_Amonestacion($vector)
{
    $json = json_decode($vector);
    $bandera ='';
    for ($i=0; $i < count($json) ; $i++) {

      if(Set_Detalle_Amonestacion($json[$i][0],$json[$i][1],$json[$i][2]))
      {
         $bandera=true;
     }  
     else
     {
        $bandera=false;
    }
}
 return $bandera;

}

/**
 * [Add_detalles_partido_Amonestados description]
 * @param [type] $vector  [description]
 * @param [type] $partido [description]
 */
function Add_detalles_partido_Amonestados($vector,$partido)
{
    $json = json_decode($vector);
    $bandera ='';
    for ($i=0; $i < count($json) ; $i++) {

        if(Boolean_Jugadorxpartido_amonestaciones($json[$i][0],$partido))
        {
            if(Set_detalle_jugador_amonestado($json[$i][0],$partido,$json[$i][3]))
            {
                $bandera=true;
            }   
            else
            {
                $bandera=false;
            }

        }
        else
        {
            if(Add_detalle_jugador_amonestado($json[$i][0],$partido,$json[$i][3],'0','0'))
            {
                $bandera=true;
            }   
            else
            {
                $bandera=false;
            }

        }
    }
    return $bandera;
}

function Array_Get_Detalles_Amonestacion($partido)
{

    $query = consultar("SELECT `partido`, `jugador`, `amonestacion`, `estado_amonestacion`, `duracion`, `comentario`, `jornada_amonestacion` 
        FROM `tr_amonestacionesxjugador` 
        WHERE `partido`='$partido' "); 
    $datos = array();
    while ($valor = mysqli_fetch_array($query)) {
        $jugador = $valor['jugador'];
        $partido = $valor['partido'];
        $comentario = $valor['comentario'];
        $amonestacion = $valor['amonestacion'];
        $estado_amonestacion = $valor['estado_amonestacion'];
        $jornada_amonestacion = $valor['jornada_amonestacion'];
        $vector = array(
            'jugador'=>"$jugador",
            'partido' => "$partido",
            'comentario' => "$comentario",
            'amonestacion' => "$amonestacion",
            'estado_amonestacion' => "$estado_amonestacion",
            'jornada_amonestacion' => "$jornada_amonestacion",
            );
        array_push($datos, $vector);
    }

    return $datos;  
}

function Array_Get_Detalles_Amonestacion_Fecha($numero_fecha,$torneo)
{

    $query = consultar("SELECT * FROM tb_partidos,tb_equipos,tr_amonestacionesxjugador,tb_jugadores
       WHERE numero_fecha='$numero_fecha' and tb_partidos.estado='2' 
       and ((tb_equipos.id_equipo =tb_partidos.equipo1) or (tb_partidos.equipo2=tb_equipos.id_equipo)) 
       and tb_equipos.torneo='$torneo' and tr_amonestacionesxjugador.partido=tb_partidos.id_partido 
       and tb_jugadores.id_jugadores=tr_amonestacionesxjugador.jugador and numero_fecha=jornada_amonestacion
        GROUP BY jugador  order by nombre_equipo asc"); 
    $datos = array();
    while ($valor = mysqli_fetch_array($query)) {
        $jugador = $valor['jugador'];
        $partido = $valor['partido'];
        $estado_amonestacion = $valor['estado_amonestacion'];
        $amonestacion = $valor['amonestacion'];
        $nombre_equipo = $valor['nombre_equipo'];
        $vector = array(
            'jugador'=>"$jugador",
            'partido'=>"$partido",
            'estado_amonestacion' => "$estado_amonestacion",
            'amonestacion' => "$amonestacion",
            'nombre_equipo' => "$nombre_equipo"
            );
        array_push($datos, $vector);
    }

    return $datos;  
}