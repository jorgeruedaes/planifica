<?php
/**
 * [String_Get_Nombre Obtiene el nombre completo del usuario]
 * @param Integer $usuario [Codigo identificador del usuario]
 */
function String_Get_modulo_hash($parametro)

{	global $conexion;

	$resultado = consultar("SELECT `nombre` FROM `tb_modulos` WHERE hash='$parametro' "); 
	while ($valor = mysqli_fetch_array($resultado)) {
	return $valor['nombre'];
	}
}

function new_Evento($id_evento, $nombre_evento, $tipo_evento,
       $fecha_inicio, $fecha_fin, $estado, $lugar, $descripcion,
      $usuario_creacion)
{
    global $conexion;
    
    $valor = mysqli_query($conexion, "INSERT INTO `tb_evento`(`id_evento`, `nombre_evento`, `tipo_evento`, `fecha_inicio`, `fecha_fin`, `estado`, `lugar`, `descripcion`, `usuario_creacion`) VALUES ('$id_evento','$nombre_evento','$tipo_evento','$fecha_inicio','$fecha_fin','$estado','$lugar',$descripcion,'$usuario_creacion')");
    
    return $valor;
}

function Get_eventos_usuario($usuario){

    global $conexion;
    $valor = mysqli_query($conexion, "SELECT `id_evento`, `nombre_evento`, `tipo_evento`, `fecha_creacion`, `fecha_inicio`, `fecha_fin`, `estado`, `lugar`, `descripcion`, `usuario_creacion` FROM `tb_evento` WHERE (`usuario_creacion`='$usuario' or `usuario_creacion` in (SELECT id_usuario from tb_usuarios where id_tipo_usuario=100) )  ");
    $datos = array();
    
    while ($informacion = mysqli_fetch_array($valor)) {
        $id_evento  = $informacion['id_evento'];
        $nombre_evento = $informacion['nombre_evento'];
        $tipo_evento  = $informacion['tipo_evento'];
        $fecha_creacion = $informacion['fecha_creacion'];
        $fecha_inicio  = $informacion['fecha_inicio'];
        $fecha_fin  = $informacion['fecha_fin'];
        $estado  = $informacion['estado'];
        $lugar  = $informacion['lugar'];
        $descripcion  = $informacion['descripcion']; 
        $usuario_creacion  = $informacion['usuario_creacion'];
        $vector = array(
            'id_evento' => "$id_evento",
            'nombre_evento' => "$nombre_evento",
            'tipo_evento' => "$tipo_evento",
            'fecha_creacion' => "$fecha_creacion",
            'fecha_inicio' => "$fecha_inicio",
            'fecha_fin' => "$fecha_fin",
            'estado' => "$estado",
            'lugar' => "$lugar",
            'descripcion' => "$descripcion",
            'usuario_creacion' => "$usuario_creacion"
            );
            
        array_push($datos, $vector);
    }
    
    return json_encode($datos,JSON_HEX_TAG);

}

function Get_tipo_eventos ($estado)
{
 global $conexion;
    $valor = mysqli_query($conexion, "SELECT `id_tipo_evento`, `nombre_tipo_evento`, `estado` FROM `tb_tipos_eventos` WHERE `estado` = $estado ");
    $datos = array();
    
    while ($informacion = mysqli_fetch_array($valor)) {
        $id_evento  = $informacion['id_tipo_evento'];
        $nombre_evento = $informacion['nombre_tipo_evento'];
        $tipo_evento  = $informacion['estado'];

        $vector = array(
            'id_tipo_evento' => "$id_evento",
            'nombre_tipo_evento' => "$nombre_evento",
            'estado' => "$tipo_evento"
            );
            
        array_push($datos, $vector);
    }
    
    return json_encode($datos,JSON_HEX_TAG);    
    
}


function Get_estados ($estado)
{
 global $conexion;
    $valor = mysqli_query($conexion, "SELECT `id_estado`, `nombre_estado` FROM `tb_estados` WHERE 1=1");
    $datos = array();
    
    while ($informacion = mysqli_fetch_array($valor)) {
        $id_estado  = $informacion['id_estado'];
        $nombre_estado = $informacion['nombre_estado'];


        $vector = array(
            'id_estado' => "$id_estado",
            'nombre_estado' => "$nombre_estado"
            );
            
        array_push($datos, $vector);
    }
    
    return json_encode($datos,JSON_HEX_TAG);    
    
}

?>