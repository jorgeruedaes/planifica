
//$(function() {
	var t='';
	var partidos = {
		inicio: function () {
			partidos.recargar();
			partidos.Add_Resultado();
		},
		recargar: function () {
			partidos.enviarDatos();
			partidos.CargarModal_Editar_Partidos();
			partidos.ModificarPartido();
			partidos.EliminarPartido();
			partidos.AbrirAgregarResultado();
			partidos.SeleccionCampeonato();
			partidos.SeleccionCampeonato_Calendario();
			partidos.SeleccionCampeonato_Resultados();
			partidos.SeleccionCampeonato_Nuevo();
			partidos.Tabla();
			partidos.Cargar();
			partidos.Cargar_Calendario();
			partidos.Cargar_Resultados();
			partidos.Cargar_Nuevo();
			partidos.TomarDatos_Resultados();
			partidos.Cargar_Goles();
			partidos.SeleccionCampeonato_Goles();
			partidos.EnviarResultadoExpress();
			partidos.Tablas();

		},
		Tablas : function()
		{
			$('#tabla1').dataTable( {
				"pageLength": 50
			} );
			$('#tabla2').dataTable( {
				"pageLength": 50
			} );
		},
		EnviarResultadoExpress : function()
		{
			$('.guardar-resultado-rapido').off('click').on('click', function () {
				{
					swal({title: "¿Esta seguro?",
						text: "Desea GUARDAR los datos del partido",
						type: "warning",
						confirmButtonText: "Aceptar",
						showCancelButton: true,
						confirmButtonColor: "rgb(174, 222, 244)",

						closeOnConfirm: false
					}, function (isConfirm) {
						if (isConfirm) {

							$.ajax({
								url: 'pages/partidos/peticiones/peticiones.php',
								type: 'POST',
								data: {
									bandera: "agregarresultado-rapido",
									partido: $('#defaultModal').data('partido'),
									resultado1 : $('#resultado1').val(),
									resultado2 : $('#resultado2').val(),
									estado : $('#estado-partido').val()

								},
								success: function (resp) {

									var resp = $.parseJSON(resp);
									if (resp.salida === true && resp.mensaje === true) {
										swal({title: "Información",
											text: "Se ha agregado el resultado de manera exitosa!",
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

}
});


},
ValidarPartidos : function()
{
	if (/\w/gi.test($('#hora').val()))
	{
		if (/\w/gi.test($('#fecha').val()))
		{
			if (/\w/gi.test($('.select-lugar option:selected').val())) 
			{
				if (/\w/gi.test($('.select-estado option:selected').val())) 
				{
					if (/[0-9]{1,9}(\.[0-9]{0,10})?$/.test($('#ronda').val()))
					{
						return true;
					}
					else
					{
						$('#ronda').focus();
						swal("Error", "Debes escribir una Ronda valída.", "error");
						return false;

					}
				}
				else
				{
					$('.select-estado').focus();
					swal("Error", "Debes seleccionar un Estado valído.", "error");
					return false;	
				}

			}
			else
			{
				$('.select-lugar').focus();
				swal("Error", "Debes seleccionar un Lugar valído.", "error");
				return false;
			}

		}
		else
		{
			$('#fecha').focus();
			swal("Error", "Debes escribir una Fecha valída.", "error");
			return false;

		}

	} 
	else
	{
		$('#hora').focus();
		swal("Error", "Debes escribir una Hora valída.", "error");
		return false;

	}

}
,SeleccionCampeonato_Goles : function()
{


	$('.selector-campeonato-goles').on('change', function () {
		$.ajax({
			url: 'pages/partidos/peticiones/peticiones.php',
			type: 'POST',
			data: {
				bandera: "getpartidosdobleestado",
				estado : '1',
				estado1 : '7',
				campeonato:  $('.selector-campeonato-goles option:selected').val()

			},
			success: function (resp) {

				var resp = $.parseJSON(resp);
				if (resp.salida === true && resp.mensaje === true) {
					t.row($('.tabla-resultados').parents('tr') ).clear().draw();
					for (var i = 0; i < resp.datos.length; i++) {
						t.row.add( [ 
							resp.datos[i].nombre_equipo1+' vs '+resp.datos[i].nombre_equipo2,
							'<strong>'+resp.datos[i].Nfecha+'</strong><br>'+resp.datos[i].fecha,	
							'<div class="btn-group btn-group-xs" role="group" aria-label="Extra-small button group"><button data-partido="'+resp.datos[i].nombre_equipo1+' vs '+resp.datos[i].nombre_equipo2+'" data-estado="'+resp.datos[i].estado+'"  data-equipo1="'+resp.datos[i].nombre_equipo1+'" data-equipo2="'+resp.datos[i].nombre_equipo2+'" data-id="'+resp.datos[i].id_partido+'"  type="button" class="btn bg-blue waves-effect modal-goles" data-partido="'+resp.datos[i].id_partido+'" data-toggle="modal" > <i class="material-icons">games</i></button><button data-partido="'+resp.datos[i].nombre_equipo1+' vs '+resp.datos[i].nombre_equipo2+'" data-id="'+resp.datos[i].id_partido+'" data-nfecha="'+resp.datos[i].Nfecha+'" data-fecha="'+resp.datos[i].fecha+'" data-estado="'+resp.datos[i].estado+'" data-lugar="'+resp.datos[i].lugar+'" data-hora="'+resp.datos[i].hora+'"  type="button" class="btn bg-info waves-effect to-goles" data-toggle="modal" > <i class="material-icons">edit</i></button></div>'
							] ).draw( false );
								//partidos.EliminarPartido();
								//partidos.CargarModal_Editar_Partidos_Eesultado();
							}
							partidos.AbrirAgregarGoles();
						} else {
							t.row($('.tabla-resultados').parents('tr') ).clear().draw();
							swal("Importante", "No hay partidos para AGREGAR GOLES para este campeonato, o selecciona alguno.", "info");
						}
					}
				});


});
},
Cargar_Goles : function()
{
	$.ajax({
		url: 'pages/partidos/peticiones/peticiones.php',
		type: 'POST',
		data: {
			bandera: "get_campeonato",
			campeonato:  $('.selector-campeonato-goles option:selected').val()
		},
		success: function (resp) {

			var resp = $.parseJSON(resp);
			if (resp.salida === true && resp.mensaje === true) {
				$('.selector-campeonato-goles').val(resp.datos);
				$('.selector-campeonato-goles').change();
			} else {
				swal("Importante", "Selecciona un campeonato.", "info");
			}
		}
	});
},
Add_Resultado: function () {
	$('.guardar-partido').on("click", function(){

		swal({title: "¿Esta seguro?",
			text: "Desea GUARDAR los datos del partido, ya no podra ser modificado.",
			type: "warning",
			confirmButtonText: "Aceptar",
			showCancelButton: true,
			confirmButtonColor: "rgb(174, 222, 244)",

			closeOnConfirm: false
		}, function (isConfirm) {
			if (isConfirm) {

				$.ajax({
					url: 'pages/partidos/peticiones/peticiones.php',
					type: 'POST',
					data: {
						bandera: "agregardetalles",
						partido: $('.guardar-partido').data('partido'),
						fecha: $('.guardar-partido').data('fecha'),
						json  : partidos.TomarDatos_Resultados(),
						resultado1 : $('#resultado1').val(),
						resultado2 : $('#resultado2').val(),

					},
					success: function (resp) {

						var resp = $.parseJSON(resp);
						if (resp.salida === true && resp.mensaje === true) {
							swal({title: "Información",
								text: "Se ha agregado el resultado de manera exitosa!",
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
TomarDatos_Resultados : function ()
{
	var array =[];
	var objeto =[];

	$('.fila-tabla').each(function(indice, elemento) {
		if($(elemento).find('.confirmacion').is(':checked'))
		{ 
			var objeto =[];

			objeto.push($(elemento).data('jugador'));
			objeto.push($(elemento).find('.gol').val());
			objeto.push($(elemento).find('.autogol').val());
			objeto.push($(elemento).find('.select-tarjeta option:selected').val());
			array.push(objeto);
		} ;
	}); 
	return array;
},
Validar : function()
{
	var equipoa = $('.select-equipoa option:selected').val();
	var equipob  = $('.select-equipob option:selected').val();
	if(equipoa==equipob)
	{
		swal("Error", "Debes seleccionar equipos diferentes.", "error");
		return false;
	}
	else
	{
		if (/\w/gi.test($('.selector-campeonato-nuevo option:selected').val()))
		{
			if (/\w/gi.test($('#hora').val()))
			{
				if (/\w/gi.test($('#fecha').val()))
				{
					if (/\w/gi.test($('.select-lugar option:selected').val())) 
					{
						if (/[0-9]{1,9}(\.[0-9]{0,10})?$/.test($('#ronda').val()))
						{
							return true;
						}
						else
						{
							$('#ronda').focus();
							swal("Error", "Debes escribir  una Ronda valída.", "error");
							return false;

						}
					}
					else
					{
						$('.select-lugar').focus();
						swal("Error", "Debes seleccionar un Lugar valída.", "error");
						return false;

					}

				}
				else
				{
					$('#fecha').focus();
					swal("Error", "Debes escribir una Fecha valída.", "error");
					return false;

				}
			}
			else
			{
				$('#hora').focus();
				swal("Error", "Debes esccribir una Hora valída.", "error");
				return false;

			}


		} 
		else
		{
			$('.selector-campeonato-nuevo').focus();
			swal("Error", "Debes seleccionar una Categoria valída.", "error");
			return false;

		}
		
	}
},

Cargar_Nuevo : function()
{
	$.ajax({
		url: 'pages/partidos/peticiones/peticiones.php',
		type: 'POST',
		data: {
			bandera: "get_campeonato",
			campeonato:  $('.selector-campeonato-nuevo option:selected').val()
		},
		success: function (resp) {

			var resp = $.parseJSON(resp);
			if (resp.salida === true && resp.mensaje === true) {
				$('.selector-campeonato-nuevo').val(resp.datos);
				$('.selector-campeonato-nuevo').change();
			} else {
				swal("Importante", "Selecciona un campeonato.", "info");
			}
		}
	});
},
Cargar_Resultados : function()
{
	$.ajax({
		url: 'pages/partidos/peticiones/peticiones.php',
		type: 'POST',
		async: false,
		data: {
			bandera: "get_campeonato",
			campeonato:  $('.selector-campeonato-resultados option:selected').val()
		},
		success: function (resp) {

			var resp = $.parseJSON(resp);
			if (resp.salida === true && resp.mensaje === true) {
				$('.selector-campeonato-resultados').val(resp.datos);
				$('.selector-campeonato-resultados').change();
			} else {
				swal("Importante", "Selecciona un campeonato.", "info");
			}
		}
	});
},
Cargar_Calendario : function()
{
	$.ajax({
		url: 'pages/partidos/peticiones/peticiones.php',
		type: 'POST',
		data: {
			bandera: "get_campeonato",
			campeonato:  $('.selector-campeonato-calendario option:selected').val()
		},
		success: function (resp) {

			var resp = $.parseJSON(resp);
			if (resp.salida === true && resp.mensaje === true) {
				$('.selector-campeonato-calendario').val(resp.datos);
				$('.selector-campeonato-calendario').change();
			} else {
				swal("Importante", "Selecciona un campeonato.", "info");
			}
		}
	});
},

Cargar : function()
{
	$.ajax({
		url: 'pages/partidos/peticiones/peticiones.php',
		type: 'POST',
		data: {
			bandera: "get_campeonato",
			campeonato:  $('.selector-campeonato option:selected').val()
		},
		success: function (resp) {

			var resp = $.parseJSON(resp);
			if (resp.salida === true && resp.mensaje === true) {
				$('.selector-campeonato').val(resp.datos);
				$('.selector-campeonato').change();
			} else {
				swal("Importante", "Selecciona un campeonato.", "info");
			}
		}
	});
},
Tabla : function()
{
	t = $('.tabla-resultados').DataTable();

},
SeleccionCampeonato_Nuevo : function()
{


	$('.selector-campeonato-nuevo').on('change', function () {
		$.ajax({
			url: 'pages/partidos/peticiones/peticiones.php',
			type: 'POST',
			data: {
				bandera: "getequipos",
				campeonato:  $('.selector-campeonato-nuevo option:selected').val()

			},
			success: function (resp) {


				var resp = $.parseJSON(resp);
				if (resp.salida === true && resp.mensaje === true) {
					$('#select-equipoa').html('').selectpicker('refresh');
					$('#select-equipoa').append('<option value="0">--Selecciona un Equipo --</option>').selectpicker('refresh');
					$('#select-equipob').html('').selectpicker('refresh');
					$('#select-equipob').append('<option value="0">--Selecciona un Equipo --</option>').selectpicker('refresh');
					for (var i = 0; i < resp.datos.length; i++) {
						$('#select-equipoa').append('<option value='+resp.datos[i].id_equipo+'>'+resp.datos[i].nombre_equipo+'</option>').selectpicker('refresh');
						$('#select-equipob').append('<option value='+resp.datos[i].id_equipo+'>'+resp.datos[i].nombre_equipo+'</option>').selectpicker('refresh');
					}
				} else {
					$('#select-equipoa').html('').selectpicker('refresh');
					$('#select-equipoa').append('<option value="0">--Selecciona un Equipo --</option>').selectpicker('refresh');
					$('#select-equipob').html('').selectpicker('refresh');
					$('#select-equipob').append('<option value="0">--Selecciona un Equipo --</option>').selectpicker('refresh');
					swal("Importante", "No hay EQUIPOS para este campeonato, o selecciona alguno.", "info");
				}
			}
		});


});
},
SeleccionCampeonato_Resultados : function()
{


	$('.selector-campeonato-resultados').on('change', function () {
		$.ajax({
			url: 'pages/partidos/peticiones/peticiones.php',
			type: 'POST',
			data: {
				bandera: "getcampeonato",
				estado : '2',
				campeonato:  $('.selector-campeonato-resultados option:selected').val()

			},
			success: function (resp) {

				var resp = $.parseJSON(resp);
				if (resp.salida === true && resp.mensaje === true) {
					t.row($('.tabla-resultados').parents('tr') ).clear().draw();
					for (var i = 0; i < resp.datos.length; i++) {
						t.row.add( [ 
							resp.datos[i].nombre_equipo1+' vs '+resp.datos[i].nombre_equipo2,
							'<strong>'+resp.datos[i].nombre_estado+'</strong><br>'+resp.datos[i].fecha,	
							'<div class="btn-group btn-group-xs" role="group" aria-label="Extra-small button group"><button data-partido="'+resp.datos[i].nombre_equipo1+' vs '+resp.datos[i].nombre_equipo2+'" data-id="'+resp.datos[i].id_partido+'" data-nfecha="'+resp.datos[i].Nfecha+'" data-fecha="'+resp.datos[i].fecha+'" data-estado="'+resp.datos[i].estado+'" data-lugar="'+resp.datos[i].lugar+'" data-hora="'+resp.datos[i].hora+'"  type="button" class="btn bg-blue waves-effect edit-goles-partido" data-toggle="modal" > <i class="material-icons">edit</i></button><button data-partido="'+resp.datos[i].nombre_equipo1+' vs '+resp.datos[i].nombre_equipo2+'" data-id="'+resp.datos[i].id_partido+'" data-nfecha="'+resp.datos[i].Nfecha+'" data-fecha="'+resp.datos[i].fecha+'" data-estado="'+resp.datos[i].estado+'" data-lugar="'+resp.datos[i].lugar+'" data-hora="'+resp.datos[i].hora+'" data-tiporesultado="'+resp.datos[i].tiporesultado+'"   type="button" class="btn bg-blue waves-effect edit-tiporesultado" > <i class="material-icons">settings</i></button></div>'
							] ).draw( false );
						partidos.EditGoles();

					}
				} else {
					t.row($('.tabla-resultados').parents('tr') ).clear().draw();
					swal("Importante", "No hay partidos para EDITAR RESULTADOS para este campeonato, o selecciona alguno.", "info");
				}
			}
		});


});
},
SeleccionCampeonato_Calendario : function()
{
	$('.selector-campeonato-calendario').on('change', function () {
		$.ajax({
			url: 'pages/partidos/peticiones/peticiones.php',
			type: 'POST',
			data: {
				bandera: "getpartidosdobleestado",
				estado : '1',
				estado1 : '3',
				campeonato:  $('.selector-campeonato-calendario option:selected').val()

			},
			success: function (resp) {

				var resp = $.parseJSON(resp);
				if (resp.salida === true && resp.mensaje === true) {
					t.row($('.tabla-resultados').parents('tr') ).clear().draw();
					for (var i = 0; i < resp.datos.length; i++) {
						t.row.add( [ 
							resp.datos[i].nombre_equipo1+' vs '+resp.datos[i].nombre_equipo2,
							'<strong>'+resp.datos[i].nombre_estado+'</strong><br>'+resp.datos[i].fecha,	
							'<div class="btn-group btn-group-xs" role="group" aria-label="Extra-small button group"><button data-partido="'+resp.datos[i].nombre_equipo1+' vs '+resp.datos[i].nombre_equipo2+'" data-id="'+resp.datos[i].id_partido+'" data-nfecha="'+resp.datos[i].Nfecha+'" data-fecha="'+resp.datos[i].fecha+'" data-estado="'+resp.datos[i].estado+'" data-lugar="'+resp.datos[i].lugar+'" data-hora="'+resp.datos[i].hora+'"  type="button" class="btn bg-blue waves-effect edit-partidos" data-toggle="modal" > <i class="material-icons">edit</i></button><button  data-partido="'+resp.datos[i].nombre_equipo1+' vs '+resp.datos[i].nombre_equipo2+'"  data-id="'+resp.datos[i].id_partido+'" type="button" class="btn bg-red waves-effect delete-partido"> <i class="material-icons">delete</i></button></div>'
							] ).draw( false );
						partidos.EliminarPartido();
						partidos.CargarModal_Editar_Partidos();

					}
				} else {
					t.row($('.tabla-resultados').parents('tr') ).clear().draw();
					swal("Importante", "No hay partidos para EDITAR CALENDARIO para este campeonato, o selecciona alguno.", "info");
				}
			}
		});


});
},

SeleccionCampeonato : function()
{
	$('.selector-campeonato').on('change', function () {
		$.ajax({
			url: 'pages/partidos/peticiones/peticiones.php',
			type: 'POST',
			data: {
				bandera: "getpartidosdobleestado",
				estado : '1',
				campeonato:  $('.selector-campeonato option:selected').val()

			},
			success: function (resp) {

				var resp = $.parseJSON(resp);
				if (resp.salida === true && resp.mensaje === true) {
					t.row($('.tabla-resultados').parents('tr') ).clear().draw();
					for (var i = 0; i < resp.datos.length; i++) {
						t.row.add( [ 
							resp.datos[i].nombre_equipo1+' vs '+resp.datos[i].nombre_equipo2,
							'<strong>'+resp.datos[i].Nfecha+'</strong> '+resp.datos[i].fecha,	
							'<div class="btn-group btn-group-xs" role="group" aria-label="Small button group"><button data-id="'+resp.datos[i].id_partido+'" type="button" class="btn btn-primary waves-effect to-partido"><i class="material-icons">edit</i></button></div>'

							] ).draw( false );
						partidos.AbrirAgregarResultado();

					}
				} else {
					t.row($('.tabla-resultados').parents('tr') ).clear().draw();
					swal("Importante", "No hay partidos en los cuales AGREGAR RESULTADOS para este campeonato, o selecciona alguno.", "info");
				}
			}
		});


});
}
,
EliminarPartido: function () {
	$('.tabla-resultados').on("click", ".delete-partido", function(){
		var partido =$(this).data('id');
		var datos = $(this).data('partido');
		swal({title: "¿Esta seguro que desea ELIMINAR el partido?",
			text: datos,
			type: "warning",
			confirmButtonText: "Aceptar",
			showCancelButton: true,
			confirmButtonColor: "rgb(174, 222, 244)",

			closeOnConfirm: false
		}, function (isConfirm) {
			if (isConfirm) {

				$.ajax({
					url: 'pages/partidos/peticiones/peticiones.php',
					type: 'POST',
					data: {
						bandera: "eliminar",
						partido: partido

					},
					success: function (resp) {

						var resp = $.parseJSON(resp);
						if (resp.salida === true && resp.mensaje === true) {
							swal({title: "Información",
								text: "El partido se ha eliminado exitosamente!",
								type: "success",
								confirmButtonText: "Aceptar",
								showCancelButton: false,
								confirmButtonColor: "rgb(174, 222, 244)",
								closeOnConfirm: false
							}, function (isConfirm) {
								if (isConfirm) {
									window.location.reload();
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
enviarDatos: function () {


	$('.guardar').off('click').on('click', function () {
		if(partidos.Validar()){
			$.ajax({
				url: 'pages/partidos/peticiones/peticiones.php',
				type: 'POST',
				data: {
					bandera: "nuevo",
					equipoa: $('.select-equipoa option:selected').val(),
					equipob: $('.select-equipob option:selected').val(),
					fecha:   $('#fecha').val(),
					hora:    $('#hora').val(),
					lugar:   $('.select-lugar option:selected').val(),
					ronda:   $('#ronda').val()


				},
				success: function (resp) {

					var resp = $.parseJSON(resp);
					if (resp.salida === true && resp.mensaje === true) {
						swal({title: "Información",
							text: "El partido se ha creado exitosamente!",
							type: "success",
							showCancelButton: false,
							confirmButtonColor: "rgb(174, 222, 244)",
							confirmButtonText: "Aceptar",
							closeOnConfirm: false
						}, function (isConfirm) {
							if (isConfirm) {
								window.location.reload();
							}
						});
					} else {
						swal("", "Ha ocurrido un error, intenta nuevamente.", "error");
					}
				}
			});

		}
	});


},
CargarModal_Editar_Partidos: function () {
	$('.tabla-resultados').on("click", ".edit-partidos", function(){
		var partido = $(this).data('partido');
		var fecha = $(this).data('fecha');
		var hora = $(this).data('hora');
		var lugar = $(this).data('lugar');
		var estado = $(this).data('estado');
		var Nfecha = $(this).data('nfecha');
		var id = $(this).data('id');

		$('#defaultModalLabel').text(partido);
		$('#fecha').val(fecha);
		$('#hora').val(hora);
		$('.select-lugar').val(lugar);
		$('.select-lugar').change();
		$('.modificar').data('partido',id);
		$('.select-estado').val(estado);
		$('.select-estado').change();
		$('#ronda').val(Nfecha);
		$('#defaultModal').modal('show'); 
		partidos.ModificarPartido();
	});

},
ModificarPartido: function () {
	$('.modificar').on("click", function(){
		if(partidos.ValidarPartidos())
		{
			swal({title: "",
				text: " ¿ Esta seguro que desea modificar el partido ?",
				type: "warning",
				showCancelButton: false,
				confirmButtonColor: "rgb(174, 222, 244)",
				confirmButtonText: "Ok",
				closeOnConfirm: false
			}, function (isConfirm) {
				if (isConfirm) {

					$.ajax({
						url: 'pages/partidos/peticiones/peticiones.php',
						type: 'POST',
						data: {
							bandera: "modificar",
							perfil:  $('#perfil').val(),
							modulo:  $('#modulo').val(),
							fecha:   $('#fecha').val(),
							hora:    $('#hora').val(),
							partido: $('.modificar').data('partido'),
							estado:  $('.select-estado option:selected').val(),
							lugar:   $('.select-lugar option:selected').val(),
							ronda:   $('#ronda').val()
						},
						success: function (resp) {

							var resp = $.parseJSON(resp);
							if (resp.salida === true && resp.mensaje === true) {
								swal({title: "Información",
									text: "El partido se ha mdificado exitosamente!",
									type: "success",
									showCancelButton: false,
									confirmButtonColor: "rgb(174, 222, 244)",
									confirmButtonText: "Aceptar",
									closeOnConfirm: false
								}, function (isConfirm) {
									if (isConfirm) {
										window.location.reload();
									}
								});
							} else {
								swal("", "Ha ocurrido un error, intenta nuevamente.", "error");
							}
						}
					});

}
});
}
});

},
AbrirAgregarResultado: function () {
	$('.tabla-resultados').on("click", ".to-partido", function(){
		var partido = $(this).data('id');
		var	url = "pages/partidos/agregarresultado.php?id="+partido; 
		window.open(url, '_self');

	});
},
AbrirAgregarGoles: function () {
	$('.tabla-resultados').on("click", ".to-goles", function(){
		var partido = $(this).data('id');
		var	url = "pages/partidos/agregargoles.php?id="+partido; 
		window.open(url, '_self');

	});
	$('.tabla-resultados').on("click", ".modal-goles", function(){
		var partido = $(this).data('id');
		var informacion =$(this).data('partido');
		var equipo1 =$(this).data('equipo1');
		var equipo2 =$(this).data('equipo2');
		var estado =$(this).data('estado');
		$('#informacion-partido').val(informacion);
		$('#equipo1').text(equipo1);
		$('#estado-partido').val(estado);
		$('#equipo2').text(equipo2);
		$('#defaultModal').data('partido',partido);
		$('#defaultModal').modal('show'); 


	});
},
EditGoles : function ()
{
	$('.tabla-resultados').on("click", ".edit-goles-partido", function(){
		var partido = $(this).data('id');
		var	url = "pages/partidos/editargoles.php?id="+partido; 
		window.open(url, '_self');

	});

	$('.tabla-resultados').on("click", ".edit-tiporesultado", function(){
		var partido = $(this).data('id');
		var tiporesultado = $(this).data('tiporesultado');
		$('.guardar-tiporesultado').data('partido',partido);
		$('.select-tiporesultado').val(tiporesultado);
		$('.select-tiporesultado').change();
		$('#defaultModal').modal('show'); 
		partidos.ModificarTipoResultadoPartido();
		

	});

},
ModificarTipoResultadoPartido: function () {

	$('.guardar-tiporesultado').on("click", function(){
			swal({title: "¿ Esta seguro ?",
				text: " Desea cambiar el tipo de  resultado del partido, Modificara directamente la tabla de posiciones.",
				type: "warning",
				showCancelButton: false,
				confirmButtonColor: "rgb(174, 222, 244)",
				confirmButtonText: "Ok",
				closeOnConfirm: false
			}, function (isConfirm) {
				if (isConfirm) {

					$.ajax({
						url: 'pages/partidos/peticiones/peticiones.php',
						type: 'POST',
						data: {
							bandera: "modificar_tiporesultado",
							partido:  $('.guardar-tiporesultado').data('partido'),
							tiporesultado:  $('.select-tiporesultado  option:selected').val(),
						},
						success: function (resp) {

							var resp = $.parseJSON(resp);
							if (resp.salida === true && resp.mensaje === true) {
								swal({title: "Información",
									text: "El partido se ha mdificado exitosamente!",
									type: "success",
									showCancelButton: false,
									confirmButtonColor: "rgb(174, 222, 244)",
									confirmButtonText: "Aceptar",
									closeOnConfirm: false
								}, function (isConfirm) {
									if (isConfirm) {
										window.location.reload();
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

	partidos.inicio();

});

//});