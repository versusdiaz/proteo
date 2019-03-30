var tabla;
var bandera;
function init(){
    mostrarform(false);
    listar();

    $("#formulario").on("submit",function(e){
            guardaryeditar(e);
    });

}

function limpiar(){

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
					url: 'controllers/ordenesA.php?op=listar',
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

 function imprimir(idodc, idrequest_temp){
    var formData = new FormData();
    formData.append("idodc",idodc);
    formData.append("idrequest_temp",idrequest_temp);
    formData.append("bdDepartamento",'odc_al'); // NOTA CAMBIAR PARA CADA DPTO
    formData.append("bdReq",'request_al'); // NOTA CAMBIAR PARA CADA DPTO
    $.ajax({
        url:"controllers/reportes.php?op=reportOC",
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

init();
