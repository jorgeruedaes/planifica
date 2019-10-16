<?php  
$ubicacion ="../";
include("../menuinicial.php");
include($ubicacion."../php/partidos.php");
include($ubicacion."../php/equipo.php");
include($ubicacion."../php/campeonatos.php");
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
								Nuevo partido
								<small>Agrega un nuevo partido al calendario.</small>
							</h2>
						</div>
						<div class="body">
							<form>
								<h2 class="card-inside-title">Campeonato o torneo</h2>
								<div class="row clearfix">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
										<select class="form-control show-tick selector-campeonato-nuevo">
											<option value="">--Selecciona un Campeonato --</option>
											<?php
											$vector = Array_Get_Campeonatos();
											foreach ($vector as  $value) 
											{
												?>
												<option value="<?php echo $value['id_torneo'] ?>"><?php echo $value['nombre_torneo'] ?></option>
												<?php 
											} 
											?>	
										</select>
									</div>
								</div>
								<h2 class="card-inside-title">Horario y lugar </h2>
								<div class="row clearfix">
									<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
										<div class="form-group">
											<div class="form-line">
												<input type="text" id="fecha" class="datepicker form-control" placeholder="Seleccina una fecha...">
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
										<div class="form-group">
											<div class="form-line">
												<input type="text" id="hora" class="timepicker form-control" placeholder="Selecciona una hora...">
											</div>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
										<select class="form-control show-tick select-lugar">
											<option value="">--Selecciona un lugar --</option>
											<?php
											$vector = Array_Get_Lugares();
											foreach ($vector as  $value) 
											{
												?>
												<option value="<?php echo $value['id_lugares'] ?>"><?php echo $value['nombre'] ?></option>
												<?php 
											}
											?>	
										</select>
									</div>
								</div>
								<h2 class="card-inside-title">Equipos que se enfrentan</h2>
								<div class="row clearfix">
									<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
										<select id='select-equipoa' class="form-control show-tick select-equipoa">
											<option value="">--Selecciona un Equipo --</option>
										</select>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
										<select id='select-equipob' class="form-control show-tick select-equipob">
										<option value="">--Selecciona un Equipo --</option>
											?>	
										</select>
									</div>
								</div>
								<h2 class="card-inside-title">Fecha o ronda </h2>
								<div class="row clearfix">
									<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
										<div class="form-group">
											<div class="form-line">
												<input type="text" id="ronda" class="form-control"  placeholder="Ingresa una fecha o ronda">
											</div>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
										<button type="button" class="btn btn-primary btn-lg m-l-15 waves-effect guardar">Guardar</button>
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
	<script src="pages/partidos/js/partidos.js"></script>

	<!-- Modal Dialogs ====================================================================================================================== -->
	<!-- Default Size -->
	<?php
}else
{
	require("../sinpermiso.php");
}
?>