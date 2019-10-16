<?php
session_start();
include('../../../php/consultas.php');
include('../../../php/galeria.php');

if(isset($_SESSION['id_usuarios']))
{
	$resultado = '{"salida":true,';
	$bandera = $_POST['bandera'];

// Agrega un nuevo modulo al sitio.
	if ($bandera === "nuevo") {
		$torneo = $_POST['torneo'];
		$url = $_POST['url'];
		if (boolean_new_imagen($url,$torneo)) {
			$resultado.='"mensaje":true';
		} else {
			$resultado.='"mensaje":false';
		}
	} else if($bandera === "nuevo_album") {

        $nombre = $_POST['nombre'];
        $estado = $_POST['estado'];
        if (boolean_new_album($nombre,$estado)) {
            $resultado.='"mensaje":true';
        } else {
            $resultado.='"mensaje":false';
        }
    }else if($bandera === "modificar_album") {

        $nombre = $_POST['nombre'];
        $estado = $_POST['estado'];
        $id_album = $_POST['codigo'];
        if (boolean_set_album($id_album,$nombre,$estado)) {
            $resultado.='"mensaje":true';
        } else {
            $resultado.='"mensaje":false';
        }
   }else if($bandera === "eliminar_album") {

        $id_album = $_POST['codigo'];
        if (boolean_delete_album($id_album)) {
            $resultado.='"mensaje":true';
        } else {
            $resultado.='"mensaje":false';
        }
    }
	// Permite modificar un modulo.
	else if($bandera === "modificar") {
		$torneo = $_POST['torneo'];
		$url = $_POST['url'];
		$codigo = $_POST['codigo'];

		
		if (boolean_set_imagen($url,$torneo,$codigo)) {
			$resultado.='"mensaje":true';
		} else {
			$resultado.='"mensaje":false';
		}
	}else if($bandera === "eliminar") {
		
		$codigo = $_POST['codigo'];

		if (boolean_delete_imagen($codigo)) {
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