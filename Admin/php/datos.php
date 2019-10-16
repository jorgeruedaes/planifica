<?php
/**
 * [valores Obtiene los valores de la configuración de cada una de las paginas]
 * @param  [String] $solicitud [Nombre del valor solicitado]
 * @return [type]            [description]
 */
function String_Get_Datos($solicitud){

	// VALORES DE CONTACTO 
	if ($solicitud == "telefono") {// color de el encabezado de las tablas
		return "+7 6450038 -  317 427 9583";
	}else if ($solicitud == "direccion") {// color de los titulos de las tablas
		return "Carrera 30 No 14 - 45 Oficina 409";
	}else if ($solicitud == "email") {// letra de el encabezado 
		return "lsf@ligasantandereanadefutbol.co";
	}else if ($solicitud == "email2") {// letra de el encabezado 
		return "lsf@ligasantandereanadefutbol.co";
	}else if ($solicitud=="direccion_2"){
		return "<li><i class='fa fa-map-marker'></i> <span> Carrera 30 No 14-45</span>
	</li><li><span> Edificio Indersantander Oficina 409</span></li><li>
	<span> Unidad deportiva Alfonso López</span></li><li><span>Bucaramanga, Colombia</span></li>";
}else if ($solicitud=="horario"){
	return "<li><i class='fa fa-clock-o'></i>
	<span>Lun - Vie  8 AM - 12M / 2PM - 5PM</span>
</li><li><span></span></li><li>
<span>Nit 890.203.403-6</span></li>";
}else if($solicitud == "telefono_2"){
	return " <li><i class='fa fa-phone'></i>
	<span>Teléfono + 7 - 6450038</span>
</li><li><span></span>
</li><li><i class='fa fa-envelope'></i>
<span class='break-word'>lsf@ligasantandereanadefutbol.co 
</span>
</li>
<li class='break-word'>lsf@ligasantandereanadefutbol.co
</li>";
}else if ($solicitud == "quienessomos"){
	return "<p class='justify'>Somos un organismo deportivo y social sin ánimo de lucro encargado de orientar, dirigir y satisfacer las necesidades de la población Santandereana, de contar con una institución altamente calificada, con una estructura organizacional y humana capaz de formar futbolistas de alto rendimiento, contando con un equipo interdisciplinario que le permita responder a las exigencias de la competencia y dirigentes deportivos comprometidos con las futuras generaciones forjando el interés hacia la practica del fútbol aficionado en la niñez, la juventud y sociedad en general.</p>";

}else if($solicitud=="vision"){
	return "<p class='justify'>Para el 2018 la liga Santandereana de fútbol se proyecta como una institución nacional, reconocida por su alto rendimiento, fomento y participación en el desarrollo y formación deportiva de la sociedad Santandereana, que cuenta con la capacidad y facilidad de adaptabilidad ante los cambios que se dan en el medio futbolístico, convirtiéndose en una institución de excelencia.</p>";
}else if($solicitud=="valores"){
	return "<ul><li><p class='justify'><b>Cordialidad:</b> Atendiendo a todos las personas que soliciten nuestros servicios con la mayor amabilidad, sin ninguna discriminación, de conformidad con las disposiciones reglamentarias, estatutarias y legales, con los recursos disponibles.</p></li>
	<li class='with-border'><p class='justify'><b>Responsabilidad:</b> Brindando atención continua y adecuada con responsabilidad social y deportiva, con unos servicios de excelente calidad. </p></li>
	<li class='with-border'><p class='justify'><b>Calidad:</b> Buscando el mejoramiento continuo que contribuya con las acciones de la Liga y de todos los integrantes de la misma para garantizar la satisfacción de todos los usuarios. </p></li>
	<li class='with-border'><p class='justify'><b>Efectividad:</b> Buscando el mejor aprovechamiento del recurso humano, administrativo, tecnológico y financiero disponibles para el cumplimiento de nuestros objetivos y la solución pronta y optima de las necesidades de los usuarios.</p></li></ul>";
}else if($solicitud=="gestioncalidad"){
	return "<p class='justify'>Objetivos de Calidad Incrementar la eficiencia, eficacia y efectividad en la prestación de los servicios. Aumentar la satisfacción de los clientes Asegurar la competencia del personal Proveer y mantener la tecnología apropiada Aprovechar de manera adecuada los recursos financieros Mejorar continuamente los procesos del sistema de Gestión de Calidad.";
}else if($solicitud == "infopresidente"){
	return "<p class='justify'>Lisanfútbol tiene como presidente al abogado bumangués y dirigente deportivo, dr. <b>Jaime Ordóñez Ordóñez</b>.

	Apasionado del deporte y destacado servidor público en diferentes cargos en el departamento, nuestro presidente es el principal gestor del buen funcionamiento del fútbol aficionado en Santander con una notable gestión administrativa en la entidad, la cual desde hace varios años ha consolidado e impulsado el desarrollo no solo de la misma sino de este deporte en Santander.

	Gracias a esto cuenta con el total respaldo de los más de 120 clubes deportivos inscritos en la Liga y el reconocimiento de la comunidad en general por su destacada labor.</p>";
}else if($solicitud == "infocanchamarte"){
	return "<blockquote class='center'>Adecuación del principal escenario deportivo del fútbol aficionado en el departamento: La Cancha Marte.</blockquote>";
}else if ($solicitud == "nombreasistente"){
	return "MARGARITA LIZARAZO";
}else if($solicitud == "cargoasistente"){
	return "ASISTENTE ADMINISTRATIVA";
}else if($solicitud == "infoasistente"){
	return "<p class='justify'>Margarita es nuestra amable y eficiente asistente, encargada de atender gestiones como: inscripcion y registros en la plataforma Comet; publicación de la programación de los torneos municipales y de las resoluciones del Comite del Estatuto del Jugador y Comision Disciplinaria; Auxiliar de Tesoreria. No dudes en contactarla para cualquier consulta o requerimiento.</p>";
}else if ($solicitud == "nombreatencionalusuario"){
	return "ALEXANDRA BEDOYA";
}else if($solicitud == "cargoatencionalusuario"){
	return "ATENCIÓN AL USUARIO";
}else if($solicitud == "infoatencionalusuario"){
	return "<p class='justify'>Alexandra es nuestra simpática compañera quien da soporte a la gestión de pagos de arbitraje, carnetización, ingresos de caja e inscripciones.</p>";
}else if ($solicitud == "nombresecretariogeneral"){
	return "EDUARDO SALCEDO";
}else if($solicitud == "cargosecretariogeneral"){
	return "SECRETARIO GENERAL";
}else if($solicitud == "infosecretariogeneral"){
	return "<p class='justify'>Eduardo desempeña con especial atención las funciones como Secretario General de la liga.</p>";
}else if ($solicitud == "nombreanalisisygestion"){
	return "JUAN MANUEL VARGAS";
}else if($solicitud == "cargoanalisisygestion"){
	return "ANÁLISIS Y GESTIÓN ESTADÍSTICA";
}else if($solicitud == "infoanalisisygestion"){
	return "<p class='justify'>Juan Manuel es el encargado de llevar los registros estadísticos de los diferentes torneos y competiciones de la liga. Su efectiva y dinámica gestión permite que los clubes y entidades participantes puedan estar enterados de todo lo referente a resultados y clasificaciones.</p>";
}
else if ($solicitud=="direccion_3"){
	return "<li> <i class='fa fa-bank'></i>
	<p>Carrera 30 No 14 - 45 Edificio Indersantander Oficina 409. Bucaramanga, Santander - Colombia.</p>
</li>";

}else if($solicitud=="telefono_contacto"){
	return "<li> <i class='fa fa-phone'></i>
	<p>7 - 6450038</p></li>";
}else if ($solicitud=="celular_contacto"){
	return "<li> <i class='fa fa-fax'></i>
			<p>317 427 9583</p>
			</li>";
	
}


}

/*   
----------------------------------------------------
--------INFORMACIÓN ESTANDARES----------------------
----------------------------------------------------

----------------------------------------------------
Estandar para el manejo de funciones y variables PHP
-------------------------><-------------------------
Funciones-->
El NOMBRE debe empezar por el tipo de dato que retorna,
seguido por el tipo de funcion y finalizando con un nombre
que descriptivo de la función de la misma.

Ejemplo : Array_Get_Elementos();

Variables-->
Las variables deben ser en minuscula, siempre muy descriptivas
además deben ser en singular o plurar dependiendo el caso de uso.

Ejemplo : $query;

----------------------------------------------------
Estandar para el manejo de la BASE DE DATOS
-------------------------><-------------------------

Tablas -->
El NOMBRE debe ser en plural, definiendo claramente el tipo de información 
que contendra, además debe empezar por tb en caso de ser una tabla maestra 
y tr en caso de ser una relación entre tablas.

Ejemplo : tb_usuarios ||  tr_usuariosxtorneo

Campos-->
Los campos dentro de la bd deben ser en singular, y la llave primaria de 
cada una de las tablas debe empezar por id_nombretabla.

Ejemplo : id_modulos --> PK de la tabla modulos 

-----------------------------------------------------
Estandar para el nombre de las paginas y archivos
-----------------------------------------------------

Archivos,carpetas y paginas PHP-->
Los archivos se guardaran en la respectiva carpeta padre de la respectiva 
pagina o archivo, los nombres de la misma seran escritos SIEMPRE en 
minuscula y en singular.

Ejemplo : php/administracion.php 

 */
?>
