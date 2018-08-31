<?php
session_start();
require_once("../modelos/Clientes.php");

$cliente = new Clientes();

/*INICIALIZO VARIABLES*/

$idcliente=isset($_POST['idcliente'])? limpiarCadena($_POST['idcliente']):"";

$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";

$telefono=isset($_POST['telefono'])? limpiarCadena($_POST['telefono']):"";

$nfiscal=isset($_POST['nfiscal'])? limpiarCadena($_POST['nfiscal']):"";

$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";

$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";

switch ($_GET["op"]){
    case 'guardaryeditar':
		if (empty($idcliente)){
            $rspta=$cliente->insertar($nombre,$nfiscal,$direccion,$telefono);
            echo $rspta ? "Cliente registrado con exito":"No se pudieron registrar todos los datos del cliente";
		}
		else {
            $rspta=$cliente->editar($idcliente,$nombre,$nfiscal,$direccion,$telefono);
			echo $rspta ? "Cliente actualizado con exito":"No se pudieron actualizar los datos del cliente";
		}
    break;

    case 'listar':
        $rspta = $cliente->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
               "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idcliente.')"><i class="nav-icon icon-pencil" style="color:white" ></i></button> <button class="btn btn-danger" onclick="eliminar('.$reg->idcliente.')"><i class="fa fa-trash"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idcliente.')"><i class="fa fa-times"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$reg->idcliente.')"><i class="nav-icon icon-pencil"  style="color:white" ></i></button> <button class="btn btn-danger" onclick="eliminar('.$reg->idcliente.')"><i class="fa fa-trash"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idcliente.')"><i class="fa fa-check"></i></button>',
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
        $rspta = $cliente->mostrar($idcliente);
        echo json_encode($rspta);
    break;

    case 'desactivar':
      $rspta = $cliente->desactivar($idcliente);
      echo $rspta ? "Cliente desativado": "El cliente no se puede desactivar";
    break;

    case 'activar':
    $rspta = $cliente->activar($idcliente);
    echo $rspta ? "Cliente activado": "El cliente no se puede activar";
    break;
    
    case 'listarc':
    $rspta = $cliente->listarc();
    while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' .$reg->idcliente. '>' .$reg->nombre. '</option>';
        }
    break;

    case 'eliminar':
    $rspta = $cliente->eliminar($idcliente);
    echo $rspta ? "Cliente eliminado": "El cliente no se puede eliminar, verifique que no este vinculado";
    break;
        

}
