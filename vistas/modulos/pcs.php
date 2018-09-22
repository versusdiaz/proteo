<?php
  if(!$_SESSION['validarPTR']){
      header("location:inicio");
      exit();
  } else {
        include_once("vistas/modulos/inc/aside.php");
 }
?>
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
                        <i class="fa fa-globe"></i> Presupuestos
                    </div>
                    <div class="card-body">
                        <!-- AQUI VA TABLA -->
                        <div class="panel-body table-responsive" id="listadoregistros">
                            <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                                <thead>
                                    <th>Opciones</th>
                                    <th>Numero Interno</th>
                                    <th>Presupuesto</th>
                                    <th>Fecha</th>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <th>Opciones</th>
                                    <th>Numero Interno</th>
                                    <th>Presupuesto</th>
                                    <th>Fecha</th>
                                </tfoot>
                            </table>
                        </div>
                        <div class="card-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                            <div class="row">
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <label class="col-sm-12 control-label">Proveedor *:</label>
                                    <div class="col-sm-12">
                                        <input type="hidden" name="idpcs" id="idpcs">
                                        <select class="form-control selectpicker" data-live-search="true" name="idproveedor" id="idproveedor">
                                           
                                        </select>
                                    </div>
                                </div>
                            </div><!-- FIN DEL ROW -->
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" type="submit" id="btnGuardar">
                                    <i class="fa fa-save"></i> Guardar</button>
                                <button class="btn btn-danger" type="button" onclick="cancelarform()">
                                    <i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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
<script src="vistas/plugins/datatables/buttons.colVis.min.js"></script>
<script type="text/javascript" src="vistas/js/pcs.js"></script>

<?php ob_end_flush(); ?>