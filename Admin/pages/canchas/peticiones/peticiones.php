<?php
session_start();
include('../../../php/consultas.php');
include('../../../php/canchas.php');

if(isset($_SESSION['id_usuarios']))
{
    $resultado = '{"salida":true,';
    $bandera = $_POST['bandera'];

// Modifica un club.
    if ($bandera === "modificar-imagen") {
    }
    // Guarda los datos de un nuevo cancha.
    else if($bandera === "nuevo") {

        $nombre = $_POST['nombre'];
         $estado = $_POST['estado'];
        if (boolean_new_cancha($nombre,$estado)) {
            $resultado.='"mensaje":true';
        } else {
            $resultado.='"mensaje":false';
        }
    }
    // Guarda los datos de un nuevo cancha.
    else if($bandera === "modificar") {
        $cancha = $_POST['cancha'];
        $nombre = $_POST['nombre'];
         $estado = $_POST['estado'];

        if (boolean_Set_cancha($nombre,$estado,$cancha)) {
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