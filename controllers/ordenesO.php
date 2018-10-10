<?php
session_start();
require_once("../modelos/OrdenesO.php");

$ordenesH = new OrdenesO();

/*INICIALIZO VARIABLES*/

$idOrdenesO=isset($_POST['idOrdenesO'])? limpiarCadena($_POST['idOrdenesO']):"";

switch ($_GET["op"]){

    case 'listar':
        $rspta = $ordenesH->listar();
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
