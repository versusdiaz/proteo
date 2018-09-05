<?php
session_start();
require_once("../modelos/Centro.php");

$centro = new Centro();

/*INICIALIZO VARIABLES*/

$idcentro=isset($_POST['idcentro'])? limpiarCadena($_POST['idcentro']):"";

$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";


switch ($_GET["op"]){
    case 'guardaryeditar':
		if (empty($idcentro)){
            $rspta=$centro->insertar($nombre);
            echo $rspta ? "Centro registrado con exito":"No se pudieron registrar todos los datos del Centro";
		}
		else {
            $rspta=$centro->editar($idcentro,$nombre);
			echo $rspta ? "Centro actualizado con exito":"No se pudieron actualizar los datos del Centro";
		}
    break;

    case 'listar':
        $rspta = $centro->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
               "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idcentro.')"><i class="nav-icon icon-pencil" style="color:white" ></i></button> <button class="btn btn-danger" onclick="eliminar('.$reg->idcentro.')"><i class="fa fa-trash"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idcentro.')"><i class="fa fa-times"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$reg->idcentro.')"><i class="nav-icon icon-pencil"  style="color:white" ></i></button> <button class="btn btn-danger" onclick="eliminar('.$reg->idcentro.')"><i class="fa fa-trash"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idcentro.')"><i class="fa fa-check"></i></button>',
               "1"=>$reg->nombre,
               "2"=>($reg->condicion)?'<span class="badge badge-success">Activado</span>':'<span class="badge badge-danger">Desactivado</span>'
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
        $rspta = $centro->mostrar($idcentro);
        echo json_encode($rspta);
    break;

    case 'desactivar':
      $rspta = $centro->desactivar($idcentro);
      echo $rspta ? "Centro desactivado": "El Centro no se puede desactivar";
    break;

    case 'activar':
    $rspta = $centro->activar($idcentro);
    echo $rspta ? "Centro activado": "El Centro no se puede activar";
    break;
    
    case 'listarc':
    $rspta = $centro->listarc();
    while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' .$reg->idcentro. '>' .$reg->nombre. '</option>';
        }
    break;

    case 'eliminar':
    $rspta = $centro->eliminar($idcentro);
    echo $rspta ? "Centro eliminado": "El Centro no se puede eliminar, verifique que no este vinculado";
    break;
        

}
