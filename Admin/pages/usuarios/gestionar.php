<?php  
$ubicacion ="../";

include("../menuinicial.php");
$id_modulos=$id_modulos =Int_RutaModulo($_SERVER['REQUEST_URI']);
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
								Usuarios
								<small></small>
							</h2>
						</div>
						<div class="body table-responsive">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Nombre</th>
										<th>Perfil</th>
										<th>Estado</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$vector = Array_Get_Usuarios($_SESSION['perfil']);
									foreach ($vector as $value)
									{
										?>
										<tr>
											<td><?php echo String_Get_Nombre($value['id_usuarios']); ?></td>
											<td><?php echo String_Get_Nombre_Perfil($value['perfil']); ?></td>
											<td><?php echo $value['estado']; ?></td>
											<td>
												<div class="btn-group btn-group-xs" role="group" aria-label="Extra-small button group">
													<button data-id="<?php echo $value['id_usuarios']?>" data-perfil="<?php echo $value['perfil']?>" data-estado="<?php echo $value['estado']?>"  type="button" class="btn bg-blue waves-effect edit-item" data-toggle="modal" > <i class="material-icons">edit</i></button>

													<button data-id="<?php echo $value['id_usuarios']?>"  type="button" class="btn bg-red waves-effect delete-item"> <i class="material-icons">delete</i></button>
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
	<script src="pages/usuarios/js/usuarios.js"></script>

	<!-- Modal Dialogs ====================================================================================================================== -->
	<!-- Default Size -->
	<div class="modal fade" id="defaultModal" data-usuario="" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="defaultModalLabel">Edición de usuarios</h4>
				</div>
				<div class="modal-body">

					<div class="body">
						<form>
							<label for="perfil">Perfil</label>
							<div class="form-group">
								<select class="form-control select-perfiles">
									<option value="">-- Selecciona --</option>
									<?php 
									$vector = Array_Get_Perfiles($_SESSION['perfil']);
									foreach ($vector as  $value)
									{
										?>
										<option value="<?php echo $value['id_perfiles']; ?>"><?php echo $value['nombre']; ?></option>
										<?php
									}
									?>
								</select>
							</div>
							<label for="estado">Estado</label>
							<div class="form-group ">
								<select class="form-control select-estados">
									<option value="">-- Selecciona --</option>
									<option value="activo">Activo</option>
									<option value="procesando">Procesando</option>
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