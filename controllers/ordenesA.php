<?php
session_start();
require_once("../modelos/OrdenesA.php");

$ordenesA = new OrdenesA();

/*INICIALIZO VARIABLES*/

$idordenesA=isset($_POST['idordenesA'])? limpiarCadena($_POST['idordenesA']):"";

switch ($_GET["op"]){

    case 'listar':
        $rspta = $ordenesA->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
               "0"=>'<button class="btn btn-primary" onclick="imprimir('.$reg->idodc.','.$reg->idrequest_temp.')"><i class="fa fa-print"></i></button>',
               "1"=>$reg->idrequest_temp,
               "2"=>$reg->codigo,
               "3"=>$reg->fecha
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

}
