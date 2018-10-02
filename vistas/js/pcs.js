var tabla;
var bandera;
function init(){
    mostrarform(false);
    listar();

    $("#formulario").on("submit",function(e){
            guardaryeditar(e);
    });

    $.post("controllers/proveedores.php?op=listarc",function(respuesta){
        $("#idproveedor").html(respuesta);
        $("#idproveedor").selectpicker('refresh');
        });    
    
}

function limpiar(){
    $("#idpcs").val("");
    $("#idproveedor").val("");
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
					url: 'controllers/pcs.php?op=listar',
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
       url:"controllers/pcs.php?op=guardaryeditar",
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

function mostrar(idpcs){
     $.post("controllers/pcs.php?op=mostrar",{idpcs:idpcs},function(data,status){
          /*Convertir la cadena enviada desde PHP a un vector de objetos en JavaScript*/
         data = JSON.parse(data);
         mostrarform(true);
        $("#idpcs").val(idpcs);
        $("#idproveedor").val(data.idproveedor);
        $("#idproveedor").selectpicker('refresh');
     });
    }

 function eliminar(idpcs){
    swal({
        title: "Esta seguro..?"
        , text: "Al eliminar este presupuesto, no podra utilizarse en el sistema"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo eliminarlo!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/pcs.php?op=eliminar',{idpcs:idpcs},function(e){
            swal("Eliminada!", e , "success");  
            tabla.ajax.reload();
            });
        });
 }

 function imprimir(idpcs,idrequest_temp){
    var formData = new FormData();
    formData.append("idpcs",idpcs);
    formData.append("idrequest_temp",idrequest_temp);
    formData.append("bdDepartamento",'request_mtto'); // NOTA CAMBIAR PARA CADA DPTO
    $.ajax({
        url:"controllers/reportes.php?op=reportPresupuesto",
        type:"POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(respuesta){
          swal({
            title: "Reporte de Entrega"
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

function convertirOrdenC(idrequest_temp){
    var formData = new FormData();
    formData.append("idrequest_temp",idrequest_temp);
    formData.append("bdDepartamento",'odc_mtto'); // NOTA CAMBIAR PARA CADA DPTO
    $.ajax({
        url:"controllers/pcs.php?op=convertirOrdenC",
        type:"POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(respuesta){
            swal(respuesta, "Presione OK para continuar");
          }
     });
}

init();
