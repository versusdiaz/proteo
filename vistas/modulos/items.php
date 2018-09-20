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
                            <i class="fa fa-globe"></i> Items
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
                                        <th>Stock</th>
                                        <th>Precio Nacional</th>
                                        <th>Precio USD</th>
                                        <th>Status</th>
                                        </tfoot>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <th>Opciones</th>
                                        <th>Nombre</th>
                                        <th>Stock</th>
                                        <th>Precio Nacional</th>
                                        <th>Precio USD</th>
                                        <th>Status</th>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="card-body" id="formularioregistros">
                            <form name="formulario" id="formulario" method="POST">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="col-sm-12 control-label">Nombre *:</label>
                        <input type="hidden" name="iditems" id="iditems">
                        <div class="col-sm-12">
                        <input type="text" class="form-control" name="nombre" id="nombre">
                        </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="col-sm-12 control-label">Precio Nacional *:</label>
                        <div class="col-sm-12">
                        <input type="number" class="form-control" name="precio_nac" id="precio_nac" step="0.01" required>                       
                        </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="col-sm-12 control-label">Precio USD *:</label>
                        <div class="col-sm-12">
                        <input type="number" class="form-control" name="precio_usd" id="precio_usd" step="0.01" required>                                               
                        </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="col-sm-12 control-label">Es un servicio? *:</label>
                        <div class="col-sm-12">
                        <select class="form-control selectpicker" data-live-search="true" name="servicio" id="servicio">
                        <option value="">SELECCIONE</option>
                        <option value="1">SI</option>
                        <option value="0">NO</option>
                        </select>
                        </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="col-sm-12 control-label">Stock *:</label>
                        <div class="col-sm-12">
                        <input type="number" class="form-control" name="stock" id="stock" step="0.01" required>
                        </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="col-sm-12 control-label">Stock Minimo *:</label>
                        <div class="col-sm-12">
                        <input type="number" class="form-control" name="stock_min" id="stock_min" step="0.01" required>
                        </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="col-sm-12 control-label">Stock Maximo *:</label>
                        <div class="col-sm-12">
                        <input type="number" class="form-control" name="stock_max" id="stock_max" step="0.01" required>
                        </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="col-sm-12 control-label">Unidad *:</label>
                        <div class="col-sm-12">
                        <select class="form-control selectpicker" data-live-search="true" name="unidad" id="unidad">
                        <option value="">SELECCIONE</option>
                        <option value="UND">UND</option>
                        <option value="PAQ">PAQUETE</option>
                        <option value="ROLLO">ROLLO</option>
                        <option value="LTS">LTS</option>
                        <option value="MTS">MTS</option>
                        </select>
                        </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="col-sm-12 control-label">Decimales *:</label>
                        <div class="col-sm-12">
                        <select class="form-control selectpicker" data-live-search="true" name="decimales" id="decimales">
                            <option value="">SELECCIONE</option>
                            <option value="1">NO</option>
                            <option value="0">SI</option>
                        </select>
                        </div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label class="col-sm-12 control-label">Detalle *:</label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control" name="detalle" id="detalle" >
                        </div>
                        </div>
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
<script src="vistas/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="vistas/plugins/datatables/buttons.html5.min.js"></script>
<script src="vistas/plugins/datatables/buttons.colVis.min.js"></script>
<script src="vistas/plugins/datatables/jszip.min.js"></script>
<script src="vistas/plugins/datatables/pdfmake.min.js"></script>
<script src="vistas/plugins/datatables/vfs_fonts.js"></script> 
<script type="text/javascript" src="vistas/js/items.js"></script>
<?php ob_end_flush(); ?>