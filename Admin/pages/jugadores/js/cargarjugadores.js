//	var Creador = '<?php echo $usuario['id_cargador']; ?>'
$(function() {
	var goblal='';
	var cargador = {
		inicio: function () {
			cargador.recargar();
		},
		recargar: function () {
			cargador.close();
			cargador.DropeZone();
			cargador.Cargar();
			cargador.add();
		},
			ModalImagen :function()
		{	$('.ver-resultados').off('click').on('click', function () {
			$('#mensaje').modal('show');
		});
	},
			add : function()
		{
			$('.add-files').off('click').on('click', function () {	
				$('#nuevaarchivos').modal('show'); 
				cargador.recargar();
		
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
					} else {
						swal("Importante", "Selecciona un campeonato.", "info");
					}
				}
			});
		},
		close : function()
		{
			$('.guardar-files').off('click').on('click', function () {	
				window.location.reload();
			});
		},
		DropeZone : function()
		{
			var bandera = $('#bandera').val();
			Dropzone.options.dropzone = {
				url: 'pages/jugadores/peticiones/subir.php?carpeta=Temporal',
				maxFilesize: 2,
				maxFiles: 1,
				acceptedFiles : ".csv",
				init: function() {
					 var myDropZone = this;

					 this.on("sending", function(file, xhr, formData) {
					 	var torneo = $('.selector-campeonato option:selected').val();
 						 formData.append("torneo",torneo);
 						 formData.append("bandera",bandera);
						});
					this.on("success", function(file, responseText) {
						var resp = $.parseJSON(responseText);
						if (resp.salida === true && resp.mensaje === true) {
							$('#nuevaarchivos').modal('hide');
						swal({title: "Información",
								text: "Los Jugadores se han cargado de manera exitosa!.",
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
						}
						else
						{
							myDropZone.removeAllFiles();
							cargador.ModalImagen();
							$('.ver-resultados').css("display","inline");
							$('#nuevaarchivos').modal('hide');	
							$('.respuesta').html('');
							$('.respuesta').html(resp.datos);
							swal("Importante!", "Ha ocurrido un error en los datos que intentas subir revisa los resultados e intenta nuevamente.", "error");

						}
						
					});
				}

			};

					var dropzone  = new Dropzone("#archivos", {
				url: 'pages/partidos/peticiones/subir.php?carpeta=Temporal'
			});


			
		}
	};
	$(document).ready(function () {

		cargador.inicio();

	});

});