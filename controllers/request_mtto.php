<?php
session_start();
require_once("../modelos/Request_mtto.php");

$request_mtto = new Request_mtto();

/*INICIALIZO VARIABLES*/

$idrequest_mtto=isset($_POST['idrequest_mtto'])? limpiarCadena($_POST['idrequest_mtto']):"";

switch ($_GET["op"]){

    case 'listar':
        $rspta = $request_mtto->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
               "0"=>'<button class="btn btn-danger" onclick="imprimir('.$reg->idrequest_mtto.')"><i class="fa fa-print" style="color:white" ></i></button>'.
 					' <button class="btn btn-primary" onclick="mostrar('.$reg->idrequest_mtto.')"><i class="nav-icon fa fa-spinner fa-pulse"></i></button>',
               "1"=>$reg->codigo,
               "2"=>$reg->lancha,
               "3"=>$reg->nombre,
               "4"=>$reg->fecha,
               "5"=>'<span class="badge badge-dark">Numero: '.$reg->idrequest_mtto.'</span>'
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
        $rspta = $request_mtto->mostrar($idrequest_mtto);
        echo json_encode($rspta);
    break;

    case 'activar':
    $rspta = $request_mtto->activar($idrequest_mttos);
    echo $rspta ? "Item activado": "El Item no se puede activar";
    break;
    
    case 'listarc':
    $rspta = $request_mtto->listarc();
    while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' .$reg->idrequest_mtto. '>' .$reg->nombre. '</option>';
        }
    break;

    case 'eliminar':
    $rspta = $request_mtto->eliminar($idrequest_mttos);
    echo $rspta ? "Requisicion eliminada": "La Requisicion no se puede eliminar, verifique que no este vinculada";
    break;

}
