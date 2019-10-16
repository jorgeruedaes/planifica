<?php  
$ubicacion ="../";
include("../menuinicial.php");
include($ubicacion."../php/partidos.php");
include($ubicacion."../php/equipo.php");
include($ubicacion."../php/jugador.php");
include($ubicacion."../php/amonestaciones.php");
$id_modulos ='26';
$numero_fecha = $_GET['id'];
if(Boolean_Get_Modulo_Permiso($id_modulos,$_SESSION['perfil'])){
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
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2>Amonestaciones de la Fecha o Ronda numero : <strong><?php echo $_GET['id']; ?></strong> 
								<small>Amonestaciones</small>
							</h2>
								<ul class="header-dropdown m-r--5">
								<li>
									<div class="col-md-3 col-xs-3">
													<div class="demo-switch-title">.</div>
													<div class="switch">
													<label><input id="principal" type="checkbox" checked>
															<span class="lever switch-col-red"></span></label>
														</div>
													</div>
							</li>
						</ul>
						</div>
						<div class="body">
							<table id="tabla3" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>Jugador</th>
										<th>Equipo</th>
										<th>Tarjeta</th>
										<th>Estado</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$vector = Array_Get_Detalles_Amonestacion_Fecha($_GET['id'],$_SESSION['campeonato']);
									$i=1;
									foreach ($vector as $value) {
										?>
										<tr class="fila-tabla" data-partido="<?php echo $value['partido']; ?>" data-jugador="<?php echo $value['jugador']; ?>">
											<td><?php echo String_Get_NombreCompleto($value['jugador']) ?></td>
											<td>
												<?php echo $value['nombre_equipo']?>
											</td>
											<td><?php echo ($value['amonestacion']=="2")?"Roja":"Amarilla"?></td>
											<td>
												<div class="col-md-3 col-xs-3">
													<div class="demo-switch-title">.</div>
													<div class="switch">
													<label><input class="confirmacion" type="checkbox" <?php echo ($value['estado_amonestacion']=="1")?"checked":"" ?> >
															<span class="lever switch-col-red"></span></label>
														</div>
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
									<button type="button" data-estado="<?php echo $partido['estado'] ?>" data-fecha="<?php echo $partido['Nfecha']; ?>" class="btn btn-primary btn-lg m-l-15 waves-effect guardar-amonestaciones-gestionar" data-partido="">Guardar</button>
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