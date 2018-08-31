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
    }, "Ruta no valida");
    
    $("#formulario").validate({
        rules:{
            nombre:{
                required: true,
                nombre:true
            },
            montotsmp:{
                required: true,
                number: true,
                min:1
            },
            montotsmc:{
                required: true,
                number: true,
                min:1
            },
            montocaribec:{
                required: true,
                number: true,
                min:1
            }
        },
        messages: {
            nombre:{
                required: "Campo requerido"
            },
            montotsmp:{
                required: "Campo requerido",
                min: "No se aceptan numeros negativos"
            },
            montotsmc:{
                required: "Campo requerido",
                min: "No se aceptan numeros negativos"
            },
            montocaribec:{
                required: "Campo requerido",
                min: "No se aceptan numeros negativos"
            }
        },
        errorElement: "em",
        errorPlacement: function ( error, element ) {
            // Add the `help-block` class to the error element
            error.addClass( "help-block" );

            if ( element.prop( "type" ) === "checkbox" ) {
                error.insertAfter( element.parent( "label" ) );
            } else {
                error.insertAfter( element );
            }
        },
        highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".col-sm-12" ).addClass( "has-error" ).removeClass( "has-success" );
        },
        unhighlight: function (element, errorClass, validClass) {
            $( element ).parents( ".col-sm-12" ).addClass( "has-success" ).removeClass( "has-error" );
        }
       });

    $("#formulario").on("submit",function(e){
        if ($("#formulario").validate().form() == true){
            guardaryeditar(e);
        }
    });
    
}

function limpiar(){
    $("#idtarifa").val("");
    $("#nombre").val("");
    $("#montotsmp").val("");
    $("#montotsmc").val("");
    $("#montocaribec").val("");
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
	    "aServerSide": true,//PaginaciÔö£Ôöén y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: 'controllers/tarifas.php?op=listar',
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
       url:"controllers/tarifas.php?op=guardaryeditar",
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

function mostrar(idtarifa){
     $.post("controllers/tarifas.php?op=mostrar",{idtarifa:idtarifa},function(data,status){
          /*Convertir la cadena enviada desde PHP a un vector de objetos en JavaScript*/
         data = JSON.parse(data);
         mostrarform(true);
        $("#idtarifa").val(data.idtarifa);
        $("#nombre").val(data.nombre);
        $("#montotsmp").val(data.montotsmp);
        $("#montotsmc").val(data.montotsmc);
        $("#montocaribec").val(data.montocaribec);
     });
    }

 function eliminar(idtarifa){
    swal({
        title: "Esta seguro..?"
        , text: "Al eliminar esta tarifa, no podra utilizarse en el sistema"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo eliminarla!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/tarifas.php?op=eliminar',{idtarifa:idtarifa},function(e){
            swal("Eliminada!", e , "success");  
            tabla.ajax.reload();
            });
        });
 }

init();
