<?php
session_start();
require_once("../modelos/Request_op.php");
require_once("../modelos/Request_m.php");

$request_op = new Request_op();

$request_temp = new Request_m();

/*INICIALIZO VARIABLES*/

$idrequest_op=isset($_POST['idrequest_op'])? limpiarCadena($_POST['idrequest_op']):"";

$idrequest_temp=isset($_POST['idrequest_temp'])? limpiarCadena($_POST['idrequest_temp']):"";

switch ($_GET["op"]){

    case 'listar':
        $rspta = $request_op->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
               "0"=>'<button class="btn btn-danger" onclick="imprimir('.$reg->idrequest_op.','.$reg->idrequest_temp.')"><i class="fa fa-print" style="color:white" ></i></button>'.
 					' <button class="btn btn-primary" onclick="mostrar('.$reg->idrequest_op.')"><i class="nav-icon fa fa-spinner fa-pulse"></i></button>',
               "1"=>$reg->codigo,
               "2"=>$reg->lancha,
               "3"=>$reg->nombre,
               "4"=>$reg->idrequest_temp,
               "5"=>$reg->fecha,
               "6"=>'<span class="badge badge-dark">Numero: '.$reg->idrequest_op.'</span>'
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
        $rspta = $request_op->mostrar($idrequest_op);
        echo json_encode($rspta);
    break;

    case 'activar':
    $rspta = $request_op->activar($idrequest_ops);
    echo $rspta ? "Item activado": "El Item no se puede activar";
    break;
    
    case 'listarc':
    $rspta = $request_op->listarc();
    while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' .$reg->idrequest_op. '>' .$reg->nombre. '</option>';
        }
    break;

    case 'eliminar':
    $rspta = $request_op->eliminar($irequest_ops);
    echo $rspta ? "Requisicion eliminada": "La Requisicion no se puede eliminar, verifique que no este vinculada";
    break;

    case 'convertirPresupuesto':
    // OBTENER DATOS DE RQ
        $rspta = $request_temp->mostrar($idrequest_temp);
        $codigo = rand( 1 , 2000 );
        $validarPresupuesto = $request_op->validarPresupuesto($idrequest_temp);
        if( $validarPresupuesto == 0 ){
            $rspta2 = $request_op->convertirPresupuesto(1,$idrequest_temp,$codigo,$rspta['fecha'],1);
            $rspta3 = $request_temp->mostrarItem($idrequest_temp);
            while($reg = $rspta3->fetch_object()){
    
                $request_op->insertItemPresupuesto($rspta2,$reg->iditem,$reg->cantidad,$reg->detalle,1);
            }
            echo $rspta ? "Presupuesto creado": "Error, presupuesto ya generado";
        } else {
            echo "Error, presupuesto ya generado";
        }

    break;

}
