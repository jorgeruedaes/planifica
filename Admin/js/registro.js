
$(function() {

	var resgistro = {
		inicio: function () {
			resgistro.recargar();

		},
		recargar: function () {
			resgistro.enviarDatos();
			resgistro.validarContrasena();
			resgistro.Validar();
		},
		enviarDatos: function () {
			$('.registro').on('click', function () {
				$.ajax({
					url: 'php/peticiones.php',
					type: 'POST',
					data: {
						bandera: "guardar",
						nombre: $('#name').val(),
						username :$('#username').val(),
						apellido: $('#lastname').val(),
						password: $('#password').val(),
						pregunta : $('.select-pregunta option:selected').val(),
						respeuesta : $('#respuesta').val(),
						email : $('email')

					},
					success: function (resp) {

						var resp = $.parseJSON(resp);
						if (resp.salida === true && resp.mensaje === true) {
							swal({title: "",
								text: "El usuario se ha creado exitosamente!, recuerde que para poder ingresar al sistema el administrador debe autorizarlo.",
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
		validarContrasena: function(){

		},
		Validar : function(){

		}
	};
	$(document).ready(function () {

		resgistro.inicio();

	});

});