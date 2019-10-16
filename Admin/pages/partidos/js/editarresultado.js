
$(function() {
	var t='';
	var partidos = {
		inicio: function () {
			partidos.recargar();
		},
		recargar: function () {
			partidos.SeleccionCampeonato_Resultados(); // CONSERVAR
			partidos.Tabla(); /// CONSERVAR ------------------------------------------->

			partidos.Cargar_Resultados(); /// CONSERVAR -------------------------------->


		},
Cargar_Resultados : function() /// CONSERVAR------------------>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
{
	$.ajax({
		url: 'pages/partidos/peticiones/peticiones.php',
		type: 'POST',
		data: {
			bandera: "get_campeonato",
			campeonato:  $('.selector-campeonato-resultados option:selected').val()
		},
		success: function (resp) {

			var resp = $.parseJSON(resp);
			if (resp.salida === true && resp.mensaje === true) {
				$('.selector-campeonato-resultados').val(resp.datos);
				$('.selector-campeonato-resultados').change();
			} else {
				swal("Importante", "Selecciona un campeonato.", "info");
			}
		}
	});
},
Tabla : function() ///// CONSERVAR -------------------------------------------------->
{
	t = $('.tabla-resultados').DataTable();

},
SeleccionCampeonato_Resultados : function() /// CONSERVAR -------------------------------------------------->>>>>>>>>>>>>>>
{


	$('.selector-campeonato-resultados').on('change', function () {
		$.ajax({
			url: 'pages/partidos/peticiones/peticiones.php',
			type: 'POST',
			data: {
				bandera: "getcampeonato",
				estado : '2',
				campeonato:  $('.selector-campeonato-resultados option:selected').val()

			},
			success: function (resp) {

				var resp = $.parseJSON(resp);
				if (resp.salida === true && resp.mensaje === true) {
					t.row($('.tabla-resultados').parents('tr') ).clear().draw();
					for (var i = 0; i < resp.datos.length; i++) {
						t.row.add( [ 
							resp.datos[i].nombre_equipo1+' vs '+resp.datos[i].nombre_equipo2,
							'<strong>'+resp.datos[i].nombre_estado+'</strong><br>'+resp.datos[i].fecha,	
							'<div class="btn-group btn-group-xs" role="group" aria-label="Extra-small button group"><button data-partido="'+resp.datos[i].nombre_equipo1+' vs '+resp.datos[i].nombre_equipo2+'" data-id="'+resp.datos[i].id_partido+'" data-nfecha="'+resp.datos[i].Nfecha+'" data-fecha="'+resp.datos[i].fecha+'" data-estado="'+resp.datos[i].estado+'" data-lugar="'+resp.datos[i].lugar+'" data-hora="'+resp.datos[i].hora+'"  type="button" class="btn bg-blue waves-effect edit-goles-partido" data-toggle="modal" > <i class="material-icons">edit</i></button><button data-partido="'+resp.datos[i].nombre_equipo1+' vs '+resp.datos[i].nombre_equipo2+'" data-id="'+resp.datos[i].id_partido+'" data-nfecha="'+resp.datos[i].Nfecha+'" data-fecha="'+resp.datos[i].fecha+'" data-estado="'+resp.datos[i].estado+'" data-lugar="'+resp.datos[i].lugar+'" data-hora="'+resp.datos[i].hora+'" data-tiporesultado="'+resp.datos[i].tiporesultado+'"   type="button" class="btn bg-blue waves-effect edit-tiporesultado" > <i class="material-icons">settings</i></button></div>'
							] ).draw( false );
						partidos.EditGoles();

					}
				} else {
					t.row($('.tabla-resultados').parents('tr') ).clear().draw();
					swal("Importante", "No hay partidos para EDITAR RESULTADOS para este campeonato, o selecciona alguno.", "info");
				}
			}
		});


});
},
EditGoles : function () ///////------------------------>>>>>>> CONVERVAR
{
	$('.tabla-resultados').on("click", ".edit-goles-partido", function(){
		var partido = $(this).data('id');
		var	url = "pages/partidos/editargoles.php?id="+partido; 
		window.open(url, '_self');

	});

	$('.tabla-resultados').on("click", ".edit-tiporesultado", function(){
		var partido = $(this).data('id');
		var tiporesultado = $(this).data('tiporesultado');
		$('.guardar-tiporesultado').data('partido',partido);
		$('.select-tiporesultado').val(tiporesultado);
		$('.select-tiporesultado').change();
		$('#defaultModal').modal('show'); 
		partidos.ModificarTipoResultadoPartido();
		

	});

},
ModificarTipoResultadoPartido: function () {

	$('.guardar-tiporesultado').on("click", function(){
			swal({title: "¿ Esta seguro ?",
				text: " Desea cambiar el tipo de  resultado del partido, Modificara directamente la tabla de posiciones.",
				type: "warning",
				showCancelButton: false,
				confirmButtonColor: "rgb(174, 222, 244)",
				confirmButtonText: "Ok",
				closeOnConfirm: false
			}, function (isConfirm) {
				if (isConfirm) {

					$.ajax({
						url: 'pages/partidos/peticiones/peticiones.php',
						type: 'POST',
						data: {
							bandera: "modificar_tiporesultado",
							partido:  $('.guardar-tiporesultado').data('partido'),
							tiporesultado:  $('.select-tiporesultado  option:selected').val(),
						},
						success: function (resp) {

							var resp = $.parseJSON(resp);
							if (resp.salida === true && resp.mensaje === true) {
								swal({title: "Información",
									text: "El partido se ha mdificado exitosamente!",
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

});

}
};
$(document).ready(function () {

	partidos.inicio();

});

});