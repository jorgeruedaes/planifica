<?php
session_start();
include('../../../php/principal.php');
include('../../../php/jugador.php');
include('../../../php/partidos.php');
include('../../../php/equipo.php');

if(isset($_SESSION['perfil']))
{
	$resultado = '{"salida":true,';
	$bandera = $_POST['bandera'];

// Agrega un partido al sitio.
	if ($bandera === "nuevo") {
		$nombre1 = $_POST['nombre1'];
		$nombre2 = $_POST['nombre2'];
		$apellido1 = $_POST['apellido1'];
		$apellido2 = $_POST['apellido2'];
		$estado = $_POST['estado'];
			$fecha = $_POST['fecha'];
		$documento= $_POST['documento'];
		$equipo = $_POST['equipo'];

		if (boolean_new_jugador($documento,$equipo,$nombre1,$nombre2,$apellido1,$apellido2,$fecha,$estado)) {
			$resultado.='"mensaje":true';
		} else {
			$resultado.='"mensaje":false';
		}
	}
	// Obtiene los datos de un partido.
	else if($bandera === "equiposxclub") {
		$club = $_POST['club'];
		$vector = Array_Get_Equipos_Club($club);
		if (!empty($vector)) {
			$resultado.='"mensaje":true,';
			$resultado.='"datos":'.json_encode($vector).'';
		} else {
			$resultado.='"mensaje":false';
		}
	}else if($bandera === "modificar") {
		$id_jugador = $_POST['id_jugador'];
		$fecha = $_POST['fecha'];
		$nombre1 = $_POST['nombre1'];
		$nombre2 = $_POST['nombre2'];
		$apellido1 = $_POST['apellido1'];
		$apellido2 = $_POST['apellido2'];
		$estado = $_POST['estado'];

		if (Set_Jugador($id_jugador,$nombre1,$nombre2,$apellido1,$apellido2,$fecha,$estado)) {
			$resultado.='"mensaje":true';
		} else {
			$resultado.='"mensaje":false';
		}
	}else if($bandera === "get_campeonato") {
		if (isset($_SESSION['campeonato'])) {
			$campeonato =$_SESSION['campeonato'];
			$resultado.='"mensaje":true,';
			$resultado.='"datos":'.json_encode($campeonato).'';
		} else {
			$resultado.='"mensaje":false';
		}
	}else if($bandera === "get_jugadores") {
		$campeonato = $_POST['campeonato'];
		$vector = Array_Get_Jugadores_Campeonato($campeonato);
		if (!empty($vector)) {
			$_SESSION['campeonato'] = $campeonato;
			$resultado.='"mensaje":true,';
			$resultado.='"datos":'.json_encode(add_nombre_equipo($vector)).'';
		} else {
			$_SESSION['campeonato']='0';
			$resultado.='"mensaje":false';
		}
	}
	else if($bandera === "getequipos") {
		$campeonato = $_POST['campeonato'];
		$vector = Array_Get_Equipos_Torneo($campeonato);
		if (!empty($vector)) {
			$resultado.='"mensaje":true,';
			$resultado.='"datos":'.json_encode($vector).'';
		} else {
			$resultado.='"mensaje":false';
		}
	}
}
else
{
	$resultado = '{"salida":false';
}
$resultado.='}';
echo ($resultado);

// funciones esecilaes

function add_nombre_equipo($vectores)
{
	$vector = array();
	foreach ($vectores as $valor) {
    $id_jugador       = $valor['id_jugador'];
        $nombre1          = $valor['nombre1'];
        $nombre2          = $valor['nombre2'];
        $apellido1        = $valor['apellido1'];
        $apellido2        = $valor['apellido2'];
        $equipo       = $valor['equipo'];
        $nombre_equipo = Get_NombreEquipo($valor['equipo']);
        $documento       = $valor['documento'];
        $nombre   =      $valor['nombre'];
        $nombre_estado  = $valor['nombre_estado'];
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
             'nombre_equipo' =>"$nombre_equipo",
            'estado_jugador' => "$estado_jugador",
            'fecha_ingreso' => "$fecha_ingreso",
            'fecha_nacimiento' => "$fecha_nacimiento",
            'telefono' => "$telefono",
            'profesion' => "$profesion"
            
            );
        array_push($vector, $datos);
    }
    return $vector ;
}