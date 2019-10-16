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

					if (/\w/gi.test($('.select-torneo option:selected').val()))
					{
						if (/\w/gi.test($('.url').val()))
						{
							return true;
						}
						else
						{
							$('.url').focus();
							swal("Error", "La imagen debe tener un archivo asociado.", "error");
							return false;

						}

					}
					else
					{
						$('.select-torneo').focus();
						swal("Error", "La imagen  debe estar asociada a un torneo.", "error");
						return false;


					}

		},
		Validaruevo : function()
		{

					if (/\w/gi.test($('.select-n-torneo option:selected').val()))
					{
						if (/\w/gi.test($('.n-url').val()))
						{
							return true;
						}
						else
						{
							$('.n-url').focus();
							swal("Error", "La imagen debe tener un archivo asociado.", "error");
							return false;

						}

					}
					else
					{
						$('.select-n-torneo').focus();
						swal("Error", "La imagen  debe estar asociada a un torneo.", "error");
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
						bandera: "nuevo",
						url:	$('.n-url').val(),
						torneo :$('.select-n-torneo option:selected').val()
						

					},
					success: function (resp) {

						var resp = $.parseJSON(resp);
						if (resp.salida === true && resp.mensaje === true) {
							swal({title: "Información",
								text: "La imagen se ha agregado exitosamente!.",
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
						bandera: "modificar",
						url:	$('.url').val(),
						torneo :$('.select-torneo option:selected').val(),
						codigo   :$('.guardar').data('imagen')
						

					},
					success: function (resp) {

						var resp = $.parseJSON(resp);
						if (resp.salida === true && resp.mensaje === true) {
							swal({title: "Información",
								text: "La imagen se ha modificado exitosamente!",
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
cargarModal: function(imagen,url,torneo)
{
	$('.url').val(url);
	$('.select-torneo').val(torneo);
	$('.select-torneo').change();
	$('.guardar').data('imagen',imagen);
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
	$('#tabla-clubs').on("click", ".ver", function(){

			$('#imagenes').attr('src',$(this).data('logo'))
	 		$('#imagenesvisor').modal('show'); 
	});

	$('#tabla-clubs').on("click", ".delete-item", function(){
		var valor = $(this).data('codigo');

		swal({title: "¿ Esta seguro ?",
				text: " Desea eliminar la imagen de la galeria, sera de manera permanente.",
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
							bandera: "eliminar",
							codigo: valor
						},
						success: function (resp) {

							var resp = $.parseJSON(resp);
							if (resp.salida === true && resp.mensaje === true) {
								swal({title: "Información",
									text: "La imagen se ha eliminado exitosamente!.",
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
		var url = $(this).data('url');
		var torneo = $(this).data('torneo');
		var codigo = $(this).data('codigo');
		galeria.cargarModal(codigo,url,torneo);
	});
}
};
$(document).ready(function () {

	galeria.inicio();

});

});