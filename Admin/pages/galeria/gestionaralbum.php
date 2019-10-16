<?php  
$ubicacion ="../";
include("../menuinicial.php");
include('../../php/galeria.php');
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
			<!-- Basic Table -->
			<div class="row ">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2>
								GESTION DE ALBUMS  
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
						<table  id="tabla-clubs" class="table table-bordered table-striped table-hover js-basic-example dataTable">
							<thead>
								<tr>
									<th>#</th>
									<th>Nombre</th>
									<th>Estado</th>
									<th>Opciones</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$vector = Array_Get_Albums();
								foreach ($vector as  $value) {
									?>
									<tr>
										<td scope="row"><?php echo $value['id_album']; ?></td>
										<td><?php echo $value['nombre']; ?></td>
										<td><?php echo $value['estado']; ?></td>
												<td>
													<div class="btn-group btn-group-xs" role="group" aria-label="Small button group">
														<button  data-codigo="<?php echo $value['id_album']; ?>" data-nombre="<?php echo $value['nombre']; ?>" data-estado="<?php echo $value['estado']; ?>" type="button" class="btn btn-primary waves-effect edit-item"><i class="material-icons">edit</i></button>
														<button  data-codigo="<?php echo $value['id_album']; ?>" type="button" class="btn btn-danger  waves-effect delete-item"><i class="material-icons">delete</i></button>

													</div>

												</td>
											</tr>
											<?php
										}
										?>
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
		<script src="pages/galeria/js/albums.js"></script>

		<div class="modal fade" id="nuevoPerfil" data-perfil="" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="defaultModalLabel">Nuevo Album</h4>
					</div>
					<div class="modal-body">

						<div class="body">
							<form>
								<label for="">Nombre</label>
								<div class="form-group">
									<div class="form-line">
										<input type="text" class="form-control n-nombre" placeholder="Nombre del album" />
									</div>
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
						<button type="button" class="btn btn-info waves-effect guardar-nuevo">Guardar</button>
						<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal Dialogs ====================================================================================================================== -->
		<!-- Default Size -->
		<div class="modal fade" id="defaultModal" data-id="" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="defaultModalLabel">Edición de Albums</h4>
					</div>
					<div class="modal-body">


						<div class="body">
							<form>
								<label for="">Nombre</label>
								<div class="form-group">
									<div class="form-line">
										<input type="text" class="form-control nombre" placeholder="Nombre del album" />
									</div>
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
						<button type="button" data-codigo="" class="btn btn-info waves-effect guardar">Guardar cambios</button>
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


