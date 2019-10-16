<?php

session_start();
if(!isset($_SESSION['id_usuarios']))
	
   {
        echo "No hay ninguna sesion iniciada";
   }
   else
   { 
     session_destroy();
     header("location:inicio.php");
       
   }

?>