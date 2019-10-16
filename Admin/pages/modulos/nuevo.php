<?php  
$ubicacion ="../";
$id_modulos="19";
include("../menuinicial.php");
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
								NUEVO MODULO
								<small></small>
							</h2>
						</div>
						
						<div class="body">
							<form>
								<div class="row clearfix">
									<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
										<div class="form-group">
											<div class="form-line">
												<input type="text" class="form-control" placeholder="Nombre">
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
										<div class="form-group">
											<div class="form-line">
												<input type="text" class="form-control" placeholder="Ruta de la carpeta contenedora">
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
										<div class="form-group">
											<div class="form-line">
												<input type="text" class="form-control icono" placeholder="Visita la seccion de iconos">
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
										<div class="form-group">

											<button type="button" class="btn bg-orange waves-effect buscar">
												<i class="material-icons">search</i>
											</button>
											
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
										<div class="form-group a">
											<select class="form-control select-tipo">
												<option value="">-- Tipo de Modulo --</option>
												<option value="0">Principal</option>
												<option value="1">Submenu</option>
											</select>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
										<div class="form-group">
											<select class="form-control select-submenus" disabled="true" >
												<option value="">--Tendra Submenus --</option>
												<option value="1">Si</option>
												<option value="0">No</option>
											</select>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
										<div class="form-group a">
											<select class="form-control select-padre" disabled="true">
												<option value="">-- Selecciona el padre --</option>
												<option value="0">Principal</option>
												<option value="1">Submenu</option>
											</select>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
										<div class="form-group">
											<div class="form-line">
												<input type="number" min"0" maxlength="2" class="form-control" placeholder="Orden ">
											</div>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
										<div class="form-group a">
											<button type="button" class="btn btn-primary waves-effect">Guardar</button>
										</div>
									</div>
								</div>

							</form>
						</div>

					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- JS ====================================================================================================================== -->
	<!--  Js-principal -->
	<script src="pages/modulos/js/modulos.js"></script>

	<!-- Modal Dialogs ====================================================================================================================== -->
	<!-- Default Size -->
	<div class="modal fade" id="defaultModal" data-usuario="" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="defaultModalLabel">Selecciona un icono</h4>
				</div>
				<div class="modal-body">
					<div class="body">
						<div class="row clearfix demo-icon-container">
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
								<input name="group1" type="radio" id="radio_4" class="with-gap" />
								<label for="radio_4"> <i class="material-icons">explore</i> <span class="icon-name"></span></label>
							</div>
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
								<input name="group1" type="radio" id="radio_5" class="with-gap" />
								<label for="radio_5"><i class="material-icons">accessibility</i> <span class="icon-name"></span></label>
							</div>
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
								<input name="group1" type="radio" id="radio_6" class="with-gap" />
								<label for="radio_6"> <i class="material-icons">group_work</i> <span class="icon-name"></span></label>
							</div>
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
								<input name="group1" type="radio" id="radio_8" class="with-gap" />
								<label for="radio_8"> <i class="material-icons">open_with</i> <span class="icon-name"></span></label>
							</div>
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
								<input name="group1" type="radio" id="radio_9" class="with-gap" />
								<label for="radio_9"><i class="material-icons">settings</i> <span class="icon-name"></span></label>
							</div>
						</div>
						<div class="row clearfix demo-icon-container">
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
								<input name="group1" type="radio" id="radio_10" class="with-gap" />
								<label for="radio_10"> <i class="material-icons">timeline</i> <span class="icon-name"></span></label>
							</div>
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
								<input name="group1" type="radio" id="radio_12" class="with-gap" />
								<label for="radio_12"> <i class="material-icons">work</i> <span class="icon-name"></span></label>
							</div>
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
								<input name="group1" type="radio" id="radio_14" class="with-gap" />
								<label for="radio_14"><i class="material-icons">warning</i> <span class="icon-name"></span></label>
							</div>
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
								<input name="group1" type="radio" id="radio_15" class="with-gap" />
								<label for="radio_15"> <i class="material-icons">airplay</i> <span class="icon-name"></span></label>
							</div>
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
								<input name="group1" type="radio" id="radio_17" class="with-gap" />
								<label for="radio_16"><i class="material-icons">games</i> <span class="icon-name"></span></label>
							</div>
						</div>

						<div class="row clearfix demo-icon-container">
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
								<input name="group1" type="radio" id="radio_19" class="with-gap" />
								<label for="radio_19"> <i class="material-icons">web</i> <span class="icon-name"></span></label>
							</div>
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
								<input name="group1" type="radio" id="radio_20" class="with-gap" />
								<label for="radio_20"><i class="material-icons">chat</i> <span class="icon-name"></span></label>
							</div>
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
								<input name="group1" type="radio" id="radio_21" class="with-gap" />
								<label for="radio_21"> <i class="material-icons">contacts</i> <span class="icon-name"></span></label>
							</div>
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
								<input name="group1" type="radio" id="radio_22" class="with-gap" />
								<label for="radio_22"><i class="material-icons">mail</i> <span class="icon-name"></span></label>
							</div>
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
								<input name="group1" type="radio" id="radio_24" class="with-gap" />
								<label for="radio_24"><i class="material-icons">attach_file</i> <span class="icon-name"></span></label>
							</div>
						</div>
						<div class="row clearfix demo-icon-container">
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
								<input name="group1" type="radio" id="radio_25" class="with-gap" />
								<label for="radio_25"> <i class="material-icons">insert_drive_file</i> <span class="icon-name"></span></label>
							</div>
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
								<input name="group1" type="radio" id="radio_26" class="with-gap" />
								<label for="radio_26"><i class="material-icons">multiline_chart</i> <span class="icon-name"></span></label>
							</div>
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
								<input name="group1" type="radio" id="radio_27" class="with-gap" />
								<label for="radio_27"> <i class="material-icons">videogame_asset</i> <span class="icon-name"></span></label>
							</div>
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
								<input name="group1" type="radio" id="radio_28" class="with-gap" />
								<label for="radio_28"><i class="material-icons">camera_alt</i> <span class="icon-name"></span></label>
							</div>
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
								<input name="group1" type="radio" id="radio_29" class="with-gap" />
								<label for="radio_29"> <i class="material-icons">filter_2</i> <span class="icon-name"></span></label>
							</div>
						</div>

						<div class="row clearfix demo-icon-container">
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
								<input name="group1" type="radio" id="radio_31" class="with-gap" />
								<label for="radio_31"> <i class="material-icons">zoom_out_map</i> <span class="icon-name"></span></label>
							</div>
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
								<input name="group1" type="radio" id="radio_32" class="with-gap" />
								<label for="radio_32"><i class="material-icons">adb</i> <span class="icon-name"></span></label>
							</div>
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
								<input name="group1" type="radio" id="radio_34" class="with-gap" />
								<label for="radio_34"><i class="material-icons">casino</i> <span class="icon-name"></span></label>
							</div>
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
								<input name="group1" type="radio" id="radio_35" class="with-gap" />
								<label for="radio_35"> <i class="material-icons">group</i> <span class="icon-name"></span></label>
							</div>
							<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
								<input name="group1" type="radio" id="radio_36" class="with-gap" />
								<label for="radio_36"><i class="material-icons">person</i> <span class="icon-name"></span></label>
							</div>
						</div>

						<div class="row clearfix demo-icon-container">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info waves-effect seleccionar">Seleccionar</button>
					<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
	<?php
}else
{
	require("../sinpermiso.php");
}
?>