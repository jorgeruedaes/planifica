<?php
session_start();
include('../../../php/consultas.php');
include('../../../php/usuario.php');

if(isset($_SESSION['id_usuarios']))
{
	$resultado = '{"salida":true,';
	$bandera = $_POST['bandera'];

// Modifica la contraseña desde el perfil del usuario.
	if ($bandera === "modificar-password") {
		$password = $_POST['password'];
		$query = Boolean_Set_Password($password,$_SESSION['id_usuarios']);
		if ($query) {
			$resultado.='"mensaje":true';
		} else {
			$resultado.='"mensaje":false';
		}
	}
	// Guarda los datos para cuando el usuario entra a modificar su perfil
	else if($bandera === "guardar-datos") {
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$email = $_POST['email'];
		$pregunta = $_POST['pregunta'];
		$respuesta = $_POST['respuesta'];
		$query = Boolean_Set_Usuario($nombre,$apellido,$email,$pregunta,$respuesta,$_SESSION['id_usuarios']);
		if ($query) {
			$resultado.='"mensaje":true';
		} else {
			$resultado.='"mensaje":false';
		}
	}
	// Permite modificar el perfil y su estado de un usuario.
	else if($bandera === "modificar") {
		$id_usuarios = $_POST['id_usuarios'];
		$estado = $_POST['estado'];
		$id_perfiles = $_POST['id_perfiles'];
		$query =Boolean_Set_Perfil_Estado_Usuario($id_usuarios,$estado,$id_perfiles);
		if ($query) {
			$resultado.='"mensaje":true';
		} else {
			$resultado.='"mensaje":false';
		}
	}
	// Permite modificar el perfil y su estado de un usuario.
	else if($bandera === "eliminar") {
		$id_usuarios = $_POST['id_usuarios'];
		$query =Boolean_Delete_Usuario($id_usuarios,$_SESSION['perfil']);
		if ($query) {
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