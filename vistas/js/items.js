var tabla;
var bandera;
function init(){
    mostrarform(false);
    listar();
    
    jQuery.validator.addMethod("nombre", function(value, element){
        if (/^[-_\w\.\s]*$/i.test(value)) {
            return true;  // FAIL validation when REGEX matches
        } else {
            return false;   // PASS validation otherwise
        };
    }, "Nombre no valido");
    
    $("#formulario").validate({
        rules:{
            nombre:{
                required: true,
                nombre:true
            }
        },
        messages: {
            nombre:{
                required: "Campo requerido"
            }
        },
        errorElement: "div",
        errorPlacement: function ( error, element ) {
            // Add the `help-block` class to the error element
            error.addClass( "invalid-feedback" );

            if ( element.prop( "type" ) === "checkbox" ) {
                error.insertAfter( element.parent( "label" ) );
            } else {
                error.insertAfter( element );
            }
        },
        highlight: function ( element, errorClass, validClass ) {
            // $( element ).parents( ".col-sm-12" ).addClass( "is-invalid" ).removeClass( "has-success" );
            $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
        },
        unhighlight: function (element, errorClass, validClass) {
            $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
        }
       });

    $("#formulario").on("submit",function(e){
        if ($("#formulario").validate().form() == true){
            guardaryeditar(e);
        }
    });
    
}

function limpiar(){
    $("#iditems").val("");
    $("#nombre").val("");
    $("#precio_nac").val("");
    $("#precio_usd").val("");
    $("#stock").val("");
    $("#stock_min").val("");
    $("#stock_max").val("");
    $("#unidad").val("");
    $("#detalle").val("");
    $("#unidad").selectpicker('refresh');
    $("#decimales").val("");
    $("#decimales").selectpicker('refresh');
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
					url: 'controllers/items.php?op=listar',
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
       url:"controllers/items.php?op=guardaryeditar",
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

function mostrar(iditems){
     $.post("controllers/items.php?op=mostrar",{iditems:iditems},function(data,status){
          /*Convertir la cadena enviada desde PHP a un vector de objetos en JavaScript*/
         data = JSON.parse(data);
         mostrarform(true);
        $("#iditems").val(data.iditems);
        $("#nombre").val(data.nombre);
        $("#precio_nac").val(data.precio_nac);
        $("#precio_usd").val(data.precio_usd);
        $("#stock").val(data.stock);
        $("#stock_min").val(data.stock_min);
        $("#stock_max").val(data.stock_max);
        $("#unidad").val(data.unidad);
        $("#unidad").selectpicker('refresh');
        $("#decimales").val(data.decimales);
        $("#decimales").selectpicker('refresh');
        $("#detalle").val(data.detalle);
     });
    }

 function eliminar(iditems){
    swal({
        title: "Esta seguro..?"
        , text: "Al eliminar este cliente, no podra utilizarse en el sistema"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo eliminarla!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/items.php?op=eliminar',{iditems:iditems},function(e){
            swal("Eliminada!", e , "success");  
            tabla.ajax.reload();
            });
        });
 }

 function desactivar(iditems){
    swal({
        title: "Esta seguro..?"
        , text: "Al desactivar este cliente, no podra utilizarse en el sistema"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo desactivarlo!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/items.php?op=desactivar',{iditems:iditems},function(e){
            swal("Desactivado!", e , "success");  
            tabla.ajax.reload();
            });
        });
 }

 function activar(iditems){
    swal({
        title: "Esta seguro..?"
        , text: "Al activar este cliente, podra utilizarse en el sistema"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo activarlo!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/items.php?op=activar',{iditems:iditems},function(e){
            swal("Activado!", e , "success");  
            tabla.ajax.reload();
            });
        });
 }

init();
