<?php  
$ubicacion ="../";
include("../menuinicial.php");
echo $_SERVER['REQUEST_URI'];
$id_modulos=Int_RutaModulo($_SERVER['REQUEST_URI']);
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
								GESTION DE PERFILES 
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
						<table class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Nombre</th>
									<th>Nivel</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$vector = Array_Get_Listado_Perfiles($_SESSION['perfil']);
								foreach ($vector as  $value) {
									?>
									<tr>
										<th scope="row"><?php echo $value['id_perfiles']; ?></th>
										<td><?php echo $value['nombre']; ?></td>
										<td><?php echo $value['nivel']; ?></td>
										<td>
											<div class="btn-group btn-group-xs" role="group" aria-label="Small button group">
												<button  data-nivel="<?php echo $value['nivel']; ?>"  data-nombre="<?php echo $value['nombre']; ?>" data-id="<?php echo $value['id_perfiles']; ?>" type="button" class="btn btn-primary waves-effect edit-item"><i class="material-icons">edit</i></button>
												<button data-modulos='<?php echo JSON_Get_ModulosxPerfil($value['id_perfiles']); ?>'  data-nombre="<?php echo $value['nombre']; ?>" data-id="<?php echo $value['id_perfiles']; ?>" type="button" class="btn btn-warning waves-effect edit-modulos"><i class="material-icons">list</i></button>
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
<?php echo  phpversion()?>

<!-- JS ====================================================================================================================== -->
<!--  Js-principal -->
<script src="pages/perfiles/js/nuevo.js"></script>

<div class="modal fade" id="nuevoPerfil" data-perfil="" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel">Nuevo perfíl</h4>
			</div>
			<div class="modal-body">

				<div class="body">
					<form>
						<label for="perfil">Perfil</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" class="form-control nuevo-nombre" placeholder="Nombre perfil" />
							</div>
						</div>
						<label for="estado">Nivel</label>
						<div class="form-group ">
							<div class="form-line">
								<input type="number" class="form-control nuevo-nivel" placeholder="Nivel" />
							</div>
						</div>
						<label for="estado">Descripción</label>
						<div class="form-group">
							<div class="form-line">
								<textarea rows="4" class="form-control no-resize detalle" placeholder="Escriba la descripción del perfil"></textarea>
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
<div class="modal fade" id="defaultModal" data-perfil="" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel">Edición perfíl</h4>
			</div>
			<div class="modal-body">

				<div class="body">
					<form>
						<label for="perfil">Perfil</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" class="form-control nombre" placeholder="Nombre perfil" />
							</div>
						</div>
						<label for="estado">Nivel</label>
						<div class="form-group ">
							<div class="form-line">
								<input type="number" class="form-control nivel" placeholder="Nivel" />
							</div>
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


<div class="modal fade" id="ModalModulos" data-usuario="" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel1"></h4>
			</div>
			<div class="modal-body">

				<div class="body">
					<div class="row clearfix">
						<div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
							<div class="panel-group" id="accordion_1" role="tablist"
							aria-multiselectable="true">
							<?php
							$vector = Array_Get_Modulos(true,'');
							foreach ($vector as $value) {	
								?>
								<div class="panel panel-primary">
									<div class="panel-heading" role="tab" id="headingOne_<?php echo $value['id_modulos']; ?>">
										<h4 class="panel-title">
											<a role="button" data-toggle="collapse" 
											data-parent="#accordion_1"
											href="#collapseOne_<?php echo $value['id_modulos']; ?>" 
											aria-expanded="false" aria-controls="collapseOne_<?php echo $value['id_modulos']; ?>">
											<?php echo $value['nombre']; ?>
										</a>
									</h4>
								</div>
								<div id="collapseOne_<?php echo $value['id_modulos']; ?>"
									class="panel-collapse collapse " role="tabpanel" 
									aria-labelledby="headingOne_<?php echo $value['id_modulos']; ?>">
									<div class="panel-body">
										<?php
										$variable = Array_Get_Modulos(False,$value['id_modulos']);
										foreach ($variable as $values) {	
											?>
											<div class="row clearfix">
												<div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
													<input data-id='<?php echo $values['id_modulos']?>' type="checkbox" id="basic_checkbox_<?php echo $values['id_modulos']?>" class="filled-in modulo-<?php echo $values['id_modulos']?> permisos"/>
													<label for="basic_checkbox_<?php echo $values['id_modulos']?>"><?php echo $values['nombre']; ?></label>
												</div>
											</div>
											<?php
										}
										?>
									</div>
								</div>
							</div>

							<?php 
						}
						?>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info waves-effect guardar-edit">Guardar cambios</button>
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