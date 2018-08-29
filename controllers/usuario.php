<?php
session_start();
require_once("../modelos/Usuario.php");

$usuario = new Usuario();

/*INICIALIZO VARIABLES*/
$idusuario=isset($_POST['idusuario'])? limpiarCadena($_POST['idusuario']):"";

$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";

$login=isset($_POST["login"])? limpiarCadena($_POST["login"]):"";

$clave=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";

$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";

$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";

switch ($_GET["op"]){
    case 'guardaryeditar':
    if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
		{
			$imagen=$_POST["imagenactual"];
		}
		else
		{
			$ext = explode(".", $_FILES["imagen"]["name"]);
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
			{
                if($_FILES["imagen"]["size"]<500000){
				$imagen = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../vistas/img/usuarios/". $imagen);
                }
			}
		}
		//Hash SHA256 en la contrasena
		$clavehash=hash("SHA256",$clave);

		if (empty($idusuario)){
            $rspta=$usuario->insertar($idchofer,$nombre,$login,$clavehash,$email,$imagen,$_POST['permiso']);
            echo $rspta ? "Usuario registrado con exito":"No se pudieron registrar todos los datos del usuario";
		}
		else {
            $rspta=$usuario->editar($idusuario,$idchofer,$nombre,$login,$clavehash,$email,$imagen,$_POST['permiso']);
			echo $rspta ? "Usuario actualizado con exito":"No se pudieron actualizar los datos del usuario";
		}
    break;
    case 'listar':
        $rspta = $usuario->listar();
        $data = Array();
        while($reg = $rspta->fetch_object()){
           $data[]=array(
               "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idusuario.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idusuario.')"><i class="fa fa-check"></i></button>',
               "1"=>$reg->nombre,
               "2"=>$reg->email,
               "3"=>$reg->login,
               "4"=>"<img src='vistas/img/usuarios/".$reg->imagen."' height='50px' width='50px'>",
               "5"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
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
        $rspta = $usuario->mostrar($idusuario);
        echo json_encode($rspta);
    break;

    case 'permisos':
        /*Obtenemos todos los permisos de la tabla permisos*/
		require_once "../modelos/Permiso.php";
		$permiso = new Permiso();
		$rspta = $permiso->listar();

		//Obtener los permisos asignados al usuario
		$id=$_GET['id'];
		$marcados = $usuario->listarmarcados($id);
		//Declaramos el array para almacenar todos los permisos marcados
		$valores=array();

		//Almacenar los permisos asignados al usuario en el array
		while ($per = $marcados->fetch_object())
			{
				array_push($valores, $per->idpermiso);
			}

		//Mostramos la lista de permisos en la vista y si estan o no marcados
		while ($reg = $rspta->fetch_object())
				{
					$sw=in_array($reg->idpermiso,$valores)?'checked':'';
					echo '<li> <input type="checkbox" '.$sw.'  name="permiso[]" value="'.$reg->idpermiso.'"> '.$reg->nombre.'</li>';
				}
    break;
        
    case 'desactivar':
      $rspta = $usuario->desactivar($idusuario);
      echo $rspta ? "Usuario desativado": "El usuario no se puede desactivar";
    break;
        
    case 'activar':
    $rspta = $usuario->activar($idusuario);
    echo $rspta ? "Usuario activado": "El usuario no se puede activar";
    break;
        
    case 'salir':
		//Limpiamos las variables de sesion   
    session_unset();
        //Destruimos la sesion
    session_destroy();
        //Redireccionamos al login
    header("Location: ../inicio");
	break;
    
    case 'verificar':
		$logina=$_POST['logina'];
	    $clavea=$_POST['clavea'];

	    //Hash SHA256 en la contrasena
		$clavehash=hash("SHA256",$clavea);

		$rspta=$usuario->verificar($logina, $clavehash);

		$fetch=$rspta->fetch_object();

		if (isset($fetch))
	    {

			//Declaramos las variables de sesion
			$_SESSION['idusuario']=$fetch->idusuario;
			$_SESSION['nombre']=$fetch->nombre;
			$_SESSION['imagen']=$fetch->imagen;
            $_SESSION['login']=$fetch->login;
            $_SESSION['validarTSM']=1;

	        //Obtenemos los permisos del usuario
	    	$marcados = $usuario->listarmarcados($fetch->idusuario);

	    	//Declaramos el array para almacenar todos los permisos marcados
			$valores=array();

			//Almacenamos los permisos marcados en el array
			while ($per = $marcados->fetch_object())
				{
					array_push($valores, $per->idpermiso);
				}

			//Determinamos los accesos del usuario
			in_array(1,$valores)?$_SESSION['escritorio']=1:$_SESSION['escritorio']=0;
			in_array(2,$valores)?$_SESSION['boletas']=1:$_SESSION['boletas']=0;
			in_array(3,$valores)?$_SESSION['ingresar']=1:$_SESSION['ingresar']=0;
			in_array(4,$valores)?$_SESSION['documentos']=1:$_SESSION['documentos']=0;
			in_array(5,$valores)?$_SESSION['carteleras']=1:$_SESSION['carteleras']=0;
			in_array(6,$valores)?$_SESSION['alertas']=1:$_SESSION['alertas']=0;
			in_array(7,$valores)?$_SESSION['permisos']=1:$_SESSION['permisos']=0;
			in_array(8,$valores)?$_SESSION['prontopago']=1:$_SESSION['prontopago']=0;			
			in_array(9,$valores)?$_SESSION['reportes']=1:$_SESSION['reportes']=0;
	}
	echo json_encode($fetch); 

	break;
        
    case 'selectChofer':
        require_once "../modelos/Chofer.php";
        $chofer = new Chofer();
        $rspta = $chofer->select();
    while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' .$reg->idchofer. '>' .$reg->nombre. '</option>';
        }
	break;
	
	case 'contador':
    $rspta = $usuario->contador();
    echo $rspta;
    break;

}