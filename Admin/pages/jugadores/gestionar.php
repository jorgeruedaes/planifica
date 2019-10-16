<?php  
$ubicacion ="../";
include("../menuinicial.php");
include('../../php/equipo.php');
include('../../php/clubs.php');
include('../../php/campeonatos.php');
include('../../php/jugador.php');
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
                                GESTION DE JUGADORES  
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li></li>
                                <li>
                                    <button type="button" class="btn bg-red 
                                    waves-effect add-jugador">
                                    <i class="material-icons">add</i>
                                </button>

                            </li>
                            <li></li>
                        </ul>
                    </div>
                    <div class="body">
                        <table  id="tabla-jugadores" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Documento</th>
                                    <th>Nombre</th>
                                    <th>Equipo</th>
                                    <th>Estado</th>
                                    <th widht="10%">Opciones</th>
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
<script src="pages/jugadores/js/nuevo.js"></script>

<!-- Modal Dialogs ====================================================================================================================== -->
<!-- Default Size -->
<div class="modal fade" id="Modalnuevo" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Edición de jugador</h4>
            </div>
            <div class="modal-body">

                <div class="body">
                    <form>
                        <label for="">Primer nombre</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control n-nombre1" placeholder="Primer nombre" />
                            </div>
                        </div>
                        <label for="">Segundo nombre</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control n-nombre2" placeholder="Primer nombre" />
                            </div>
                        </div>
                        <label for="">Primer apellido</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control n-apellido1" placeholder="Segundo apellido" />
                            </div>
                        </div>
                        <label for="">Segundo apellido</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control n-apellido2" placeholder="Segundo apellido" />
                            </div>
                        </div>
                        <label for="">Documento de indentidad</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control n-documento" placeholder="Documento" />
                            </div>
                        </div>
                        <label for="">Fecha de nacimiento</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="datepicker form-control n-fechanacimiento" placeholder="Seleccina una fecha...">
                            </div>
                        </div>
                        <label for="">Equipos</label>
                        <div class="form-group">
                            <select id="select-n-equipos" class="form-control show-tick select-n-equipos">
                                <option value="">--Selecciona un equipo --</option>

                            </select>
                        </div>
                        <label for="">Estado</label>
                        <div class="form-group">
                            <select class="form-control show-tick select-n-estado">
                                <option value="">--Selecciona un estado --</option>

                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>

                            </select>
                        </div>

                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button"  data-idjugador="" class="btn btn-info waves-effect guardar-nuevo">Guardar</button>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Dialogs ====================================================================================================================== -->
<!-- Default Size -->
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Edición de jugador</h4>
            </div>
            <div class="modal-body">

                <div class="body">
                    <form>
                        <label for="">Primer nombre</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control nombre1" placeholder="Primer nombre" />
                            </div>
                        </div>
                        <label for="">Segundo nombre</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control nombre2" placeholder="Primer nombre" />
                            </div>
                        </div>
                        <label for="">Primer apellido</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control apellido1" placeholder="Segundo apellido" />
                            </div>
                        </div>
                        <label for="">Segundo apellido</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="form-control apellido2" placeholder="Segundo apellido" />
                            </div>
                        </div>
                        <label for="">Fecha de nacimiento</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" class="datepicker form-control fechanacimiento" placeholder="Seleccina una fecha...">
                            </div>
                        </div>
                        <label for="">Estado</label>
                        <div class="form-group">
                            <select class="form-control show-tick select-estado">
                                <option value="">--Selecciona un estado --</option>

                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>

                            </select>
                        </div>

                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button"  data-idjugador="" class="btn btn-info waves-effect guardar">Guardar cambios</button>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>
                </div>
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


