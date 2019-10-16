//	var Creador = '<?php echo $usuario['id_usuarios']; ?>'
$(function() {

	var usuarios = {
		inicio: function () {
			usuarios.recargar();
		},
		recargar: function () {
			usuarios.enviarDatos();
			usuarios.borrarUsuario();
			usuarios.editarItem();
		},
		enviarDatos: function () {
			$('.guardar').off('click').on('click', function () {
				$.ajax({
					url: 'pages/usuarios/peticiones/peticiones.php',
					type: 'POST',
					data: {
						bandera: "modificar",
						id_perfiles: $('.select-perfiles option:selected').val(),
						estado: $('.select-estados option:selected').val(),
						id_usuarios: $('#defaultModal').data('usuario')

					},
					success: function (resp) {

						var resp = $.parseJSON(resp);
						if (resp.salida === true && resp.mensaje === true) {
							swal({title: "",
								text: "El usuario se ha modificado exitosamente!",
								type: "success",
								showCancelButton: false,
								confirmButtonColor: "rgb(174, 222, 244)",
								confirmButtonText: "Ok",
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
						usuarios.desactivar(valor);
					} else {
						swal("Cancelado", "", "error");
					}
				});

			});


		},
		desactivar: function(valor)
		{
			$.ajax({
				url: 'pages/usuarios/peticiones/peticiones.php',
				type: 'POST',
				data: {
					bandera: "eliminar",
					id_usuarios: valor.data('id')

				},
				success: function (resp) {

					var resp = $.parseJSON(resp);
					if (resp.salida === true && resp.mensaje === true) {
						swal({
							title: "",
							text: "El usuario se ha eliminado exitosamente!",
							type: "info",
							showCancelButton: false,
							confirmButtonColor: "rgb(174, 222, 244)",
							confirmButtonText: "Ok",
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
		cargarModal: function(perfil,estado,usuario)
		{
			$('.select-perfiles').val(perfil);
			$('.select-perfiles').change();
			$('.select-estados').val(estado);
			$('.select-estados').change();
			$('#defaultModal').data('usuario',usuario);
			$('#defaultModal').modal('show'); 
			usuarios.recargar();
		},

		editarItem : function()
		{
			$('.edit-item').off('click').on('click', function () {
				var perfil = $(this).data('perfil');
				var estado = $(this).data('estado');
				var usuario = $(this).data('id');
				usuarios.cargarModal(perfil,estado,usuario);
			});
		}
	};
	$(document).ready(function () {

		usuarios.inicio();

	});

});