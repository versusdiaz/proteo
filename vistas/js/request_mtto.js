var tabla;
var bandera;
function init(){
    mostrarform(false);
    listar();

}

function limpiar(){
    $("#idcliente").val("");
    $("#nombre").val("");
    $("#nfiscal").val("");
    $("#telefono").val("");
    $("#direccion").val("");
    /*QUITAR CLASES A LOS ELEMENTOS*/
    $(".form-group").removeClass('has-success has-error');
}

function mostrarform(flag){
    limpiar();
    if(flag){
        $("#listadoregistros").hide();
        $("#formulario").show('fast');
        $("#btnGuardar").prop("disabled",false);
        $("#btnagregar").hide();
        
    }else{
        $("#listadoregistros").show();
        $("#formulario").hide();
        $("#btnagregar").show();
    }
}

function cancelarform(){
    mostrarform(false);
    limpiar();
}

function listar(){
    tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginacion y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: 'controllers/request_mtto.php?op=listar',
					type : "get",
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy": true,
		"iDisplayLength": 10,//Paginacion
	    "order": [[ 1, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#formulario")[0]);
    $.ajax({
       url:"controllers/clientes.php?op=guardaryeditar",
       type:"POST",
       data: formData,
       contentType: false,
	   processData: false,
       success: function(respuesta){
         swal(respuesta, "Presione OK para continuar");
         mostrarform(false);
	     tabla.ajax.reload();
       }
    });
}

function mostrar(idrequest_mtto){
     $.post("controllers/request_mtto.php?op=mostrar",{idrequest_mtto:idrequest_mtto},function(data,status){
          /*Convertir la cadena enviada desde PHP a un vector de objetos en JavaScript*/
         data = JSON.parse(data);
         mostrarform(true);
         $("#idrequest_mtto").val(data.idrequest_mtto);
         $("#idrequest_temp").val(data.idrequest_temp);
        $("#codigo").val(data.codigo);
     });
    }

 function eliminar(idcliente){
    swal({
        title: "Esta seguro..?"
        , text: "Al eliminar este cliente, no podra utilizarse en el sistema"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo eliminarla!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/clientes.php?op=eliminar',{idcliente:idcliente},function(e){
            swal("Eliminada!", e , "success");  
            tabla.ajax.reload();
            });
        });
 }

 function desactivar(idcliente){
    swal({
        title: "Esta seguro..?"
        , text: "Al desactivar este cliente, no podra utilizarse en el sistema"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo desactivarlo!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/clientes.php?op=desactivar',{idcliente:idcliente},function(e){
            swal("Desactivado!", e , "success");  
            tabla.ajax.reload();
            });
        });
 }

 function activar(idcliente){
    swal({
        title: "Esta seguro..?"
        , text: "Al activar este cliente, podra utilizarse en el sistema"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo activarlo!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/clientes.php?op=activar',{idcliente:idcliente},function(e){
            swal("Activado!", e , "success");  
            tabla.ajax.reload();
            });
        });
 }

 function convertirPresupuesto(){
    var formData = new FormData($("#formulario")[0]);
     $.ajax({
        url:"controllers/request_mtto.php?op=convertirPresupuesto",
        type:"POST",
        data: formData,
        contentType: false,
	    processData: false,
        success: function(respuesta){
          swal(respuesta, "Presione OK para continuar");
          mostrarform(false);
        }
     });
}

function convertirCompra(){
    var formData = new FormData($("#formulario")[0]);
     $.ajax({
        url:"controllers/request_mtto.php?op=convertirCompra",
        type:"POST",
        data: formData,
        contentType: false,
	    processData: false,
        success: function(respuesta){
          swal(respuesta, "Presione OK para continuar");
          mostrarform(false);
        }
     });
}

function imprimir(idrequest, idrequest_temp){
    var formData = new FormData();
    formData.append("idrequest",idrequest);
    formData.append("idrequest_temp",idrequest_temp);
    formData.append("bdDepartamento",'request_mtto'); // NOTA CAMBIAR PARA CADA DPTO
    $.ajax({
        url:"controllers/reportes.php?op=reportRequisicion",
        type:"POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(respuesta){
          swal({
            title: "Reporte de Presupuesto"
            , text: "Ha sido generado, continue para imprimir"
            , type: "info"
            , showCancelButton: true
            , confirmButtonColor: "#da4f49"
            , confirmButtonText: "Imprimir!"
            , closeOnConfirm: true
            }, function () {
                window.open(respuesta,"_blank");
            });
        }
     });
}

init();
