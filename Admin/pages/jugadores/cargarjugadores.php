<?php  
$ubicacion ="../";
include("../menuinicial.php");
include($ubicacion."../php/partidos.php");
include($ubicacion."../php/equipo.php");
include($ubicacion."../php/campeonatos.php");
$id_modulos =Int_RutaModulo($_SERVER['REQUEST_URI']);

if(Boolean_Get_Modulo_Permiso($id_modulos,$_SESSION['perfil'])){
	?>
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
							<h2>
								Cargar  Jugadores
								<small>Agrega jugadores a los equipos.</small>
							</h2>
						</div>
						<div class="body">
							<form>
									<h2 class="card-inside-title">Campeonato o torneo</h2>
								<div class="row clearfix">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
										<select class="form-control show-tick selector-campeonato">
											<option value="">--Selecciona un Campeonato --</option>
											<?php
											$vector = Array_Get_Campeonatos();
											foreach ($vector as  $value) 
											{
												?>
												<option value="<?php echo $value['id_torneo'] ?>"><?php echo $value['nombre_torneo'] ?></option>
												<?php 
											} 
											?>	
										</select>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<button type="button" class="btn btn-primary btn-lg m-l-15 waves-effect add-files">Cargar Archivo</button>
						<button type="button" style="display : none" class="btn btn-warning  btn-lg m-l-15 waves-effect ver-resultados">Ver resultados</button>
											<input type="hidden" id="bandera" value="subirjugadores" />
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- JS ====================================================================================================================== -->
			<!--  Js-principal -->

			<!-- Modal Dialogs ====================================================================================================================== -->
			<!-- Default Size -->
			<div class="modal fade" id="nuevaarchivos" data-perfil="" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="defaultModalLabel">Cargador del archivo</h4>
						</div>
						<div class="modal-body">

							<div class="body">
								<form action="pages/jugadores/peticiones/subir.php?carpeta=Temporal" id="dropzone" class="dropzone" >
								<div class="dz-message">
									<div class="drag-icon-cph">
										<i class="material-icons">touch_app</i>
									</div>
									<h3>Pon los archivos aqui para subirlos al servidor.</h3>

								</div>
								<div class="fallback">
									<input name="file" type="file" multiple id="archivos" />
								</div>
							</form> 
						</div>
					</div>
					<div class="modal-footer">
						<button data-carpeta='Temporal' type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="mensaje" data-perfil="" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="defaultModalLabel">Problemas con el Archivo</h4>
						</div>
						<div class="modal-body">
							<div class="body">
								<div class="respuesta"></div>
						</div>
					</div>
					<div class="modal-footer">
						<button data-carpeta='Temporal' type="button" class="btn btn-danger waves-effect " data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Dropzone Plugin Js -->
		<script src="plugins/dropzone/dropzone.js"></script>
		<!-- Dropzone Css -->
		<link href="plugins/dropzone/dropzone.css" rel="stylesheet">
		<script src="pages/jugadores/js/cargarjugadores.js"></script>



		<?php
	}else
	{
		require("../sinpermiso.php");
	}
	?>