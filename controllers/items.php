<?php
session_start();
require_once("../modelos/Items.php");

$item = new Items();

/*INICIALIZO VARIABLES*/

$iditem=isset($_POST['iditem'])? limpiarCadena($_POST['iditem']):"";

$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";

$precio_nac=isset($_POST['precio_nac'])? limpiarCadena($_POST['precio_nac']):"";

$precio_usd=isset($_POST['precio_usd'])? limpiarCadena($_POST['precio_usd']):"";

$stock=isset($_POST['stock'])? limpiarCadena($_POST['stock']):"";

$stock_min=isset($_POST['stock_min'])? limpiarCadena($_POST['stock_min']):"";

$stock_max=isset($_POST['stock_max'])? limpiarCadena($_POST['stock_max']):"";

$unidad=isset($_POST['unidad'])? limpiarCadena($_POST['unidad']):"";

$detalle=isset($_POST['detalle'])? limpiarCadena($_POST['detalle']):"";

switch ($_GET["op"]){
    case 'guardaryeditar':
		if (empty($iditem)){
            $rspta=$item->insertar($nombre,$precio_nac,$precio_usd,$stock,$stock_min,$stock_max,$unidad,$detalle);
            echo $rspta ? "Item registrado con exito":"No se pudieron registrar todos los datos del Item";
		}
		else {
            $rspta=$item->editar($nombre,$precio_nac,$precio_usd,$stock,$stock_min,$stock_max,$unidad,$detalle);
			echo $rspta ? "Item actualizado con exito":"No se pudieron actualizar los datos del Item";
		}
    break;

    case 'listar':
        $rspta = $item->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
               "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->iditem.')"><i class="nav-icon icon-pencil" style="color:white" ></i></button> <button class="btn btn-danger" onclick="eliminar('.$reg->iditem.')"><i class="fa fa-trash"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->iditem.')"><i class="fa fa-times"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$reg->iditem.')"><i class="nav-icon icon-pencil"  style="color:white" ></i></button> <button class="btn btn-danger" onclick="eliminar('.$reg->iditem.')"><i class="fa fa-trash"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->iditem.')"><i class="fa fa-check"></i></button>',
               "1"=>$reg->nombre,
               "2"=>$reg->precio_nac,
               "3"=>$reg->precio_usd,
               "4"=>($reg->condicion)?'<span class="badge badge-success">Activado</span>':'<span class="badge badge-danger">Desactivado</span>'
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
        $rspta = $item->mostrar($iditem);
        echo json_encode($rspta);
    break;

    case 'desactivar':
      $rspta = $item->desactivar($iditem);
      echo $rspta ? "Item desativado": "El Item no se puede desactivar";
    break;

    case 'activar':
    $rspta = $item->activar($iditem);
    echo $rspta ? "Item activado": "El Item no se puede activar";
    break;
    
    case 'listarc':
    $rspta = $item->listarc();
    while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' .$reg->iditem. '>' .$reg->nombre. '</option>';
        }
    break;

    case 'eliminar':
    $rspta = $item->eliminar($iditem);
    echo $rspta ? "Item eliminado": "El Item no se puede eliminar, verifique que no este vinculado";
    break;
        

}
