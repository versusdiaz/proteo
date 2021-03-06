var tabla;
var tabla2;
var bandera;
function init(){
    mostrarform(false);
    mostrarformP(false);
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
                nombre: true
            },
            departamento:{
                required: true
            },
            responsable:{
                required: true,
                nombre: true
            },
            supervisor:{
                required: true,
                nombre: true
            },
            fecha:{
                required: true,
                date: true,
            },
            mantenimiento:{
                required: true
            },
            prioridad:{
                required: true,
            },
            comentario:{
                required: true,
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

    $.post("controllers/centro.php?op=listarc",function(respuesta){
    $("#centro").html(respuesta);
    $("#centro").selectpicker('refresh');
    });

    $.post("controllers/servicios.php?op=listarc",function(respuesta){
    $("#nombreItem").html(respuesta);
    $("#nombreItem").selectpicker('refresh');
    });    

    $("#formulario").on("submit",function(e){
        if ($("#formulario").validate().form() == true){
            guardaryeditar(e);
        }
    });

    $("#formularioP").on("submit",function(e){
            guardaryeditarP(e);
    });
    
}

function limpiar(){
    $("#idrequest_temp").val("");
    $("#departamento").val("");
    $("#departamento").selectpicker("refresh");

    $("#responsable").val("");
    $("#supervisor").val("");
    $("#fecha").val("");
    $("#mantenimiento").val("");
    $("#mantenimiento").selectpicker("refresh");


    $("#calidad").val("");
    $("#calidad").selectpicker("refresh");

    $("#prioridad").val("");
    $("#prioridad").selectpicker('refresh');

    $("#comentario").val("");

    $(".form-group").removeClass('has-success has-error');
}

function limpiarP(){
    $("#nombre").val("");
    $("#cantidad").val("");
    $("#detalle").val("");
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

function mostrarformP(flag){
    limpiar();
    if(flag){
        $("#listadoregistrosPurchase").show();
        $("#formularioPurchase").show('fast');
        $("#btnGuardarP").prop("disabled",false);
        
    }else{
        $("#listadoregistrosPurchase").hide();
        $("#formularioPurchase").hide();
        $("#btnagregar").show();
    }
}

function cancelarform(){
    mostrarform(false);
    limpiar();
}

function cancelarformP(){
    limpiarP();
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
					url: 'controllers/request_s.php?op=listar',
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
       url:"controllers/request_s.php?op=guardaryeditar",
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

function guardaryeditarP(e){
    e.preventDefault();
     var formData = new FormData($("#formularioP")[0]);
     $.ajax({
        url:"controllers/request_s.php?op=guardaryeditarP",
        type:"POST",
        data: formData,
        contentType: false,
	    processData: false,
        success: function(respuesta){
          swal(respuesta, "Presione OK para continuar");
          limpiarP();
	      tabla2.ajax.reload();
        }
     });
}

function mostrar(idrequestS_temp){
     $.post("controllers/request_s.php?op=mostrar",{idrequestS_temp:idrequestS_temp},function(data,status){
          /*Convertir la cadena enviada desde PHP a un vector de objetos en JavaScript*/
         data = JSON.parse(data);
         mostrarform(true);
        $("#idrequestS_temp").val(data.idrequestS_temp);
        $("#departamento").val(data.iddepartamento);
        $("#departamento").selectpicker('refresh');
        $("#centro").val(data.idcentro);
        $("#centro").selectpicker('refresh');
        $("#responsable").val(data.responsable);
        $("#supervisor").val(data.supervisor);
        $("#comentario").val(data.comentario);
        $("#fecha").val(data.fecha);
        $("#mantenimiento").val(data.mantenimiento);
        $("#mantenimiento").selectpicker('refresh');
        $("#calidad").val(data.calidad);
        $("#calidad").selectpicker('refresh');
        $("#prioridad").val(data.prioridad);
        $("#prioridad").selectpicker('refresh');
     });
    }

function mostrarP(idrequest_temp){
    $("#idrequest_tempP").val(idrequest_temp); // ASIGNO ID AL PURCHASE
    $("#btnInfo").text('Nro: '+idrequest_temp);
    mostrarformP(true);
    tabla2=$('#tbllistadoPurchase').dataTable(
        {
            "aProcessing": true,//Activamos el procesamiento del datatables
            "aServerSide": true,//Paginacion y filtrado realizados por el servidor
            dom: 'Bfrtip',//Definimos los elementos del control de tabla
            "ajax":
                    {
                        url: 'controllers/request_s.php?op=listarP&idrequest='+idrequest_temp,
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

 function eliminar(idrequestS_temp){
    swal({
        title: "Esta seguro..?"
        , text: "Al eliminar esta requisicion, no podra utilizarse en el sistema"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo eliminarla!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/request_s.php?op=eliminar',{idrequestS_temp:idrequestS_temp},function(respuesta){
            swal(respuesta, "Presione OK para continuar");  
            tabla.ajax.reload();
            });
        });
 }

 function eliminarItem(idrequest_servicios){
    swal({
        title: "Esta seguro..?"
        , text: "Al eliminar este item, no podra utilizarse en el sistema"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo eliminarlo!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/request_s.php?op=eliminarItem',{idrequest_servicios:idrequest_servicios},function(e){
            swal("Eliminada!", e , "success");  
            tabla2.ajax.reload();
            });
        });
 }

 function desactivar(idrequest_temp){
    swal({
        title: "Esta seguro..?"
        , text: "Al desactivar esta requisicion, no podra utilizarse en el sistema"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo desactivarlo!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/request_m.php?op=desactivar',{idrequest_temp:idrequest_temp},function(e){
            swal("Desactivado!", e , "success");  
            tabla.ajax.reload();
            });
        });
 }

 function activar(idrequest_temp){
    swal({
        title: "Esta seguro..?"
        , text: "Al activar esta requisicion, podra utilizarse en el sistema"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, deseo activarlo!"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/request_m.php?op=activar',{idrequest_temp:idrequest_temp},function(e){
            swal("Activado!", e , "success");  
            tabla.ajax.reload();
            });
        });
 }

 function confirmarP(idrequest_temp){
    swal({
        title: "Esta seguro..?"
        , text: "Al procesar esta requisicion, sera enumerada"
        , type: "warning"
        , showCancelButton: true
        , confirmButtonColor: "#da4f49"
        , confirmButtonText: "Si, procesarla !"
        , closeOnConfirm: false
        }, function () {
            $.post('controllers/request_m.php?op=confirmarP',{idrequest_temp:idrequest_temp},function(e){
            swal(e, "Presione OK para continuar");
            tabla.ajax.reload();
            mostrarformP(false);            
            });
        });
 }

init();
