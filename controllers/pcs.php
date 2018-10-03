<?php
session_start();
require_once("../modelos/Pcs.php");
require_once("../modelos/Request_m.php");

$pcs = new Pcs();

$request_temp = new Request_m();

/*INICIALIZO VARIABLES*/

$idpcs=isset($_POST['idpcs'])? limpiarCadena($_POST['idpcs']):"";

$idrequest_temp=isset($_POST['idrequest_temp'])? limpiarCadena($_POST['idrequest_temp']):"";

$proveedor=isset($_POST["idproveedor"])? limpiarCadena($_POST["idproveedor"]):"";

$bdDepartamento=isset($_POST['bdDepartamento'])? limpiarCadena($_POST['bdDepartamento']):"";

$fecha=isset($_POST['fecha'])? limpiarCadena($_POST['fecha']):"";

switch ($_GET["op"]){
    case 'guardaryeditar':
		if (empty($idpcs)){
            $rspta=$pcs->insertar($proveedor);
            echo $rspta ? "pcs registrado con exito":"No se pudieron registrar todos los datos del pcs";
		}
		else {
            $rspta=$pcs->editar($idpcs,$proveedor);
			echo $rspta ? "Presupuesto actualizado con exito":"No se pudo actualizar el Presupuesto";
		}
    break;

    case 'listar':
        $rspta = $pcs->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
               "0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idpcs.')"><i class="nav-icon icon-pencil" style="color:white" ></i></button> <button class="btn btn-danger" onclick="eliminar('.$reg->idpcs.')"><i class="fa fa-trash"></i></button>'.
 					' <button class="btn btn-primary" onclick="imprimirp('.$reg->idpcs.','.$reg->idrequest_temp.')"><i class="fa fa-print"></i></button>',
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

    case 'mostrar':
        /*ID USUARIO SE ENVIA POR POST ESTA DECLARADO EN LA INICIALIACION*/
        $rspta = $pcs->mostrar($idpcs);
        echo json_encode($rspta);
    break;
 
    case 'listarc':
    $rspta = $pcs->listarc();
    while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' .$reg->idpcs. '>' .$reg->nombre. '</option>';
        }
    break;

    case 'eliminar':
    $rspta = $pcs->eliminar($idpcs);
    echo $rspta ? "Presupuesto eliminado": "El Presupuesto no se puede eliminar, verifique que no este vinculado";
    break;

}
