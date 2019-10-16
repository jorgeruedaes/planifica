<?php  
$ubicacion ="../";
include("../menuinicial.php");
include('../../php/comunicados.php');
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
								GESTION DE COMUNICADOS  
							</h2>
							<ul class="header-dropdown m-r--5">
								<li></li>
								<li>
									<button type="button" class="btn bg-red 
									waves-effect add-noticia">
									<i class="material-icons">add</i>
								</button>

							</li>
							<li></li>
						</ul>
					</div>
					<div class="body">
						<table  id="tabla-comunicados" class="table table-bordered table-striped table-hover js-basic-example dataTable">
							<thead>
								<tr>
									<th>#</th>
									<th width="70%">Titulo</th>
									<th width="15%">Tipo</th>
									<th width="15%">Fecha</th>
									<th width="15%">Opciones</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$vector = Array_Get_Comunicados();
								foreach ($vector as  $value) {
									?>
									<tr>
										<td scope="row"><?php echo $value['id_comunicados']; ?></td>
										<td scope="row"><?php echo $value['titulo']; ?></td>
										<td scope="row"><?php echo $value['tipo']; ?></td>
										<td><?php echo $value['fecha']; ?></td>
										<td>
											<div class="btn-group btn-group-xs" role="group" aria-label="Small button group">
												<button 
												data-codigo="<?php echo $value['id_comunicados'];?>"
												data-titulo="<?php echo $value['titulo']; ?>"
												data-fecha="<?php echo $value['fecha'];?>"
												data-url="<?php echo $value['comunicado'];?>"
												data-tipo="<?php echo $value['tipo'];?>"
												type="button" class="btn btn-primary waves-effect edit-item"><i class="material-icons">edit</i></button>
												<button 
												data-codigo="<?php echo $value['id_comunicados'];?>"
												type="button" class="btn btn-danger waves-effect delete-item"><i class="material-icons">delete</i></button>

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
	<script src="pages/comunicados/js/nuevo.js"></script>

	<div class="modal fade" id="nuevacomunicados" data-perfil="" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="defaultModalLabel">Nuevo comunicado</h4>
				</div>
				<div class="modal-body">

					<div class="body">
						<form>
							<label for="">Titulo</label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" class="form-control n-titulo" placeholder="Titulo del comunicado" />
								</div>
							</div>
							<label for="">Url</label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" class="form-control n-url" placeholder="Url del comunicado" />
								</div>
							</div>
							<div class="row clearfix">
								<div class="col-sm-6">
									<label for="">Tipo</label>
									<div class="form-group">
										<select class="form-control show-tick select-n-tipo">
											<option value="">--Selecciona un tipo --</option>
											<option value="programacion">Programación</option>
											<option value="boletin">Boletín</option>
											<option value="resolucion">Resolución</option>
											<option value="documentos">Documentos</option>

										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<label for="">Fecha de publicación</label>
									<div class="form-group">
										<div class="form-line">
											<input type="text" id="fecha" class="datepicker form-control n-fecha" placeholder="Seleccina una fecha...">
										</div>
									</div>
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
	<div class="modal fade" id="defaultModal" data-id="" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="defaultModalLabel">Edición de comunicados</h4>
				</div>
				<div class="modal-body">

					<div class="body">
						<form>
							<label for="">Titulo</label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" class="form-control titulo" placeholder="Titulo del comunicado" />
								</div>
							</div>
							<label for="">Url</label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" class="form-control url" placeholder="Url del comunicado" />
								</div>
							</div>
							<div class="row clearfix">
								<div class="col-sm-6">
									<label for="">Tipo</label>
									<div class="form-group">
										<select class="form-control show-tick select-tipo">
											<option value="">--Selecciona un tipo --</option>
											<option value="programacion">Programación</option>
											<option value="boletin">Boletín</option>
											<option value="resolucion">Resolución</option>
											<option value="documentos">Documentos</option>

										</select>
									</div>
								</div>
								<div class="col-sm-6">
									<label for="">Fecha de publicación</label>
									<div class="form-group">
										<div class="form-line">
											<input type="text" id="fecha" class="datepicker form-control fecha" placeholder="Seleccina una fecha...">
										</div>
									</div>
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

	<?php
}else
{
	require("../sinpermiso.php");

}
?>


