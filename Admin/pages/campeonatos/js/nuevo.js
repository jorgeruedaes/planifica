//	var Creador = '<?php echo $usuario['id_campeonatos']; ?>'
$(function() {

	var campeonatos = {
		inicio: function () {
			campeonatos.recargar();
		},
		recargar: function () {
			campeonatos.enviarDatos();
			campeonatos.editarCampeonato();
			campeonatos.addPerfil();
			campeonatos.Nuevo();
			campeonatos.ModalArchivos();
		},
		Nuevo : function ()
		{
		$('.guardar-nuevo').off('click').on('click', function () {	
				$.ajax({
					url: 'pages/campeonatos/peticiones/peticiones.php',
					type: 'POST',
					data: {
						bandera: "nuevo",
						nombre: $('.nuevo-nombre').val(),
						puntos: $('.nuevo-puntos').val(),
						url: $('.nuevo-url').val(),
						categoria:$('.select-nuevo-categoria option:selected').val()
						
			
					},
					success: function (resp) {

						var resp = $.parseJSON(resp);
						if (resp.salida === true && resp.mensaje === true) {
							swal({title: "Información",
								text: "El campeonato se ha creado exitosamente!, recuerde que por defecto esta en estado inactivo.",
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
		enviarDatos: function () {
			$('.guardar').off('click').on('click', function () {
				$.ajax({
					url: 'pages/campeonatos/peticiones/peticiones.php',
					type: 'POST',
					data: {
						bandera: "modificar-campeonato",
						nombre: $('.nombre').val(),
						puntos: $('.puntos').val(),
						url: $('.url').val(),
						categoria:$('.select-categoria option:selected').val(),
						estado : $('.select-estado option:selected').val(),
						torneo: $('#defaultModal').data('torneo')
						
			
					},
					success: function (resp) {

						var resp = $.parseJSON(resp);
						if (resp.salida === true && resp.mensaje === true) {
							swal({title: "Información",
								text: "El campeonato se ha modificado exitosamente!",
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
		cargarModal: function(torneo,nombre,estado,categoria,puntos,url)
		{
			$('.nombre').val(nombre);
			$('.puntos').val(puntos);
			$('.url').val(url);
			$('.select-estado').val(estado);
			$('.select-estado').change();
			$('.select-categoria').val(categoria);
			$('.select-categoria').change();
			$('#defaultModal').data('torneo',torneo);
			$('#defaultModal').modal('show'); 
			campeonatos.recargar();
		},
		addPerfil : function()
		{
			$('.add-perfil').off('click').on('click', function () {	
				$('#nuevoPerfil').modal('show'); 
			});

		},

		editarCampeonato : function()
		{
				$('#tabla-campeonatos').on("click", ".edit-item", function(){
				var nombre = $(this).data('nombre');
				var categoria = $(this).data('categoria');
				var estado = $(this).data('estado');
				var puntos = $(this).data('puntos');
				var torneo = $(this).data('torneo');
				var url = $(this).data('url');
				campeonatos.cargarModal(torneo,nombre,estado,categoria,puntos,url);
			});
		},
		ModalArchivos :function()
		{
			$('.add-pdf').off('click').on('click', function () {
				//campeonatos.cargarModal(nombre,nivel,perfil);
				$('#defaultModalReglamentos').modal('show'); 
			});
		}
	};
	$(document).ready(function () {

		campeonatos.inicio();

	});

});