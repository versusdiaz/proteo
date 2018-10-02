<?php
session_start();
require_once("../modelos/OrdenesM.php");

$ordenesM = new OrdenesM();

/*INICIALIZO VARIABLES*/

$idordenesM=isset($_POST['idordenesM'])? limpiarCadena($_POST['idordenesM']):"";

switch ($_GET["op"]){

    case 'listar':
        $rspta = $ordenesM->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
               "0"=>'<button class="btn btn-primary" onclick="imprimirp('.$reg->idodc_mtto.')"><i class="fa fa-print"></i></button>',
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
