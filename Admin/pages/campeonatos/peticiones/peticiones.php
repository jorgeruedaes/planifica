<?php
session_start();
include('../../../php/consultas.php');
include('../../../php/campeonatos.php');

if(isset($_SESSION['id_usuarios']))
{
    $resultado = '{"salida":true,';
    $bandera = $_POST['bandera'];

// Modifica uno de los perfiles de usuario.
    if ($bandera === "modificar-reglamentos") {
    }
    // Guarda los datos de un nuevo campeonato.
    else if($bandera === "nuevo") {

        $nombre = $_POST['nombre'];
        $categoria = $_POST['categoria'];
        $puntos = $_POST['puntos'];
        $url = $_POST['url'];

        if (boolean_new_Campeonato($nombre,$categoria,$puntos,$url)) {
            $resultado.='"mensaje":true';
        } else {
            $resultado.='"mensaje":false';
        }
    }
    // Guarda los datos de un nuevo perfil.
    else if($bandera === "modificar-campeonato") {

        $nombre = $_POST['nombre'];
        $categoria = $_POST['categoria'];
        $estado = $_POST['estado'];
        $puntos = $_POST['puntos'];
        $torneo = $_POST['torneo'];
        $url = $_POST['url'];

        if (Set_Campeonatos($nombre,$categoria,$estado,$torneo,$puntos,$url)) {
            $resultado.='"mensaje":true';
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