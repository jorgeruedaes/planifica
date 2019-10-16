//	var Creador = '<?php echo $usuario['id_jugadores']; ?>'
$(function() {
	var t ='';
	var jugadores = {
		inicio: function () {
			jugadores.recargar();
			jugadores.Cargar();
		},
		recargar: function () {
			jugadores.enviarDatos();
			jugadores.Nuevo();
			jugadores.evento_cambiosclub();
			jugadores.Modal_Editar();
			jugadores.Tabla();
			jugadores.SeleccionCampeonato();
			jugadores.cargarModalNuevo();
			jugadores.SeleccionEquipo();

		},ValidarEditar : function()
		{
			if (/\w/gi.test($('.nombre1').val())) 
				{
						if (/\w/gi.test($('.apellido1').val())) 
				{
					if (/\w/gi.test($('.select-equipos option:selected').val())) 
					{
						if (/\w/gi.test($('.select-estado option:selected').val())) 
						{
							return true;
						}
						else
						{
					$('.select-estado').focus();
					swal("Error", "Debes seleccionar un estado.", "error");
					return false;
						}

					}
					else
					{
					$('.select-equipos').focus();
					swal("Error", "Debes seleccionar un equipo.", "error");
					return false;

					}

				}
				else
				{
					$('.apellido1').focus();
					swal("Error", "Debes escribir al menos 1 apellido.", "error");
					return false;
				}


				}
				else
				{
					$('.nombre1').focus();
					swal("Error", "Debes escribir al menos 1 nombre.", "error");
					return false;

				}


		},
		ValidarNuevo : function()
		{
			if (/\w/gi.test($('.n-nombre1').val())) 
				{
						if (/\w/gi.test($('.n-apellido1').val())) 
				{
					if (/\w/gi.test($('.select-n-equipos option:selected').val())) 
					{
						if (/\w/gi.test($('.select-n-estado option:selected').val())) 
						{
							return true;
						}
						else
						{
					$('.select-n-estado').focus();
					swal("Error", "Debes seleccionar un estado.", "error");
					return false;
						}

					}
					else
					{
					$('.select-n-equipos').focus();
					swal("Error", "Debes seleccionar un equipo.", "error");
					return false;

					}

				}
				else
				{
					$('.n-apellido1').focus();
					swal("Error", "Debes escribir al menos 1 apellido.", "error");
					return false;
				}


				}
				else
				{
					$('.n-nombre1').focus();
					swal("Error", "Debes escribir al menos 1 nombre.", "error");
					return false;

				}


		},
		SeleccionEquipo : function()
		{
			$('.selector-campeonato').on('change', function () {
				$.ajax({
					url: 'pages/jugadores/peticiones/peticiones.php',
					type: 'POST',
					data: {
						bandera: "getequipos",
						campeonato:  $('.selector-campeonato option:selected').val()

					},
					success: function (resp) {


						var resp = $.parseJSON(resp);
						if (resp.salida === true && resp.mensaje === true) {
							$('#select-n-equipos').html('').selectpicker('refresh');
							$('#select-n-equipos').append('<option value="0">--Selecciona un Equipo --</option>').selectpicker('refresh');
							for (var i = 0; i < resp.datos.length; i++) {
								$('#select-n-equipos').append('<option value='+resp.datos[i].id_equipo+'>'+resp.datos[i].nombre_equipo+'</option>').selectpicker('refresh');
							
							}
						} else {
							$('#select-n-equipos').html('').selectpicker('refresh');
							$('#select-n-equipos').append('<option value="0">--Selecciona un Equipo --</option>').selectpicker('refresh');

						}
					}
				});


});

},
		SeleccionCampeonato: function()
		{
			$('.selector-campeonato').on('change', function () {
				$.ajax({
					url: 'pages/jugadores/peticiones/peticiones.php',
					type: 'POST',
					data: {
						bandera: "get_jugadores",
						campeonato:  $('.selector-campeonato option:selected').val()

					},
					success: function (resp) {

						var resp = $.parseJSON(resp);
						if (resp.salida === true && resp.mensaje === true) {
							t.row($('#tabla-jugadores').parents('tr') ).clear().draw();
							for (var i = 0; i < resp.datos.length; i++) {
								t.row.add( [ 
									resp.datos[i].id_jugador,
									resp.datos[i].documento,
									resp.datos[i].nombre,	
									resp.datos[i].nombre_equipo,
									resp.datos[i].nombre_estado,
									'<div class="btn-group btn-group-xs" role="group" aria-label="Small button group"><button data-id_jugador='+resp.datos[i].id_jugador+' data-nombre1="'+resp.datos[i].nombre1+'" data-nombre2="'+resp.datos[i].nombre2+'" data-apellido1="'+resp.datos[i].apellido1+'" data-apellido2="'+resp.datos[i].apellido2+'" data-fechanacimiento="'+resp.datos[i].fecha_nacimiento+'" data-estado='+resp.datos[i].estado_jugador+'  type="button" class="btn btn-primary waves-effect edit-item"><i class="material-icons">edit</i></button></div>'
									] ).draw( false );
								

							}
							jugadores.Modal_Editar();
						//	$('.page-loader-wrapper').css('display','none');
						} else {
							t.row($('#tabla-jugadores').parents('tr') ).clear().draw();
							swal("Importante", "No hay JUGADORES  para este campeonato, o selecciona alguno.", "info");
						}
					}
				});


			});
		},
		Cargar : function()
		{
			$.ajax({
				url: 'pages/jugadores/peticiones/peticiones.php',
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
						jugadores.SeleccionEquipo();
					} else {
						swal("Importante", "Selecciona un campeonato.", "info");
					}
				}
			});
		},
		Tabla : function()
		{
			t = $('#tabla-jugadores').DataTable();

		},
		evento_cambiosclub : function ()
		{
			$('.select-n-club').on('change', function() {

				$.ajax({
					url: 'pages/jugadores/peticiones/peticiones.php',
					type: 'POST',
					data: {
						bandera: "equiposxclub",
						club :$('.select-n-club option:selected').val()
						

					},
					success: function (resp) {

						var resp = $.parseJSON(resp);
						if (resp.salida === true && resp.mensaje === true) {
							for (var i = 0; i<= resp.datos.length; i++) {
								$('.select-n-equipos').first().append('<option value="'+resp.datos[i].id_equipo+'">"'+resp.datos[i].nombre_equipo+'"</option>')

							};


						} else {
							swal("", "Ha ocurrido un error, intenta nuevamente.", "error");
						}
					}
				});

			});
		},
		Nuevo : function ()
		{
			$('.guardar-nuevo').off('click').on('click', function () {	
				if(jugadores.ValidarNuevo())
				{
				$.ajax({
					url: 'pages/jugadores/peticiones/peticiones.php',
					type: 'POST',
					data: {
						bandera: "nuevo",
						nombre1 : $('.n-nombre1').val(),
						nombre2 :$('.n-nombre2').val(),
						apellido1 :$('.n-apellido1').val(),
						apellido2 : $('.n-apellido2').val(),
						fecha :$('.n-fechanacimiento').val(),
						documento :$('.n-documento').val(),
						estado :$('.select-n-estado option:selected').val(),
						equipo :$('.select-n-equipos option:selected').val(),
						

					},
					success: function (resp) {

						var resp = $.parseJSON(resp);
						if (resp.salida === true && resp.mensaje === true) {
							swal({title: "Información",
								text: "El jugador se ha creado exitosamente!.",
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

		enviarDatos: function () {
			$('.guardar').off('click').on('click', function () {
				if(jugadores.ValidarEditar())
				{
				$.ajax({
					url: 'pages/jugadores/peticiones/peticiones.php',
					type: 'POST',
					data: {
						bandera: "modificar",
						id_jugador : $('.guardar').data('idjugador'),
						nombre1 : $('.nombre1').val(),
						nombre2 :$('.nombre2').val(),
						apellido1 :$('.apellido1').val(),
						apellido2 : $('.apellido2').val(),
						fecha :$('.fechanacimiento').val(),
						estado :$('.select-estado option:selected').val(),


					},
					success: function (resp) {

						var resp = $.parseJSON(resp);
						if (resp.salida === true && resp.mensaje === true) {
							swal({title: "Importante",
								text: "El jugador se ha modificado exitosamente!",
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
		cargarModal: function(id_jugador,nombre1,nombre2,apellido1,apellido2,estado,fechanacimiento)
		{
			$('.guardar').data('idjugador',id_jugador)
			$('.nombre1').val(nombre1);
			$('.nombre2').val(nombre2);
			$('.apellido1').val(apellido1);
			$('.apellido2').val(apellido2);
			$('.fechanacimiento').val(fechanacimiento);
			$('.select-estado').val(estado);
			$('.select-estado').change();
			$('#defaultModal').modal('show'); 
		},
		cargarModalNuevo: function()
		{
			$('.add-jugador').on("click", function(){
			$('#Modalnuevo').modal('show'); 
			});


		},

		Modal_Editar :function()
		{

			$('#tabla-jugadores').on("click", ".edit-item", function(){
				var id_jugador = $(this).data('id_jugador');
				var nombre1 = $(this).data('nombre1');
				var nombre2 = $(this).data('nombre2');
				var apellido1 = $(this).data('apellido1');
				var apellido2 = $(this).data('apellido2');
				var estado = $(this).data('estado');
				var fechanacimiento = $(this).data('fechanacimiento');
				jugadores.cargarModal(id_jugador,nombre1,nombre2,apellido1,apellido2,estado,fechanacimiento);
			});
		}
	};
	$(document).ready(function () {

		jugadores.inicio();

	});

});