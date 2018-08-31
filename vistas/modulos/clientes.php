<?php
  if(!$_SESSION['validarTSM']){
      header("location:inicio");
      exit();
  } else {
        include_once("vistas/modulos/inc/aside.php");
 }
?>
<!-- INICIO DEL ESCRITORIO USUARIOS COMUNES -->
<!-- FIN DEL BODY -->
<main class="main">
    <!-- Breadcrumb-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">
            <a href="#">Admin</a>
        </li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-globe"></i> Portal
                            <button class="float-right btn btn-success" id="btnagregar" onclick="mostrarform(true)">
                                <i class="fa fa-plus-circle"></i> Agregar</button>
                        </div>
                        <div class="card-body">
                            <!-- AQUI VA TABLA -->
                            <div class="panel-body table-responsive" id="listadoregistros">
                                <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                                    <thead>
                                        <th>Opciones</th>
                                        <th>Nombre</th>
                                        <th>Id. Fiscal</th>
                                        <th>Tlf</th>
                                        <th>Status</th>
                                        </tfoot>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <th>Opciones</th>
                                        <th>Nombre</th>
                                        <th>Id. Fiscal</th>
                                        <th>Tlf</th>
                                        <th>Status</th>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="card-body" id="formularioregistros">
                            <form name="formulario" id="formulario" method="POST">
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label class="col-sm-12 control-label">Ruta *:</label>
                                <input type="hidden" name="idtarifa" id="idtarifa">
                                <div class="col-sm-12">
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ruta" required>
                                </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label class="col-sm-12 control-label">Monto Chofer *:</label>
                                <div class="col-sm-12">
                                <input type="number" class="form-control" name="montotsmp" id="montotsmp" required>
                                </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label class="col-sm-12 control-label">Monto TSM *:</label>
                                <div class="col-sm-12">
                                <input type="number" class="form-control" name="montotsmc" id="montotsmc" required>
                                </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label class="col-sm-12 control-label">Monto CARIBBEAN *:</label>
                                <div class="col-sm-12">
                                <input type="number" class="form-control" name="montocaribec" id="montocaribec" required>
                                </div>
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" type="submit" id="btnGuardar">
                                    <i class="fa fa-save"></i> Guardar</button>
                                <button class="btn btn-danger" type="button" onclick="cancelarform()">
                                    <i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-primary">
                                    Ayuda
                                </button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN DEL JUMBO -->
    </div>
</main>
</div>
<?php include_once("vistas/modulos/inc/footer.php"); ?>
<!-- SCRIPT UNICOS-->
<script src="vistas/plugins/datatables/jquery.dataTables.min.js"></script>    
<script src="vistas/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="vistas/plugins/datatables/buttons.html5.min.js"></script>
<script src="vistas/plugins/datatables/buttons.colVis.min.js"></script>
<script src="vistas/plugins/datatables/jszip.min.js"></script>
<script src="vistas/plugins/datatables/pdfmake.min.js"></script>
<script src="vistas/plugins/datatables/vfs_fonts.js"></script> 
<script type="text/javascript" src="vistas/js/clientes.js"></script>
<?php ob_end_flush(); ?>