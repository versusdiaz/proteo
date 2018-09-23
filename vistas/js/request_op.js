var tabla;
var bandera;
function init(){
    mostrarform(false);
    listar();
}

function limpiar(){
    $("#idrequest_op").val("");
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
					url: 'controllers/request_op.php?op=listar',
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

function mostrar(idrequest_op){
     $.post("controllers/request_op.php?op=mostrar",{idrequest_op:idrequest_op},function(data,status){
          /*Convertir la cadena enviada desde PHP a un vector de objetos en JavaScript*/
         data = JSON.parse(data);
         mostrarform(true);
        $("#idrequest_op").val(data.idrequest_op);
        $("#idrequest_temp").val(data.idrequest_temp);
        $("#codigo").val(data.codigo);
     });
    }

 function convertirPresupuesto(){
    var formData = new FormData($("#formulario")[0]);
     $.ajax({
        url:"controllers/request_op.php?op=convertirPresupuesto",
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


init();
