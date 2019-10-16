//	var Creador = '<?php echo $usuario['id_perfiles']; ?>'
$(function() {

	var perfiles = {
		inicio: function () {
			perfiles.recargar();
		},
		recargar: function () {
			perfiles.enviarDatos();
			perfiles.borrarUsuario();
			perfiles.editarItem();
			perfiles.editarModulos();
			perfiles.addPerfil();
			perfiles.Nuevo();
			perfiles.Permisos();
			perfiles.Modulos();
		},
		ValidarNuevo : function ()
		{
			if (/\w/gi.test($('.nuevo-nombre').val())) {
				if (/[0-9]{1,9}(\.[0-9]{0,10})?$/.test($('.nuevo-nivel').val()) && $('.nuevo-nivel').val() > 0)
				{
					return true;
				}
				else
				{ 
					$('.nuevo-nivel').focus();
					swal("Error", "El nivel no es valído.", "error");
					return false;

				}

			}
			else
			{	
				$('.nuevo-nombre').focus();
				swal("Error", "El nombre no es valído.", "error");
				return false;

			}

		},
		ValidarEdicion : function ()
		{
			if (/\w/gi.test($('.nombre').val())) {
				if (/[0-9]{1,9}(\.[0-9]{0,10})?$/.test($('.nivel').val()) && $('.nivel').val() > 0)
				{
					return true;
				}
				else
				{
					$('.nombre').focus();
					swal("Error", "El nivel no es valído.", "error");
					return false;

				}

			}
			else
				{$('.nivel').focus();
			swal("Error", "El nombre no es valído.", "error");
			return false;

		}

	},
	Modulos : function ()
	{
		var array =[];

		$('.permisos').each(function(indice, elemento) {
			if($(elemento).is(':checked'))
			{ 
				var item = $(elemento).data('id');
				array.push(item); 
			} ;
		}); 
		return array;
	},

	Permisos :  function ()
	{
		$('.guardar-edit').off('click').on('click', function () {	
			$.ajax({
				url: 'pages/perfiles/peticiones/peticiones.php',
				type: 'POST',
				data: {
					bandera: "modificar-permisos",
					perfil: $('#ModalModulos').data('perfil'),
					json: perfiles.Modulos(),


				},
				success: function (resp) {

					var resp = $.parseJSON(resp);
					if (resp.salida === true && resp.mensaje === true) {
						swal({title: "información",
							text: "El perfil modifico los permisos exitosamente!",
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
	}
	,
	Nuevo : function ()
	{

		$('.guardar-nuevo').off('click').on('click', function () {	
			if(perfiles.ValidarNuevo()){
				$.ajax({
					url: 'pages/perfiles/peticiones/peticiones.php',
					type: 'POST',
					data: {
						bandera: "nuevo",
						nombre: $('.nuevo-nombre').val(),
						nivel:$('.nuevo-nivel').val(),
						descripcion: $('.detalle').val()


					},
					success: function (resp) {

						var resp = $.parseJSON(resp);
						if (resp.salida === true && resp.mensaje === true) {
							swal({title: "información",
								text: "El perfil se ha creado exitosamente!",
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
			if(perfiles.ValidarEdicion()){
				$.ajax({
					url: 'pages/perfiles/peticiones/peticiones.php',
					type: 'POST',
					data: {
						bandera: "modificar-perfil",
						nombre: $('.nombre').val(),
						nivel:$('.nivel').val(),
						id_perfil: $('#defaultModal').data('perfil')


					},
					success: function (resp) {

						var resp = $.parseJSON(resp);
						if (resp.salida === true && resp.mensaje === true) {
							swal({title: "información",
								text: "El perfil se ha modificado exitosamente!",
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
	borrarUsuario: function () {
		$('.delete-item').off('click').on('click', function () {
			var valor = $(this);
			swal({
				title: "¿ Esta seguro ?",
				text: "Todos los usuarios que tengan este perfil seran eliminados!",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Si,Eliminalo!",
				cancelButtonText: "No,Cancelalo!",
				closeOnConfirm: false,
				closeOnCancel: false
			}, function (isConfirm) {
				if (isConfirm) {
					perfiles.desactivar(valor);
				} else {
					swal("Cancelado", "", "error");
				}
			});

		});


	},
	desactivar: function(valor)
	{
		$.ajax({
			url: 'pages/perfiles/peticiones/peticiones.php',
			type: 'POST',
			data: {
				bandera: "eliminar",
				id_perfiles: valor.data('id')

			},
			success: function (resp) {

				var resp = $.parseJSON(resp);
				if (resp.salida === true && resp.mensaje === true) {
					swal({
						title: "información",
						text: "El perfil se ha eliminado exitosamente!",
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
	cargarModal: function(nombre,nivel,perfil)
	{
		$('.nombre').val(nombre);
		$('.nivel').val(nivel);
		$('#defaultModal').data('perfil',perfil);
		$('#defaultModal').modal('show'); 
		perfiles.recargar();
	},
	cargarModalModulos: function(nombre,perfil,modulos)
	{
		$('#defaultModalLabel1').text('Editar Permisos del perfil : ' + nombre);
		$('#ModalModulos').data('perfil',perfil);
		perfiles.Selecionarmodulos(modulos);
		$('#ModalModulos').modal('show'); 
		perfiles.recargar();
	},
	addPerfil : function()
	{
		$('.add-perfil').off('click').on('click', function () {	
			$('#nuevoPerfil').modal('show'); 
		});

	},
	editarModulos : function()
	{
		$('.edit-modulos').off('click').on('click', function () {	
			var nombre = $(this).data('nombre');
			var perfil = $(this).data('id');
			var modulos = $(this).data('modulos');
			perfiles.cargarModalModulos(nombre,perfil,modulos);
		});
	},

	editarItem : function()
	{
		$('.edit-item').off('click').on('click', function () {
			var nombre = $(this).data('nombre');
			var nivel = $(this).data('nivel');
			var perfil = $(this).data('id');
			perfiles.cargarModal(nombre,nivel,perfil);
		});
	},
	Selecionarmodulos : function(modulos)
	{
		$('input').prop("checked", "");
		for (i = 0; i < modulos.length; i++) { 
			$('div').find("[data-id='"+modulos[i]+"']").prop("checked", "checked");
		}


	}
};
$(document).ready(function () {

	perfiles.inicio();

});

});