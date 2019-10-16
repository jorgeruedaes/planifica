//	var Creador = '<?php echo $usuario['id_cargador']; ?>'
$(function() {
	var goblal='';
	var cargador = {
		inicio: function () {
			cargador.recargar();
		},
		recargar: function () {
			cargador.enviarDatos();
			cargador.Nuevo();
			cargador.add();
			cargador.ModalImagen();
			cargador.CopiarUrl();
			cargador.Eliminar_Archivo();
			cargador.VistaPrevia();
			cargador.ToFolder();
			cargador.addfolder();
			cargador.Nuevo_Folder();
			cargador.close();
			cargador.DropeZone();
		},
		close : function()
		{
			$('.guardar-files').off('click').on('click', function () {	
				window.location.reload();
			});
		},
		DropeZone : function()
		{
			var torneo = $('.selector-campeonato-nuevo option:selected').val();
			var bandera = $('#bandera').val();
			//	Dropzone.autoDiscover = false;		
			//var carpeta = $('.guardar-files').data('carpeta');
			//$('.dropzone').attr('action','pages/partidos/peticiones/subir.php?carpeta=Temporal&&torneo='+torneo);
	
			Dropzone.options.dropzone = {
				url: 'pages/partidos/peticiones/subir.php?carpeta=Temporal',
				maxFilesize: 2,
				maxFiles: 1,
				acceptedFiles : ".csv",
				init: function() {
					 var myDropZone = this;

					 this.on("sending", function(file, xhr, formData) {
					 	var torneo = $('.selector-campeonato-nuevo option:selected').val();
 						 formData.append("torneo",torneo);
 						 formData.append("bandera",bandera);
						});
					this.on("success", function(file, responseText) {
						var resp = $.parseJSON(responseText);
						if (resp.salida === true && resp.mensaje === true) {
							$('#nuevaarchivos').modal('hide');
						swal({title: "Información",
								text: "Los partidos se han cargado de manera exitosa!.",
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


			
		},
		Nuevo_Folder : function(){
			$('.guardar-nuevo-carpeta').off('click').on('click', function () {	
				$.ajax({
					url: 'pages/cargador/peticiones/peticiones.php',
					type: 'POST',
					data: {
						bandera: "nuevo",
						carpeta: $('.n-carpeta').val()

					},
					success: function (resp) {

						var resp = $.parseJSON(resp);
						if (resp.salida === true && resp.mensaje === true) {
							swal({title: "Información",
								text: "La carpeta se ha creado exitosamente!.",
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
		ToFolder : function()
		{
			$('.to_folder').off('click').on('click', function () {	
				window.open('pages/cargador/gestionararchivos.php?id='+$(this).data('url'),"_self");
			});
		},
		CopiarUrl: function()
		{
			$('.copy-clipboard').off('click').on('click', function () {	
				window.prompt("Copiar la Url : Ctrl+C, Enter",$(this).data('url'));
			});

		},
		VistaPrevia : function()
		{
			$('.preview').off('click').on('click', function () {	
				window.open($(this).data('url'),"_blank")
			});

		},
		Eliminar_Archivo : function()
		{
			$('.delete').off('click').on('click', function () {	
				cargador.Eliminar($(this).data('url'));
			});

		},
		Eliminar : function (valor)
		{
			swal({title: "¿ Esta seguro ?",
				text: " Al eliminar el archivo todos los lugares donde se este usando perderan su URL.",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Si,Eliminalo!",
				cancelButtonText: "No,Cancelalo!",
				closeOnConfirm: false
			}, function (isConfirm) {
				if (isConfirm) {
					$.ajax({
						url: 'pages/cargador/peticiones/peticiones.php',
						type: 'POST',
						data: {
							bandera: "eliminar",
							archivo: valor
						},
						success: function (resp) {

							var resp = $.parseJSON(resp);
							if (resp.salida === true && resp.mensaje === true) {
								swal({title: "Información",
									text: "El archivo se ha eliminado exitosamente!.",
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
		addfolder : function()
		{	
			$('.add-folder').off('click').on('click', function () {	
				$('#nuevacarpeta').modal('show'); 

			});


		},
		add : function()
		{
			$('.add-files').off('click').on('click', function () {	
				$('#nuevaarchivos').modal('show'); 
				cargador.recargar();
		
			});

		}
		,
		Nuevo : function ()
		{
			$('.guardar-nuevo').off('click').on('click', function () {	
				$.ajax({
					url: 'pages/cargador/peticiones/peticiones.php',
					type: 'POST',
					data: {
						bandera: "nuevo",
						titulo:	$('.n-titulo').val(),
						fecha:	$('.n-fecha').val(),
						tipo :$('.select-n-tipo option:selected').val()



					},
					success: function (resp) {

						var resp = $.parseJSON(resp);
						if (resp.salida === true && resp.mensaje === true) {
							swal({title: "Información",
								text: "El comunicado se ha creado exitosamente!.",
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
					url: 'pages/cargador/peticiones/peticiones.php',
					type: 'POST',
					data: {
						bandera: "modificar",
						titulo:	$('.titulo').val(),
						fecha:	$('.fecha').val(),
						comunicado:$('#defaultModal').data('id'),
						tipo :$('.select-tipo option:selected').val()



					},
					success: function (resp) {

						var resp = $.parseJSON(resp);
						if (resp.salida === true && resp.mensaje === true) {
							swal({title: "Información",
								text: "El comunicado  se ha modificado exitosamente!",
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
		cargarModal: function(titulo,fecha,id,tipo)
		{
			$('.titulo').val(titulo);
			$('.select-tipo').val(tipo);
			$('.select-tipo').change();
			$('.fecha').val(fecha);
			$('#defaultModal').data('id',id);
			$('#defaultModal').modal('show'); 
			cargador.recargar();
		},
		ModalImagen :function()
		{	$('.ver-resultados').off('click').on('click', function () {
			$('#mensaje').modal('show');
		});

			$('#tabla-cargador').on("click", ".edit-item", function(){
				var titulo = $(this).data('titulo');
				var fecha = $(this).data('fecha');
				var id = $(this).data('id');
				var tipo = $(this).data('tipo');
				cargador.cargarModal(titulo,fecha,id,tipo);
			});
			$('#tabla-cargador').on("click", ".delete-item", function(){
				var id = $(this).data('id');
				cargador.Eliminar(id);
			});
		}
	};
	$(document).ready(function () {

		cargador.inicio();

	});

});