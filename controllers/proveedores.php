<?php
session_start();
require_once("../modelos/Proveedores.php");

$proveedor = new Proveedores();

/*INICIALIZO VARIABLES*/

$idproveedor=isset($_POST['idproveedor'])? limpiarCadena($_POST['idproveedor']):"";

$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";

$telefono=isset($_POST['telefono'])? limpiarCadena($_POST['telefono']):"";

$nfiscal=isset($_POST['nfiscal'])? limpiarCadena($_POST['nfiscal']):"";

$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";

$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";

switch ($_GET["op"]){
    case 'guardaryeditar':
		if (empty($idproveedor)){
            $rspta=$proveedor->insertar($nombre,$nfiscal,$direccion,$telefono);
            echo $rspta ? "Proveedor registrado con exito":"No se pudieron registrar todos los datos del proveedor";
		}
		else {
            $rspta=$proveedor->editar($idproveedor,$nombre,$nfiscal,$direccion,$telefono);
			echo $rspta ? "Proveedor actualizado con exito":"No se pudieron actualizar los datos del proveedor";
		}
    break;

    case 'listar':
        $rspta = $proveedor->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
               "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idproveedor.')"><i class="nav-icon icon-pencil" style="color:white" ></i></button> <button class="btn btn-danger" onclick="eliminar('.$reg->idproveedor.')"><i class="fa fa-trash"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idproveedor.')"><i class="fa fa-times"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$reg->idproveedor.')"><i class="nav-icon icon-pencil"  style="color:white" ></i></button> <button class="btn btn-danger" onclick="eliminar('.$reg->idproveedor.')"><i class="fa fa-trash"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idproveedor.')"><i class="fa fa-check"></i></button>',
               "1"=>$reg->nombre,
               "2"=>$reg->nfiscal,
               "3"=>$reg->telefono,
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
        $rspta = $proveedor->mostrar($idproveedor);
        echo json_encode($rspta);
    break;

    case 'desactivar':
      $rspta = $proveedor->desactivar($idproveedor);
      echo $rspta ? "Proveedor desativado": "El cliente no se puede desactivar";
    break;

    case 'activar':
    $rspta = $proveedor->activar($idproveedor);
    echo $rspta ? "Cliente activado": "El cliente no se puede activar";
    break;
    
    case 'listarc':
    $rspta = $proveedor->listarc();
    while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' .$reg->idproveedor. '>' .$reg->nombre. '</option>';
        }
    break;

    case 'eliminar':
    $rspta = $proveedor->eliminar($idproveedor);
    echo $rspta ? "Cliente eliminado": "El cliente no se puede eliminar, verifique que no este vinculado";
    break;
        

}
