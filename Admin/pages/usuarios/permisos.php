<?php  
$ubicacion ="../";
$id_modulos="17";
include("../menuinicial.php");
if(Boolean_Get_Modulo_Permiso($id_modulos,"3")){
	?>

	<?php
}else
{
	require("../sinpermiso.php");
}
?>