<?php
session_start();
require_once("../modelos/Servicios.php");

$servicio = new Servicios();

/*INICIALIZO VARIABLES*/

$idservicios=isset($_POST['idservicios'])? limpiarCadena($_POST['idservicios']):"";

$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";

$precio_nac=isset($_POST['precio_nac'])? limpiarCadena($_POST['precio_nac']):"";

$precio_usd=isset($_POST['precio_usd'])? limpiarCadena($_POST['precio_usd']):"";

switch ($_GET["op"]){
    case 'guardaryeditar':
		if (empty($idservicios)){
            $rspta=$servicio->insertar($nombre,$precio_nac,$precio_usd);
            echo $rspta ? "Servicios registrado con exito":"No se pudieron registrar todos los datos del Servicios";
		}
		else {
            $rspta=$servicio->editar($idservicios,$nombre,$precio_nac,$precio_usd);
			echo $rspta ? "Servicios actualizado con exito":"No se pudieron actualizar los datos del Servicios";
		}
    break;

    case 'listar':
        $rspta = $servicio->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
               "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idservicios.')"><i class="nav-icon icon-pencil" style="color:white" ></i></button> <button class="btn btn-danger" onclick="eliminar('.$reg->idservicios.')"><i class="fa fa-trash"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idservicios.')"><i class="fa fa-times"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$reg->idservicios.')"><i class="nav-icon icon-pencil"  style="color:white" ></i></button> <button class="btn btn-danger" onclick="eliminar('.$reg->idservicios.')"><i class="fa fa-trash"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idservicios.')"><i class="fa fa-check"></i></button>',
               "1"=>$reg->nombre,
               "2"=>$reg->precio_nac.' Bs.S',
               "3"=>$reg->precio_usd.' $ ',
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
        $rspta = $servicio->mostrar($idservicios);
        echo json_encode($rspta);
    break;

    case 'desactivar':
      $rspta = $servicio->desactivar($idservicios);
      echo $rspta ? "Servicios desactivado": "El Servicios no se puede desactivar";
    break;

    case 'activar':
    $rspta = $servicio->activar($idservicios);
    echo $rspta ? "Servicios activado": "El Servicios no se puede activar";
    break;
    
    case 'listarc':
    $rspta = $servicio->listarc();
    while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' .$reg->idservicios. '>' .$reg->nombre. '</option>';
        }
    break;

    case 'eliminar':
    $rspta = $servicio->eliminar($idservicios);
    echo $rspta ? "Servicios eliminado": "El Servicios no se puede eliminar, verifique que no este vinculado";
    break;
        

}
