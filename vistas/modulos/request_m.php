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
            <div class="col-sm-6 col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-globe"></i> Request
                        <button class="float-right btn btn-success" id="btnagregar" onclick="mostrarform(true)">
                            <i class="fa fa-plus-circle"></i> Agregar</button>
                    </div>
                    <div class="card-body">
                        <!-- AQUI VA TABLA -->
                        <div class="panel-body table-responsive" id="listadoregistros">
                            <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                                <thead>
                                    <th>Opciones</th>
                                    <th>Departamento</th>
                                    <th>Centro</th>
                                    <th>Creada Por</th>
                                    <th>Fecha</th>
                                    <th>Temporal</th>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <th>Opciones</th>
                                    <th>Departamento</th>
                                    <th>Centro</th>
                                    <th>Creada Por</th>
                                    <th>Fecha</th>
                                    <th>Temporal</th>
                                </tfoot>
                            </table>
                        </div>
                        <div class="card-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                            <div class="row">
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <label class="col-sm-12 control-label">Departamento *:</label>
                                    <div class="col-sm-12">
                                        <input type="hidden" name="idrequest_temp" id="idrequest_temp">
                                        <select class="form-control selectpicker" data-live-search="true" name="departamento" id="departamento">
                                            <option value="">SELECCIONE</option>
                                            <option value="1">MANTENIMIENTO</option>
                                            <option value="2">OPERACIONES</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <label class="col-sm-12 control-label">Centro *:</label>
                                    <div class="col-sm-12">
                                        <select class="form-control selectpicker" data-live-search="true" name="centro" id="centro">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <label class="col-sm-12 control-label">Responsable *:</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="responsable" id="responsable">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <label class="col-sm-12 control-label">Supervisor *:</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="supervisor" id="supervisor">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <label class="col-sm-12 control-label">Fecha *:</label>
                                    <div class="col-sm-12">
                                        <input type="date" class="form-control" name="fecha" id="fecha" required>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <label class="col-sm-12 control-label">Mantenimiento *:</label>
                                    <div class="col-sm-12">
                                        <select class="form-control selectpicker" data-live-search="true" name="mantenimiento" id="mantenimiento">
                                            <option value="">SELECCIONE</option>
                                            <option value="1">CORRECTIVO</option>
                                            <option value="2">PREVENTIVO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <label class="col-sm-12 control-label">Calidad *:</label>
                                    <div class="col-sm-12">
                                        <select class="form-control selectpicker" data-live-search="true" name="calidad" id="calidad">
                                            <option value="">SELECCIONE</option>
                                            <option value="1">SI</option>
                                            <option value="2">NO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <label class="col-sm-12 control-label">Prioridad *:</label>
                                    <div class="col-sm-12">
                                        <select class="form-control selectpicker" data-live-search="true" name="prioridad" id="prioridad">
                                            <option value="">SELECCIONE</option>
                                            <option value="1">BAJA</option>
                                            <option value="2">MEDIA</option>
                                            <option value="3">AlTA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <label class="col-sm-12 control-label">Comentario *:</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="comentario" id="comentario">
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <label class="col-sm-12 control-label">Tipo *:</label>
                                    <div class="col-sm-12">
                                    <select class="form-control selectpicker" data-live-search="true" name="servicio" id="servicio">
                                            <option value="">SELECCIONE</option>
                                            <option value="1">SERVICIOS</option>
                                            <option value="0">MATERIALES</option>
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
            <div class="col-sm-6 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-cart-arrow-down"></i> Purchase Item
                    <button class="float-right btn btn-success" id="btnInfo" >
                            Numero</button>
                </div>
                <div class="card-body" id="formularioPurchase">
                    <form name="formulario" id="formularioP" method="POST">
                        <div class="row">
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <input type="hidden" name="idrequest_tempP" id="idrequest_tempP">
                            <input type="text" name="idservicio" id="idservicio">
                                <label class="col-sm-12 control-label">Nombre *:</label>
                                <input type="hidden" name="iditems" id="iditems">
                                <div class="col-sm-12">
                                    <select class="form-control selectpicker" data-live-search="true" name="nombreItem" id="nombreItem">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6 formDetalle">
                                <label class="col-sm-12 control-label">Detalle *:</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="detalle" id="detalle" >
                                </div>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <label class="col-sm-12 control-label">Cantidad *:</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" name="cantidad" id="cantidad" min='0.1' step='0.1' value='1' >
                                </div>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" type="submit" id="btnGuardarP">
                                    <i class="fa fa-download"></i> Cargar</button>
                                <button class="btn btn-danger" type="button" onclick="cancelarformP()">
                                    <i class="fa fa-eraser"></i> Limpiar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-xl-12">
        <div class="card">
                    <div class="card-header">
                        <i class="fa fa-list-alt"></i> Request List
                    </div>
                    <div class="card-body">
                        <!-- AQUI VA TABLA -->
                        <div class="panel-body table-responsive" id="listadoregistrosPurchase">
                            <table id="tbllistadoPurchase" class="table table-striped table-bordered table-condensed table-hover">
                                <thead>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                    </tfoot>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div> 
                <!-- FIN DEL TABLE PURCHASE -->
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
<!-- <script src="vistas/plugins/datatables/dataTables.buttons.min.js"></script> -->
<!-- <script src="vistas/plugins/datatables/buttons.html5.min.js"></script> -->
<script src="vistas/plugins/datatables/buttons.colVis.min.js"></script>
<!-- <script src="vistas/plugins/datatables/jszip.min.js"></script> -->
<!-- <script src="vistas/plugins/datatables/pdfmake.min.js"></script> -->
<!-- <script src="vistas/plugins/datatables/vfs_fonts.js"></script>  -->
<script type="text/javascript" src="vistas/js/request_m.js"></script>
<?php ob_end_flush(); ?>