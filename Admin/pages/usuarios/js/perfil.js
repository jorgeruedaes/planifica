
$(function() {

	var perfil = {
		inicio: function () {
			perfil.recargar();
		},
		recargar: function () {
			perfil.enviarDatos();
			perfil.borrarUsuario();
			perfil.seleccionarIcono();
			perfil.cargarModal();
			perfil.activarEditar();
		},
		enviarDatos: function () {
			$('.guardar').off('click').on('click', function () {
				$.ajax({
					url: 'pages/perfil/peticiones/peticiones.php',
					type: 'POST',
					data: {
						bandera: "modificar",
						id_perfiles: $('.select-perfiles option:selected').val(),
						estado: $('.select-estados option:selected').val(),
						id_perfil: $('#defaultModal').data('usuario')

					},
					success: function (resp) {

						var resp = $.parseJSON(resp);
						if (resp.salida === true && resp.mensaje === true) {
							swal({title: "Información",
								text: "El usuario se ha modificado exitosamente!",
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
			});

		},
		borrarUsuario: function () {
			$('.delete-item').off('click').on('click', function () {
				var valor = $(this);
				swal({
					title: "¿ Esta seguro ?",
					text: "El usuario ya no podra realizar acciones en el aplicativo!",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Si,Eliminalo!",
					cancelButtonText: "No,Cancelalo!",
					closeOnConfirm: false,
					closeOnCancel: false
				}, function (isConfirm) {
					if (isConfirm) {
						perfil.desactivar(valor);
					} else {
						swal("Cancelado", "", "error");
					}
				});

			});


		},
		desactivar: function(valor)
		{
			$.ajax({
				url: 'pages/perfil/peticiones/peticiones.php',
				type: 'POST',
				data: {
					bandera: "eliminar",
					id_perfil: valor.data('id')

				},
				success: function (resp) {

					var resp = $.parseJSON(resp);
					if (resp.salida === true && resp.mensaje === true) {
						swal({
							title: "Información",
							text: "El usuario se ha eliminado exitosamente!",
							type: "info",
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
		},
		cargarModal: function()
		{
			$('.editar-pass').off('click').on('click', function () {
				$('#defaultModal').modal('show'); 
			});
		},

		seleccionarIcono : function()
		{
			$('.seleccionar').off('click').on('click', function () {
				var valor =	$('input:radio[name=group1]:checked').parent().find('.material-icons').text();
				$('.icono').val(valor);
				$('#defaultModal').modal('hide'); 
			});
		},
		activarEditar : function()
		{
			$('.activate-edit').off('click').on('click', function (){
				$('.nombre').attr('disabled',false);
				$('.apellido').attr('disabled',false);
				$('.email').attr('disabled',false);
				$('.respuesta').attr('disabled',false);

				
			});

		}
	};
	$(document).ready(function () {

		perfil.inicio();

	});

});