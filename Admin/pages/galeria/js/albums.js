//	var Creador = '<?php echo $usuario['id_galeria']; ?>'
$(function() {

	var galeria = {
		inicio: function () {
			galeria.recargar();
		},
		recargar: function () {
			galeria.enviarDatos();
			galeria.addPerfil();
			galeria.Nuevo();
			galeria.ModalImagen();
		},
		ValidarEditar: function()
		{

					if (/\w/gi.test($('.select-estado option:selected').val()))
					{
						if (/\w/gi.test($('.nombre').val()))
						{
							return true;
						}
						else
						{
							$('.nombre').focus();
							swal("Error", "El Albumm debe tener un nombre.", "error");
							return false;

						}

					}
					else
					{
						$('.select-estado').focus();
						swal("Error", "El Album debe tener un estado.", "error");
						return false;


					}

		},
		Validaruevo : function()
		{

					if (/\w/gi.test($('.select-n-estado option:selected').val()))
					{
						if (/\w/gi.test($('.n-nombre').val()))
						{
							return true;
						}
						else
						{
							$('.n-nombre').focus();
							swal("Error", "El ALbum debe tener un nombre.", "error");
							return false;

						}

					}
					else
					{
						$('.select-n-estado').focus();
						swal("Error", "El Album debe tener un estado.", "error");
						return false;


					}

		},
		Nuevo : function ()
		{
			$('.guardar-nuevo').off('click').on('click', function () {	
				if(galeria.Validaruevo())
				{
				$.ajax({
					url: 'pages/galeria/peticiones/peticiones.php',
					type: 'POST',
					data: {
						bandera: "nuevo_album",
						nombre:	$('.n-nombre').val(),
						estado :$('.select-n-estado option:selected').val()
						

					},
					success: function (resp) {

						var resp = $.parseJSON(resp);
						if (resp.salida === true && resp.mensaje === true) {
							swal({title: "Información",
								text: "El Album se ha agregado exitosamente!.",
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
				if(galeria.ValidarEditar())
				{
				$.ajax({
					url: 'pages/galeria/peticiones/peticiones.php',
					type: 'POST',
					data: {
						bandera: "modificar_album",
						nombre:	$('.nombre').val(),
						estado :$('.select-estado option:selected').val(),
						codigo   :$('.guardar').data('codigo')
						

					},
					success: function (resp) {

						var resp = $.parseJSON(resp);
						if (resp.salida === true && resp.mensaje === true) {
							swal({title: "Información",
								text: "El Album se ha modificado exitosamente!",
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
cargarModal: function(codigo,nombre,estado)
{
	$('.nombre').val(nombre);
	$('.select-estado').val(estado);
	$('.select-estado').change();
	$('.guardar').data('codigo',codigo);
	$('#defaultModal').modal('show'); 
	galeria.recargar();
},
addPerfil : function()
{
	$('.add-perfil').off('click').on('click', function () {	
		$('#nuevoPerfil').modal('show'); 
	});

},
ModalImagen :function()
{

	$('#tabla-clubs').on("click", ".delete-item", function(){
		var valor = $(this).data('codigo');

		swal({title: "¿ Esta seguro ?",
				text: " Desea eliminar el Album, sera de manera permanente.",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "rgb(174, 222, 244)",
				confirmButtonText: "Aceptar",
				closeOnConfirm: false
			}, function (isConfirm) {
				if (isConfirm) {
					$.ajax({
						url: 'pages/galeria/peticiones/peticiones.php',
						type: 'POST',
						data: {
							bandera: "eliminar_album",
							codigo: valor
						},
						success: function (resp) {

							var resp = $.parseJSON(resp);
							if (resp.salida === true && resp.mensaje === true) {
								swal({title: "Información",
									text: "El Album se ha eliminado exitosamente!.",
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

	$('#tabla-clubs').on("click", ".edit-item", function(){
		var nombre = $(this).data('nombre');
		var estado = $(this).data('estado');
		var codigo = $(this).data('codigo');
		galeria.cargarModal(codigo,nombre,estado);
	});
}
};
$(document).ready(function () {

	galeria.inicio();

});

});