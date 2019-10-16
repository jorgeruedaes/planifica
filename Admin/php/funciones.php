<?php
// Recibe : id del equipo 
// Retorna : Nombre del equipo.
function NombreEquipo($identificador)
{
    global $conexion;
    $valor = mysqli_fetch_array(mysqli_query($conexion, "SELECT nombre_equipo 
        FROM tb_equipos WHERE id_equipo=$identificador"));
    $valor = $valor['nombre_equipo'];
    
    return $valor;
}function ObtenerCanchasDePartidos($estado)
{

    global $conexion;
    $valor = mysqli_query($conexion, "SELECT DISTINCT part.fecha, lug.nombre, lug.id_lugar FROM `tb_lugares` lug, tb_partidos part WHERE part.fecha IN (SELECT fecha FROM tb_partidos where estado='$estado' AND part.lugar = lug.id_lugar  AND part.fecha >= curdate()) ORDER BY lug.nombre asc, MONTH(part.fecha) asc, DAY(part.fecha) asc");
    $datos = array();
    while ($informacion = mysqli_fetch_array($valor)) {
        $cancha  = $informacion['nombre'];
        $fecha = $informacion['fecha'];
        $idcancha = $informacion['id_lugar'];
        $vector = array(
            'cancha' => "$cancha",
            'fecha' => "$fecha",
            'idcancha' => "$idcancha",
            );
        array_push($datos, $vector);
    }
    
    return $datos;
}
function ObtenerPartidosPorCanchaFecha($idcancha,$fecha,$estado)
{

    global $conexion;
    $valor = mysqli_query($conexion, "SELECT equipo1, equipo2, hora,id_partido, fecha, lugar FROM `tb_partidos` WHERE lugar='$idcancha' AND fecha='$fecha' AND estado='$estado'
        AND fecha >= curdate() ORDER BY hora asc");
    $datos = array();
    while ($informacion = mysqli_fetch_array($valor)) {
        $equipo1  = $informacion['equipo1'];
        $equipo2 = $informacion['equipo2'];
        $hora = $informacion['hora'];
        $fecha = $informacion['fecha'];
        $lugar = $informacion['lugar'];
        $idpartido = $informacion['id_partido'];
        $vector = array(
            'equipo1' => "$equipo1",
            'equipo2' => "$equipo2",
            'hora' => "$hora",
            'fecha' => "$fecha",
            'lugar' => "$lugar",
            'idpartido' => "$idpartido",
            );
        array_push($datos, $vector);
    }
    
    return $datos;
}

function NombreEquipoJugador($jugador)
{
    global $conexion;
    $valor = mysqli_fetch_array(mysqli_query($conexion, "SELECT eq.nombre_equipo FROM tb_equipos eq, tb_jugadores jug WHERE eq.id_equipo=jug.equipo AND 
        jug.id_jugadores ='$jugador'"));
    $valor = $valor['nombre_equipo'];
    
    return $valor;
}

function ComentarioAmonestacion($jugador,$partido)
{
    global $conexion;
    $valor = mysqli_fetch_array(mysqli_query($conexion, "SELECT comentario FROM tr_amonestacionesxjugador WHERE jugador='$jugador' AND partido='$partido'"));
    $valor = $valor['comentario'];
    
    return $valor;
}
// Recibe : id de cancha
// Retorna : Nombre de cancha.
function NombreCancha($identificador)
{
    global $conexion;
    $valor = mysqli_fetch_array(mysqli_query($conexion, "SELECT nombre 
      FROM tb_lugares WHERE id_lugar=$identificador"));
    $valor = $valor['nombre'];
    
    return $valor;
}

function NombreClub($identificador)
{
    global $conexion;
    $valor = mysqli_fetch_array(mysqli_query($conexion, "SELECT nombre 
      FROM tb_colegio WHERE id_colegio=$identificador"));
    $valor = $valor['nombre'];
    
    return $valor;
}
function NombreTorneo($identificador)
{
    global $conexion;
    $valor = mysqli_fetch_array(mysqli_query($conexion, "SELECT nombre_torneo
      FROM tb_torneo WHERE id_torneo=$identificador"));
    $valor = $valor['nombre_torneo'];
    
    return $valor;
}
function TipoTorneo($identificador)
{
    global $conexion;
    $valor = mysqli_fetch_array(mysqli_query($conexion, "SELECT tipo
      FROM tb_torneo WHERE id_torneo=$identificador"));
    $valor = $valor['tipo'];
    
    return $valor;
}
function ReglamentoTorneo($identificador)
{
    global $conexion;
    $valor = mysqli_fetch_array(mysqli_query($conexion, "SELECT reglamento
      FROM tb_torneo WHERE id_torneo=$identificador"));
    $valor = $valor['reglamento'];
    
    return $valor;
}

function LogoClub($identificador)
{
    global $conexion;
    $valor = mysqli_fetch_array(mysqli_query($conexion, "SELECT logo 
      FROM tb_colegio WHERE id_colegio=$identificador"));
    $valor = $valor['logo'];
    
    return $valor;
}
function ClubEquipo($id_equipo)
{
    global $conexion;
    $valor = mysqli_fetch_array(mysqli_query($conexion, "SELECT colegio 
      FROM tb_equipos WHERE id_equipo=$id_equipo"));
    $valor = $valor['colegio'];
    
    return $valor;
}
function DireccionClub($identificador)
{
    global $conexion;
    $valor = mysqli_fetch_array(mysqli_query($conexion, "SELECT direccion 
      FROM tb_colegio WHERE id_colegio=$identificador"));
    $valor = $valor['direccion'];
    
    return $valor;
}
function TelefonoClub($identificador)
{
    global $conexion;
    $valor = mysqli_fetch_array(mysqli_query($conexion, "SELECT telefono 
      FROM tb_colegio WHERE id_colegio=$identificador"));
    $valor = $valor['telefono'];
    
    return $valor;
}
function CorreoClub($identificador)
{
    global $conexion;
    $valor = mysqli_fetch_array(mysqli_query($conexion, "SELECT correo 
      FROM tb_colegio WHERE id_colegio=$identificador"));
    $valor = $valor['correo'];
    
    return $valor;
}
function NombrePresidenteClub($identificador)
{
    global $conexion;
    $valor = mysqli_fetch_array(mysqli_query($conexion, "SELECT presidente 
      FROM tb_colegio WHERE id_colegio=$identificador"));
    $valor = $valor['presidente'];
    
    return $valor;
}
function CanchaClub($identificador)
{
    global $conexion;
    $valor = mysqli_fetch_array(mysqli_query($conexion, "SELECT cancha_entrenamiento 
      FROM tb_colegio WHERE id_colegio=$identificador"));
    $valor = $valor['cancha_entrenamiento'];
    
    return $valor;
}
function HorarioClub($identificador)
{
    global $conexion;
    $valor = mysqli_fetch_array(mysqli_query($conexion, "SELECT horario 
      FROM tb_colegio WHERE id_colegio=$identificador"));
    $valor = $valor['horario'];
    
    return $valor;
}
// Recibe : Hora
// Retorna : 3:30 pm formato de hora .
function FormatoHora($hora)
{
    $valor = date("g", strtotime($hora)) . ":" . date("i", strtotime($hora)) . " " . date("a", strtotime($hora));
    
    return $valor;
}
// Recibe : Fecha 2016-05-12
// Retorna : 12 de Mayo .
function FormatoFecha($fecha)
{
    $meses = array(
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre"
        );
    $valor = date("d", strtotime($fecha)) . " de " . $meses[date("m", strtotime($fecha)) - 1];
    
    return $valor;
}
function FormatoFecha_Dia($fecha)
{
    $dias = array(
        "Domingo",
        "Lunes",
        "Martes",
        "Miercoles",
        "Jueves",
        "Viernes",
        "Sabado"
        );
    $valor = $dias[date("w", strtotime($fecha))];
    
    return $valor;
}


function Int_Total_Equipos(){

    global $conexion;
    $valor = mysqli_fetch_array(mysqli_query($conexion, "SELECT COUNT(*) 
      AS totalequipos FROM tb_equipos"));
    $totalequipos= $valor['totalequipos'];
    
    return $totalequipos;
}

function Int_Total_Jugadores($estado){

    global $conexion;
    $valor = mysqli_fetch_array(mysqli_query($conexion, "SELECT COUNT(*) 
      AS totaljugadores FROM tb_jugadores WHERE estado_jugador='$estado'"));
    $totaljugadores= $valor['totaljugadores'];
    
    return $totaljugadores;
}

function Int_Total_Partidos($estado){

    global $conexion;
    $valor = mysqli_fetch_array(mysqli_query($conexion, "SELECT COUNT(*) 
      AS totalpartidos FROM tb_partidos WHERE Estado='$estado'"));
    $totalpartidos= $valor['totalpartidos'];
    
    return $totalpartidos;
}

function Int_Total_Goles(){

    global $conexion;
    $valor = mysqli_fetch_array(mysqli_query($conexion, "SELECT 
        SUM(resultado1) + SUM(resultado2) AS totalgoles from tb_partidos"));
    $totalgoles= $valor['totalgoles'];
    
    return $totalgoles;
    
}

// Recibe : id del partido 
// Retorna : Infomacion del paritdo en un array
function DatosPartido($identificador)
{
    global $conexion;
    $valor      = mysqli_fetch_array(mysqli_query($conexion, "SELECT * 
      FROM tb_partidos WHERE id_partido=$identificador"));
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
// Recibe : id de equipo
// Retorna : retorna un array con los jugadores del equipo de cancha.
function ObtenerJugadoresEquipo($identificador)
{
    global $conexion;
    $jugadores = mysqli_query($conexion, "SELECT *FROM tb_jugadores WHERE equipo=$identificador ORDER BY fecha_nacimiento desc");
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

function ObtenerNoticias($orden,$limite)
{
    global $conexion;
    $valor = mysqli_query($conexion, "SELECT * FROM tb_noticias WHERE fecha <= curdate()
        ORDER BY fecha $orden Limit $limite ");
    $datos = array();
    while ($informacion = mysqli_fetch_array($valor)) {
        $id  = $informacion['id_noticias'];
        $titulo = $informacion['titulo'];
        $texto  = $informacion['texto'];
        $imagen  = $informacion['imagen'];
        $torneo  = $informacion['torneo'];
        $fecha  = $informacion['fecha'];
        $encabezado  = $informacion['emcabezado'];
        $vector = array(
            'id' => "$id",
            'titulo' => "$titulo",
            'texto' => "$texto",
            'imagen' => "$imagen",
            'torneo' => "$torneo",
            'fecha' => "$fecha",
            'encabezado' => "$encabezado"
            );
        array_push($datos, $vector);
    }
    
    return $datos;
}
function ObtenerNoticia($id)
{
    global $conexion;
    $valor = mysqli_query($conexion, "SELECT * FROM tb_noticias
        WHERE id_noticias='$id'");
    $datos = array();
    while ($informacion = mysqli_fetch_array($valor)) {
        $id  = $informacion['id_noticias'];
        $titulo = $informacion['titulo'];
        $texto  = $informacion['texto'];
        $imagen  = $informacion['imagen'];
        $torneo  = $informacion['torneo'];
        $fecha  = $informacion['fecha'];
        $vector = array(
            'id' => "$id",
            'titulo' => "$titulo",
            'texto' => "$texto",
            'imagen' => "$imagen",
            'torneo' => "$torneo",
            'fecha' => "$fecha"
            );
        array_push($datos, $vector);
    }
    
    return $datos;
}
// Recibe : id de equipo
// Retorna : retorna un array con los jugadores del equipo de cancha.
function Array_Jugadores_Equipo($identificador)
{
    global $conexion;
    $jugadores = mysqli_query($conexion, "SELECT *FROM tb_jugadores WHERE equipo=$identificador ORDER BY nombre1 desc");
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
// Recibe : id del jugador 
// Retorna : Primer nombre y primer apellido.
function ObtenerNombreCompletoJugador($identificador)
{
    global $conexion;
    $valor = mysqli_fetch_array(mysqli_query($conexion, "SELECT nombre1,apellido1 
      FROM tb_jugadores WHERE id_jugadores=$identificador"));
    $valor = $valor['nombre1'] . " " . $valor['apellido1'];
    ;
    
    return $valor;
}
function ObtenerComunicados($tipo)
{
    global $conexion;
    $comunicados = mysqli_query($conexion, "SELECT *
      FROM tb_comunicados WHERE tipo='$tipo' AND fecha <= curdate() ORDER BY fecha desc");
    $vector    = array();
    while ($valor = mysqli_fetch_array($comunicados)) {
        $id   = $valor['id_comunicados'];
        $tipo  = $valor['tipo'];
        $comunicado = $valor['comunicado'];
        $fecha = $valor['fecha'];
        $titulo = $valor['titulo'];
        $datos            = array(
           'id' => "$id",
           'tipo' => "$tipo",
           'comunicado' => "$comunicado",
           'fecha' => "$fecha",
           'titulo' => "$titulo"

           );
        array_push($vector, $datos);
    }
    
    return $vector;
}

// Recibe : id del jugador 
// Retorna : Nombre completo.
function Obtener_Nombre_Jugador($identificador)
{
    global $conexion;
    $valor = mysqli_fetch_array(mysqli_query($conexion, "SELECT nombre1,nombre2,apellido1 
      ,apellido2  FROM tb_jugadores WHERE id_jugadores=$identificador"));
    $valor = $valor['nombre1'] ." ". $valor['nombre2'] ." " . $valor['apellido1']." ".$valor['apellido2'];
    ;
    
    return $valor;
}

// Recibe : Id del equipo 
// Retorna : Array con los datos del equipo.
function ObtenerEquipo($identificador)
{
    global $conexion;
    $valor         = mysqli_fetch_array(mysqli_query($conexion, "SELECT * 
      FROM tb_equipos WHERE id_equipo=$identificador ORDER BY nombre_equipo desc"));
    $nombre_equipo = $valor['nombre_equipo'];
    $puntos        = $valor['puntos'];
    $tecnico1      = $valor['tecnico1'];
    $tecnico2      = $valor['tecnico2'];
    $imagen_equipo = $valor['imagen_escudo'];
    
    return array(
        "nombre_equipo" => "$nombre_equipo",
        "puntos" => "$puntos",
        "tecnico1" => "$tecnico1",
        "tecnico2" => "$tecnico2",
        "imagen_equipo" => "$imagen_equipo",
        "id_equipo" => "$identificador"
        );
}
// Recibe : Id del jugador
// Retorna : Numero con partidos asistidos por un jugador.
function ObtenerPartidosAsistidos($identificador)
{
    global $conexion;
    $valor = mysqli_num_rows(mysqli_query($conexion, "SELECT jugador FROM tr_jugadoresxpartido WHERE jugador=$identificador and partido In (SELECT id_partido FROM tb_partidos WHERE Estado=2)  "));
    
    return $valor;
}
// Recibe : Id del jugador 
// Retorna : Infomacion del jugador en un array
function ObtenerDatosJugador($identificador)
{
    global $conexion;
    $valor            = mysqli_fetch_array(mysqli_query($conexion, "SELECT * 
      FROM tb_jugadores WHERE id_jugadores=$identificador"));
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
    
    return $datos;
}
// Recibe : Id equipo
// Retorna : Grupo de goleadores en un array
function ObtenerGoleadoresEquipo($equipo)
{
    global $conexion;
    $valor = mysqli_query($conexion, "SELECT jugador,SUM(goles) AS numero from tr_jugadoresxpartido WHERE goles!=0 and partido IN(SELECT id_partido FROM tb_partidos WHERE Estado=2) and jugador IN (SELECT id_jugadores FROM tb_jugadores WHERE equipo=$equipo) GROUP BY jugador order by numero desc");
    $datos = array();
    while ($informacion = mysqli_fetch_array($valor)) {
        $jugador = $informacion['jugador'];
        $goles   = $informacion['numero'];
        $vector  = array(
            'jugador' => "$jugador",
            'goles' => "$goles"
            );
        array_push($datos, $vector);
    }
    
    return $datos;
}
// Recibe un limite para la consulta.
// Retorna : Tabla de posiciones en  un array
function ObtenerTablaPosiciones($limite,$grupo,$torneo)
{
    global $conexion;
    Generar_Tabla_De_Posiciones($torneo);
    $valor = mysqli_query($conexion, "SELECT * FROM te_posiciones WHERE grupo='$grupo' order by  puntos desc, pg desc,gf desc,gc asc ,dg desc limit $limite");
    $datos = array();
    while ($informacion = mysqli_fetch_array($valor)) {
        $equipo = $informacion['equipo'];
        $puntos = $informacion['puntos'];
        $pj     = $informacion['pj'];
        $pg     = $informacion['pg'];
        $pe     = $informacion['pe'];
        $pp     = $informacion['pp'];
        $gf     = $informacion['gf'];
        $gc     = $informacion['gc'];
        $dg     = $informacion['dg'];
        $grupo     = $informacion['grupo'];
        $id     = $informacion['id'];
        $vector = array(
            'equipo' => "$equipo",
            'puntos' => "$puntos",
            'pj' => "$pj",
            'pg' => "$pg",
            'pe' => "$pe",
            'pp' => "$pp",
            'gf' => "$gf",
            'gc' => "$gc",
            'id' => "$id",
            'grupo' => "$grupo",
            'dg' => "$dg"
            );
        array_push($datos, $vector);
    }
    
    return $datos;
}

function ObtenerGoleadoresTorneo($torneo,$grupo,$limite)
{
    global $conexion;
    $valor = mysqli_query($conexion, "SELECT jugador,SUM(goles) AS goles1, id_equipo FROM tr_jugadoresxpartido,tb_jugadores,tb_equipos 
        WHERE goles>=1 AND jugador=id_jugadores AND equipo=id_equipo and partido IN (SELECT id_partido FROM 
            tb_partidos WHERE Estado=2) and tb_equipos.torneo='$torneo' and tb_equipos.grupo='$grupo' GROUP BY jugador ORDER BY `goles1` DESC, 
    nombre_equipo asc LIMIT $limite");
    $datos = array();
    while ($informacion = mysqli_fetch_array($valor)) {
        $jugador = $informacion['jugador'];
        $goles1 = $informacion['goles1'];
        $id_equipo  = $informacion['id_equipo'];
        $vector = array(
            'jugador' => "$jugador",
            'goles' => "$goles1",
            'idequipo' => "$id_equipo",
            );
        array_push($datos, $vector);
    }
    
    return $datos;
}

function ObtenerVallaMenosVencidaTorneo($torneo)
{
    global $conexion;
    $valor = mysqli_query($conexion, "SELECT equipo,gc FROM te_posiciones,tb_equipos 
        WHERE tb_equipos.id_equipo=te_posiciones.id AND te_posiciones.grupo='$torneo' order by gc asc");
    $datos = array();
    while ($informacion = mysqli_fetch_array($valor)) {
        $equipo = $informacion['equipo'];
        $goles = $informacion['gc'];
        $vector = array(
            'equipo' => "$equipo",
            'goles' => "$goles",
            );
        array_push($datos, $vector);
    }
    
    return $datos;
}
function ObtenerAmonestacionesTorneo($torneo)
{
    global $conexion;
    $valor = mysqli_query($conexion, "SELECT jugador,amonestacion,comentario
        FROM tr_amonestacionesxjugador,tb_jugadores,tb_equipos
        WHERE estado_amonestacion='1' 
        AND amonestacion!=5 
        and tb_jugadores.id_jugadores=tr_amonestacionesxjugador.jugador
        and tb_equipos.id_equipo=tb_jugadores.equipo
        and tb_equipos.torneo='$torneo'");
    $datos = array();
    while ($informacion = mysqli_fetch_array($valor)) {
        $jugador = $informacion['jugador'];
        $amonestacion = $informacion['amonestacion'];
        $comentario = $informacion['comentario'];
        $vector = array(
            'jugador' => "$jugador",
            'amonestacion' => "$amonestacion",
            'comentario' => "$comentario",
            );
        array_push($datos, $vector);
    }
    
    return $datos;
}
// Recibe : Estado de los partidos y orden.
// Retorna : Array con diferentes fechas.
function ObtenerFechasdePartidos($estado, $orden)
{
    global $conexion;
    $valor = mysqli_query($conexion, "SELECT DISTINCT fecha,nombre,Lugar 
       FROM `tb_partidos`,tb_lugares WHERE tb_partidos.Estado=$estado and id_lugar=Lugar  and fecha>=curdate()
       ORDER BY fecha $orden ,Lugar asc ,hora asc");
    $datos = array();
    while ($informacion = mysqli_fetch_array($valor)) {
        $fecha  = $informacion['fecha'];
        $nombre = $informacion['nombre'];
        $lugar  = $informacion['Lugar'];
        $vector = array(
            'fecha' => "$fecha",
            'nombre' => "$nombre",
            'lugar' => "$lugar"
            );
        array_push($datos, $vector);
    }
    
    return $datos;
}
// Recibe : Estado de los partidos, orden y el equipos.
// Retorna : Array con diferentes fechas.
function ObtenerFechasdePartidosDeUnEquipo($estado, $orden, $equipo)
{
    global $conexion;
    $valor = mysqli_query($conexion, "SELECT DISTINCT fecha,nombre,Lugar 
       FROM `tb_partidos`,tb_lugares WHERE Estado=$estado and id_lugar=Lugar 
       and   (equipo1=$equipo OR equipo2=$equipo)
       ORDER BY Lugar asc,fecha $orden ,hora asc");
    $datos = array();
    while ($informacion = mysqli_fetch_array($valor)) {
        $fecha  = $informacion['fecha'];
        $nombre = $informacion['nombre'];
        $lugar  = $informacion['Lugar'];
        $vector = array(
            'fecha' => "$fecha",
            'nombre' => "$nombre",
            'lugar' => "$lugar"
            );
        array_push($datos, $vector);
    }
    
    return $datos;
}

// Recibe: Deporte 
// Retorna: Array con torneos del deporte
function ObtenerTorneosPorDeporte($deporte,$estado){

    global $conexion;
    $valor = mysqli_query($conexion, "SELECT id_torneo, nombre_torneo
       FROM tb_torneo WHERE deporte='$deporte' and estado='$estado' ORDER BY RAND()");
    $datos = array();
    while ($informacion = mysqli_fetch_array($valor)) {
        $id  = $informacion['id_torneo'];
        $nombre = $informacion['nombre_torneo'];
        $vector = array(
            'id' => "$id",
            'nombre' => "$nombre",
            );
        array_push($datos, $vector);
    }
    
    return $datos;

}
function ObtenerTorneosPorDeporteOrdenado($deporte,$estado){

    global $conexion;
    $valor = mysqli_query($conexion, "SELECT id_torneo, nombre_torneo
       FROM tb_torneo WHERE deporte='$deporte' and estado='$estado' ORDER BY id_torneo asc");
    $datos = array();
    while ($informacion = mysqli_fetch_array($valor)) {
        $id  = $informacion['id_torneo'];
        $nombre = $informacion['nombre_torneo'];
        $vector = array(
            'id' => "$id",
            'nombre' => "$nombre",
            );
        array_push($datos, $vector);
    }
    
    return $datos;

}
function CategoriaEquipo($idequipo)
{
    global $conexion;
    $valor = mysqli_fetch_array(mysqli_query($conexion, "SELECT nombre_torneo from tb_torneo WHERE id_torneo in (Select torneo from tb_equipos where id_equipo='$idequipo')"));
    $valor = $valor['nombre_torneo'];
    
    return $valor;
}
function ObtenerPartidosPorJugarByCancha($estado){

    global $conexion;
    $valor = mysqli_query($conexion, "SELECT lug.nombre, part.id_partido, part.equipo1, part.equipo2, part.fecha, part.hora, part.Lugar, part.resultado1, part.resultado2 FROM tb_partidos part INNER JOIN tb_lugares lug ON lug.id_lugar = part.lugar WHERE part.estado='$estado' and part.equipo1 IN (select id_equipo from tb_equipos) AND part.equipo2 IN (select id_equipo from tb_equipos) AND part.fecha >= curdate() ORDER BY lug.nombre asc,MONTH(part.fecha) asc, DAY(part.fecha) asc, part.hora asc");
    $datos = array();
    while ($informacion = mysqli_fetch_array($valor)) {
        $idpartido  = $informacion['id_partido'];
        $equipo1    = $informacion['equipo1'];
        $equipo2    = $informacion['equipo2'];
        $fecha      = $informacion['fecha'];
        $hora       = $informacion['hora'];
        $lugar      = $informacion['Lugar'];
        $resultado1    = $informacion['resultado1'];
        $resultado2    = $informacion['resultado2'];
        $vector     = array(
            "idpartido" => "$idpartido",
            "equipo1" => "$equipo1",
            "equipo2" => "$equipo2",
            "fecha" => "$fecha",
            "hora" => "$hora",
            "lugar" => "$lugar",
            "resultado1" => "$resultado1",
            "resultado2" => "$resultado2",
            );
        array_push($datos, $vector);
    }
    
    return $datos;

}
function ObtenerCanchasOrdenado($estado){

    global $conexion;
    $valor = mysqli_query($conexion, "SELECT * FROM `tb_lugares` where estado='$estado' order by nombre asc");
    $datos = array();
    while ($informacion = mysqli_fetch_array($valor)) {
        $id  = $informacion['id_lugar'];
        $nombre = $informacion['nombre'];
        $vector = array(
            'id' => "$id",
            'nombre' => "$nombre",
            );
        array_push($datos, $vector);
    }
    
    return $datos;

}
function ObtenerTorneosDeClub($club,$estado){

    global $conexion;
    $valor = mysqli_query($conexion, "SELECT DISTINCT torneo FROM tb_equipos 
        WHERE colegio='$club' and estado='$estado'");
    $datos = array();
    while ($informacion = mysqli_fetch_array($valor)) {
        $id  = $informacion['torneo'];
        $vector = array(
            'id' => "$id",
            );
        array_push($datos, $vector);
    }
    
    return $datos;

}

// Recibe: Torneo y estado
// Retorna: Array con diferentes partidos de ese torneo y estado.
function ObtenerPartidosDeUnTorneo ($torneo, $estado){

    global $conexion;
    $valor = mysqli_query($conexion, "SELECT id_partido,equipo1, equipo2, fecha, hora, Lugar, 
      resultado1, resultado2 FROM tb_partidos WHERE estado='$estado' and equipo1 IN 
      (select id_equipo from tb_equipos where torneo='$torneo') AND
      equipo2 IN (select id_equipo from tb_equipos where torneo='$torneo')   
      ORDER BY fecha desc, hora asc ");
    $datos = array();
    while ($informacion = mysqli_fetch_array($valor)) {
        $idpartido  = $informacion['id_partido'];
        $equipo1    = $informacion['equipo1'];
        $equipo2    = $informacion['equipo2'];
        $fecha      = $informacion['fecha'];
        $hora       = $informacion['hora'];
        $lugar      = $informacion['Lugar'];
        $resultado1    = $informacion['resultado1'];
        $resultado2    = $informacion['resultado2'];
        $vector     = array(
            "idpartido" => "$idpartido",
            "equipo1" => "$equipo1",
            "equipo2" => "$equipo2",
            "fecha" => "$fecha",
            "hora" => "$hora",
            "lugar" => "$lugar",
            "resultado1" => "$resultado1",
            "resultado2" => "$resultado2",
            );
        array_push($datos, $vector);
    }
    
    return $datos;

}
function ObtenerPartidosPorJugarDeUnTorneo ($torneo, $estado){

    global $conexion;
    $valor = mysqli_query($conexion, "SELECT id_partido,equipo1, equipo2, fecha, hora, Lugar, 
      resultado1, resultado2 FROM tb_partidos WHERE estado='$estado' and equipo1 IN 
      (select id_equipo from tb_equipos where torneo='$torneo') AND
      equipo2 IN (select id_equipo from tb_equipos where torneo='$torneo')   
      AND fecha >= curdate()
      ORDER BY fecha asc, hora asc ");
    $datos = array();
    while ($informacion = mysqli_fetch_array($valor)) {
        $idpartido  = $informacion['id_partido'];
        $equipo1    = $informacion['equipo1'];
        $equipo2    = $informacion['equipo2'];
        $fecha      = $informacion['fecha'];
        $hora       = $informacion['hora'];
        $lugar      = $informacion['Lugar'];
        $resultado1    = $informacion['resultado1'];
        $resultado2    = $informacion['resultado2'];
        $vector     = array(
            "idpartido" => "$idpartido",
            "equipo1" => "$equipo1",
            "equipo2" => "$equipo2",
            "fecha" => "$fecha",
            "hora" => "$hora",
            "lugar" => "$lugar",
            "resultado1" => "$resultado1",
            "resultado2" => "$resultado2",
            );
        array_push($datos, $vector);
    }
    
    return $datos;

}
function ObtenerPartidosPorJugar($estado){

    global $conexion;
    $valor = mysqli_query($conexion, "SELECT id_partido,equipo1, equipo2, fecha, hora, Lugar, 
      resultado1, resultado2 FROM tb_partidos WHERE estado='$estado' and equipo1 IN 
      (select id_equipo from tb_equipos) AND
      equipo2 IN (select id_equipo from tb_equipos)   
      AND fecha >= curdate()
      ORDER BY fecha asc, hora asc ");
    $datos = array();
    while ($informacion = mysqli_fetch_array($valor)) {
        $idpartido  = $informacion['id_partido'];
        $equipo1    = $informacion['equipo1'];
        $equipo2    = $informacion['equipo2'];
        $fecha      = $informacion['fecha'];
        $hora       = $informacion['hora'];
        $lugar      = $informacion['Lugar'];
        $resultado1    = $informacion['resultado1'];
        $resultado2    = $informacion['resultado2'];
        $vector     = array(
            "idpartido" => "$idpartido",
            "equipo1" => "$equipo1",
            "equipo2" => "$equipo2",
            "fecha" => "$fecha",
            "hora" => "$hora",
            "lugar" => "$lugar",
            "resultado1" => "$resultado1",
            "resultado2" => "$resultado2",
            );
        array_push($datos, $vector);
    }
    
    return $datos;

}
function ObtenerPartidosPorJugarEnUnLugar($lugar,$estado){

    global $conexion;
    $valor = mysqli_query($conexion, "SELECT id_partido,equipo1, equipo2, fecha, hora, Lugar, 
      resultado1, resultado2 FROM tb_partidos,tb_lugares WHERE tb_partidos.estado='$estado' and equipo1 IN 
      (select id_equipo from tb_equipos) AND
      equipo2 IN (select id_equipo from tb_equipos)   
      AND fecha >= curdate() and tb_partidos.lugar=tb_lugares.id_lugar and id_lugar='$lugar'
      ORDER BY fecha asc, hora asc ");
    $datos = array();
    while ($informacion = mysqli_fetch_array($valor)) {
        $idpartido  = $informacion['id_partido'];
        $equipo1    = $informacion['equipo1'];
        $equipo2    = $informacion['equipo2'];
        $fecha      = $informacion['fecha'];
        $hora       = $informacion['hora'];
        $lugar      = $informacion['Lugar'];
        $resultado1    = $informacion['resultado1'];
        $resultado2    = $informacion['resultado2'];
        $vector     = array(
            "idpartido" => "$idpartido",
            "equipo1" => "$equipo1",
            "equipo2" => "$equipo2",
            "fecha" => "$fecha",
            "hora" => "$hora",
            "lugar" => "$lugar",
            "resultado1" => "$resultado1",
            "resultado2" => "$resultado2",
            );
        array_push($datos, $vector);
    }
    
    return $datos;

}
function ObtenerPartidosDeUnClub ($club, $torneo, $estado){

    global $conexion;
    $valor = mysqli_query($conexion, "SELECT * FROM tb_equipos, tb_partidos
        WHERE tb_equipos.colegio='$club' AND tb_equipos.torneo = '$torneo' AND 
        tb_partidos.estado='$estado' AND 
        (tb_equipos.id_equipo = tb_partidos.equipo1 OR tb_equipos.id_equipo = tb_partidos.equipo2)
        GROUP BY id_partido");
    $datos = array();
    while ($informacion = mysqli_fetch_array($valor)) {
        $idpartido  = $informacion['id_partido'];
        $equipo1    = $informacion['equipo1'];
        $equipo2    = $informacion['equipo2'];
        $fecha      = $informacion['fecha'];
        $hora       = $informacion['hora'];
        $lugar      = $informacion['lugar'];
        $resultado1    = $informacion['resultado1'];
        $resultado2    = $informacion['resultado2'];
        $vector     = array(
            "idpartido" => "$idpartido",
            "equipo1" => "$equipo1",
            "equipo2" => "$equipo2",
            "fecha" => "$fecha",
            "hora" => "$hora",
            "lugar" => "$lugar",
            "resultado1" => "$resultado1",
            "resultado2" => "$resultado2"
            );
        array_push($datos, $vector);
    }
    
    return $datos;

}
function ObtenerPartidosPorJugarDeUnClub ($club, $torneo, $estado){

    global $conexion;
    $valor = mysqli_query($conexion, "SELECT * FROM tb_equipos, tb_partidos
        WHERE tb_equipos.colegio='$club' AND tb_equipos.torneo = '$torneo' AND 
        tb_partidos.estado='$estado' AND 
        (tb_equipos.id_equipo = tb_partidos.equipo1 OR tb_equipos.id_equipo = tb_partidos.equipo2)
        AND tb_partidos.fecha >= curdate()
        GROUP BY id_partido");
    $datos = array();
    while ($informacion = mysqli_fetch_array($valor)) {
        $idpartido  = $informacion['id_partido'];
        $equipo1    = $informacion['equipo1'];
        $equipo2    = $informacion['equipo2'];
        $fecha      = $informacion['fecha'];
        $hora       = $informacion['hora'];
        $lugar      = $informacion['lugar'];
        $resultado1    = $informacion['resultado1'];
        $resultado2    = $informacion['resultado2'];
        $vector     = array(
            "idpartido" => "$idpartido",
            "equipo1" => "$equipo1",
            "equipo2" => "$equipo2",
            "fecha" => "$fecha",
            "hora" => "$hora",
            "lugar" => "$lugar",
            "resultado1" => "$resultado1",
            "resultado2" => "$resultado2"
            );
        array_push($datos, $vector);
    }
    
    return $datos;

}
// Recibe : Estado de los partidos y Fecha.
// Retorna : Array con diferentes partidos de ese estado y fecha.
function ObtenerPartidoDeUnaFecha($fecha, $estado, $lugar)
{
    global $conexion;
    $valor = mysqli_query($conexion, "SELECT * 
      FROM tb_partidos WHERE fecha='$fecha' and Lugar=$lugar
      and Estado=$estado   ORDER BY hora asc  ");
    $datos = array();
    while ($informacion = mysqli_fetch_array($valor)) {
        $id_partido = $informacion['id_partido'];
        $equipo1    = $informacion['equipo1'];
        $equipo2    = $informacion['equipo2'];
        $estado     = $informacion['estado'];
        $fecha      = $informacion['fecha'];
        $hora       = $informacion['hora'];
        $lugar      = $informacion['lugar'];
        $Nfecha     = $informacion['numero_fecha'];
        $resultado1 = $informacion['resultado1'];
        $resultado2 = $informacion['resultado2'];
        $vector     = array(
            "id_partido" => "$id_partido",
            "equipo1" => "$equipo1",
            "equipo2" => "$equipo2",
            "estado" => "$estado",
            "fecha" => "$fecha",
            "hora" => "$hora",
            "lugar" => "$lugar",
            "Nfecha" => "$Nfecha",
            "resultado1" => "$resultado1",
            "resultado2" => "$resultado2"
            );
        array_push($datos, $vector);
    }
    
    return $datos;
}

// Recibe : Estado de los partidos y orden.
// Retorna : Array con partidos en fechas dadas.
function ObtenerFechasdePartidosConFechas($estado, $orden, $menosdias, $masdias)
{
    $menosdias = ObtenerFechaModificada($menosdias);
    $masdias   = ObtenerFechaModificada($masdias);
    global $conexion;
    
    $valor = mysqli_query($conexion, "SELECT DISTINCT fecha,nombre,Lugar 
       FROM `tb_partidos`,tb_lugares WHERE Estado=$estado and id_lugar=Lugar 
       and fecha between '$menosdias' and '$masdias'  
       ORDER BY fecha $orden, Lugar asc,hora asc");
    $datos = array();
    while ($informacion = mysqli_fetch_array($valor)) {
        $fecha  = $informacion['fecha'];
        $nombre = $informacion['nombre'];
        $lugar  = $informacion['Lugar'];
        $vector = array(
            'fecha' => "$fecha",
            'nombre' => "$nombre",
            'lugar' => "$lugar"
            );
        array_push($datos, $vector);
    }
    
    return $datos;
}
//Recibe la fecha y los dias a agregar o quitar 
//Retorna una fecha +1 day o -1 day
function ObtenerFechaModificada($agregado)
{
    $fecha = date("Y-m-d");
    return date('Y-m-d', strtotime($agregado, strtotime($fecha)));
}
// Retorna : Los equipos con su informaciÃ³n
function ObtenerEquipos()
{
    global $conexion;
    
    $query = mysqli_query($conexion, "SELECT  * FROM tb_equipos ORDER BY nombre_equipo ASC ");
    $vector    = array();
    while ($valor = mysqli_fetch_array($query)) {
        $arreglo = ObtenerEquipo($valor['id_equipo']);
        array_push($vector, $arreglo);
    }
    
    return $vector;
}
// Recibe : Fecha de nacimiento
// Retorna : Carnet
function ObtenerCarnet($fechaNacimiento)
{
    $horanow  = date("Y-m-d");
    $edadreal = $horanow - $fechaNacimiento;
    if ($edadreal >= 40) {
        return 'verde.png';
    } elseif ($edadreal < 40 && $edadreal >= 35) {
        return 'azul.png';
    } elseif ($edadreal < 35 && $edadreal >= 32) {
        return 'rojo.png';
    } elseif ($edadreal < 32) {
        return 'amarillo.png';
    }
}
// Recibe : Codigo Tarjeta
// Retorna : Imagen tarjeta
function ObtenerTipoTarjeta($codigo)
{
    if ($codigo == 1) {
        return "<img src=\"images/amarilla.png\" style=\"width: 15px;\">";
    } elseif ($codigo == 2) {
        return "<img src=\"images/roja.png\" style=\"width: 15px;\">";
    } else {
        return "";
    }
    
}
//Recibe el equipo y un partido
// retorna lista de asistentes,goles y targetas.
function ObtenerPlanillaPartido($equipo, $partido)
{
    global $conexion;
    $consulta = mysqli_query($conexion, "SELECT * FROM `tr_jugadoresxpartido` WHERE jugador
      IN(SELECT id_jugadores FROM tb_jugadores WHERE equipo=$equipo) and partido=$partido");
    $datos    = array();
    while ($informacion = mysqli_fetch_array($consulta)) {
        $jugador      = $informacion['jugador'];
        $amonestacion = $informacion['amonestacion'];
        $partido = $informacion['partido'];
        $goles        = $informacion['goles'];
        $autogoles    = $informacion['autogoles'];
        $vector       = array(
            'jugador' => "$jugador",
            'amonestacion' => "$amonestacion",
            'goles' => "$goles",
            'autogoles' => "$autogoles",
            'partido' => "$partido"
            );
        array_push($datos, $vector);
    }
    
    return $datos;
}
// Recibe : Estado de los partidos,euipo y orden
// Retorna : Array con diferentes partidos de ese estado y fecha.
function ObtenerPartidoDeEquipo($estado, $equipo, $orden)
{
    global $conexion;
    $valor = mysqli_query($conexion, "SELECT * 
      FROM tb_partidos WHERE 
      Estado=$estado and (equipo1=$equipo or equipo2=$equipo) ORDER BY fecha $orden,hora asc ");
    $datos = array();
    while ($informacion = mysqli_fetch_array($valor)) {
        $id_partido = $informacion['id_partido'];
        $equipo1    = $informacion['equipo1'];
        $equipo2    = $informacion['equipo2'];
        $estado     = $informacion['Estado'];
        $fecha      = $informacion['fecha'];
        $hora       = $informacion['hora'];
        $lugar      = $informacion['Lugar'];
        $Nfecha     = $informacion['numero_fecha'];
        $resultado1 = $informacion['resultado1'];
        $resultado2 = $informacion['resultado2'];
        $vector     = array(
            "id_partido" => "$id_partido",
            "equipo1" => "$equipo1",
            "equipo2" => "$equipo2",
            "estado" => "$estado",
            "fecha" => "$fecha",
            "hora" => "$hora",
            "lugar" => "$lugar",
            "Nfecha" => "$Nfecha",
            "resultado1" => "$resultado1",
            "resultado2" => "$resultado2"
            );
        array_push($datos, $vector);
    }
    
    return $datos;
}

// Recibe : id del lugar
// Retorna : Nombre del lugar.
function ObtenerNombreCancha($identificador)
{
    global $conexion;
    $valor = mysqli_fetch_array(mysqli_query($conexion, "SELECT nombre
      FROM tb_lugares WHERE id_lugar=$identificador"));
    
    return $valor['nombre'];
}

// Recibe : IP
// Retorna : nada.
function ContadorVisitas($ipvisitante,$lugar)
{
    global $conexion;
    $valor = mysqli_query($conexion, "INSERT INTO `tb_contador`(`visitas`, `fecha`,`ip`,`lugar`) VALUES (NULL,NOW(),'$ipvisitante','$lugar')");
}
// Recibe : CargadordeImagenes
// Retorna : nada.
function CargarImagenes($valor)
{
    global $conexion;
    $valor = mysqli_query($conexion, "SELECT * 
      FROM tb_galeria where torneo!='100' and torneo='$valor' ORDER BY fecha desc");
    $datos = array();
    while ($informacion = mysqli_fetch_array($valor)) {
        $id_imagen = $informacion['codigo'];
        $imagen    = $informacion['imagen'];
        $vector    = array(
            "id_imagen" => "$id_imagen",
            "imagen" => "$imagen"
            );
        array_push($datos, $vector);
    }
    
    return $datos;
}

function Array_Get_Albums()
{
 global $conexion;
 $query = mysqli_query($conexion,"SELECT * FROM `tb_album` where estado='activo' and id_album!=100 order by fecha_creacion desc");
 $vector    = array();
 while ($valor = mysqli_fetch_array($query)) {

    $id_album = $valor['id_album'];
    $nombre = $valor['nombre'];


    $arreglo = array(
      'id_album'=>"$id_album",
      'nombre'=>"$nombre"

      );
    array_push($vector, $arreglo);
}

return $vector;
}
function ObtenerPrimeraImagen($identificador)
{
    global $conexion;
    $valor = mysqli_fetch_array(mysqli_query($conexion, "SELECT * 
      FROM tb_galeria where torneo!='100' and torneo='$identificador' ORDER BY fecha desc limit 1 "));
    
    return $valor['imagen'];
}
function CargarImagenes_Principal()
{
    global $conexion;
    $valor = mysqli_query($conexion, "SELECT * 
      FROM tb_galeria where torneo='100' ORDER BY fecha desc");
    $datos = array();
    while ($informacion = mysqli_fetch_array($valor)) {
        $id_imagen = $informacion['codigo'];
        $imagen    = $informacion['imagen'];
        $vector    = array(
            "id_imagen" => "$id_imagen",
            "imagen" => "$imagen"
            );
        array_push($datos, $vector);
    }
    
    return $datos;
}

// Establecer desde que dispositivo estamos navegando 
// para el manejo de publicidad.
function TipoNavegador()
{
    $tablet_browser = 0;
    $mobile_browser = 0;
    $body_class     = 'desktop';
    
    if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
        $tablet_browser++;
        $body_class = "tablet";
    }
    
    if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
        $mobile_browser++;
        $body_class = "mobile";
    }
    
    if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']), 'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
        $mobile_browser++;
        $body_class = "mobile";
    }
    
    $mobile_ua     = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
    $mobile_agents = array(
        'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac','blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno','ipaq','java',
        'jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-','maui','maxo','midp','mits','mmef','mobi','mot-','moto',
        'mwbp','nec-','newt','noki','palm','pana','pant','phil','play','port','prox','qwap','sage',
        'sams','sany','sch-','sec-','send','seri','sgh-','shar','sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
        'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp','wapr','webc','winw','winw','xda ','xda-'
        );
    
    if (in_array($mobile_ua, $mobile_agents)) {
        $mobile_browser++;
    }
    
    if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'opera mini') > 0) {
        $mobile_browser++;
        //Check for tablets on opera mini alternative headers
        $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA']) ? $_SERVER['HTTP_X_OPERAMINI_PHONE_UA'] : (isset($_SERVER['HTTP_DEVICE_STOCK_UA']) ? $_SERVER['HTTP_DEVICE_STOCK_UA'] : ''));
        if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
            $tablet_browser++;
        }
    }
    
    return array(
        $mobile_browser,
        $tablet_browser
        );
}

//Recibe el id del equipo para consultar los amonestado vigentes
//
// Retorna un array con los amonestados

function AmonestadoFechaeEquipo($equipo)
{
    global $conexion;
    $datos = array();
    $query = mysqli_query($conexion, "SELECT jugador,amonestacion from tr_amonestacionesxjugador WHERE estado_amonestacion='1' AND amonestacion!=5  and jugador IN ( SELECT id_jugadores FROM tb_jugadores WHERE equipo=$equipo ) ");
    while ($amonestados = mysqli_fetch_array($query)) {
        $jugador      = $amonestados['jugador'];
        $amonestacion = $amonestados['amonestacion'];
        $vector       = array(
            "jugador" => "$jugador",
            "amonestacion" => "$amonestacion"
            );
        
        array_push($datos, $vector);
    }
    
    
    return $datos;
}
// Obtener las diferentes fechas de los partidos que estan en estado 2 --- Termminados

function Array_ObtenerNumeroFechas($equipo, $estado)
{
    global $conexion;
    $fechas = mysqli_query($conexion, "SELECT  distinct numero_fecha FROM tb_partidos WHERE Estado=$estado AND (equipo1=$equipo or equipo2=$equipo)");
    $datos  = array();
    while ($valor = mysqli_fetch_array($fechas)) {
        $numero_fecha = $valor['numero_fecha'];
        $vector       = array(
            "numero_fecha" => "$numero_fecha"
            );
        array_push($datos, $vector);
    }
    
    return $datos;
}
// Obtiene los partidos asistidos por un jugador
//
function Int_PartidosAsistidos_Jugador($jugador)
{
    global $conexion;
    $calculo = mysqli_query($conexion, "SELECT * FROM tr_jugadoresxpartido  WHERE jugador=$jugador and partido IN (SELECT id_partido FROM tb_partidos WHERE Estado='2')");
    
    return mysqli_num_rows($calculo);
}
// Obtiene los partidos jugados por un jugador
//
function Int_PartidosJugados_Equipo($equipo)
{
    global $conexion;
    $calculo = mysqli_query($conexion, "SELECT * FROM tb_partidos WHERE  (equipo1=$equipo || equipo2 = $equipo) AND Estado='2'");
    
    return mysqli_num_rows($calculo);
}
// Obtiene los partidos que podria haber jugado dependiendo la fecha de ingreso por un jugador
//
function Int_PartidosPosibles_Jugador($equipo, $fechaingreso)
{
    global $conexion;
    $calculo = mysqli_query($conexion, "SELECT id_partido FROM tb_partidos WHERE fecha>'$fechaingreso' AND (equipo1=$equipo || equipo2 =$equipo)  AND Estado='2'");
    
    return mysqli_num_rows($calculo);
}
// Obtiene los partidos que podria haber jugado dependiendo la fecha de ingreso por un jugador
//
function Int_PorcentajeAsistencia_Jugador($asistidos, $partidos)
{

    return round(($asistidos / $partidos) * 100) . ' %';
}

// Saber si un jugador jugo o no en una determinada fecha
//
function Bole_SabersiAsistio_Partidos($jugador, $numerofecha)
{
    global $conexion;
    $calculo  = mysqli_query($conexion, "SELECT * FROM  tr_jugadoresxpartido where jugador=$jugador and partido in (SELECT id_partido FROM tb_partidos WHERE numero_fecha=$numerofecha) ");
    $columnas = (int) mysqli_num_rows($calculo);
    if ($columnas > 0) {
        $resultado = 'images/icons-png/check-black.png';
    } else {
        $resultado = 'images/icons-png/star-white.png';
    }
    
    return $resultado;
}
//Recibe la cantidad de jugadores a mostrar
//
function Array_Goleadores_Jugadores($cantidad)
{
    global $conexion;
    $calculo  = mysqli_query($conexion, "SELECT jugador,SUM(goles) AS goles1, id_equipo 
      from tr_jugadoresxpartido,tb_jugadores,tb_equipos 
      WHERE goles>=1 and jugador=id_jugadores and equipo=id_equipo and partido IN (SELECT id_partido FROM tb_partidos WHERE Estado=2 ) GROUP BY jugador ORDER BY `goles1` DESC, nombre_equipo asc limit $cantidad");
    $datos  = array();
    while ($valor = mysqli_fetch_array($calculo)) {
        $goles = $valor['goles1'];
        $jugador = $valor['jugador'];
        $id_equipo = $valor['id_equipo'];

        $vector       = array(
            "goles" => "$goles",
            "jugador" => "$jugador",
            "id_equipo" => "$id_equipo"
            );
        array_push($datos, $vector);
    }
    return $datos;

}

//
//

function Array_Amonestados_Jugadores($equipo)
{
    global $conexion;
    $calculo  = mysqli_query($conexion, "SELECT * from tr_jugadoresxpartido WHERE 
       amonestacion!=5 and partido IN(SELECT id_partido FROM tb_partidos WHERE Estado=2) and jugador 
       in (SELECT id_jugadores FROM tb_jugadores WHERE equipo=$equipo) GROUP BY jugador");
    $datos  = array();
    while ($valor = mysqli_fetch_array($calculo)) {
        $jugador = $valor['jugador'];

        $vector       = array(
           "jugador" => "$jugador"
           );
        array_push($datos, $vector);
    }
    return $datos;

}

// numeroo0 de amonestaciones que tiene un jugador
function Int_Amonestaciones_Jugadores($jugador,$amonestacion)
{
    global $conexion;
    $calculo  = mysqli_query($conexion, "SELECT COUNT(amonestacion) as cantidad FROM tr_jugadoresxpartido 
        WHERE  jugador=$jugador and amonestacion=$amonestacion");
    $valor = mysqli_fetch_array($calculo);
    return $valor['cantidad'];

}

// Recibe un limite para la consulta.
// Retorna : Tabla de valla menos vencida en  un array
function ObtenerTablaVayaMenovencida()
{
    global $conexion;
    $valor = mysqli_query($conexion, "SELECT equipo,gc 
        FROM te_posiciones 
        order by gc asc");
    $datos = array();
    while ($informacion = mysqli_fetch_array($valor)) {
        $equipo = $informacion['equipo'];
        $gc     = $informacion['gc'];

        $vector = array(
            'equipo' => "$equipo",
            'gc' => "$gc"


            );
        array_push($datos, $vector);
    }
    
    return $datos;
}
// Tabla de equipos m¨¢s goleadores
function ObtenerTablaEquipoGoleador()
{
    global $conexion;
    $valor = mysqli_query($conexion, "SELECT equipo,gf 
        FROM te_posiciones 
        order by gf desc");
    $datos = array();
    while ($informacion = mysqli_fetch_array($valor)) {
        $equipo = $informacion['equipo'];
        $gf     = $informacion['gf'];

        $vector = array(
            'equipo' => "$equipo",
            'gf' => "$gf"


            );
        array_push($datos, $vector);
    }
    
    return $datos;
}
// goleadores de la ultima fecha Jugada
function Goleadores_De_Fecha()
{
    global $conexion;
    $valor = mysqli_query($conexion, "SELECT jugador,goles,equipo FROM `tr_jugadoresxpartido`,tb_jugadores WHERE partido in (select id_partido from tb_partidos where numero_fecha in (select max(numero_fecha) from tb_partidos where estado='2')and estado='2') and goles >=2 and id_jugadores=jugador order by goles desc");
    $datos = array();
    while ($informacion = mysqli_fetch_array($valor)) {
        $jugador = $informacion['jugador'];
        $goles     = $informacion['goles'];
        $equipo     = $informacion['equipo'];

        $vector = array(
            'jugador' => "$jugador",
            'goles' => "$goles",
            'equipo' => "$equipo"


            );
        array_push($datos, $vector);
    }
    
    return $datos;
}
/**
 * [Array_Get_Modulos_All_Users Obtiene el menu principal]
 */
function Array_Get_Modulos_All_Users()
{
    global $conexion;
    $consulta = mysqli_query($conexion,"SELECT * FROM `tb_modulos` where tipo='users' 
        and estado='activo' and padre='0' Order by orden asc");   
    $datos = array();
    while ($informacion = mysqli_fetch_array($consulta)) {
        $id_modulos  = $informacion['id_modulos'];
        $nombre  = $informacion['nombre'];
        $ruta  = $informacion['ruta'];
        $submenu =$informacion['submenu'];
        $padre =$informacion['padre'];
        $vector = array(
            'id_modulos' => "$id_modulos",
            'nombre' => "$nombre",
            'ruta' =>"$ruta",
            'submenu'=>"$submenu",
            'padre' =>"$padre"
            );
        array_push($datos, $vector);
    }
    return $datos;

}
/**
 * [Array_Get_Modulos_All_Users Obtiene el menu principal]
 */
function Array_Get_Modulos_Sons_All_Users($padre)
{
    global $conexion;
    $consulta = mysqli_query($conexion,"SELECT * FROM `tb_modulos` where tipo='users' 
        and estado='activo' and padre=$padre  and padre !='0'  Order by orden asc");   
    $datos = array();
    while ($informacion = mysqli_fetch_array($consulta)) {
        $id_modulos  = $informacion['id_modulos'];
        $nombre  = $informacion['nombre'];
        $submenu  = $informacion['submenu'];
        $ruta  = $informacion['ruta'];
        $vector = array(
            'id_modulos' => "$id_modulos",
            'submenu' => "$submenu",
            'nombre' => "$nombre",
            'ruta' =>"$ruta",
            );
        array_push($datos, $vector);
    }
    return $datos;

}

/**
 * [Array_Get_PadreHijo Obtiene la información del modulo con la de su respectivo padre]
 * @param [type] $hijo [Identificador del sub modulo]
 */
function Array_Get_PadreHijo($hijo)
{
    global $conexion;
    $consulta = mysqli_query($conexion,"(SELECT * from tb_modulos WHERE id_modulos=$hijo) union (SELECT * FROM tb_modulos WHERE id_modulos IN (SELECT padre from tb_modulos WHERE id_modulos=$hijo)) ORDER BY padre");
    $datos = array();
    while ($informacion = mysqli_fetch_array($consulta)) {
        $id_modulos  = $informacion['id_modulos'];
        $padre = $informacion['padre'];
        $nombre  = $informacion['nombre'];
        $ruta  = $informacion['ruta'];
        $icono =  $informacion['icono'];
        $vector = array(
            'id_modulos' => "$id_modulos",
            'padre' => "$padre",
            'nombre' => "$nombre",
            'ruta' =>"$ruta",
            'icono' => "$icono"
            );
        array_push($datos, $vector);
    }
    return $datos;

}

////////////////////////////-------///////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
////////-//////////////-//////////////////////////////////////////////////////////////
///-----------------------LOS JUEGOS-------------------------------------------------
/////////////////////////-------///////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
////////-//////////////-//////////////////////////////////////////////////////////////

/**
 * [Get_Lista_Deportes Lista de los deportes]
 */
function Get_Lista_Deportes()
{
    global $conexion;
    $query = mysqli_query($conexion, "SELECT * FROM tb_deportes ORDER BY nombre ASC ");
    $vector    = array();
    while ($valor = mysqli_fetch_array($query)) {
     $id_deportes  = $valor['id_deportes'];
     $nombre = $valor['nombre'];
     $logo  = $valor['logo'];
     $tipo_deporte =  $valor['tipo_deporte'];
     $tipo_resultado =  $valor['tipo_resultado'];
     $vectores = array(
        'id_deportes' => "$id_deportes",
        'nombre' => "$nombre",
        'logo' => "$logo",
        'tipo_deporte' =>"$tipo_deporte",
        'tipo_resultado' => "$tipo_resultado"
        );
     array_push($vector, $vectores);
 }

 return $vector;
}
/**
 * [Get_Lista_Colegios Lista de Colegios]
 */
function Get_Lista_Colegios()
{
    global $conexion;
    $query = mysqli_query($conexion, "SELECT * FROM tb_colegio ORDER BY nombre ASC ");
    $vector    = array();
    while ($valor = mysqli_fetch_array($query)) {
     $id_colegio  = $valor['id_colegio'];
     $nombre = $valor['nombre'];
     $logo  = $valor['logo'];
     $vectores = array(
        'id_colegio' => "$id_colegio",
        'nombre' => "$nombre",
        'logo' => "$logo"
        );
     array_push($vector, $vectores);
 }

 return $vector;
}
function Get_Medallero()
{
    global $conexion;
    $query = mysqli_query($conexion, "SELECT 
        nombre,cl.id_colegio,
        COALESCE(oro, 0 ) as oro,
        COALESCE(plata, 0 ) as plata,
        COALESCE(bronce, 0 ) as bronce,
        COALESCE(total, 0 ) as total 
        FROM tb_colegio cl LEFT JOIN (SELECT t.id_colegio,COALESCE(oro, 0 ) as oro,
            COALESCE(plata, 0 ) as plata,
            COALESCE(bronce, 0 ) as bronce,
            COALESCE(total, 0 ) as total 
            FROM
            (SELECT  id_colegio,COUNT(*) as total FROM tb_medallas,tb_equipos,tb_colegio WHERE tb_medallas.equipo=tb_equipos.id_equipo AND tb_colegio.id_colegio=tb_equipos.colegio GROUP bY id_colegio ) AS t
            LEFT JOIN
            (SELECT  id_colegio,COUNT(*) as oro FROM tb_medallas,tb_equipos,tb_colegio WHERE tb_medallas.equipo=tb_equipos.id_equipo AND tb_colegio.id_colegio=tb_equipos.colegio and medalla='oro' GROUP bY id_colegio) AS O ON t.id_colegio=O.id_colegio
            LEFT JOIN
            (SELECT  id_colegio,COUNT(*) as plata FROM tb_medallas,tb_equipos,tb_colegio WHERE tb_medallas.equipo=tb_equipos.id_equipo AND tb_colegio.id_colegio=tb_equipos.colegio and medalla='plata' GROUP bY id_colegio) AS P ON t.id_colegio=P.id_colegio
            LEFT JOIN
            (SELECT  id_colegio,COUNT(*) as bronce FROM tb_medallas,tb_equipos,tb_colegio WHERE tb_medallas.equipo=tb_equipos.id_equipo AND tb_colegio.id_colegio=tb_equipos.colegio and medalla='bronce' GROUP bY id_colegio) AS B ON t.id_colegio=B.id_colegio )  AS TB_GENERAL ON cl.id_colegio=TB_GENERAL.id_colegio ORDER BY ORO DESC,PLATA DESC,BRONCE DESC
");
$vector    = array();
while ($valor = mysqli_fetch_array($query)) {
    $nombre = $valor['nombre'];
    $id_colegio = $valor['id_colegio'];
    $oro  = $valor['oro'];
    $plata  = $valor['plata'];
    $bronce  = $valor['bronce'];
    $total  = $valor['total'];
    $vectores = array(
        'nombre' => "$nombre",
        'id_colegio' => "$id_colegio",
        'oro' => "$oro",
        'plata' => "$plata",
        'bronce' => "$bronce",
        'total' => "$total"
        );
    array_push($vector, $vectores);
}

return $vector;
}
function Generar_Tabla_De_Posiciones($torneo)
{
    global $conexion;
/// Consulta de numero de equipos que han jugado para generar la Tabla de posiciones
    $equiposquehanjugado = mysqli_query($conexion,"SELECT id_equipo,nombre_equipo,grupo
        FROM tb_equipos,tb_partidos 
        WHERE (tb_equipos.id_equipo = tb_partidos.equipo1
            OR tb_equipos.id_equipo = tb_partidos.equipo2)
    AND  (tb_equipos.torneo = '$torneo'
        OR tb_equipos.torneo = '$torneo')
    AND  tb_partidos.Estado='2'
    GROUP BY id_equipo");

// se realiza la busqueda equipo por equipo con el fin de que se guarden los datos en una matrix , esto ayudara a organizar la informacion
// se calcula el numero de equipos que han jugado hasta ahora con una nueva variable que define el numero de columnas creadas (numero de equipos que ha jugado)
    $numerodeequiposparaeltamañodelamatriz = mysqli_num_rows($equiposquehanjugado);

    $matriz[$numerodeequiposparaeltamañodelamatriz]['22'] = 0;
    $i = 0;
    while ($identificaciones = mysqli_fetch_array($equiposquehanjugado)) {
    $matriz[$i]['3'] = 0;  // GOLES A FAVOR
    $matriz[$i]['4'] = 0; // GOLES CONTRA
    $matriz[$i]['5'] = 0;  // PARTIDOS PERDIOS
    $matriz[$i]['6'] = 0;  // PARTIDOS GANADOS
    $matriz[$i]['7'] = 0; // EMPATES
 $matriz[$i]['12'] = 0;  // PUNTOS RESTADOS POR REGLAMENTO;

    $matriz[$i]['0'] = $identificaciones['id_equipo'];
    $matriz[$i]['1'] = $identificaciones['nombre_equipo'];
    $matriz[$i]['2'] = 0;
    $matriz[$i]['11'] = $identificaciones['grupo'];


// // saber en que lugar esta si en el equipo1 o equipo2 para tomar los valores de los goles 
    $liga = Get_Partidos_Liga_Torneo($torneo);

    $lugardentrodelospartidos = mysqli_query($conexion,"SELECT   equipo1,equipo2,resultado1,resultado2,tipo_resultado
       FROM  tb_partidos WHERE tb_partidos.Estado='2' AND numero_fecha <=$liga ");

    while ($equipoparticipante = mysqli_fetch_array($lugardentrodelospartidos)) {
        if ($equipoparticipante['equipo1'] == $identificaciones['id_equipo'] || $equipoparticipante['equipo2'] == $identificaciones['id_equipo']) 
        {


            // se incluira el codigo para saber que partidos se han ganado perdido o empatado por el respectivo equipo
// ifs para definir el ganador perdedor o empate
// 
            //validar tipo de resultado WO esas cosas
            if($equipoparticipante['tipo_resultado'] == 1 or $equipoparticipante['tipo_resultado'] == 3 or $equipoparticipante['tipo_resultado'] == 8 or $equipoparticipante['tipo_resultado'] == 7 or $equipoparticipante['tipo_resultado'] == 6 )
            {

                if ($equipoparticipante['equipo1'] == $identificaciones['id_equipo']) {

                    if ($equipoparticipante['resultado1'] == $equipoparticipante['resultado2']) {
                    // EMPATE
                        $matriz[$i]['7'] = $matriz[$i]['7'] + 1;
                    }

                    if ($equipoparticipante['resultado1'] > $equipoparticipante['resultado2']) {
                    // GANA EQUIPO 1
                        $matriz[$i]['6'] = $matriz[$i]['6'] + 1;
                    }

                    if ($equipoparticipante['resultado1'] < $equipoparticipante['resultado2']) {
                    // GANA EQUIPO 2
                        $matriz[$i]['5'] = $matriz[$i]['5'] + 1;
                    }
            }    ///---------------> PARA EQUIPO 1 ARRIBA


            if ($equipoparticipante['equipo2'] == $identificaciones['id_equipo']) {

                if ($equipoparticipante['resultado1'] == $equipoparticipante['resultado2']) {
                    // EMPATE
                    $matriz[$i]['7'] = $matriz[$i]['7'] + 1;
                }

                if ($equipoparticipante['resultado1'] > $equipoparticipante['resultado2']) {
                    // GANA EQUIPO 1
                    $matriz[$i]['5'] = $matriz[$i]['5'] + 1;
                }

                if ($equipoparticipante['resultado1'] < $equipoparticipante['resultado2']) {
                    // GANA EQUIPO 2
                    $matriz[$i]['6'] = $matriz[$i]['6'] + 1;
                }
            }//-------------------> PARA EQUIPO 2 CUANDO GPE ARRIBA
// --->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>AQUI TERMINA CODIGO PARTIDOS GPE


            if ($equipoparticipante['equipo1'] == $identificaciones['id_equipo']) {
                $Golesafavor = $equipoparticipante['resultado1'];
// guardamos los datos en la matriz y sumamos los goles que deban ser sumados
                $matriz[$i]['3'] = $matriz[$i]['3'] + $Golesafavor;
// guardamos los datos en la matriz y sumamos los goles que deban ser sumados
                $Golescontra = $equipoparticipante['resultado2'];
                $matriz[$i]['4'] = $matriz[$i]['4'] + $Golescontra;
            } else {
                $Golesacontra = $equipoparticipante['resultado1'];
// guardamos los datos en la matriz y sumamos los goles que deban ser sumados
                $matriz[$i]['4'] = $matriz[$i]['4'] + $Golesacontra;
// guardamos los datos en la matriz y sumamos los goles que deban ser sumados
                $Golesafavor = $equipoparticipante['resultado2'];
                $matriz[$i]['3'] = $matriz[$i]['3'] + $Golesafavor;
            }
            
              // 1.CUANDO LOS DOS EQIPOS PIERDEN POR MAL COMPORTAMIENTO .
               if($equipoparticipante['tipo_resultado'] == 8)
            {

            if ($equipoparticipante['equipo1'] == $identificaciones['id_equipo']) 
            {
                    // PIERDEN LOS DOS
               $matriz[$i]['12'] = $matriz[$i]['12'] + 3;
                

            }    ///---------------> PARA EQUIPO 1 ARRIBA


            if ($equipoparticipante['equipo2'] == $identificaciones['id_equipo']) {
                    // PIERDEN LOS DOS
                 $matriz[$i]['12'] = $matriz[$i]['12']+ 3;
            } 

            }

                  // 1.EQUIPOS IZQUIERDO POR MAL COMPORTAMIENTO .
               if($equipoparticipante['tipo_resultado'] == 7)
            {

            if ($equipoparticipante['equipo2'] == $identificaciones['id_equipo']) 
            {
                    // PIERDEN LOS DOS
                $matriz[$i]['12'] = $matriz[$i]['12'] + 3;
                

            }    


            }

                      // 1.EQUIPOS IZQUIERDO POR MAL COMPORTAMIENTO .
               if($equipoparticipante['tipo_resultado'] == 6)
            {

          
            if ($equipoparticipante['equipo1'] == $identificaciones['id_equipo']) 
            {
                    // PIERDEN LOS DOS
                  $matriz[$i]['12'] = $matriz[$i]['12'] + 3;
            } 


            }
            
            
            
            
            
        }
        else
        { /// RESULTADO ESPECIALES 

            // 1.CUANDO LOS DOS PIERDEN.
               if($equipoparticipante['tipo_resultado'] == 2)
            {

            if ($equipoparticipante['equipo1'] == $identificaciones['id_equipo']) 
            {
                    // PIERDEN LOS DOS
                $matriz[$i]['5'] = $matriz[$i]['5'] + 1;
                

            }    ///---------------> PARA EQUIPO 1 ARRIBA


            if ($equipoparticipante['equipo2'] == $identificaciones['id_equipo']) {
                    // PIERDEN LOS DOS
                $matriz[$i]['5'] = $matriz[$i]['5'] + 1;
            } 

            }

             // 2.EQUIPO 1 GANA POR REGLAMENTO.
               if($equipoparticipante['tipo_resultado'] == 4)
            {

            if ($equipoparticipante['equipo1'] == $identificaciones['id_equipo']) 
            {
                   // GANA EQUIPO 1
                  $matriz[$i]['6'] = $matriz[$i]['6'] + 1;
                

            }    ///---------------> PARA EQUIPO 1 ARRIBA


            if ($equipoparticipante['equipo2'] == $identificaciones['id_equipo']) {
                    // PIERDE POR REGLAMENTO
                $matriz[$i]['5'] = $matriz[$i]['5'] + 1;
            } 

                if ($equipoparticipante['equipo1'] == $identificaciones['id_equipo']) {
                $Golesafavor = $equipoparticipante['resultado1'];
// guardamos los datos en la matriz y sumamos los goles que deban ser sumados
                $matriz[$i]['3'] = $matriz[$i]['3'] + $Golesafavor;
// guardamos los datos en la matriz y sumamos los goles que deban ser sumados
                $Golescontra = $equipoparticipante['resultado2'];
                $matriz[$i]['4'] = $matriz[$i]['4'] + $Golescontra;
            } else {
                $Golesacontra = $equipoparticipante['resultado1'];
// guardamos los datos en la matriz y sumamos los goles que deban ser sumados
                $matriz[$i]['4'] = $matriz[$i]['4'] + $Golesacontra;
// guardamos los datos en la matriz y sumamos los goles que deban ser sumados
                $Golesafavor = $equipoparticipante['resultado2'];
                $matriz[$i]['3'] = $matriz[$i]['3'] + $Golesafavor;
            }

            }
                    // 2.EQUIPO 2 GANA POR REGLAMENTO.
               if($equipoparticipante['tipo_resultado'] == 5)
            {

            if ($equipoparticipante['equipo1'] == $identificaciones['id_equipo']) 
            {
                 
                      // PIERDE POR REGLAMENTO
                 $matriz[$i]['5'] = $matriz[$i]['5'] + 1;

            }    ///---------------> PARA EQUIPO 1 ARRIBA


            if ($equipoparticipante['equipo2'] == $identificaciones['id_equipo']) {
                  // GANA EQUIPO 2
                 $matriz[$i]['6'] = $matriz[$i]['6'] + 1;
            } 


                if ($equipoparticipante['equipo1'] == $identificaciones['id_equipo']) {
                $Golesafavor = $equipoparticipante['resultado1'];
// guardamos los datos en la matriz y sumamos los goles que deban ser sumados
                $matriz[$i]['3'] = $matriz[$i]['3'] + $Golesafavor;
// guardamos los datos en la matriz y sumamos los goles que deban ser sumados
                $Golescontra = $equipoparticipante['resultado2'];
                $matriz[$i]['4'] = $matriz[$i]['4'] + $Golescontra;
            } else {
                $Golesacontra = $equipoparticipante['resultado1'];
// guardamos los datos en la matriz y sumamos los goles que deban ser sumados
                $matriz[$i]['4'] = $matriz[$i]['4'] + $Golesacontra;
// guardamos los datos en la matriz y sumamos los goles que deban ser sumados
                $Golesafavor = $equipoparticipante['resultado2'];
                $matriz[$i]['3'] = $matriz[$i]['3'] + $Golesafavor;
            }

            }

            
           

        }
    }
}
$i++;
}

// Ordenar matriz
$eliminaciondeinfoanterio = mysqli_query($conexion,"DELETE FROM te_posiciones");

for ($i = 0; $i < $numerodeequiposparaeltamañodelamatriz; $i++) {

    $matriz[$i]['8'] = $matriz[$i]['6'] + $matriz[$i]['7'] + $matriz[$i]['5'];
    $matriz[$i]['9'] = $matriz[$i]['3'] - $matriz[$i]['4'];
    $matriz[$i]['10'] = $i + 1;

                            $variable1 = $matriz[$i]['1'];  // nombre equipo
                            $variable11 = $matriz[$i]['0'];  // id
         $variable2 = (($matriz[$i]['6'] * Get_Puntos_Ganador_Torneo($torneo)) + $matriz[$i]['7'] -  $matriz[$i]['12']);  // puntos
                            $variable3 = $matriz[$i]['8'];  // partidos jugados
                            $variable4 = $matriz[$i]['6'];  // partidos ganados
                            $variable5 = $matriz[$i]['7'];  // empates
                            $variable6 = $matriz[$i]['5'];  // partidos perdidos
                            $variable7 = $matriz[$i]['3'];  // goles a favor
                            $variable8 = $matriz[$i]['4'];  // goles en contra
                            $variable9 = $matriz[$i]['9'];  // diferencia de Gol
                            $variable10 = $matriz[$i]['11'];  // Grupo
                            
                                //SITUACIONES ESPECIALES


                            // FIN SITUACIONES ESPECIALES

                            mysqli_query($conexion,"INSERT INTO `te_posiciones`(`equipo`, `puntos`, `pj`, `pg`, `pe`, `pp`, `gf`, `gc`, `dg`,`id`,`grupo`)
                              VALUES ('$variable1','$variable2','$variable3','$variable4','$variable5','$variable6','$variable7','$variable8','$variable9','$variable11','$variable10');")
                            or die(mysql_error());

                        }

                    }

                    function Generar_Tabla_De_Posiciones_Deportes($torneo)
                    {
                        global $conexion;
/// Consulta de numero de equipos que han jugado para generar la Tabla de posiciones
                        $equiposquehanjugado = mysqli_query($conexion,"SELECT tb_equipos.nombre_equipo,tb_equipos.id_equipo,tb_equipos.grupo 
                            FROM tb_partidos,tr_equiposxpartidos,tb_equipos,tb_torneo WHERE tb_partidos.id_partido=tr_equiposxpartidos.partido AND tb_equipos.id_equipo=tr_equiposxpartidos.equipo AND tb_torneo.id_torneo=tb_equipos.torneo 
                            AND tb_torneo.id_torneo=$torneo AND tb_partidos.estado='2' GROUP BY tb_equipos.id_equipo");

// se realiza la busqueda equipo por equipo con el fin de que se guarden los datos en una matrix , esto ayudara a organizar la informacion
// se calcula el numero de equipos que han jugado hasta ahora con una nueva variable que define el numero de columnas creadas (numero de equipos que ha jugado)
                        $numerodeequiposparaeltamañodelamatriz = mysqli_num_rows($equiposquehanjugado);

                        $matriz[$numerodeequiposparaeltamañodelamatriz]['20'] = 0;
                        $i = 0;
                        while ($identificaciones = mysqli_fetch_array($equiposquehanjugado)) {
    $matriz[$i]['3'] = 0;  // GOLES A FAVOR
    $matriz[$i]['4'] = 0; // GOLES CONTRA
    $matriz[$i]['5'] = 0;  // PARTIDOS PERDIOS
    $matriz[$i]['6'] = 0;  // PARTIDOS GANADOS
    $matriz[$i]['7'] = 0; // EMPATES


    $matriz[$i]['0'] = $identificaciones['id_equipo'];
    $matriz[$i]['1'] = $identificaciones['nombre_equipo'];
    $matriz[$i]['2'] = 0;
    $matriz[$i]['11'] = $identificaciones['grupo'];


// // saber en que lugar esta si en el equipo1 o equipo2 para tomar los valores de los goles 
    $lugardentrodelospartidos = mysqli_query($conexion,"SELECT tabla2.partido as
       partido,equipo1,resultado1,equipo2,resultado2 
       FROM 
       (SELECT partido,equipo as equipo1,resultado as resultado1 
           FROM tb_partidos,tr_equiposxpartidos,tb_equipos,tb_torneo 
           WHERE tb_partidos.id_partido=tr_equiposxpartidos.partido
           AND tb_equipos.id_equipo=tr_equiposxpartidos.equipo 
           AND tb_torneo.id_torneo=tb_equipos.torneo 
           AND tb_torneo.id_torneo=$torneo 
           AND tb_partidos.estado='2'
           AND numero=1) as tabla1, 
    (SELECT partido,equipo as equipo2,resultado as resultado2 
       FROM tb_partidos,tr_equiposxpartidos,tb_equipos,tb_torneo
       WHERE tb_partidos.id_partido=tr_equiposxpartidos.partido 
       AND tb_equipos.id_equipo=tr_equiposxpartidos.equipo 
       AND tb_torneo.id_torneo=tb_equipos.torneo 
       AND tb_torneo.id_torneo=$torneo 
       AND tb_partidos.estado='2'
       AND numero=2) as tabla2 WHERE tabla1.partido=tabla2.partido");

    while ($equipoparticipante = mysqli_fetch_array($lugardentrodelospartidos)) {
        if ($equipoparticipante['equipo1'] == $identificaciones['id_equipo'] || $equipoparticipante['equipo2'] == $identificaciones['id_equipo']) {


            // se incluira el codigo para saber que partidos se han ganado perdido o empatado por el respectivo equipo
// ifs para definir el ganador perdedor o empate
            if ($equipoparticipante['equipo1'] == $identificaciones['id_equipo']) {

                if ($equipoparticipante['resultado1'] == $equipoparticipante['resultado2']) {
                    // EMPATE
                    $matriz[$i]['7'] = $matriz[$i]['7'] + 1;
                }

                if ($equipoparticipante['resultado1'] > $equipoparticipante['resultado2']) {
                    // GANA EQUIPO 1
                    $matriz[$i]['6'] = $matriz[$i]['6'] + 1;
                }

                if ($equipoparticipante['resultado1'] < $equipoparticipante['resultado2']) {
                    // GANA EQUIPO 2
                    $matriz[$i]['5'] = $matriz[$i]['5'] + 1;
                }
            }    ///---------------> PARA EQUIPO 1 ARRIBA


            if ($equipoparticipante['equipo2'] == $identificaciones['id_equipo']) {

                if ($equipoparticipante['resultado1'] == $equipoparticipante['resultado2']) {
                    // EMPATE
                    $matriz[$i]['7'] = $matriz[$i]['7'] + 1;
                }

                if ($equipoparticipante['resultado1'] > $equipoparticipante['resultado2']) {
                    // GANA EQUIPO 1
                    $matriz[$i]['5'] = $matriz[$i]['5'] + 1;
                }

                if ($equipoparticipante['resultado1'] < $equipoparticipante['resultado2']) {
                    // GANA EQUIPO 2
                    $matriz[$i]['6'] = $matriz[$i]['6'] + 1;
                }
            }//-------------------> PARA EQUIPO 2 CUANDO GPE ARRIBA
// --->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>AQUI TERMINA CODIGO PARTIDOS GPE


            if ($equipoparticipante['equipo1'] == $identificaciones['id_equipo']) {
                $Golesafavor = $equipoparticipante['resultado1'];
// guardamos los datos en la matriz y sumamos los goles que deban ser sumados
                $matriz[$i]['3'] = $matriz[$i]['3'] + $Golesafavor;
// guardamos los datos en la matriz y sumamos los goles que deban ser sumados
                $Golescontra = $equipoparticipante['resultado2'];
                $matriz[$i]['4'] = $matriz[$i]['4'] + $Golescontra;
            } else {
                $Golesacontra = $equipoparticipante['resultado1'];
// guardamos los datos en la matriz y sumamos los goles que deban ser sumados
                $matriz[$i]['4'] = $matriz[$i]['4'] + $Golesacontra;
// guardamos los datos en la matriz y sumamos los goles que deban ser sumados
                $Golesafavor = $equipoparticipante['resultado2'];
                $matriz[$i]['3'] = $matriz[$i]['3'] + $Golesafavor;
            }
        }
    }
    $i++;
}

// Ordenar matriz
$eliminaciondeinfoanterio = mysqli_query($conexion,"DELETE FROM te_posiciones");

for ($i = 0; $i < $numerodeequiposparaeltamañodelamatriz; $i++) {

    $matriz[$i]['8'] = $matriz[$i]['6'] + $matriz[$i]['7'] + $matriz[$i]['5'];
    $matriz[$i]['9'] = $matriz[$i]['3'] - $matriz[$i]['4'];
    $matriz[$i]['10'] = $i + 1;

                            $variable1 = $matriz[$i]['1'];  // nombre equipo
                            $variable11 = $matriz[$i]['0'];  // id
         $variable2 = (($matriz[$i]['6'] * Get_Puntos_Ganador_Torneo($torneo)) + $matriz[$i]['7']);  // puntos
                            $variable3 = $matriz[$i]['8'];  // partidos jugados
                            $variable4 = $matriz[$i]['6'];  // partidos ganados
                            $variable5 = $matriz[$i]['7'];  // empates
                            $variable6 = $matriz[$i]['5'];  // partidos perdidos
                            $variable7 = $matriz[$i]['3'];  // goles a favor
                            $variable8 = $matriz[$i]['4'];  // goles en contra
                            $variable9 = $matriz[$i]['9'];  // diferencia de Gol
                            $variable10 = $matriz[$i]['11'];  // Grupo
                            
                                //SITUACIONES ESPECIALES


                            // FIN SITUACIONES ESPECIALES

                            mysqli_query($conexion,"INSERT INTO `te_posiciones`(`equipo`, `puntos`, `pj`, `pg`, `pe`, `pp`, `gf`, `gc`, `dg`,`id`,`grupo`)
                              VALUES ('$variable1','$variable2','$variable3','$variable4','$variable5','$variable6','$variable7','$variable8','$variable9','$variable11','$variable10');")
                            or die(mysql_error());

                        }

                    }
                    /**
                     * [Get_Deporte Obtengo la infomación de un deporte]
                     * @param [type] $identificador [Deporte]
                     */
                    function Get_Deporte($identificador)
                    {
                        global $conexion;
                        $valor  = mysqli_fetch_array(mysqli_query($conexion, 
                            "SELECT * from tb_deportes WHERE id_deportes='$identificador' "));
                        $nombre = $valor['nombre'];
                        $logo        = $valor['logo'];
                        $tipo_deporte      = $valor['tipo_deporte'];
                        $tipo_resultado      = $valor['tipo_resultado'];
                        return array(
                            "nombre" => "$nombre",
                            "logo" => "$logo",
                            "tipo_deporte" => "$tipo_deporte",
                            "tipo_resultado" => "$tipo_resultado"
                            );
                    }

                    function Get_Lista_Torneos_Partido_Programados()
                    {
                        global $conexion;
                        $query = mysqli_query($conexion, 
                            "SELECT id_torneo,deporte,logo,tipo_deporte,tipo_resultado,categoria,id_deportes,nombre_torneo from tr_equiposxpartidos,tb_partidos,tb_equipos,tb_torneo,tb_deportes WHERE estado=1 and partido=id_partido and estado=1 and id_equipo=equipo and id_torneo=torneo and deporte=id_deportes Group by partido   order by fecha asc , hora asc  ");
                        $vector    = array();
                        while ($valor = mysqli_fetch_array($query)) {

                         $id_torneo  = $valor['id_torneo'];
                         $nombre_torneo = $valor['nombre_torneo'];
                         $deporte  = $valor['deporte'];
                         $categoria  = $valor['categoria'];
                         $id_deportes  = $valor['id_deportes'];
                         $logo  = $valor['logo'];
                         $tipo_deporte  = $valor['tipo_deporte'];
                         $tipo_resultado  = $valor['tipo_resultado'];

                         $vectores = array(
                            'id_torneo' => "$id_torneo",
                            'nombre_torneo' => "$nombre_torneo",
                            'deporte' => "$deporte",
                            'categoria' => "$categoria",
                            'id_deportes' => "$id_deportes",
                            'logo' => "$logo",
                            'tipo_deporte' => "$tipo_deporte",
                            'tipo_resultado' => "$tipo_resultado"
                            );
                         array_push($vector, $vectores);
                     }
                     return $vector;
                 } 
/**
 * [Get_Lista_Partido_Por_Torneo Obtengo los partido que tienen programación de u 
 *  torneo X]
 * @param [type] $torneo [description]
 */
function Get_Lista_Partido_Por_Torneo($torneo,$estado)
{
    global $conexion;
    $query = mysqli_query($conexion, 
        "SELECT DISTINCT partido from tr_equiposxpartidos,tb_equipos
        WHERE  partido in (SELECT id_partido from tb_partidos 
            WHERE estado=$estado order by fecha desc , hora desc) 
    AND equipo=id_equipo and torneo='$torneo' ");
    $vector    = array();
    while ($valor = mysqli_fetch_array($query)) {

     $partido  = $valor['partido'];

     $vectores = array(
        'partido' => "$partido"
        );
     array_push($vector, $vectores);
 }
 return $vector;
} 
/**
 * [Get_Partido Obtener la informaciń de un partido]
 * @param [type] $identificador [description]
 */
function Get_Partido($identificador)
{
    global $conexion;
    $valor         = mysqli_fetch_array(mysqli_query($conexion, "SELECT * FROM
       tb_partidos,tr_equiposxpartidos WHERE id_partido=partido and partido='$identificador' GROUP BY partido "));
    $nombre_partido = $valor['nombre_partido'];
    $fecha      = $valor['fecha'];
    $hora      = $valor['hora'];
    $numero_fecha      = $valor['numero_fecha'];
    $lugar = $valor['lugar'];
    $estado = $valor['estado'];
    
    return array(
        "nombre_partido" => "$nombre_partido",
        "fecha" => "$fecha",
        "hora" => "$hora",
        "numero_fecha" => "$numero_fecha",
        "lugar" => "$lugar",
        "estado" => "$estado"
        );
}
// Recibe : Fecha
// Retorna : 03-31 pm formato de fecha .
function Formato_Fecha_Sin_Ano($fecha)
{
    $valor = date("m", strtotime($fecha)) . "-" . date("d", strtotime($fecha));
    
    return $valor;
}
/**
 * [Get_Partido Equipos de un partido]
 * @param [type] $identificador [description]
 */
function Get_Equipos_Partido_Clasico($partido)
{
    global $conexion;
    $valor  = mysqli_fetch_array(mysqli_query($conexion, "SELECT * FROM 
     (SELECT equipo as equipo1,resultado as resultado1,partido FROM `tr_equiposxpartidos` WHERE partido='$partido' and numero='1' ) as tabla1, (SELECT equipo as equipo2,resultado as resultado2,partido FROM `tr_equiposxpartidos` WHERE partido='$partido' and numero='2') as tabla2,tb_partidos 
     WHERE tabla1.partido=tabla2.partido and tb_partidos.id_partido=tabla2.partido"));
    $partido        = $valor['partido'];
    $equipo1      = $valor['equipo1'];
    $equipo2      = $valor['equipo2'];
    $resultado1 = $valor['resultado1'];
    $resultado2 = $valor['resultado2'];
    $fecha = $valor['fecha'];
    $lugar = $valor['lugar'];
    $nombre_partido = $valor['nombre_partido'];
    return array(
        "partido" => "$partido",
        "equipo1" => "$equipo1",
        "equipo2" => "$equipo2",
        "resultado1" => "$resultado1",
        "resultado2" => "$resultado2",
        "lugar" => "$lugar",
        "fecha" => "$fecha",
        "nombre_partido" => "$nombre_partido"
        );
}
function Get_Lista_Torneos_Partido_Terminados()
{
    global $conexion;
    $query = mysqli_query($conexion, 
        "SELECT id_torneo,deporte,logo,tipo_deporte,tipo_resultado,categoria,id_deportes,nombre_torneo from tr_equiposxpartidos,tb_partidos,tb_equipos,tb_torneo,tb_deportes WHERE  partido=id_partido and estado=2 and id_equipo=equipo and id_torneo=torneo and deporte=id_deportes Group by torneo   order by fecha desc , hora desc  ");
    $vector    = array();
    while ($valor = mysqli_fetch_array($query)) {

     $id_torneo  = $valor['id_torneo'];
     $nombre_torneo = $valor['nombre_torneo'];
     $deporte  = $valor['deporte'];
     $categoria  = $valor['categoria'];
     $id_deportes  = $valor['id_deportes'];
     $logo  = $valor['logo'];
     $tipo_deporte  = $valor['tipo_deporte'];
     $tipo_resultado  = $valor['tipo_resultado'];

     $vectores = array(
        'id_torneo' => "$id_torneo",
        'nombre_torneo' => "$nombre_torneo",
        'deporte' => "$deporte",
        'categoria' => "$categoria",
        'id_deportes' => "$id_deportes",
        'logo' => "$logo",
        'tipo_deporte' => "$tipo_deporte",
        'tipo_resultado' => "$tipo_resultado"
        );
     array_push($vector, $vectores);
 }
 return $vector;
} 

// Recibe : id del partido
// Retorna : Nombre del torneo.
function Get_Nombre_Torneo_Pasando_Partido($identificador)
{
    global $conexion;
    $valor = mysqli_fetch_array(mysqli_query($conexion, "SELECT nombre_torneo 
        FROM tb_partidos,tr_equiposxpartidos,tb_equipos,tb_torneo 
        WHERE id_partido='$identificador' and tr_equiposxpartidos.partido=tb_partidos.id_partido and tb_equipos.id_equipo=tr_equiposxpartidos.equipo and tb_torneo.id_torneo=torneo group by torneo"));
    $valor = $valor['nombre_torneo'];
    
    return $valor;
}
/**
 * [Get_Nombre_Partido ]
 * @param [type] $identificador [Id del partido]
 */
function Get_Nombre_Partido($identificador)
{
    global $conexion;
    $valor = mysqli_fetch_array(mysqli_query($conexion, "SELECT nombre_partido
       FROM  tb_partidos WHERE id_partido='$identificador'"));
    $valor = $valor['nombre_partido'];
    
    return $valor;
}
/**
 * [Get_Equipos_Partido_Especial ]
 * @param [type] $partido [description]
 */
function Get_Equipos_Partido_Especial($partido)
{
    global $conexion;
    $valor  = mysqli_fetch_array(mysqli_query($conexion, "SELECT * FROM tb_partidos,tr_equiposxpartidos,tb_equipos,tb_torneo WHERE id_partido='$partido' and tr_equiposxpartidos.partido=tb_partidos.id_partido and tb_equipos.id_equipo=tr_equiposxpartidos.equipo and tb_torneo.id_torneo=torneo group by torneo"));
    $partido        = $valor['partido'];
    $fecha = $valor['fecha'];
    $lugar = $valor['lugar'];
    $nombre_partido = $valor['nombre_partido'];
    return array(
        "partido" => "$partido",
        "lugar" => "$lugar",
        "fecha" => "$fecha",
        "nombre_partido" => "$nombre_partido"
        );
}
/**
 * [Get_Lista_Participantes de un partido de natacioón ejemplo]
 * @param [type] $partido [description]
 */
function Get_Lista_Participantes($partido)
{
    global $conexion;
    $query = mysqli_query($conexion, "SELECT * FROM tb_partidos,tr_equiposxpartidos,tb_equipos,tb_torneo,tb_colegio WHERE id_partido='$partido' and tr_equiposxpartidos.partido=tb_partidos.id_partido and tb_equipos.id_equipo=tr_equiposxpartidos.equipo and tb_torneo.id_torneo=torneo and tb_colegio.id_colegio=colegio");
    $vector    = array();
    while ($valor = mysqli_fetch_array($query)) {

     $nombre_equipo  = $valor['nombre_equipo'];
     $resultado  = $valor['resultado'];
     $nombre  = $valor['nombre'];


     $vectores = array(
        'nombre_equipo' => "$nombre_equipo",
        'resultado' => "$resultado",
        'nombre' => "$nombre"
        );
     array_push($vector, $vectores);
 }
 return $vector;
} 
/**
 * [Get_Lista_Partido_Programados_Deporte Los partidos partidos progamados para un torneo]
 * @param [type] $deporte [Id_deporte]
 */
function Get_Lista_Partido_Deporte($deporte,$estado)
{
    global $conexion;
    $query = mysqli_query($conexion, 
        "SELECT id_torneo,deporte,logo,tipo_deporte,tipo_resultado,categoria,id_deportes,nombre_torneo from tr_equiposxpartidos,tb_partidos,tb_equipos,tb_torneo,tb_deportes WHERE estado='$estado' and partido=id_partido  and id_equipo=equipo and id_torneo=torneo and deporte=id_deportes and deporte='$deporte'  Group by id_torneo    order by fecha asc , hora asc ");
    $vector    = array();
    while ($valor = mysqli_fetch_array($query)) {

     $id_torneo  = $valor['id_torneo'];
     $nombre_torneo = $valor['nombre_torneo'];
     $deporte  = $valor['deporte'];
     $categoria  = $valor['categoria'];
     $id_deportes  = $valor['id_deportes'];
     $logo  = $valor['logo'];
     $tipo_deporte  = $valor['tipo_deporte'];
     $tipo_resultado  = $valor['tipo_resultado'];

     $vectores = array(
        'id_torneo' => "$id_torneo",
        'nombre_torneo' => "$nombre_torneo",
        'deporte' => "$deporte",
        'categoria' => "$categoria",
        'id_deportes' => "$id_deportes",
        'logo' => "$logo",
        'tipo_deporte' => "$tipo_deporte",
        'tipo_resultado' => "$tipo_resultado"
        );
     array_push($vector, $vectores);
 }
 return $vector;
} 
/**
 * [Get_Lista_Torneos lista de torneos de un deporte]
 * @param [type] $deporte [Id_deporte]
 */
function Get_Lista_Torneos($deporte)
{
    global $conexion;
    $query = mysqli_query($conexion, "SELECT * from tb_torneo WHERE tb_torneo.deporte='$deporte' ");
    $vector    = array();
    while ($valor = mysqli_fetch_array($query)) {

     $id_torneo  = $valor['id_torneo'];
     $nombre_torneo  = $valor['nombre_torneo'];
     $categoria  = $valor['categoria'];


     $vectores = array(
        'id_torneo' => "$id_torneo",
        'nombre_torneo' => "$nombre_torneo",
        'categoria' => "$categoria"
        );
     array_push($vector, $vectores);
 }
 return $vector;
}
/**
 * [Get_Torneo ]
 * @param [type] $deporte [id_torneo]
 */
function Get_Torneo($torneo)
{
  global $conexion;
  $valor  = mysqli_fetch_array(mysqli_query($conexion, "SELECT * FROM tb_torneo,tb_deportes WHERE tb_torneo.deporte=tb_deportes.id_deportes and tb_torneo.id_torneo='$torneo'"));
  $id_torneo        = $valor['id_torneo'];
  $nombre_torneo        = $valor['nombre_torneo'];
  $deporte        = $valor['deporte'];
  $categoria        = $valor['categoria'];
  $nombre        = $valor['nombre'];
  $logo        = $valor['logo'];
  $tipo_deporte        = $valor['tipo_deporte'];
  $tipo_resultado        = $valor['tipo_resultado'];
  return array(
    "id_torneo" => "$id_torneo",
    "nombre_torneo" => "$nombre_torneo",
    "deporte" => "$deporte",
    "categoria" => "$categoria",
    "nombre" => "$nombre",
    "logo" => "$logo",
    "tipo_deporte" => "$tipo_deporte",
    "tipo_resultado" => "$tipo_resultado",

    );
}

/**
 * [Get_Lista_Grupos de un torneo]
 * @param [type] $torneo [Id_Torneo]
 */
function Get_Lista_Grupos($torneo)
{
    global $conexion;
    $query = mysqli_query($conexion, "SELECT DISTINCT grupo from tb_equipos WHERE torneo='$torneo' ");
    $vector    = array();
    while ($valor = mysqli_fetch_array($query)) {

     $grupo  = $valor['grupo'];
     $vectores = array(
        'grupo' => "$grupo",

        );
     array_push($vector, $vectores);
 }
 return $vector;
}

/**
 * [Get_Puntos_Ganador_Torneo description]
 * @param [type] $torneo [description]
 */
function Get_Puntos_Ganador_Torneo($torneo)
{
    global $conexion;
    $valor = mysqli_fetch_array(mysqli_query($conexion, "SELECT puntos_ganador FROM `tb_torneo` WHERE id_torneo=$torneo "));
    $valor = $valor['puntos_ganador'];
    
    return $valor;
}
/**
 * [Get_Partidos_Liga_Torneo description]
 * @param [type] $torneo [description]
 */
function Get_Partidos_Liga_Torneo($torneo)
{
    global $conexion;
    $valor = mysqli_fetch_array(mysqli_query($conexion, "SELECT partidos_liga FROM `tb_torneo` WHERE id_torneo=$torneo "));
    $valor = $valor['partidos_liga'];
    
    return $valor;
}
/**
 * [Get_Texto_TipoResultado description]
 * @param [type] $tiporesultado [description]
 */
function Get_Texto_TipoResultado($tiporesultado)
{
    global $conexion;
    $valor = mysqli_fetch_array(mysqli_query($conexion, "SELECT texto FROM `tb_tiporesultado` WHERE id_tiporesultado=$tiporesultado "));
    $valor = $valor['texto'];
    
     
    return $valor;
}
/**
 * [Get_Colegio ]
 * @param [type] $torneo [id_coelgio]
 */
function Get_Colegio($colegio)
{
  global $conexion;
  $valor  = mysqli_fetch_array(mysqli_query($conexion, "SELECT * FROM `tb_colegio` WHERE id_colegio='$colegio'"));
  $id_colegio        = $valor['id_colegio'];
  $nombre        = $valor['nombre'];
  $logo        = $valor['logo'];

  return array(
    "id_colegio" => "$id_colegio",
    "nombre" => "$nombre",
    "logo" => "$logo"
    );
}
/**
 * [Get_Lista_Partido_Programados_Deporte Los partidos partidos progamados para un torneo]
 * @param [type] $deporte [Id_deporte]
 */
function Get_Lista_Partido_Colegio($colegio,$estado)
{
    global $conexion;
    $query = mysqli_query($conexion, 
        "SELECT id_torneo,deporte,tipo_deporte,tipo_resultado,categoria,id_deportes,nombre_torneo from tr_equiposxpartidos,tb_partidos,tb_equipos,tb_torneo,tb_deportes,tb_colegio WHERE estado='$estado' and partido=id_partido  and id_equipo=equipo and id_torneo=torneo and deporte=id_deportes  and tb_colegio.id_colegio=tb_equipos.colegio and colegio='$colegio'    Group by id_torneo    order by fecha asc , hora asc ");
    $vector    = array();
    while ($valor = mysqli_fetch_array($query)) {

     $id_torneo  = $valor['id_torneo'];
     $nombre_torneo = $valor['nombre_torneo'];
     $deporte  = $valor['deporte'];
     $categoria  = $valor['categoria'];
     $id_deportes  = $valor['id_deportes'];
     $tipo_deporte  = $valor['tipo_deporte'];
     $tipo_resultado  = $valor['tipo_resultado'];

     $vectores = array(
        'id_torneo' => "$id_torneo",
        'nombre_torneo' => "$nombre_torneo",
        'deporte' => "$deporte",
        'categoria' => "$categoria",
        'id_deportes' => "$id_deportes",
        'tipo_deporte' => "$tipo_deporte",
        'tipo_resultado' => "$tipo_resultado"
        );
     array_push($vector, $vectores);
 }
 return $vector;
}

/**
 * [Get_Lista_Partido_Por_Torneo_Colegio Obtengo los partido de un colegio
 *  torneo X]
 * @param [type] $torneo [description]
 */
function Get_Lista_Partido_Por_Torneo_Colegio($torneo,$estado,$colegio)
{
    global $conexion;
    $query = mysqli_query($conexion, 
        "SELECT DISTINCT partido from tr_equiposxpartidos,tb_equipos
        WHERE  partido in (SELECT id_partido from tb_partidos 
            WHERE estado=$estado order by fecha desc , hora desc) 
    AND equipo=id_equipo and torneo='$torneo' and tb_equipos.colegio=$colegio ");
    $vector    = array();
    while ($valor = mysqli_fetch_array($query)) {

     $partido  = $valor['partido'];

     $vectores = array(
        'partido' => "$partido"
        );
     array_push($vector, $vectores);
 }
 return $vector;
} 
/**
 * [Get_Colegio ]
 * @param [type] $torneo [id_coelgio]
 */
function Get_Jugadores_Colegio($colegio)
{
   global $conexion;
   $query = mysqli_query($conexion,"SELECT * FROM tb_equipos,tb_torneo,tb_deportes WHERE tb_equipos.torneo=tb_torneo.id_torneo and tb_torneo.deporte=tb_deportes.id_deportes AND colegio=$colegio ");
   $vector    = array();
   while ($valor = mysqli_fetch_array($query)) {

     $nombre_equipo        = $valor['nombre_equipo'];
     $nombre_torneo        = $valor['nombre_torneo'];
     $categoria        = $valor['categoria'];
     $nombre        = $valor['nombre'];

     $vectores = array(
        "nombre_equipo" => "$nombre_equipo",
        "nombre_torneo" => "$nombre_torneo",
        "categoria" => "$categoria",
        "nombre" => "$nombre"
        );
     array_push($vector, $vectores);
 }
 return $vector;
}

function Get_Lista_Clubes($estado){

    global $conexion;
    $valor = mysqli_query($conexion, "SELECT *
       FROM tb_colegio WHERE estado='$estado'");
    $datos = array();
    while ($informacion = mysqli_fetch_array($valor)) {
        $id  = $informacion['id_colegio'];
        $nombre = $informacion['nombre'];
        $direccion  = $informacion['direccion'];
        $telefono = $informacion['telefono'];
        $correo  = $informacion['correo'];
        $presidente = $informacion['presidente'];
        $cancha  = $informacion['cancha_entrenamiento'];
        $horario = $informacion['horario'];
        $logo = $informacion['logo'];
        $vector = array(
            'id' => "$id",
            'nombre' => "$nombre",
            'direccion' => "$direccion",
            'telefono' => "$telefono",
            'correo' => "$correo",
            'presidente' => "$presidente",
            'cancha' => "$cancha",
            'horario' => "$horario",
            'logo' => "$logo",
            );
        array_push($datos, $vector);
    }
    
    return $datos;

}


function Get_Ruta_Usuario($ruta){

    global $conexion;
    $valor = mysqli_query($conexion, "SELECT *
       FROM tb_ruta_usuario WHERE id_ruta='$ruta' order by orden asc ");
    $datos = array();
    while ($informacion = mysqli_fetch_array($valor)) {
        $id_ruta  = $informacion['id_ruta'];
        $lat = $informacion['lat'];
        $lon  = $informacion['lon'];
        $fecha_generacion = $informacion['fecha_generacion'];
        $orden  = $informacion['orden'];
        $vector = array(
            'id_ruta' => "$id_ruta",
            'lat' => "$lat",
            'lon' => "$lon",
            'fecha_generacion' => "$fecha_generacion",
            'orden' => "$orden"
            );
        array_push($datos, $vector);
    }
    
    return json_encode($datos,JSON_HEX_TAG);

}

?>
