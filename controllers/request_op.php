<?php
session_start();
require_once("../modelos/Request_op.php");

$request_op = new Request_op();

/*INICIALIZO VARIABLES*/

$idrequest_op=isset($_POST['idrequest_op'])? limpiarCadena($_POST['idrequest_op']):"";

switch ($_GET["op"]){

    case 'listar':
        $rspta = $request_op->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
               "0"=>'<button class="btn btn-danger" onclick="imprimir('.$reg->idrequest_op.')"><i class="fa fa-print" style="color:white" ></i></button>'.
 					' <button class="btn btn-primary" onclick="mostrar('.$reg->idrequest_op.')"><i class="nav-icon fa fa-spinner fa-pulse"></i></button>',
               "1"=>$reg->codigo,
               "2"=>$reg->lancha,
               "3"=>$reg->nombre,
               "4"=>$reg->fecha,
               "5"=>'<span class="badge badge-dark">Numero: '.$reg->idrequest_op.'</span>'
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

}
