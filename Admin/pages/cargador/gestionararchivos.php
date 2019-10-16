<?php  
$ubicacion ="../";
include("../menuinicial.php");
include('../../php/cargador.php');
$id_modulos ='65';
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
								GESTION DE ARCHIVOS  -- 	<?php echo  strtoupper($_GET['id']) ?>
							</h2>
							<ul class="header-dropdown m-r--5">
								<li></li>
								<li>
									<button type="button" class="btn bg-red 
									waves-effect add-files">
									<i class="material-icons">add</i>
								</button>

							</li>
							<li></li>
						</ul>
					</div>
					<div class="body">
						<div class="row clearfix">
							<?php
							$vector =  Read_Files_Folder('../../../Archivos/'.$_GET['id'],$_GET['id']);
							if(empty($vector)){echo 'No hay archivos en esta carpeta.';}
							foreach ($vector as $value) {
								?>
								<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
									<div class="card">
										<div class="header">
											<h2><small></small>
											</h2>
											<ul class="header-dropdown m-r--5">
												<li class="dropdown">
													<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
														<i class="material-icons">more_vert</i>
													</a>
													<ul class="dropdown-menu pull-right">
														<li><a href="javascript:void(0);"  data-url="<?php  echo $value['Url'];?>"  class=" waves-effect waves-block copy-clipboard ">Copiar Url</a></li>
														<li><a href="javascript:void(0);" data-url="<?php  echo $value['Url'];?>"  class=" waves-effect waves-block preview">Vista Previa</a></li>
														<li><a href="<?php echo $value['Url']?>" download="<?php echo $value['Archivo'];?>" class=" waves-effect waves-block preview">Descargar</a></li>
														<li><a href="javascript:void(0);" data-url="<?php echo $value['Archivo'];?>" class=" waves-effect waves-block  delete">Eliminar</a></li>
													</ul>
												</li>
											</ul>
										</div>
										<div class="body">
											<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
												<?php
												if(Get_Icon($value['Extension'])[0] == "image"){
													?>
													<img class="media-object preview" style="cursor: pointer;" src="<?php  echo $value['Url'];?>" width="64px" height="64px" >
													<?php
												}
												else
												{
													?>
													<div title="<?php echo $value['FileName'] ?>" class="icon" style="padding-left: 30%;">
														<i data-url="<?php  echo $value['Url'];?>" style="font-size: 60px;cursor: pointer;" class="material-icons preview col-<?php echo Get_Icon($value['Extension'])[1]?>"><?php echo Get_Icon($value['Extension'])[0]; ?></i>
													</div>
													<?php
												}
												?>											
											</div>
											<div title="<?php echo $value['FileName'] ?>" class="content">
												<div class="text"><?php  echo substr(strtoupper($value['FileName']),0,20)?></div>
												<div class="number count-to" data-from="0" data-to="125" data-speed="1000" data-fresh-interval="20"></div>
											</div>
										</div>
									</div>
								</div>
								<?php
							}
							?>


						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- JS ====================================================================================================================== -->
<!--  Js-principal -->
<script src="pages/cargador/js/nuevo.js"></script>

<div class="modal fade" id="nuevaarchivos" data-perfil="" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="defaultModalLabel">Cargador de archivos</h4>
			</div>
			<div class="modal-body">

				<div class="body">
					<form action="pages/cargador/peticiones/subir.php?carpeta=<?php echo $_GET['id'] ?>" 
						id="dropzone" class="dropzone" >
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
				<button data-carpeta='<?php echo $_GET['id']?>' type="button" class="btn btn-danger waves-effect guardar-files" data-dismiss="modal">Cerrar</button>
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
								<input type="text" class="form-control titulo" placeholder="Titulo de la noticia" />
							</div>
						</div>
						<div class="row clearfix">
							<div class="col-sm-6">
								<label for="">Tipo</label>
								<div class="form-group">
									<select class="form-control show-tick select-tipo">
										<option value="">--Selecciona un tipo --</option>
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


<!-- Dropzone Plugin Js -->
<script src="plugins/dropzone/dropzone.js"></script>
<!-- Dropzone Css -->
<link href="plugins/dropzone/dropzone.css" rel="stylesheet">

<?php
}else
{
	require("../sinpermiso.php");
}
?>
