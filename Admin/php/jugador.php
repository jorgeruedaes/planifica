<?php
/**
 * [Get_Jugadores_Equipo Obtiene los jugadores de un equipo]
 * @param [type] $identificador [codigo del equipo]
 */
function Array_Get_Jugadores_Equipo($identificador)
{
    $jugadores = consultar("SELECT * FROM tb_jugadores WHERE 
        equipo=$identificador and estado_jugador='1'  ORDER BY fecha_nacimiento desc");
    $vector    = array();
    while ($valor = mysqli_fetch_array($jugadores)) {
        $id_jugador       = $valor['id_jugadores'];
        $nombre1          = $valor['nombre1'];
        $nombre2          = $valor['nombre2'];
        $apellido1        = $valor['apellido1'];
        $apellido2        = $valor['apellido2'];
        $estado_jugador   = $valor['estado_jugador'];
        $fecha_ingreso    = $valor['fecha_ingreso'];
        $fecha_nacimiento = $valor['fecha_nacimiento'];
        $telefono         = $valor['telefono'];
        $profesion        = $valor['profesion'];
        $datos            = array(
            'id_jugador' => "$id_jugador",
            'nombre1' => "$nombre1",
            'nombre2' => "$nombre2",
            'apellido1' => "$apellido1",
            'apellido2' => "$apellido2",
            'estado_jugador' => "$estado_jugador",
            'fecha_ingreso' => "$fecha_ingreso",
            'fecha_nacimiento' => "$fecha_nacimiento",
            'telefono' => "$telefono",
            'profesion' => "$profesion"
            
            );
        array_push($vector, $datos);
    }
    
    return $vector;
}
function Array_Get_Jugadores_Campeonato($identificador)
{
    $jugadores = consultar("SELECT * from tb_jugadores,tb_equipos 
        where tb_jugadores.equipo=tb_equipos.id_equipo and tb_equipos.torneo=$identificador ORDER BY nombre1 asc,apellido1 asc");
    $vector    = array();
    while ($valor = mysqli_fetch_array($jugadores)) {
        $id_jugador       = $valor['id_jugadores'];
        $nombre1          = $valor['nombre1'];
        $nombre2          = $valor['nombre2'];
        $apellido1        = $valor['apellido1'];
        $apellido2        = $valor['apellido2'];
        $equipo       = $valor['equipo'];
        $documento       = $valor['documento'];
        $nombre   =      String_Get_NombreCompleto($valor['id_jugadores']);
        $nombre_estado  = String_Get_NombreEstado($valor['estado_jugador']);
        $estado_jugador   = $valor['estado_jugador'];
        $fecha_ingreso    = $valor['fecha_ingreso'];
        $fecha_nacimiento = $valor['fecha_nacimiento'];
        $telefono         = $valor['telefono'];
        $profesion        = $valor['profesion'];
        $datos            = array(
            'id_jugador' => "$id_jugador",
            'nombre1' => "$nombre1",
            'nombre2' => "$nombre2",
            'apellido1' => "$apellido1",
            'apellido2' => "$apellido2",
            'nombre' => "$nombre",
              'equipo' => "$equipo",
                'documento' => "$documento",
            'nombre_estado' =>"$nombre_estado",
            'estado_jugador' => "$estado_jugador",
            'fecha_ingreso' => "$fecha_ingreso",
            'fecha_nacimiento' => "$fecha_nacimiento",
            'telefono' => "$telefono",
            'profesion' => "$profesion"
            
            );
        array_push($vector, $datos);
    }
    
    return $vector;
}
function Array_Get_Jugadores()
{
    $jugadores = consultar("SELECT * FROM tb_jugadores  ORDER BY fecha_nacimiento desc");
    $vector    = array();
    while ($valor = mysqli_fetch_array($jugadores)) {
        $id_jugador       = $valor['id_jugadores'];
        $equipo       = $valor['equipo'];
        $nombre1          = $valor['nombre1'];
        $nombre2          = $valor['nombre2'];
        $apellido1        = $valor['apellido1'];
        $apellido2        = $valor['apellido2'];
        $estado_jugador   = $valor['estado_jugador'];
        $fecha_ingreso    = $valor['fecha_ingreso'];
        $fecha_nacimiento = $valor['fecha_nacimiento'];
        $telefono         = $valor['telefono'];
        $profesion        = $valor['profesion'];
        $datos            = array(
            'id_jugador' => "$id_jugador",
            'equipo' => "$equipo",
            'nombre1' => "$nombre1",
            'nombre2' => "$nombre2",
            'apellido1' => "$apellido1",
            'apellido2' => "$apellido2",
            'estado_jugador' => "$estado_jugador",
            'fecha_ingreso' => "$fecha_ingreso",
            'fecha_nacimiento' => "$fecha_nacimiento",
            'telefono' => "$telefono",
            'profesion' => "$profesion"
            
            );
        array_push($vector, $datos);
    }
    
    return $vector;
}
/**
 * [ObtenerNombreCompletoJugador ]
 * @param [Int] $identificador [Codigo del jugador]
 */
function String_Get_NombreCompleto($identificador)
{
    $valor = mysqli_fetch_array(consultar("SELECT nombre1,apellido1,apellido2
      FROM tb_jugadores WHERE id_jugadores=$identificador"));
    $valor = $valor['nombre1'] . " " . $valor['apellido1']." " . $valor['apellido2'];
    ;
    
    return $valor;
}
function String_Get_NombreEstado($identificador)
{
    $valor = mysqli_fetch_array(consultar("SELECT `id_estado`, `nombre` 
        FROM `tb_estados_jugador` WHERE id_estado=$identificador"));
    $valor = $valor['nombre'];
    
    return $valor;
}
/**
 * [Set_Jugador description]
 * @param [type] $id_jugador [description]
 * @param [type] $nombre1    [description]
 * @param [type] $nombre2    [description]
 * @param [type] $apellido1  [description]
 * @param [type] $apellido2  [description]
 * @param [type] $fecha      [description]
 * @param [type] $estado     [description]
 */
function Set_Jugador($id_jugador,$nombre1,$nombre2,$apellido1,$apellido2,$fecha,$estado)
{
    $valor  = modificar(sprintf("UPDATE `tb_jugadores` SET `nombre1`='%s',`nombre2`='%s',`apellido1`='%s',`apellido2`='%s',`fecha_nacimiento`='%s',`estado_jugador`='%d'
        WHERE `id_jugadores`='%d' ",
        escape($nombre1),escape($nombre2),escape($apellido1),escape($apellido2),escape($fecha),escape($estado),escape($id_jugador)));
    return $valor;
}
/**
 * [boolean_new_jugador description]
 * @param  [type] $documento [description]
 * @param  [type] $equipo    [description]
 * @param  [type] $nombre1   [description]
 * @param  [type] $nombre2   [description]
 * @param  [type] $apellido1 [description]
 * @param  [type] $apellido2 [description]
 * @param  [type] $fecha     [description]
 * @param  [type] $estado    [description]
 * @return [type]            [description]
 */
function boolean_new_jugador($documento,$equipo,$nombre1,$nombre2,$apellido1,$apellido2,$fecha,$estado)
{
    $partido = insertar(sprintf("INSERT INTO `tb_jugadores`(`id_jugadores`, `documento`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, 
        `fecha_nacimiento`, `email`, `equipo`, `foto_jugador`, `fecha_ingreso`, `estado_jugador`, `telefono`, `profesion`, `tipo_jugador`)
     VALUES (NULL,'%d','%s','%s','%s','%s','%s','','%d','',NOW(),'%d','','','')"
    ,escape($documento),escape($nombre1),escape($nombre2),escape($apellido1),escape($apellido2),escape($fecha),escape($equipo),escape($estado)));
    return $partido;    
}
