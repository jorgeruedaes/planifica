<?php
session_start();
include('../../../php/consultas.php');
include('../../../php/equipo.php');

if(isset($_SESSION['id_usuarios']))
{
    $resultado = '{"salida":true,';
    $bandera = $_POST['bandera'];

// Modifica un club.
    if ($bandera === "modificar-imagen") {
    }
    // Guarda los datos de un nuevo equipo.
    else if($bandera === "nuevo") {

        $nombre = $_POST['nombre'];
        $tecnico = $_POST['tecnico'];
        $torneo = $_POST['torneo'];
        $grupo = $_POST['grupo'];
        $club = $_POST['club'];
        $estado = $_POST['estado'];
        if (boolean_new_equipo($nombre,$tecnico,$grupo,$torneo,$club,$estado)) {
            $resultado.='"mensaje":true';
        } else {
            $resultado.='"mensaje":false';
        }
    }
    // Guarda los datos de un nuevo equipo.
    else if($bandera === "modificar") {
        $equipo = $_POST['equipo'];
        $nombre = $_POST['nombre'];
        $tecnico = $_POST['tecnico'];
        $torneo = $_POST['torneo'];
        $grupo = $_POST['grupo'];
        $club = $_POST['club'];
        $estado = $_POST['estado'];

        if (boolean_Set_equipo($nombre,$tecnico,$grupo,$torneo,$club,$estado,$equipo)) {
            $resultado.='"mensaje":true';
        } else {
            $resultado.='"mensaje":false';
        }
    }else if($bandera === "get_campeonato") {
        if (isset($_SESSION['campeonato'])) {
            $campeonato =$_SESSION['campeonato'];
            $resultado.='"mensaje":true,';
            $resultado.='"datos":'.$campeonato.'';
        } else {
            $resultado.='"mensaje":false';
        }
    }
    else if($bandera === "getequipos") {
        $campeonato =$_POST['campeonato'];
        $_SESSION['campeonato']=$_POST['campeonato'];
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
?>