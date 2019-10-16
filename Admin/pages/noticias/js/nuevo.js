//	var Creador = '<?php echo $usuario['id_noticias']; ?>'
$(function() {
	var goblal='';
	var noticias = {
		inicio: function () {
			noticias.recargar();
			noticias.Inicial();
		},
		recargar: function () {
			noticias.enviarDatos();
			noticias.Nuevo();
			noticias.add();
			noticias.ModalImagen();
		},
		ValidarEditar : function()
		{
			if (/\w/gi.test($('.titulo').val()))
			{
				if(/\w/gi.test(CKEDITOR.instances['ckeditor1'].getData()))
				{
					if (/\w/gi.test($('.emcabezado').val()))
					{
						if (/\w/gi.test($('.url').val()))
						{
							if (/\w/gi.test($('.fecha').val()))
							{
								return true;

							}
							else
							{
								$('.n-fecha').focus();
								swal("Error", "La noticia debe tener una fecha de publicación.", "error");
								return false;

							}

						}
						else
						{
							$('.n-url').focus();
							swal("Error", "La noticia debe tener una imagen principal.", "error");
							return false;

						}

					}
					else
					{
						$('.n-emcabezado').focus();
						swal("Error", "La noticia debe tener un emcabezado.", "error");
						return false;


					}

				}
				else
				{
					swal("Error", "La noticia debe tener un contenido.", "error");
					return false;

				}

			}
			else
			{
				$('.n-titulo').focus();
				swal("Error", "Debes escribir un titulo.", "error");
				return false;

			}

		},
		Validaruevo : function()
		{
			if (/\w/gi.test($('.n-titulo').val()))
			{
				if(/\w/gi.test(CKEDITOR.instances['ckeditor'].getData()))
				{
					if (/\w/gi.test($('.n-emcabezado').val()))
					{
						if (/\w/gi.test($('.n-url').val()))
						{
							if (/\w/gi.test($('.n-fecha').val()))
							{
								return true;

							}
							else
							{
								$('.n-fecha').focus();
								swal("Error", "La noticia debe tener una fecha de publicacion.", "error");
								return false;

							}

						}
						else
						{
							$('.n-url').focus();
							swal("Error", "La noticia debe tener una imagen principal.", "error");
							return false;

						}

					}
					else
					{
						$('.n-emcabezado').focus();
						swal("Error", "La noticia debe tener un emcabezado.", "error");
						return false;


					}

				}
				else
				{
					swal("Error", "La noticia debe tener un contenido.", "error");
					return false;

				}

			}
			else
			{
				$('.n-titulo').focus();
				swal("Error", "Debes escribir un titulo.", "error");
				return false;

			}

		}, 
		Eliminar : function (valor)
		{
			swal({title: "¿ Esta seguro ?",
				text: " Desea eliminar esta noticia.",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Si,Eliminalo!",
				cancelButtonText: "No,Cancelalo!",
				closeOnConfirm: false
			}, function (isConfirm) {
				if (isConfirm) {
					$.ajax({
						url: 'pages/noticias/peticiones/peticiones.php',
						type: 'POST',
						data: {
							bandera: "eliminar",
							noticia: valor
						},
						success: function (resp) {

							var resp = $.parseJSON(resp);
							if (resp.salida === true && resp.mensaje === true) {
								swal({title: "Información",
									text: "La noticia se ha eliminado exitosamente!.",
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
		Inicial: function()
		{

	//CKEditor
	CKEDITOR.replace('ckeditor');
	CKEDITOR.config.height = 300;

	CKEDITOR.replace('ckeditor1');
	CKEDITOR.config.height = 300;

},
add : function()
{
	$('.add-noticia').off('click').on('click', function () {	
		$('#nuevanoticias').modal('show'); 
	});

}
,
Nuevo : function ()
{
	$('.guardar-nuevo').off('click').on('click', function () {	

		if(noticias.Validaruevo())
		{
			$.ajax({
				url: 'pages/noticias/peticiones/peticiones.php',
				type: 'POST',
				data: {
					bandera: "nuevo",
					titulo:	$('.n-titulo').val(),
					emcabezado:	$('.n-emcabezado').val(),
					fecha:	$('.n-fecha').val(),
					url:	$('.n-url').val(),
					texto : CKEDITOR.instances['ckeditor'].getData(),
					torneo :$('.select-n-torneo option:selected').val()



				},
				success: function (resp) {

					var resp = $.parseJSON(resp);
					if (resp.salida === true && resp.mensaje === true) {
						swal({title: "Información",
							text: "La noticia se ha creado exitosamente!.",
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

		if(noticias.ValidarEditar())
		{
		$.ajax({
			url: 'pages/noticias/peticiones/peticiones.php',
			type: 'POST',
			data: {
				bandera: "modificar",
				titulo:	$('.titulo').val(),
				emcabezado:	$('.emcabezado').val(),
				fecha:	$('.fecha').val(),
				url:	$('.url').val(),
				noticia:$('#defaultModal').data('id'),
				texto : CKEDITOR.instances['ckeditor1'].getData(),
				torneo :$('.select-torneo option:selected').val()
				


			},
			success: function (resp) {

				var resp = $.parseJSON(resp);
				if (resp.salida === true && resp.mensaje === true) {
					swal({title: "Información",
						text: "La noticia  se ha modificado exitosamente!",
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
cargarModal: function(titulo,emcabezado,fecha,id,texto,torneo,url)
{
	$('.titulo').val(titulo);
	$('.select-torneo').val(torneo);
	$('.select-torneo').change();
	CKEDITOR.instances['ckeditor1'].setData(texto);
	$('.fecha').val(fecha);
	$('.emcabezado').val(emcabezado);
	$('.url').val(url);
	$('#defaultModal').data('id',id);
	$('#defaultModal').modal('show'); 
	noticias.recargar();
},
ModalImagen :function()
{

	$('#tabla-noticias').on("click", ".edit-item", function(){
		var titulo = $(this).data('titulo');
		var fecha = $(this).data('fecha');
		var emcabezado = $(this).data('emcabezado');
		var texto = $(this).data('texto');
		var id = $(this).data('id');
		var url = $(this).data('url');
		var torneo = $(this).data('torneo');
		noticias.cargarModal(titulo,emcabezado,fecha,id,texto,torneo,url);
	});
	$('#tabla-noticias').on("click", ".delete-item", function(){
		var id = $(this).data('id');
		noticias.Eliminar(id);
	});
}
};
$(document).ready(function () {

	noticias.inicio();

});

});