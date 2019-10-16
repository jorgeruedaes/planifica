
$(function() {

	var goles = {
		inicio: function () {
			goles.recargar();
			goles.Add_Resultado();
			goles.get_datos();
			goles.Tablas();
			goles.Add_Edit_Resultado();
		},
		recargar: function () {
			goles.TomarDatos_Resultados();


		},
		Tablas : function()
		{
			$('#tabla1').dataTable( {
				"pageLength": 50
			} );
			$('#tabla2').dataTable( {
				"pageLength": 50
			} );
		},
		ValidarGoles : function()
		{
			if (/[0-9]{1,9}(\.[0-9]{0,10})?$/.test($('#resultado1').val()) && ($('#resultado1').val() >= 0) && ($('#resultado1').val().length<=2 ))
			{
				if (/[0-9]{1,9}(\.[0-9]{0,10})?$/.test($('#resultado2').val()) && ($('#resultado2').val() >= 0) && ($('#resultado2').val().length<=2  ))
				{
					return true;
				}
				else
				{
					$('#resultado2').focus();
					swal("Error", "Debes escribir un valor valído.", "error");
					return false;
				}

			}
			else
			{
				$('#resultado1').focus();
				swal("Error", "Debes escribir un valor valído.", "error");
				return false;

			}
		},
		get_datos : function ()
		{
			$.ajax({
				url: 'pages/partidos/peticiones/peticiones.php',
				type: 'POST',
				data: {
					bandera: "get_detalles_partido",
					partido: $('.guardar-editar-goles').data('partido'),
				},
				success: function (resp) {

					var resp = $.parseJSON(resp);
					if (resp.salida === true && resp.mensaje === true) {
						for (var i = 0; i <= resp.datos.length-1; i++) {
							$('.fila-tabla').each(function(indice, elemento) {
								if( ($(elemento).data('jugador')==resp.datos[i].jugador)
									&& ((resp.datos[i].goles>0) || (resp.datos[i].autogoles>0) ) )
								{
									$(elemento).find('.confirmacion').prop("checked", "checked");
									$(elemento).find('.gol').val(resp.datos[i].goles);
									$(elemento).find('.autogol').val(resp.datos[i].autogoles);
								}
							});

						};

					} else {
					//	swal("Agrega los detalles", ", intenta nuevamente.", "info");
					}
				}
			});

		},
		TomarDatos_Resultados : function ()
		{
			var array =[];
			var objeto =[];

			$('.fila-tabla').each(function(indice, elemento) {
				if($(elemento).find('.confirmacion').is(':checked'))
				{ 
					var objeto =[];
					objeto.push($(elemento).data('jugador'));
					objeto.push($(elemento).find('.gol').val());
					objeto.push($(elemento).find('.autogol').val());
					objeto.push('5');
					array.push(objeto);
				} ;
			}); 
			return array;
		},
		Add_Resultado: function () {
			$('.guardar-goles').on("click", function(){
				if(goles.ValidarGoles())
				{

					swal({title: "¿Esta seguro que desea GUARDAR los goles del partido?",
						text: "",
						type: "warning",
						confirmButtonText: "Aceptar",
						showCancelButton: true,
						confirmButtonColor: "rgb(174, 222, 244)",

						closeOnConfirm: false
					}, function (isConfirm) {
						if (isConfirm) {

							$.ajax({
								url: 'pages/partidos/peticiones/peticiones.php',
								type: 'POST',
								data: {
									bandera: "agregardetalles-goles",
									partido: $('.guardar-goles').data('partido'),
									fecha: $('.guardar-goles').data('fecha'),
									estado : $('.guardar-goles').data('estado'),
									json  : goles.TomarDatos_Resultados(),
									tipo :"nuevo",
									resultado1 : $('#resultado1').val(),
									resultado2 : $('#resultado2').val(),

								},
								success: function (resp) {

									var resp = $.parseJSON(resp);
									if (resp.salida === true && resp.mensaje === true) {
										swal({title: "Información",
											text: "Se ha agregado los goles de manera exitosa!",
											type: "success",
											confirmButtonText: "Aceptar",
											showCancelButton: false,
											confirmButtonColor: "rgb(174, 222, 244)",
											closeOnConfirm: false
										}, function (isConfirm) {
											if (isConfirm) {
												history.back();
											}
										});

									} else {
										swal("", "Ha ocurrido un error, intenta nuevamente.", "error");
									}
								}
							});
}
});

}
});

},
Add_Edit_Resultado: function () {
	$('.guardar-editar-goles').on("click", function(){
		if(goles.ValidarGoles())
		{
			swal({title: "¿Esta seguro que desea GUARDAR los goles del partido?",
				text: "",
				type: "warning",
				confirmButtonText: "Aceptar",
				showCancelButton: true,
				confirmButtonColor: "rgb(174, 222, 244)",

				closeOnConfirm: false
			}, function (isConfirm) {
				if (isConfirm) {

					$.ajax({
						url: 'pages/partidos/peticiones/peticiones.php',
						type: 'POST',
						data: {
							bandera: "agregardetalles-goles",
							partido: $('.guardar-editar-goles').data('partido'),
							fecha: $('.guardar-editar-goles').data('fecha'),
							estado : $('.guardar-editar-goles').data('estado'),
							tipo : "editar",
							json  : goles.TomarDatos_Resultados(),
							resultado1 : $('#resultado1').val(),
							resultado2 : $('#resultado2').val(),

						},
						success: function (resp) {

							var resp = $.parseJSON(resp);
							if (resp.salida === true && resp.mensaje === true) {
								swal({title: "Información",
									text: "Se ha agregado los goles de manera exitosa!",
									type: "success",
									confirmButtonText: "Aceptar",
									showCancelButton: false,
									confirmButtonColor: "rgb(174, 222, 244)",
									closeOnConfirm: false
								}, function (isConfirm) {
									if (isConfirm) {
										history.back();
									}
								});

							} else {
								swal("", "Ha ocurrido un error, intenta nuevamente.", "error");
							}
						}
					});
}
});
}

});

}
};
$(document).ready(function () {

	goles.inicio();

});

});