
$(function() {
	var t='';
	var amonestaciones = {
		inicio: function () {
			amonestaciones.Cargar_Fechas();
			amonestaciones.recargar();
			amonestaciones.Add_Resultado();
			amonestaciones.Cargar_Partidos();
			amonestaciones.Cargar();
			amonestaciones.CargarDatos();
			amonestaciones.Add_Amonestaciones_Edit();
			amonestaciones.Tablas();
			amonestaciones.Checkprincipal();
		},
		recargar: function () {
			amonestaciones.TomarDatos_Resultados();
			amonestaciones.Tabla();
			amonestaciones.SeleccionPartidos();
			amonestaciones.Seleccion();
			amonestaciones.Seleccion_fechas();
			amonestaciones.Guardar_Gestion();


		},
		Checkprincipal : function()
		{
			$('#principal').change(function() {
				if($(this).is(":checked")) {

					$('.fila-tabla').each(function(indice, elemento) {
						$(elemento).find('.confirmacion').prop('checked',true);
					}); 

				}
				else
				{
					$('.fila-tabla').each(function(indice, elemento) {
						$(elemento).find('.confirmacion').prop('checked',false);
					}); 

				}

			});

		},

		Tablas : function()
		{
			$('#tabla1').dataTable( {
				"pageLength": 50
			} );
			$('#tabla2').dataTable( {
				"pageLength": 50
			} );
			$('#tabla3').dataTable( {
				"pageLength": 100
			} );
		},
		TomarDatos_Gestion : function ()
		{
			var array =[];
			var objeto =[];

			$('.fila-tabla').each(function(indice, elemento) {
				
				var objeto =[];
				objeto.push($(elemento).data('jugador'));
				objeto.push($(elemento).data('partido'));
				if($(elemento).find('.confirmacion').is(':checked'))
				{
					objeto.push(1); 
				}
				else
				{
					objeto.push(2);
				}
				array.push(objeto);
			}); 
			return array;
		},
		Guardar_Gestion: function () {
			$('.guardar-amonestaciones-gestionar').on("click", function(){

				swal({title: "¿Esta seguro que DESEA GUARDAR LA GESTION DE LAS AMONESTACIONES?",
					text: "",
					type: "warning",
					confirmButtonText: "Aceptar",
					showCancelButton: true,
					confirmButtonColor: "rgb(174, 222, 244)",
					closeOnConfirm: false
				}, function (isConfirm) {
					if (isConfirm) {
						$.ajax({
							url: 'pages/amonestaciones/peticiones/peticiones.php',
							type: 'POST',
							data: {
								bandera: "agregardetalles-amonestaciones-gestion",
								json  : amonestaciones.TomarDatos_Gestion()
							},
							success: function (resp) {

								var resp = $.parseJSON(resp);
								if (resp.salida === true && resp.mensaje === true) {
									swal({title: "Información",
										text: "Se han gestionado las amonestaciones de manera exitosa!",
										type: "success",
										confirmButtonText: "Aceptar",
										showCancelButton: false,
										confirmButtonColor: "rgb(174, 222, 244)",
										closeOnConfirm: false
									}, function (isConfirm) {
										if (isConfirm) {
											history.back();
										}
									});

								} else {
									swal("", "Ha ocurrido un error, intenta nuevamente.", "error");
								}
							}
						});
					}
				});


});

},
Abrir_Gestionar_Amonestaciones: function () {
	$('.tabla-resultados').on("click", ".to-gestionar", function(){
		var numero_fecha = $(this).data('numero_fecha');
		var	url = "pages/amonestaciones/manejargestionamonestaciones.php?id="+numero_fecha; 
		window.open(url, '_self');

	});
},
Seleccion_fechas: function()
{
	$('.selector-fechas').on('change', function () {
		$.ajax({
			url: 'pages/amonestaciones/peticiones/peticiones.php',
			type: 'POST',
			data: {
				bandera: "get_fechas",
				campeonato:  $('.selector-fechas  option:selected').val()
			},
			success: function (resp) {


				var resp = $.parseJSON(resp);
				if (resp.salida === true && resp.mensaje === true) {
					t.row($('.tabla-resultados').parents('tr') ).clear().draw();
					for (var i = 0; i < resp.datos.length; i++) {
						t.row.add( [ 
							resp.datos[i].numero_fecha,
							'<div class="btn-group btn-group-xs" role="group" aria-label="Extra-small button group"><button data-numero_fecha="'+resp.datos[i].numero_fecha+'"  type="button" class="btn bg-blue waves-effect to-gestionar" data-toggle="modal" > <i class="material-icons">edit</i></button></div>'
							] ).draw( false );

					}
					amonestaciones.Abrir_Gestionar_Amonestaciones();
				} else {
					t.row($('.tabla-resultados').parents('tr') ).clear().draw();
					swal("Importante", "No hay FECHAS PARA GESTIONAR AMONESTACIONES para este campeonato, o selecciona alguno.", "info");
				}
			}
		});
});
},
Cargar_Fechas : function()
{
	$.ajax({
		url: 'pages/amonestaciones/peticiones/peticiones.php',
		type: 'POST',
		data: {
			bandera: "get_campeonato",
			campeonato:  $('.selector-fechas  option:selected').val()
		},
		success: function (resp) {

			var resp = $.parseJSON(resp);
			if (resp.salida === true && resp.mensaje === true) {
				$('.selector-fechas').val(resp.datos);
				$('.selector-fechas').change();
			} else {
				swal("Importante", "Selecciona un campeonato.", "info");
			}
		}
	});
},
Add_Amonestaciones_Edit: function () {
	$('.guardar-amonestaciones-editar').on("click", function(){

		swal({title: "¿Esta seguro que desea GUARDAR los amonestaciones del partido?",
			text: "",
			type: "warning",
			confirmButtonText: "Aceptar",
			showCancelButton: true,
			confirmButtonColor: "rgb(174, 222, 244)",

			closeOnConfirm: false
		}, function (isConfirm) {
			if (isConfirm) {

				$.ajax({
					url: 'pages/amonestaciones/peticiones/peticiones.php',
					type: 'POST',
					data: {
						bandera: "agregardetalles-amonestaciones",
						partido: $('.guardar-amonestaciones-editar').data('partido'),
						fecha: $('.guardar-amonestaciones-editar').data('fecha'),
						estado : $('.guardar-amonestaciones-editar').data('estado'),
						tipo : "editar",
						valor : jQuery.isEmptyObject(amonestaciones.TomarDatos_Resultados()),
						json  : amonestaciones.TomarDatos_Resultados(),
					},
					success: function (resp) {

						var resp = $.parseJSON(resp);
						if (resp.salida === true && resp.mensaje === true) {
							swal({title: "Información",
								text: "Se han editado las amonestaciones de manera exitosa!",
								type: "success",
								confirmButtonText: "Aceptar",
								showCancelButton: false,
								confirmButtonColor: "rgb(174, 222, 244)",
								closeOnConfirm: false
							}, function (isConfirm) {
								if (isConfirm) {
									history.back();
								}
							});

						} else {
							swal("", "Ha ocurrido un error, intenta nuevamente.", "error");
						}
					}
				});
}
});


});

},
CargarDatos : function ()
{
	$.ajax({
		url: 'pages/amonestaciones/peticiones/peticiones.php',
		type: 'POST',
		data: {
			bandera: "get_datosamonestaciones",
			partido:  $('.guardar-amonestaciones-editar').data('partido')
		},
		success: function (resp) {

			var resp = $.parseJSON(resp);
			if (resp.salida === true && resp.mensaje === true) {
				for (var i = 0; i < resp.datos.length; i++) {
					$('.fila-tabla').each(function(indice, elemento) {
						if( ($(elemento).data('jugador')==resp.datos[i].jugador))
						{
							$(elemento).find('.confirmacion').prop("checked", "checked");
							$(elemento).find('.comentario').val(resp.datos[i].comentario);
							$(elemento).find('.select-tarjeta').val(resp.datos[i].amonestacion);
							$(elemento).find('.select-tarjeta').change();
						}
					});

				};

			} else {
			//	swal("Importante", "No hay jugadores con amonestaciones para estos equipos,Para agregar las amonestaciones al menos debe haber un jugador en uno de los dos equipos.", "info");
			}
		}
	});

},
Editar_Amonestaciones: function () {
	$('.tabla-resultados').on("click", ".to-amonestaciones-editar", function(){
		var partido = $(this).data('id');
		var	url = "pages/amonestaciones/editaramonestaciones.php?id="+partido; 
		window.open(url, '_self');

	});
},
Cargar : function()
{
	$.ajax({
		url: 'pages/amonestaciones/peticiones/peticiones.php',
		type: 'POST',
		data: {
			bandera: "get_campeonato",
			campeonato:  $('.selector-campeonato-amonestaciones-editar  option:selected').val()
		},
		success: function (resp) {

			var resp = $.parseJSON(resp);
			if (resp.salida === true && resp.mensaje === true) {
				$('.selector-campeonato-amonestaciones-editar').val(resp.datos);
				$('.selector-campeonato-amonestaciones-editar').change();
			} else {
				swal("Importante", "Selecciona un campeonato.", "info");
			}
		}
	});
},
Abrir_Amonestaciones: function () {
	$('.tabla-resultados').on("click", ".to-amonestaciones", function(){
		var partido = $(this).data('id');
		var	url = "pages/amonestaciones/agregaramonestaciones.php?id="+partido; 
		window.open(url, '_self');

	});
},
Tabla : function()
{
	t = $('.tabla-resultados').DataTable();

},
Seleccion: function()
{


	$('.selector-campeonato-amonestaciones-editar').on('change', function () {
		$.ajax({
			url: 'pages/amonestaciones/peticiones/peticiones.php',
			type: 'POST',
			data: {
				bandera: "getpartidosdobleestado",
				estado : '2',
				estado1 : '7',
				campeonato:  $('.selector-campeonato-amonestaciones-editar option:selected').val()

			},
			success: function (resp) {


				var resp = $.parseJSON(resp);
				if (resp.salida === true && resp.mensaje === true) {
					t.row($('.tabla-resultados').parents('tr') ).clear().draw();
					for (var i = 0; i < resp.datos.length; i++) {
						t.row.add( [ 
							resp.datos[i].nombre_equipo1+' vs '+resp.datos[i].nombre_equipo2,
							'<strong>'+resp.datos[i].nombre_estado+'</strong><br>'+resp.datos[i].fecha,	
							'<div class="btn-group btn-group-xs" role="group" aria-label="Extra-small button group"><button data-partido="'+resp.datos[i].nombre_equipo1+' vs '+resp.datos[i].nombre_equipo2+'" data-id="'+resp.datos[i].id_partido+'" data-nfecha="'+resp.datos[i].Nfecha+'" data-fecha="'+resp.datos[i].fecha+'" data-estado="'+resp.datos[i].estado+'" data-lugar="'+resp.datos[i].lugar+'" data-hora="'+resp.datos[i].hora+'"  type="button" class="btn bg-blue waves-effect to-amonestaciones-editar" data-toggle="modal" > <i class="material-icons">edit</i></button></div>'
							] ).draw( false );

					}
					amonestaciones.Editar_Amonestaciones();
				} else {
					t.row($('.tabla-resultados').parents('tr') ).clear().draw();
					swal("Importante", "No hay partidos para EDITAR AMONESTACIONES para este campeonato, o selecciona alguno.", "info");
				}
			}
		});


});
},
SeleccionPartidos: function()
{


	$('.selector-campeonato-amonestaciones').on('change', function () {
		$.ajax({
			url: 'pages/amonestaciones/peticiones/peticiones.php',
			type: 'POST',
			data: {
				bandera: "getpartidosdobleestado",
				estado : '1',
				estado1 : '8',
				campeonato:  $('.selector-campeonato-amonestaciones  option:selected').val()

			},
			success: function (resp) {


				var resp = $.parseJSON(resp);
				if (resp.salida === true && resp.mensaje === true) {
					t.row($('.tabla-resultados').parents('tr') ).clear().draw();
					for (var i = 0; i < resp.datos.length; i++) {
						t.row.add( [ 
							resp.datos[i].nombre_equipo1+' vs '+resp.datos[i].nombre_equipo2,
							'<strong>'+resp.datos[i].nombre_estado+'</strong><br>'+resp.datos[i].fecha,	
							'<div class="btn-group btn-group-xs" role="group" aria-label="Extra-small button group"><button data-partido="'+resp.datos[i].nombre_equipo1+' vs '+resp.datos[i].nombre_equipo2+'" data-id="'+resp.datos[i].id_partido+'" data-nfecha="'+resp.datos[i].Nfecha+'" data-fecha="'+resp.datos[i].fecha+'" data-estado="'+resp.datos[i].estado+'" data-lugar="'+resp.datos[i].lugar+'" data-hora="'+resp.datos[i].hora+'"  type="button" class="btn bg-blue waves-effect to-amonestaciones" data-toggle="modal" > <i class="material-icons">edit</i></button></div>'
							] ).draw( false );

					}
					amonestaciones.Abrir_Amonestaciones();
				} else {
					t.row($('.tabla-resultados').parents('tr') ).clear().draw();
					swal("Importante", "No hay partidos para AGREGAR AMONESTACIONES para este campeonato, o selecciona alguno.", "info");
				}
			}
		});


});
},
Cargar_Partidos : function()
{
	$.ajax({
		url: 'pages/amonestaciones/peticiones/peticiones.php',
		type: 'POST',
		data: {
			bandera: "get_campeonato",
			campeonato:  $('.selector-campeonato-amonestaciones  option:selected').val()
		},
		success: function (resp) {

			var resp = $.parseJSON(resp);
			if (resp.salida === true && resp.mensaje === true) {
				$('.selector-campeonato-amonestaciones').val(resp.datos);
				$('.selector-campeonato-amonestaciones').change();
			} else {
				swal("Importante", "Selecciona un campeonato.", "info");
			}
		}
	});
},
TomarDatos_Resultados : function ()
{
	var array =[];
	var objeto =[];

	$('.fila-tabla').each(function(indice, elemento) {
		if($(elemento).find('.confirmacion').is(':checked'))
		{ 
			var objeto =[];
			objeto.push($(elemento).data('jugador'));
			objeto.push('0');
			objeto.push($(elemento).find('.comentario').val());
			objeto.push($(elemento).find('.select-tarjeta option:selected').val());
			array.push(objeto);

		} ;
	}); 
	return array;
},
Add_Resultado: function () {
	$('.guardar-amonestaciones').on("click", function(){

		swal({title: "¿Esta seguro que desea GUARDAR los amonestaciones del partido?",
			text: "",
			type: "warning",
			confirmButtonText: "Aceptar",
			showCancelButton: true,
			confirmButtonColor: "rgb(174, 222, 244)",

			closeOnConfirm: false
		}, function (isConfirm) {
			if (isConfirm) {

				$.ajax({
					url: 'pages/amonestaciones/peticiones/peticiones.php',
					type: 'POST',
					data: {
						bandera: "agregardetalles-amonestaciones",
						partido: $('.guardar-amonestaciones').data('partido'),
						fecha: $('.guardar-amonestaciones').data('fecha'),
						estado : $('.guardar-amonestaciones').data('estado'),
						tipo :  "nuevo",
						valor : jQuery.isEmptyObject(amonestaciones.TomarDatos_Resultados()),
						json  : amonestaciones.TomarDatos_Resultados(),
					},
					success: function (resp) {

						var resp = $.parseJSON(resp);
						if (resp.salida === true && resp.mensaje === true) {
							swal({title: "Información",
								text: "Se ha agregado los amonestaciones de manera exitosa!",
								type: "success",
								confirmButtonText: "Aceptar",
								showCancelButton: false,
								confirmButtonColor: "rgb(174, 222, 244)",
								closeOnConfirm: false
							}, function (isConfirm) {
								if (isConfirm) {
									history.back();
								}
							});

						} else {
							swal("", "Ha ocurrido un error, intenta nuevamente.", "error");
						}
					}
				});
}
});


});

}
};
$(document).ready(function () {

	amonestaciones.inicio();

});

});