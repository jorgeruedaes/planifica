<?php  
$ubicacion ="../";
$id_modulos="1";
include("../menuinicial.php");
if(isset($_SESSION['id_usuarios'])){
	$usuario =Array_Get_Usuario($_SESSION['id_usuarios']);
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
						<li>
							<a href="pages/usuarios/perfil.php" class="active">
								<!--<i class="material-icons"><?php echo $value['icono'] ?></i>-->
								Usuarios
							</a>
						</li>
					</ol>
				</h2>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2>
								USUARIO
								<small></small>
								<ul class="header-dropdown m-r--5">
									<li></li>
									<li>
										<button type="button" class="btn bg-red 
										waves-effect activate-edit">Activar edición

									</button>

								</li>
								<li></li>
							</ul>
						</h2>
					</div>

					<div class="body">
						<form>
							<div class="row clearfix">
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
									<div class="form-group">
										<div class="form-line">
											<input disabled="true" value="<?php echo $usuario['nombre'] ?>" type="text" class="form-control nombre" placeholder="Nombre">
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
									<div class="form-group">
										<div class="form-line">
											<input disabled="true" value="<?php echo $usuario['apellido'] ?>" type="text" class="form-control apellido" placeholder="Apellido">
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
									<div class="form-group">
										<div class="form-line">
											<input disabled="true" value="<?php echo $usuario['email'] ?>" type="text" class="form-control email" placeholder="Email ">
										</div>
									</div>
								</div>
								<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
									<div class="form-group">

									</div>
								</div>
							</div>
							<div class="row clearfix">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="form-group a">
										<select  class="form-control select-pregunta">
											<option value="">-- Selecciona una pregunta --</option>
											<?php 
											$vector = Array_Get_Preguntas();
											foreach ($vector as  $value)
											{
												?>
												<option <?php  echo ($value['id_preguntas']==$usuario['pregunta']) ? "selected":""; ?> 
													value="<?php echo $value['id_preguntas'];?>"><?php echo $value['pregunta']; ?></option>
													<?php
												} 
												?>    
											</select>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
										<div class="form-group">
											<input disabled="true" value="" type="password" class="form-control respuesta" placeholder="Respuesta ">
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">

										<div class="form-group">
											<label class="font-bold">Cambiar contraseña</label>
											<button type="button" class="btn bg-orange waves-effect editar-pass">
												<i class="material-icons">edit</i>
											</button>
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
	<script src="pages/usuarios/js/perfil.js"></script>

	<!-- Modal Dialogs ====================================================================================================================== -->
	<!-- Default Size -->
	<div class="modal fade" id="defaultModal" data-usuario="" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="defaultModalLabel">Cambiar contraseña</h4>
				</div>
				<div class="modal-body">
					<div class="body">
						<div class="form-group">
							<div class="form-line">
								<input  type="password" class="form-control viejo-password" placeholder="Contraseña antigua">
							</div>
						</div>
						<div class="form-group">
							<div class="form-line">
								<input  type="password" class="form-control nuevo-password" placeholder="Nueva contraseña">
							</div>
						</div>
						<div class="form-group">
							<div class="form-line">
								<input  type="password" class="form-control" placeholder="Repita la nueva cotraseña">
							</div>
						</div>

						<div class="row clearfix demo-icon-container">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info waves-effect guardar">Guardar</button>
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