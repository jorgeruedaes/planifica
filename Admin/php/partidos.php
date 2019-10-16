<?php
/////////////////////////////////////////////////////////////
////////////////////--PARTIDOS---///////////////////////////
///////////////////////////////////////////////////////////

/**
 * [Boolean_Agregar_Partido Permite agregar un nuevo partido al calendario del torneo]
 * @param [type] $equipoa [Equipo local]
 * @param [type] $equipob [Equpo visitante]
 * @param [type] $fecha   [Fecha aaaa-mm-dd]
 * @param [type] $hora    [Hora HH:mm:ss]
 * @param [type] $lugar   [Lugar o cancha del partido]
 * @param [type] $ronda   [Ronda  a jugar]
 */
function Boolean_Agregar_Partido($equipoa,$equipob,$fecha,$hora,$lugar,$ronda)
{
	$partido = insertar(sprintf("INSERT INTO `tb_partidos`(`id_partido`, `nombre_partido`, `equipo1`, `equipo2`, `resultado1`, `resultado2`, `fecha`, `hora`, `numero_fecha`, `lugar`, `estado`)
     VALUES (NULL,'','%s','%s','0','0','%s','%s','%d','%d','1')"
     ,escape($equipoa),escape($equipob),escape($fecha),escape($hora),escape($ronda),escape($lugar)));
	return $partido;	
}
/**
 * [Get_Partido Obtiene los datos de un partido]
 * @param [type] $identificador [Codigo del partido]
 */
function Get_Partido($identificador)
{
    $valor  = mysqli_fetch_array(consultar("SELECT * 
      FROM tb_partidos WHERE id_partido=$identificador"));
    $id_partido    = $valor['id_partido'];
    $equipo1    = $valor['equipo1'];
    $equipo2    = $valor['equipo2'];
    $estado     = $valor['estado'];
    $fecha      = $valor['fecha'];
    $hora       = $valor['hora'];
    $lugar      = $valor['lugar'];
    $Nfecha     = $valor['numero_fecha'];
    $resultado1 = $valor['resultado1'];
    $resultado2 = $valor['resultado2'];
     $tiporesultado = $valor['tipo_resultado'];
    
    return array(
    	"id_partido" => "$id_partido",
        "equipo1" => "$equipo1",
        "equipo2" => "$equipo2",
        "estado" => "$estado",
        "fecha" => "$fecha",
        "hora" => "$hora",
        "lugar" => "$lugar",
        "Nfecha" => "$Nfecha",
        "resultado1" => "$resultado1",
        "resultado2" => "$resultado2",
         "tiporesultado" => "$tiporesultado"
        );
}
/**
 * [Set_Partido Permite modificar los datos basicos de un partido]
 * @param [type] $partido [id_partido]
 * @param [type] $fecha   []
 * @param [type] $hora    []
 * @param [type] $lugar   []
 * @param [type] $estado  []
 * @param [type] $ronda   []
 */
function Set_Partido($partido,$fecha,$hora,$lugar,$estado,$ronda)
{
    $valor  = insertar(sprintf("UPDATE tb_partidos 
        SET fecha='%s', hora='%s', Estado='%d',Lugar='%d',numero_fecha='%d'
        WHERE id_partido='%d' ",escape($fecha),escape($hora),escape($estado),escape($lugar),escape($ronda),escape($partido)));
    return $valor;
}
/**
 * [Delete_Partido Permite eliminar un partido]
 * @param [Int] $partido []
 */
function Delete_Partido($partido)
{
    $valor  = eliminar("DELETE FROM `tb_partidos` WHERE id_partido=$partido");
    return $valor;
}

function Delete_Detalles_Partido($partido)
{
    $valor  = eliminar("DELETE FROM tr_jugadoresxpartido WHERE id_partido=$partido and amonestacion='5' ");
    return $valor;
}
function Reinicia_Detalles_Partido($partido)
{
    $valor  = modificar("UPDATE `tr_jugadoresxpartido` SET `goles`='0',`autogoles`='0' WHERE  partido='$partido'");
    return $valor;
}
/**
 * [Array_Get_Partidos_No_Estado Trae los partidos que no tengan ese estado]
 * @param [type] $estado [Codigo Estado que no queremos mostrar]
 */
function Array_Get_Partidos_No_Estado($estado)
{
    $query = consultar("SELECT * FROM tb_partidos WHERE estado!='$estado' and estado!='6' ORDER BY fecha ASC ");
    $vector    = array();
    while ($valor = mysqli_fetch_array($query)) {
        $arreglo = Get_Partido($valor['id_partido']);
        array_push($vector, $arreglo);
    }
    
    return $vector;
}
function Array_Get_Partidos_Campeonato($estado,$campeonato)
{
    $query = consultar("SELECT * FROM tb_partidos WHERE (equipo1 IN (select id_equipo from tb_equipos where torneo='$campeonato' ) and equipo2  IN (select id_equipo from tb_equipos where torneo='$campeonato' )) and estado='$estado' ");
    $vector    = array();
    while ($valor = mysqli_fetch_array($query)) {
        $arreglo = Get_Partido($valor['id_partido']);
        array_push($vector, $arreglo);
    }
    
    return $vector;
}
/**
 * [Array_Get_Partidos_Campeonato_DobleEstado description]
 * @param [type] $estado     [description]
 * @param [type] $estado1    [description]
 * @param [type] $campeonato [description]
 */
function Array_Get_Partidos_Campeonato_DobleEstado($estado,$estado1,$campeonato)
{
    $query = consultar("SELECT * FROM tb_partidos WHERE (equipo1 IN (select id_equipo from tb_equipos where torneo='$campeonato' ) and equipo2  IN (select id_equipo from tb_equipos where torneo='$campeonato' )) and (estado='$estado'or estado='$estado1')");
    $vector    = array();
    while ($valor = mysqli_fetch_array($query)) {
        $arreglo = Get_Partido($valor['id_partido']);
        array_push($vector, $arreglo);
    }
    
    return $vector;
}
/**
 * [Array_Get_Partidos_Campeonato_Diferente description]
 * @param [type] $estado     [description]
 * @param [type] $campeonato [description]
 */
function Array_Get_Partidos_Campeonato_Diferente($estado,$campeonato)
{
    $query = consultar("SELECT * FROM tb_partidos WHERE (equipo1 IN (select id_equipo from tb_equipos where torneo='$campeonato' ) and equipo2  IN (select id_equipo from tb_equipos where torneo='$campeonato' )) and estado!='$estado' ");
    $vector    = array();
    while ($valor = mysqli_fetch_array($query)) {
        $arreglo = Get_Partido($valor['id_partido']);
        array_push($vector, $arreglo);
    }
    
    return $vector;
}
/**
 * [Array_Get_Partidos_Estado Partidos en un estado especifico]
 * @param [type] $estado [Codigo del estado]
 */
function Array_Get_Partidos_Estado($estado)
{
    $query = consultar("SELECT * FROM tb_partidos WHERE estado='$estado' ORDER BY fecha ASC ");
    $vector    = array();
    while ($valor = mysqli_fetch_array($query)) {
        $arreglo = Get_Partido($valor['id_partido']);
        array_push($vector, $arreglo);
    }
    
    return $vector;
}
/**
 * [Set_resultado_Partido description]
 * @param [type] $partido    [description]
 * @param [type] $resultado1 [description]
 * @param [type] $resultado2 [description]
 * @param [type] $estado     [description]
 */
function Set_resultado_Partido($partido,$resultado1,$resultado2,$estado)
{
    $valor  = modificar(sprintf("UPDATE `tb_partidos` SET `resultado1`='%d',`resultado2`='%d',`estado`='%d' 
        WHERE `id_partido`='%d' ",escape($resultado1),escape($resultado2),escape($estado),escape($partido)));
    return $valor;
}

function Set_tiporesultado_Partido($partido,$tiporesultado)
{
    $valor  = modificar(sprintf("UPDATE `tb_partidos` SET tipo_resultado ='%d'
        WHERE `id_partido`='%d' ",escape($tiporesultado),escape($partido)));
    return $valor;
}
function Set_resultado_Partido_Amonestaciones($partido,$estado)
{
    $valor  = modificar(sprintf("UPDATE `tb_partidos` SET `estado`='%d' 
        WHERE `id_partido`='%d' ",escape($estado),escape($partido)));
    return $valor;
}

/**
 * [Add_detalle_jugador description]
 * @param [type] $jugador      [description]
 * @param [type] $partido      [description]
 * @param [type] $amonestacion [description]
 * @param [type] $gol          [description]
 * @param [type] $autogol      [description]
 */
function Add_detalle_jugador($jugador,$partido,$amonestacion,$gol,$autogol)
{
    $valor  = insertar(sprintf("INSERT INTO `tr_jugadoresxpartido`(`jugador`, `partido`, `amonestacion`, `goles`, `autogoles`)
     VALUES ('%d','%d','%d','%d','%d') ",escape($jugador),escape($partido),escape($amonestacion),escape($gol),escape($autogol)));
    return $valor;
}
/**
 * [Set_detalle_jugador description]
 * @param [type] $jugador [description]
 * @param [type] $partido [description]
 * @param [type] $gol     [description]
 * @param [type] $autogol [description]
 */
function Set_detalle_jugador($jugador,$partido,$gol,$autogol)
{
    $valor  = insertar(sprintf("UPDATE `tr_jugadoresxpartido` SET `goles`='%d',`autogoles`='%d' WHERE jugador='%d' and partido='%d' ",escape($gol),escape($autogol),escape($jugador),escape($partido)));
    return $valor;
}
/**
 * [Boolean_Jugadorxpartido description]
 * @param [type] $jugador [description]
 * @param [type] $partido [description]
 */
function Boolean_Jugadorxpartido($jugador,$partido)
{
    $query = consultar("SELECT * FROM  `tr_jugadoresxpartido` WHERE `jugador`='$jugador' and `partido`='$partido' ");

    return (Int_consultaVacia($query)>0) ? true : false ;
}
/**
 * [Array_Get_Datos_Partido description]
 * @param [type] $partido [description]
 */
function Array_Get_Datos_Partido($partido)
{
    $query = consultar("SELECT * FROM  `tr_jugadoresxpartido` WHERE  `partido`='$partido' "); 
    $datos = array();
    while ($valor = mysqli_fetch_array($query)) {
        $jugador = $valor['jugador'];
        $partido = $valor['partido'];
        $goles = $valor['goles'];
        $autogoles = $valor['autogoles'];
        $vector = array(
            'jugador'=>"$jugador",
            'partido' => "$partido",
            'goles' => "$goles",
            'autogoles' => "$autogoles",
            );
        array_push($datos, $vector);
    }

    return $datos;   
}
/**
 * [Add_detalles_partido description]
 * @param [type] $vector  [description]
 * @param [type] $partido [description]
 */
function Add_detalles_partido($vector,$partido)
{
    $json = json_decode($vector);
    $bandera ='';
    for ($i=0; $i < count($json) ; $i++) {

        if(Boolean_Jugadorxpartido($json[$i][0],$partido))
        {
            if(Set_detalle_jugador($json[$i][0],$partido,$json[$i][1],$json[$i][2]))
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
            if(Add_detalle_jugador($json[$i][0],$partido,$json[$i][3],$json[$i][1],$json[$i][2]))
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

function Array_Get_fechas_terminadas($torneo)
{
$query = consultar("SELECT  distinct numero_fecha FROM tb_partidos,tb_equipos WHERE tb_partidos.estado='2' 
and ((tb_equipos.id_equipo=tb_partidos.equipo1) or (tb_equipos.id_equipo=tb_partidos.equipo2)) 
and tb_equipos.torneo='$torneo' "); 
    $datos = array();
    while ($valor = mysqli_fetch_array($query)) {
        $numero_fecha = $valor['numero_fecha'];
        $vector = array(
            'numero_fecha'=>"$numero_fecha"
            );
        array_push($datos, $vector);
    }

    return $datos; 
}
function Array_Get_Gestion_Amonestaciones($estado)
{
    $query = consultar("SELECT * FROM tb_partidos WHERE estado!='$estado' and estado!='6' ORDER BY fecha ASC ");
    $vector    = array();
    while ($valor = mysqli_fetch_array($query)) {
        $arreglo = Get_Partido($valor['id_partido']);
        array_push($vector, $arreglo);
    }
    
    return $vector;
}



////////////////////////////////////////////////////////////////////
//////////////////////----ESTADOS----//////////////////////////////
//////////////////////////////////////////////////////////////////
///
/**
 * [Get_NombreEstado_Partido Nombres de los estados de un partido]
 * @param [type] $identificador [Codigo del estado]
 */
function Get_NombreEstado_Partido($identificador)
{
    global $conexion;
    $valor = mysqli_fetch_array(consultar("SELECT *
      FROM tb_estados_partido WHERE id_estado=$identificador"));
    
    return $valor['nombre'];
}
/**
 * [Array_Get_Estados Obtiene los estados de los partidos]
 */
function Array_Get_Estados()
{
    $lugares = consultar("SELECT * FROM tb_estados_partido WHERE id_estado!='6'");  
    $datos = array();
    while ($valor = mysqli_fetch_array($lugares)) {
        $id_estado = $valor['id_estado'];
        $nombre       = $valor['nombre'];
        $vector = array(
            'id_estado'=>"$id_estado",
            'nombre' => "$nombre",
            );
        array_push($datos, $vector);
    }

    return $datos;  
}

/////////////////////////////////////////////////////////////
/////////////////////--CANCHAS-/////////////////////////////
//////////////////////////////////////////////////////////

/**
 * [Array_Get_Lugares Obtiene los nombres de las canchas del campeonato]
 */
function Array_Get_Lugares()
{
    $lugares = consultar("SELECT * FROM tb_lugares ");  
    $datos = array();
    while ($valor = mysqli_fetch_array($lugares)) {
        $id_lugares = $valor['id_lugar'];
        $nombre       = $valor['nombre'];
        $vector = array(
            'id_lugares'=>"$id_lugares",
            'nombre' => "$nombre",
            );
        array_push($datos, $vector);
    }

    return $datos;  
}
/**
 * [Get_NombreCancha Obtiene el nombre de la cancha]
 * @param [type] $identificador [Codigo del lugar]
 */
function Get_NombreCancha($identificador)
{
    global $conexion;
    $valor = mysqli_fetch_array(consultar("SELECT nombre
      FROM tb_lugares WHERE id_lugar=$identificador"));
    
    return $valor['nombre'];
}

//////////////////////////////////////////////////////////////
///////////////// TIPO RESULTADO /////////////////////////////
/////////////////////////////////////////////////////////////

function Array_Get_tipo_Resultado()
{
    $lugares = consultar("SELECT * FROM tb_tiporesultado where estado='activo'");  
    $datos = array();
    while ($valor = mysqli_fetch_array($lugares)) {
        $id_tiporesultado = $valor['id_tiporesultado'];
        $texto       = $valor['texto'];
        $vector = array(
            'id_tiporesultado'=>"$id_tiporesultado",
            'texto' => "$texto",
            );
        array_push($datos, $vector);
    }

    return $datos;  
}
?>
