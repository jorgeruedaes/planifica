<?php
session_start();
include('../../../php/consultas.php');
include('../../../php/clubs.php');

if(isset($_SESSION['id_usuarios']))
{
    $resultado = '{"salida":true,';
    $bandera = $_POST['bandera'];

// Modifica un club.
    if ($bandera === "modificar-imagen") {
    }
    // Guarda los datos de un nuevo campeonato.
    else if($bandera === "nuevo") {

        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $presidente = $_POST['presidente'];
        $horario = $_POST['horario'];
        $cancha = $_POST['cancha'];
        $correo = $_POST['email'];
        $estado = $_POST['estado'];
        $url = $_POST['url'];

        if (boolean_new_Club($nombre,$telefono,$direccion,$presidente,$horario,$cancha,$correo,$estado,$url)) {
            $resultado.='"mensaje":true';
        } else {
            $resultado.='"mensaje":false';
        }
    }
    // Guarda los datos de un nuevo perfil.
    else if($bandera === "modificar") {
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $presidente = $_POST['presidente'];
        $horario = $_POST['horario'];
        $cancha = $_POST['cancha'];
        $correo = $_POST['correo'];
        $estado = $_POST['estado'];
        $club = $_POST['club'];
         $url = $_POST['url'];

        if (Set_Clubs($nombre,$telefono,$direccion,$presidente,$horario,$cancha,$correo,$estado,$club) and boolean_set_imagen_clubs($url,$club)) {
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