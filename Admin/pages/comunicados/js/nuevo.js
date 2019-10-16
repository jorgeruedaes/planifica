//	var Creador = '<?php echo $usuario['id_comunicados']; ?>'
$(function() {
	var goblal='';
	var comunicados = {
		inicio: function () {
			comunicados.recargar();
		},
		recargar: function () {
			comunicados.enviarDatos();
			comunicados.Nuevo();
			comunicados.add();
			comunicados.ModalImagen();
		},	ValidarEditar : function()
		{
			if (/\w/gi.test($('.titulo').val()))
			{
					if (/\w/gi.test($('.select-tipo option:selected').val()))
					{
						if (/\w/gi.test($('.url').val()))
						{
							if (/\w/gi.test($('.fecha').val()))
							{
								return true;

							}
							else
							{
								$('.fecha').focus();
								swal("Error", "El comunicado debe tener una fecha de publicación.", "error");
								return false;

							}

						}
						else
						{
							$('.url').focus();
							swal("Error", "El comunicado debe tener un archivo asociado.", "error");
							return false;

						}

					}
					else
					{
						$('.select-tipo').focus();
						swal("Error", "El comunicado debe tener un tipo.", "error");
						return false;


					}

				}
			else
			{
				$('.titulo').focus();
				swal("Error", "Debes escribir un titulo.", "error");
				return false;

			}

		},
			Validaruevo : function()
		{
			if (/\w/gi.test($('.n-titulo').val()))
			{
					if (/\w/gi.test($('.select-n-tipo option:selected').val()))
					{
						if (/\w/gi.test($('.n-url').val()))
						{
							if (/\w/gi.test($('.n-fecha').val()))
							{
								return true;

							}
							else
							{
								$('.fecha').focus();
								swal("Error", "El comunicado debe tener una fecha de publicación.", "error");
								return false;

							}

						}
						else
						{
							$('.url').focus();
							swal("Error", "El comunicado debe tener un archivo asociado.", "error");
							return false;

						}

					}
					else
					{
						$('.select-n-tipo').focus();
						swal("Error", "El comunicado debe tener un tipo.", "error");
						return false;


					}

				}
			else
			{
				$('.titulo').focus();
				swal("Error", "Debes escribir un titulo.", "error");
				return false;

			}

		},
		Eliminar : function (valor)
		{
			swal({title: "¿ Esta seguro ?",
				text: " Desea eliminar el comunicado.",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Si,Eliminalo!",
				cancelButtonText: "No,Cancelalo!",
				closeOnConfirm: false
			}, function (isConfirm) {
				if (isConfirm) {
					$.ajax({
						url: 'pages/comunicados/peticiones/peticiones.php',
						type: 'POST',
						data: {
							bandera: "eliminar",
							comunicado: valor
						},
						success: function (resp) {

							var resp = $.parseJSON(resp);
							if (resp.salida === true && resp.mensaje === true) {
								swal({title: "Información",
									text: "El comunicado se ha eliminado exitosamente!.",
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
add : function()
{
	$('.add-noticia').off('click').on('click', function () {	
		$('#nuevacomunicados').modal('show'); 
	});

}
,
Nuevo : function ()
{
	$('.guardar-nuevo').off('click').on('click', function () {	
		if(comunicados.Validaruevo())
		{
		$.ajax({
			url: 'pages/comunicados/peticiones/peticiones.php',
			type: 'POST',
			data: {
				bandera: "nuevo",
				titulo:	$('.n-titulo').val(),
				fecha:	$('.n-fecha').val(),
				comunicado:	$('.n-url').val(),
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
	}

	});
},

enviarDatos: function () {
	$('.guardar').off('click').on('click', function () {
		if(comunicados.ValidarEditar())
		{
		$.ajax({
			url: 'pages/comunicados/peticiones/peticiones.php',
			type: 'POST',
			data: {
				bandera: "modificar",
				titulo:	$('.titulo').val(),
				fecha:	$('.fecha').val(),
				comunicado:	$('.url').val(),
				codigo:$('#defaultModal').data('id'),
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
	}
	});


},
cargarModal: function(titulo,fecha,id,tipo,comunicado)
{
	$('.titulo').val(titulo);
	$('.url').val(comunicado);
	$('.select-tipo').val(tipo);
	$('.select-tipo').change();
	$('.fecha').val(fecha);
	$('#defaultModal').data('id',id);
	$('#defaultModal').modal('show'); 
	comunicados.recargar();
},
ModalImagen :function()
{

	$('#tabla-comunicados').on("click", ".edit-item", function(){
		var titulo = $(this).data('titulo');
		var fecha = $(this).data('fecha');
		var id = $(this).data('codigo');
		var tipo = $(this).data('tipo');
		var comunicado = $(this).data('url');
		comunicados.cargarModal(titulo,fecha,id,tipo,comunicado);
	});
	$('#tabla-comunicados').on("click", ".delete-item", function(){
		var id = $(this).data('codigo');
		comunicados.Eliminar(id);
	});
}
};
$(document).ready(function () {

	comunicados.inicio();

});

});