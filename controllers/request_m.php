<?php
session_start();
require_once("../modelos/Request_m.php");

$request_temp = new Request_m();

/*INICIALIZO VARIABLES*/

$idrequest_temps=isset($_POST['idrequest_temp'])? limpiarCadena($_POST['idrequest_temp']):"";

$idrequest_tempP=isset($_POST['idrequest_tempP'])? limpiarCadena($_POST['idrequest_tempP']):"";

$idrequest = isset($_GET['idrequest'])? limpiarCadena($_GET['idrequest']):"";

$idrequest_item = isset($_POST['idrequest_item'])? limpiarCadena($_POST['idrequest_item']):"";

$idusuario = isset($_SESSION['idusuario'])? $_SESSION['idusuario']: "";

$iddepartamento=isset($_POST["departamento"])? limpiarCadena($_POST["departamento"]):"";

$responsable=isset($_POST['responsable'])? limpiarCadena($_POST['responsable']):"";

$nombreItem=isset($_POST['nombreItem'])? limpiarCadena($_POST['nombreItem']):"";

$cantidad=isset($_POST['cantidad'])? limpiarCadena($_POST['cantidad']):"";

$precio=isset($_POST['precio'])? limpiarCadena($_POST['precio']):"";

$supervisor=isset($_POST['supervisor'])? limpiarCadena($_POST['supervisor']):"";

$fecha=isset($_POST['fecha'])? limpiarCadena($_POST['fecha']):"";

$idcentro=isset($_POST['centro'])? limpiarCadena($_POST['centro']):"";

$mantenimiento=isset($_POST['mantenimiento'])? limpiarCadena($_POST['mantenimiento']):"";

$calidad=isset($_POST['calidad'])? limpiarCadena($_POST['calidad']):"";

$prioridad=isset($_POST['prioridad'])? limpiarCadena($_POST['prioridad']):"";

$comentario=isset($_POST['comentario'])? limpiarCadena($_POST['comentario']):"";

$detalle=isset($_POST['detalle'])? limpiarCadena($_POST['detalle']):"";

$servicio=isset($_POST['servicio'])? limpiarCadena($_POST['servicio']):"";

$stock=isset($_POST['stock'])? limpiarCadena($_POST['stock']):"";

switch ($_GET["op"]){
    case 'guardaryeditar':
		if (empty($idrequest_temps)){
            $rspta=$request_temp->insertar($idusuario,$iddepartamento,$idcentro,$comentario,$responsable,$supervisor,$prioridad,$calidad,$mantenimiento,$fecha,$servicio,$stock);
            echo $rspta ? "Requisicion registrada con exito":"No se pudieron registrar todos los datos de la Requisicion";
		}
		else {
            $rspta=$request_temp->editar($idrequest_temps,$idusuario,$iddepartamento,$idcentro,$comentario,$responsable,$supervisor,$prioridad,$calidad,$mantenimiento,$fecha,$servicio,$stock);
			echo $rspta ? "Requisicion actualizada con exito":"No se pudieron actualizar los datos de la requisicion";
		}
    break;

    case 'guardaryeditarP':
        $validarItem = $request_temp->propiedadItem($nombreItem);
        $validarRequest = $request_temp->propiedadRequest($idrequest_tempP);
        if( $validarItem == $validarRequest ){
            $rspta =$request_temp->insertarItem($idrequest_tempP,$detalle,$nombreItem,$cantidad,$precio);
            echo $rspta ? "Item cargado con exito":"No se pudieron registrar todos los item de la Requisicion";
          } else {
             echo 'Error el Item y el tipo de Requisicion no coinciden';
          }
break;

    case 'listar':
        $rspta = $request_temp->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
               "0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idrequest_temp.')"><i class="nav-icon icon-pencil" style="color:white" ></i></button> <button class="btn btn-danger" onclick="eliminar('.$reg->idrequest_temp.')"><i class="fa fa-trash"></i></button>'.
 					' <button class="btn btn-primary" onclick="mostrarP('.$reg->idrequest_temp.')"><i class="fa fa-cart-arrow-down"></i></button> <button class="btn btn-success" onclick="confirmarP('.$reg->idrequest_temp.')"><i class="fa fa fa-check"></i></button>',
               "1"=>$reg->depto,
               "2"=>$reg->buque,
               "3"=>$reg->usuario,
               "4"=>$reg->fecha,
               "5"=>'<span class="badge badge-dark">Numero: '.$reg->idrequest_temp.'</span>'
           );
        }
        /*CARGAMOS LA DATA EN LA VARIABLE USADA PARA EL DATATABLE*/
        $results = array(
 			"sEcho"=>1, //Informacion para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
        echo json_encode($results);
    break;

    case 'mostrar':
        /*ID USUARIO SE ENVIA POR POST ESTA DECLARADO EN LA INICIALIACION*/
        $rspta = $request_temp->mostrar($idrequest_temps);
        echo json_encode($rspta);
    break;

    case 'desactivar':
      $rspta = $request_temp->desactivar($idrequest_temps);
      echo $rspta ? "Item desactivado": "El Item no se puede desactivar";
    break;

    case 'activar':
    $rspta = $request_temp->activar($idrequest_temps);
    echo $rspta ? "Item activado": "El Item no se puede activar";
    break;
    
    case 'listarc':
    $rspta = $request_temp->listarc();
    while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' .$reg->idrequest_temp. '>' .$reg->nombre. '</option>';
        }
    break;

    case 'eliminar':
    $rspta = $request_temp->eliminar($idrequest_temps);
    echo $rspta ? "Requisicion eliminada": "La Requisicion no se puede eliminar, verifique que no este vinculada";
    break;

    case 'eliminarItem':
    $rspta = $request_temp->eliminarItem($idrequest_item);
    echo $rspta ? "Item eliminado": "El Item no se puede eliminar, verifique que no este vinculado";
    break;

    case 'listarP':
    $rspta = $request_temp->listarP($idrequest);
    $data = Array();
    while($reg = $rspta->fetch_object()){
       $data[]=array(
           "0"=>'<button class="btn btn-danger" onclick="eliminarItem('.$reg->idrequest_items_temp.')"><i class="fa fa-trash"></i></button>',
           "1"=>($reg->detalle) ? $reg->nombre.' '.$reg->detalle : $reg->nombre,
           "2"=>$reg->cantidad,
           "3"=>$reg->precio
       );
    }
    /*CARGAMOS LA DATA EN LA VARIABLE USADA PARA EL DATATABLE*/
    $results = array(
         "sEcho"=>1, //Informacion para el datatables
         "iTotalRecords"=>count($data), //enviamos el total registros al datatable
         "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
         "aaData"=>$data);
    echo json_encode($results);
    break;

    case 'confirmarP':
    $rspta = $request_temp->mostrarObj($idrequest_temps);
    while($reg = $rspta->fetch_object() ){
        switch ($reg->iddepartamento) {
            case 1:
                # MTTO
                $dpto = 'request_mtto';
                $dptoOC = 'odc_mtto';
                $codigo = '';
                $codigoOC = '';
                $validarFecha = $request_temp->validarAnterior($reg->iddepartamento,$reg->fecha);
                $validarFecha2 = $request_temp->validarSiguiente($reg->iddepartamento,$reg->fecha);
                if( $validarFecha == 0 && $validarFecha2 == 0 ){

                    $rspta2 = $request_temp->insertR($reg->idrequest_temp,$dpto,$reg->fecha);
                    $rspta5 = $request_temp->insertOC($reg->idrequest_temp,$dptoOC,$reg->fecha);

                    if( $rspta2 != "0" ){
                        if( $rspta2 < 10 ){
                            $codigo = 'RQ/GGO/MT-00'.$rspta2; /* AGREGAR IF DE 00 */
                        } else if ( $rspta2 < 100 ){
                            $codigo = 'RQ/GGO/MT-0'.$rspta2; /* AGREGAR IF DE 00 */
                        } else {
                            $codigo = 'RQ/GGO/MT-'.$rspta2; /* AGREGAR IF DE 00 */
                        }

                        if( $rspta5 < 10 ){
                            $codigoOC = 'OC/GGO/MT-00'.$rspta2; /* AGREGAR IF DE 00 */
                        } else if ( $rspta2 < 100 ){
                            $codigoOC = 'OC/GGO/MT-0'.$rspta2; /* AGREGAR IF DE 00 */
                        } else {
                            $codigoOC = 'OC/GGO/MT-'.$rspta2; /* AGREGAR IF DE 00 */
                        }

                        $rspta3 = $request_temp->updateR($reg->idrequest_temp,$dpto,$codigo);
                        $rspta6 = $request_temp->updateOC($reg->idrequest_temp,$dptoOC,$codigoOC,1);
                        $rspta4 = $request_temp->vincular($reg->idrequest_temp);

                        echo $rspta3 ? "Requisicion almacenada": "Requisicion no se puede almacenar";
                        break;
                       
                    } else {
                        echo 'Error al insertar requisicion ya existe';
                    }
                } else {
                    echo 'Error existe una requisicion pendiente para la fecha';
                }
                 break;
            
            case 2:
                # OPERACIONES
                $dpto = 'request_op';
                $dptoOC = 'odc_op';
                $codigo = '';
                $codigoOC = '';
                $validarFecha = $request_temp->validarAnterior($reg->iddepartamento,$reg->fecha);
                $validarFecha2 = $request_temp->validarSiguiente($reg->iddepartamento,$reg->fecha);
                if( $validarFecha == 0 && $validarFecha2 == 0 ){

                    $validarItem = $request_temp->validarItem($reg->idrequest_temp);

                    if( $validarItem != 0 ){

                        $rspta2 = $request_temp->insertR($reg->idrequest_temp,$dpto,$reg->fecha);
                        $rspta5 = $request_temp->insertOC($reg->idrequest_temp,$dptoOC,$reg->fecha);
    
                        if( $rspta2 != "0" ){
                            if( $rspta2 < 10 ){
                                $codigo = 'RQ/GGO/OP-00'.$rspta2; /* AGREGAR IF DE 00 */
                            } else if ( $rspta2 < 100 ){
                                $codigo = 'RQ/GGO/OP-0'.$rspta2; /* AGREGAR IF DE 00 */
                            } else {
                                $codigo = 'RQ/GGO/OP-'.$rspta2; /* AGREGAR IF DE 00 */
                            }
    
                            if( $rspta5 < 10 ){
                                $codigoOC = 'OC/GGO/OP-00'.$rspta2; /* AGREGAR IF DE 00 */
                            } else if ( $rspta2 < 100 ){
                                $codigoOC = 'OC/GGO/OP-0'.$rspta2; /* AGREGAR IF DE 00 */
                            } else {
                                $codigoOC = 'OC/GGO/OP-'.$rspta2; /* AGREGAR IF DE 00 */
                            }
    
                            $rspta3 = $request_temp->updateR($reg->idrequest_temp,$dpto,$codigo);
                            $rspta6 = $request_temp->updateOC($reg->idrequest_temp,$dptoOC,$codigoOC,1);
                            $rspta4 = $request_temp->vincular($reg->idrequest_temp);
    
                            echo $rspta3 ? "Requisicion almacenada": "Requisicion no se puede almacenar";
                            break;
                           
                        } else {
                            echo 'Error al insertar requisicion ya existe';
                        }

                    } else {
                        echo 'Error esta requisicion no tiene items asociados';
                    }

                } else {
                    echo 'Error existe una requisicion pendiente para la fecha';
                }
                 break;
        }
    }

    break;        

}
