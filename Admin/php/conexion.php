
<?php
	include('configuracion.php');
	$server=String_Get_Valores('server');
	$username=String_Get_Valores('username');
	$password=String_Get_Valores('password');
	$db=String_Get_Valores('basededatos');
	$conexion = mysqli_connect($server,$username,$password,$db);
	if (mysqli_connect_errno())
	{
		printf('Conexión fallida: %s\n', mysqli_connect_error());
	}
	mysqli_query($conexion,"SET NAMES 'utf8'");
?>