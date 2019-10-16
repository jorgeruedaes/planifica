//	var Creador = '<?php echo $usuario['id_equipos']; ?>'
$(function() {
	var t='';
	var equipos = {
		inicio: function () {
			equipos.recargar();
			equipos.Cargar();
		},
		recargar: function () {
			equipos.Tabla();
			equipos.enviarDatos();
			equipos.Nuevo();
			equipos.add();
			equipos.ModalImagen();
			equipos.SeleccionEquipos();
			
		},
		ValidarNuevo : function ()
		{
			if (/\w/gi.test($('.n-nombre').val())) {
				if (/[0-9]{1,9}(\.[0-9]{0,10})?$/.test($('.select-n-club option:selected').val()) && $('.select-n-club option:selected').val() > 0)
				{
					if (/[0-9]{1,9}(\.[0-9]{0,10})?$/.test($('.select-n-torneo option:selected').val()) && $('.select-n-torneo option:selected').val() > 0)
					{
						if (/\w/gi.test($('.n-grupo').val())) 
						{
							if (/\w/gi.test($('.select-n-estado option:selected').val())) 
							{

								return true;
							}
							else
							{
								$('.select-n-estado').focus();
								swal("Error", "Debes seleccionar un Estado.", "error");
								return false;

							}
						}
						else
						{
							$('.n-grupo').focus();
							swal("Error", "Debe Escribir un Grupo.", "error");
							return false;

						}
					}
					else
					{
						$('.select-n-torneo').focus();
						swal("Error", "Debe seleccionar un Torneo o Categoria.", "error");
						return false;

					}
				}
				else
				{ 
					$('.select-n-club').focus();
					swal("Error", "Debe seleccionar un Club.", "error");
					return false;

				}

			}
			else
			{	
				$('.n-nombre').focus();
				swal("Error", "El nombre no es valído.", "error");
				return false;

			}

		},
		ValidarEdicion : function ()
		{
			if (/\w/gi.test($('.nombre').val())) {
				if (/[0-9]{1,9}(\.[0-9]{0,10})?$/.test($('.select-club option:selected').val()) && $('.select-club option:selected').val() > 0)
				{
					if (/[0-9]{1,9}(\.[0-9]{0,10})?$/.test($('.select-torneo option:selected').val()) && $('.select-torneo option:selected').val() > 0)
					{
						if (/\w/gi.test($('.grupo').val())) 
						{
							if (/\w/gi.test($('.select-estado option:selected').val())) 
							{

								return true;
							}
							else
							{
								$('.select-estado').focus();
								swal("Error", "Debes seleccionar un Estado.", "error");
								return false;

							}
						}
						else
						{
							$('.grupo').focus();
							swal("Error", "Debe Escribir un Grupo.", "error");
							return false;

						}
					}
					else
					{
						$('.select-torneo').focus();
						swal("Error", "Debe seleccionar un Torneo o Categoria.", "error");
						return false;

					}
				}
				else
				{ 
					$('.select-club').focus();
					swal("Error", "Debe seleccionar un Club.", "error");
					return false;

				}

			}
			else
			{	
				$('.nombre').focus();
				swal("Error", "El nombre no es valído.", "error");
				return false;

			}

		},
		Tabla : function()
		{
			t = $('.tabla-resultados').DataTable();

		},
		SeleccionEquipos : function()
		{


			$('.selector-campeonato').on('change', function () {
				$.ajax({
					url: 'pages/equipos/peticiones/peticiones.php',
					type: 'POST',
					data: {
						bandera: "getequipos",
						campeonato:  $('.selector-campeonato option:selected').val()

					},
					success: function (resp) {


						var resp = $.parseJSON(resp);
						if (resp.salida === true && resp.mensaje === true) {
							t.row($('.tabla-resultados').parents('tr') ).clear().draw();
							for (var i = 0; i < resp.datos.length; i++) {
								t.row.add( [ 
									resp.datos[i].id_equipo,
									resp.datos[i].nombre_equipo,
									resp.datos[i].colegio,
									resp.datos[i].grupo,
									resp.datos[i].estado,
									'<div class="btn-group btn-group-xs" role="group" aria-label="Small button group"><button data-id="'+resp.datos[i].id_equipo+'"data-estado="'+resp.datos[i].estado+'"data-tecnico="'+resp.datos[i].tecnico1+'"data-nombre="'+resp.datos[i].nombre_equipo+'"data-club="'+resp.datos[i].colegio+'"data-grupo="'+resp.datos[i].grupo+'"data-torneo="'+resp.datos[i].torneo+'" type="button" class="btn btn-primary waves-effect edit-item"><i class="material-icons">edit</i></button></div>'
									] ).draw( false );

							}
							equipos.ModalImagen();

						} else {
							t.row($('.tabla-resultados').parents('tr') ).clear().draw();
							swal("Importante", "No hay EQUIPOS para este campeonato, o selecciona alguno.", "info");
						}
					}
				});


});
},
Cargar : function()
{
	$.ajax({
		url: 'pages/equipos/peticiones/peticiones.php',
		type: 'POST',
		data: {
			bandera: "get_campeonato"
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
add : function()
{
	$('.add-perfil').off('click').on('click', function () {	
		$('#nuevoPerfil').modal('show'); 
	});

}
,
Nuevo : function ()
{
	$('.guardar-nuevo').off('click').on('click', function () {	

		if(equipos.ValidarNuevo())
		{
			$.ajax({
				url: 'pages/equipos/peticiones/peticiones.php',
				type: 'POST',
				data: {
					bandera: "nuevo",

					nombre:	$('.n-nombre').val(),
					grupo: $('.n-grupo').val(),
					tecnico: $('.n-tecnico').val(),
					torneo :$('.select-n-torneo option:selected').val(),
					estado :$('.select-n-estado option:selected').val(),
					club :$('.select-n-club option:selected').val()


				},
				success: function (resp) {

					var resp = $.parseJSON(resp);
					if (resp.salida === true && resp.mensaje === true) {
						swal({title: "Información",
							text: "El equipo se ha creado exitosamente!.",
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
		if(equipos.ValidarEdicion())
		{
			$.ajax({
				url: 'pages/equipos/peticiones/peticiones.php',
				type: 'POST',
				data: {
					bandera: "modificar",
					nombre:	$('.nombre').val(),
					tecnico :$('.tecnico').val(),
					grupo: $('.grupo').val(),
					tecnico: $('.tecnico').val(),
					torneo :$('.select-torneo option:selected').val(),
					estado :$('.select-estado option:selected').val(),
					club :$('.select-club option:selected').val(),
					equipo : $('#defaultModal').data('equipo')


				},
				success: function (resp) {

					var resp = $.parseJSON(resp);
					if (resp.salida === true && resp.mensaje === true) {
						swal({title: "Información",
							text: "El equipo se ha modificado exitosamente!",
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
cargarModal: function(club,nombre,tecnico,torneo,grupo,estado,equipo)
{
	$('.nombre').val(nombre);
	$('.tecnico').val(tecnico);
	$('.grupo').val(grupo);
	$('.select-torneo').val(torneo);
	$('.select-torneo').change();
	$('.select-club').val(club);
	$('.select-club').change();
	$('.select-estado').val(estado);
	$('.select-estado').change();

	$('#defaultModal').data('equipo',equipo);
	$('#defaultModal').modal('show'); 
	equipos.recargar();
},
ModalImagen :function()
{
	$('.tabla-resultados').on("click", ".edit-item", function(){
		var nombre = $(this).data('nombre');
		var tecnico = $(this).data('tecnico');
		var club = $(this).data('club');
		var torneo = $(this).data('torneo');
		var grupo = $(this).data('grupo');
		var estado = $(this).data('estado');
		var equipo = $(this).data('id');
		equipos.cargarModal(club,nombre,tecnico,torneo,grupo,estado,equipo);
	});
}
};
$(document).ready(function () {

	equipos.inicio();

});

});