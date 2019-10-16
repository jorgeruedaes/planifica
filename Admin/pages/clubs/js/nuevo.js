//	var Creador = '<?php echo $usuario['id_campeonatos']; ?>'
$(function() {

	var campeonatos = {
		inicio: function () {
			campeonatos.recargar();
		},
		recargar: function () {
			campeonatos.enviarDatos();
			campeonatos.addPerfil();
			campeonatos.Nuevo();
			campeonatos.ModalImagen();
		},
		ValidarEditar : function()
		{
			if (/\w/gi.test($('.nombre').val())) 
			{
				if (/\w/gi.test($('.url').val())) 
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
					$('.url').focus();
					swal("Error", "El Club debe tener un logotipo.", "error");
					return false;
				}


			}
			else
			{
				$('.nombre').focus();
				swal("Error", "El Club debe tener un nombre.", "error");
				return false;

			}


		},
		ValidarNuevo : function()
		{
			if (/\w/gi.test($('.n-nombre').val())) 
			{
				if (/\w/gi.test($('.n-url').val())) 
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
					$('.n-url').focus();
					swal("Error", "El Club debe tener un logotipo.", "error");
					return false;
				}


			}
			else
			{
				$('.n-nombre').focus();
				swal("Error", "El Club debe tener un nombre.", "error");
				return false;

			}


		}
		,
		Nuevo : function ()
		{
			$('.guardar-nuevo').off('click').on('click', function () {	

				if(campeonatos.ValidarNuevo())
				{
				$.ajax({
					url: 'pages/clubs/peticiones/peticiones.php',
					type: 'POST',
					data: {
						bandera: "nuevo",
						nombre:	$('.n-nombre').val(),
						presidente :$('.n-presidente').val(),
						direccion: $('.n-direccion').val(),
						telefono:$('.n-telefono').val(),
						url:$('.n-url').val(),
						email:$('.n-email').val(),
						horario:$('.n-horario').val(),
						cancha:$('.n-cancha').val(),
						estado :$('.select-n-estado option:selected').val()
						

					},
					success: function (resp) {

						var resp = $.parseJSON(resp);
						if (resp.salida === true && resp.mensaje === true) {
							swal({title: "Información",
								text: "El club se ha creado exitosamente!.",
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
if(campeonatos.ValidarEditar())
{
		$.ajax({
			url: 'pages/clubs/peticiones/peticiones.php',
			type: 'POST',
			data: {
				bandera: "modificar",
				nombre:	$('.nombre').val(),
				presidente :$('.presidente').val(),
				direccion: $('.direccion').val(),
				telefono:$('.telefono').val(),
				correo:$('.correos').val(),
				url:$('.url').val(),
				horario:$('.horario').val(),
				cancha:$('.cancha').val(),
				estado :$('.select-estado option:selected').val(),
				club : $('#defaultModal').data('club')


			},
			success: function (resp) {

				var resp = $.parseJSON(resp);
				if (resp.salida === true && resp.mensaje === true) {
					swal({title: "Información",
						text: "El club se ha modificado exitosamente!",
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
cargarModal: function(club,nombre,presidente,direccion,telefono,email,horario,cancha,estado,url)
{
	$('.nombre').val(nombre);
	$('.presidente').val(presidente);
	$('.direccion').val(direccion);
	$('.telefono').val(telefono);
	$('.correos').val(email);
	$('.horario').val(horario);
	$('.cancha').val(cancha);
	$('.url').val(url);
	$('.select-estado').val(estado);
	$('.select-estado').change();
	$('#defaultModal').data('club',club);
	$('#defaultModal').modal('show'); 
	campeonatos.recargar();
},
addPerfil : function()
{
	$('.add-perfil').off('click').on('click', function () {	
		$('#nuevoPerfil').modal('show'); 
	});

},
ModalImagen :function()
{
	$('#tabla-clubs').on("click", ".ver", function(){

		$('#imagenes').attr('src',$(this).data('logo'))
		$('#imagenesvisor').modal('show'); 
	});

	$('#tabla-clubs').on("click", ".edit-item", function(){
		var tabla = $(this);
		var nombre = $(this).data('nombre');
		var presidente = $(this).data('presidente');
		var direccion = $(this).data('direccion');
		var telefono = $(this).data('telefono');
		var email = $(this).data('correo');
		var horario = $(this).data('horario');
		var cancha = $(this).data('cancha');
		var club = $(this).data('club');
		var estado = $(this).data('estado');
		var url = $(this).data('url');
		campeonatos.cargarModal(club,nombre,presidente,direccion,telefono,email,horario,cancha,estado,url);
	});
}
};
$(document).ready(function () {

	campeonatos.inicio();

});

});