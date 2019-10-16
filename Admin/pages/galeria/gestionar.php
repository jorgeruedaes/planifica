<?php  
$ubicacion ="../";
include("../menuinicial.php");
include('../../php/galeria.php');
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
			<!-- Basic Table -->
			<div class="row ">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2>
								GESTION DE LA GALERIA 
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
									<th>Url</th>
									<th>Fecha</th>
									<th>Vista previa</th>
									<th>Opciones</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$vector = Array_Get_Galeria();
								foreach ($vector as  $value) {
									?>
									<tr>
										<th scope="row"><?php echo $value['codigo']; ?></th>
										<td><?php echo $value['imagen']; ?></td>
										<td><?php echo $value['fecha']; ?></td>
										<td> 
											<div class="btn-group btn-group-xs" role="group" aria-label="Small button group">
												<button  data-logo="<?php echo $value['imagen']; ?>" type="button" class="btn btn-primary waves-effect ver"><i class="material-icons">collections</i></button>
												<div>
												</td>
												<td>
													<div class="btn-group btn-group-xs" role="group" aria-label="Small button group">
<button  data-url="<?php echo $value['imagen']; ?>" data-codigo="<?php echo $value['codigo']; ?>" 
data-torneo="<?php echo $value['torneo']; ?>" 
															type="button" class="btn btn-primary waves-effect edit-item"><i class="material-icons">edit</i></button>
															<button  data-codigo="<?php echo $value['codigo']; ?>" type="button" class="btn btn-danger  waves-effect delete-item"><i class="material-icons">delete</i></button>

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
			<script src="pages/galeria/js/nuevo.js"></script>

			<div class="modal fade" id="nuevoPerfil" data-perfil="" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="defaultModalLabel">Nueva Imagen</h4>
						</div>
						<div class="modal-body">

							<div class="body">
								<form>
									<label for="">Url</label>
									<div class="form-group">
										<div class="form-line">
											<input type="text" class="form-control n-url" placeholder="Url" />
										</div>
									</div>
									<label for="">Album</label>
									<div class="form-group ">
										<select class="form-control show-tick select-n-torneo">
											<option value="">--Selecciona un Album --</option>

											<?php 
											$vector = Array_Get_Albums();
											foreach ($vector as $value) {

												?>
												<option value="<?php echo $value['id_album']; ?>"><?php echo $value['nombre']; ?></option>
												<?php
											}
											?>

										</select>
									</div>


								</form>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-info waves-effect guardar-nuevo">Guardar </button>
							<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal Dialogs ====================================================================================================================== -->
			<!-- Default Size -->
			<div class="modal fade" id="defaultModal" data-club="" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="defaultModalLabel">Editar Imagen</h4>
						</div>
						<div class="modal-body">

							<div class="body">
								<form>
									<label for="">Url</label>
									<div class="form-group">
										<div class="form-line">
											<input type="text" class="form-control url" placeholder="Url" />
										</div>
									</div>
									<label for="">Album</label>
									<div class="form-group ">
										<select class="form-control show-tick select-torneo">
											<option value="">--Selecciona un Album --</option>

											<?php 
										$vector = Array_Get_Albums();
											foreach ($vector as $value) {

												?>
												<option value="<?php echo $value['id_album']; ?>"><?php echo $value['nombre']; ?></option>
												<?php
											}
											?>

										</select>
									</div>

								</form>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" data-imagen="" class="btn btn-info waves-effect guardar">Guardar cambios</button>
							<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="imagenesvisor" data-perfil="" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="defaultModalLabel">Logo Club</h4>
						</div>
						<div class="modal-body">

							<div class="body">
								<div class="row clearfix">
									<!-- Basic Example -->
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<img id="imagenes" src="" width="500px" /

									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
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


