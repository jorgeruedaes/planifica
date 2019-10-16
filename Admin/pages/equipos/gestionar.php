<?php  
$ubicacion ="../";
include("../menuinicial.php");
include('../../php/equipo.php');
include('../../php/clubs.php');
include('../../php/campeonatos.php');
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
                                Selecciona un campeonato 
                                <small>Selecciona un campeonato, para visualizar sus respecivos jugadores.</small>
                            </h2>
                        </div>
                        <div class="body">
                            <label for="">Campeonato</label>
                            <div class="form-group">
                                <select class="form-control show-tick selector-campeonato">
                                    <option value="0">--Selecciona un campeonato --</option>
                                    <?php 
                                    $vector = Array_Get_Campeonatos();
                                    foreach ($vector as $value) {

                                        ?>
                                        <option value="<?php echo $value['id_torneo']; ?>"><?php echo $value['nombre_torneo']; ?></option>
                                        <?php
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<div class="row ">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2>
								GESTION DE EQUIPOS  
							</h2>
							<ul class="header-dropdown m-r--5">
								<li></li>
								<li>
									<button type="button" class="btn bg-red 
									waves-effect add-perfil">
									<i class="material-icons">add</i>
								</button>

							</li>
							<li></li>
						</ul>
					</div>
					<div class="body">
						<table  id="tabla-clubs" class="table table-bordered table-striped table-hover js-basic-example dataTable tabla-resultados">
							<thead>
								<tr>
									<th>#</th>
									<th width="50%">Nombre</th>
									<th>Club</th>
									<th>Grupo</th>
									<th>Estado</th>
									<th>Opciones</th>
								</tr>
							</thead>
							<tbody>
							
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- JS ====================================================================================================================== -->
		<!--  Js-principal -->
		<script src="pages/equipos/js/nuevo.js"></script>

		<div class="modal fade" id="nuevoPerfil" data-perfil="" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="defaultModalLabel">Nuevo  equipo</h4>
					</div>
					<div class="modal-body">

						<div class="body">
							<form>
								<label for="">Nombre</label>
								<div class="form-group">
									<div class="form-line">
										<input type="text" class="form-control n-nombre" placeholder="Nombre del equipo" />
									</div>
								</div>
								<label for="">Club</label>
								<div class="form-group">
									<select class="form-control show-tick select-n-club">
										<option value="">--Selecciona un club --</option>
										<?php 
										$vector = Array_Get_Clubs();
										foreach ($vector as $value) {
									
										?>
										<option value="<?php echo $value['id_colegio']; ?>"><?php echo $value['nombre']; ?></option>
										<?php
										}
										?>

									</select>
								</div>
								<label for="">Campeonato</label>
								<div class="form-group">
									<select class="form-control show-tick select-n-torneo">
										<option value="">--Selecciona un campeonato --</option>
										<?php 
										$vector = Array_Get_Campeonatos();
										foreach ($vector as $value) {
									
										?>
										<option value="<?php echo $value['id_torneo']; ?>"><?php echo $value['nombre_torneo']; ?></option>
										<?php
										}
										?>

									</select>
								</div>
								<label for="">Tecnico</label>
								<div class="form-group ">
								<input type="text" class="form-control n-tecnico" placeholder="Nombre del tecnico" />
								</div>
								<label for="">Grupo</label>
								<div class="form-group ">
									<input type="text" class="form-control n-grupo" placeholder="Grupo ejemplo: A" />
								</div>
								<label for="">Estado</label>
								<div class="form-group">
									<select class="form-control show-tick select-n-estado">
										<option value="">--Selecciona un estado --</option>

										<option value="activo">Activo</option>
										<option value="inactivo">Inactivo</option>

									</select>
								</div>

							</form>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-info waves-effect guardar-nuevo">Guardar cambios</button>
						<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal Dialogs ====================================================================================================================== -->
		<!-- Default Size -->
		<div class="modal fade" id="defaultModal" data-equipo="" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="defaultModalLabel">Edición de equipo</h4>
					</div>
					<div class="modal-body">

						<div class="body">
								<form>
								<label for="">Nombre</label>
								<div class="form-group">
									<div class="form-line">
										<input type="text" class="form-control nombre" placeholder="Nombre del equipo" />
									</div>
								</div>
								<label for="">Club</label>
								<div class="form-group">
									<select class="form-control show-tick select-club">
										<option value="">--Selecciona un club --</option>
										<?php 
										$vector = Array_Get_Clubs();
										foreach ($vector as $value) {
									
										?>
										<option value="<?php echo $value['id_colegio']; ?>"><?php echo $value['nombre']; ?></option>
										<?php
										}
										?>

									</select>
								</div>
								<label for="">Campeonato</label>
								<div class="form-group">
									<select class="form-control show-tick select-torneo">
										<option value="">--Selecciona un campeonato --</option>
										<?php 
										$vector = Array_Get_Campeonatos();
										foreach ($vector as $value) {
									
										?>
										<option value="<?php echo $value['id_torneo']; ?>"><?php echo $value['nombre_torneo']; ?></option>
										<?php
										}
										?>

									</select>
								</div>
								<label for="">Tecnico</label>
								<div class="form-group ">
								<input type="text" class="form-control tecnico" placeholder="Nombre del tecnico" />
								</div>
								<label for="">Grupo</label>

								<div class="form-group ">
									<input type="text" class="form-control grupo" placeholder="Grupo ejemplo: A" />
								</div>
								<label for="">Estado</label>
								<div class="form-group">
									<select class="form-control show-tick select-estado">
										<option value="">--Selecciona un estado --</option>

										<option value="activo">Activo</option>
										<option value="inactivo">Inactivo</option>

									</select>
								</div>

							</form>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-info waves-effect guardar">Guardar cambios</button>
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


