<?php  
$ubicacion ="../";
include("../menuinicial.php");
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
								GESTION DE CAMPEONATOS 
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
					<div class="body table-responsive">
						<table  id="tabla-campeonatos" class="table table-bordered table-striped table-hover js-basic-example dataTable">
							<thead>
								<tr>
									<th>#</th>
									<th>Nombre</th>
									<th>Categoria</th>
									<th>Estado</th>
									<th>Reglamentos</th>
									<th>Opciones</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$vector = Array_Get_Campeonatos();
								foreach ($vector as  $value) {
									?>
									<tr>
										<th scope="row"><?php echo $value['id_torneo']; ?></th>
										<td><?php echo $value['nombre_torneo']; ?></td>
										<td><?php echo $value['categoria']; ?></td>
										<td><?php echo $value['estado']; ?></td>
										<td> 
											<div class="demo-google-material-icon"><a href="<?php echo $value['reglamento']; ?>" target="_blank"> <i class="material-icons">picture_as_pdf</i> <span class="icon-name"></span><a/></div>
										</td>
										<td>
											<div class="btn-group btn-group-xs" role="group" aria-label="Small button group">
												<button data-estado="<?php echo $value['estado']; ?>" 
												data-puntos="<?php echo $value['puntos_ganador']; ?>" 
												data-url="<?php echo $value['reglamento']; ?>" 
												 data-categoria="<?php echo $value['categoria']; ?>" 
												  data-nombre="<?php echo $value['nombre_torneo']; ?>"
												   data-torneo="<?php echo $value['id_torneo']; ?>"
												    type="button" class="btn btn-primary waves-effect edit-item"><i class="material-icons">edit</i></button>

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
<script src="pages/campeonatos/js/nuevo.js"></script>

<div class="modal fade" id="nuevoPerfil" data-perfil="" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel">Nuevo de campeonato</h4>
			</div>
			<div class="modal-body">

				<div class="body">
					<form>
						<label for="perfil">Nombre</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" class="form-control nuevo-nombre" placeholder="Nombre campeonato" />
							</div>
						</div>
						<label for="perfil">Reglamentos</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" class="form-control nuevo-url" placeholder="Url del pdf" />
							</div>
						</div>
						<label for="estado">Categoria</label>
						<div class="form-group ">
							<select class="form-control show-tick select-nuevo-categoria">
								<option value="">--Selecciona una categoria --</option>

								<option value="menores">Menores</option>
								<option value="intermedio">Intermedio</option>
								<option value="mayores">Mayores</option>

							</select>
						</div>
							<label for="">Puntos</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" class="form-control nuevo-puntos" placeholder="Puntos" />
							</div>
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
<div class="modal fade" id="defaultModal" data-torneo="" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel">Edición Campeonato</h4>
			</div>
			<div class="modal-body">

				<div class="body">
					<form>
						<label for="">Campeonato</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" class="form-control nombre" placeholder="Nombre campeonato" />
							</div>
						</div>
							<label for="">Reglamentos</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" class="form-control url" placeholder=" Url de PDF" />
							</div>
						</div>
						<label for="">Categotria</label>
						<div class="form-group ">
							<select class="form-control show-tick select-categoria">
								<option value="">--Selecciona una categoria --</option>

								<option value="menores">Menores</option>
								<option value="intermedio">Intermedio</option>
								<option value="mayores">Mayores</option>

							</select>
						</div>
							<label for="">Puntos</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" class="form-control puntos" placeholder="Puntos" />
							</div>
						</div>
						<label for="">Estado</label>
						<div class="form-group ">
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


