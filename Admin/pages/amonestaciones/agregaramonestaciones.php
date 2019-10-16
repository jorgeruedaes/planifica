<?php  
$ubicacion ="../";
include("../menuinicial.php");
include($ubicacion."../php/partidos.php");
include($ubicacion."../php/equipo.php");
include($ubicacion."../php/jugador.php");
$id_modulos ='62';
$partido = Get_Partido($_GET['id']);
if(Boolean_Get_Modulo_Permiso($id_modulos,$_SESSION['perfil']) and ($partido['estado']==='1' 
	or $partido['estado']==='8')){
	?>


	<!-- JQuery DataTable Css -->
	<link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
	<section class="content">
		<div class="container-fluid">
			<div class="block-header">
				<h2>
					<ol class="breadcrumb">
						<li>
							<a href="pages/administracion.php">
								<!--<i class="material-icons">home</i>-->
								Administración
							</a>
						</li>
						<?php
						$vector = Array_Get_PadreHijo($id_modulos);
						foreach ($vector as $value)
						{
							?>
							<li>
								<a href="<?php echo $value['ruta'] ?>" class="active">
									<!--<i class="material-icons"><?php echo $value['icono'] ?></i>-->
									<?php echo $value['nombre'] ?>
								</a>
							</li>
							<?php
						}
						?>
					</ol>
				</h2>
			</div>
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2>
								<?php echo Get_NombreEquipo($partido['equipo1']);  ?>
								<small>Amonestaciones</small>
							</h2>
						</div>
						<div class="body">
							<table id="tabla1" class="table table-bordered table-striped table-hover ">
								<thead>
									<tr>
										<th>Jugador</th>
										<th>Tarjeta</th>
										<th>Comentario</th>
										<th>Check</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$vector = Array_Get_Jugadores_Equipo($partido['equipo1']);
									$i=1;
									foreach ($vector as $value) {
										?>
										<tr class="fila-tabla" data-jugador="<?php echo $value['id_jugador']; ?>">
											<td><?php echo String_Get_NombreCompleto($value['id_jugador']) ?></td>
											<td>
												<select class="form-control show-tick select-tarjeta">
													<option value="5">--Tarjeta--</option>
													<option value="1">Amarilla</option>
													<option value="2">Roja</option>
												</select>
											</td>
											<td>
												<div class="col-md-12">
													<div class="form-group">
														<div class="form-line">
														<textarea rows="4" class="form-control no-resize comentario" placeholder="Escriba un comentario"></textarea>
														</div>
													</div>
												</div>
											</td>
											<td>
												<div class="col-md-6 col-xs-6">
													<input type="checkbox" id="md_checkbox_<?php echo $value['id_jugador']?>" class="filled-in chk-col-blue confirmacion"  />
													<label for="md_checkbox_<?php echo $value['id_jugador']?>"></label>
												</div>
											</td>
										</tr>
										<?php
										$i++; 
									}
									?>
								</tbody>
							</table>

						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2>
								<?php echo Get_NombreEquipo($partido['equipo2']);  ?>
								<small>Amonestaciones</small>
							</h2>
						</div>
						<div class="body">
							<table id="tabla2" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>Jugador</th>
										<th>Tarjeta</th>
										<th>Comentario</th>
										<th>Check</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$vector = Array_Get_Jugadores_Equipo($partido['equipo2']);
									$i=1;
									foreach ($vector as $value) {
										?>
										<tr class="fila-tabla" data-jugador="<?php echo $value['id_jugador']; ?>">
											<td><?php echo String_Get_NombreCompleto($value['id_jugador']) ?></td>
											<td>
												<select class="form-control show-tick select-tarjeta">
													<option value="5">--Tarjeta--</option>
													<option value="1">Amarilla</option>
													<option value="2">Roja</option>
												</select>
											</td>
											<td>
												<div class="col-md-12 col-xs-12">
													<div class="form-group">
														<div class="form-line">
															<textarea rows="4" class="form-control no-resize comentario" placeholder="Escriba un comentario"></textarea>
														</div>
													</div>
												</div>
											</td>
											<td>
												<div class="col-md-6 col-xs-6">
													<input type="checkbox" id="md_checkbox_<?php echo $value['id_jugador']?>" class="filled-in chk-col-green confirmacion"  />
													<label for="md_checkbox_<?php echo $value['id_jugador']?>"></label>
												</div>
											</td>
										</tr>
										<?php
										$i++; 
									}
									?>
								</tbody>
							</table>

						</div>

					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="body">
							<center>
					<button type="button" data-estado="<?php echo $partido['estado'] ?>" data-fecha="<?php echo $partido['Nfecha']; ?>" class="btn btn-primary btn-lg m-l-15 waves-effect guardar-amonestaciones" data-partido="<?php echo $_GET['id']?>">Guardar</button>
							</center>
						</div>

					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- JS ====================================================================================================================== -->
	<!--  Js-principal -->
	<script src="pages/amonestaciones/js/nuevo.js"></script>

	<!-- Jquery DataTable Plugin Js -->
	<script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
	<script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

	<!-- Custom Js -->
	<script src="js/pages/tables/jquery-datatable.js"></script>



	<!-- Modal Dialogs ====================================================================================================================== -->
	<!-- Default Size -->
	<?php
}else
{
	require("../sinpermiso.php");
}
?>